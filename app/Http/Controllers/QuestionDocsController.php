<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\QuestionDocs;
use App\Question;

class QuestionDocsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $docs = QuestionDocs::all();

        return view('backend.unggah_docs.index', ['docs' => $docs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pertanyaan = Question::get();
        return view('backend.unggah_docs.create', ['pertanyaan' => $pertanyaan]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_dokumen' => 'required',
            'keterangan_dokumen' => 'required',
            'file_dokumen.*' => 'required|file',
            'file_dokumen' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {

            if ($request->hasFile('file_dokumen')) {
                $file = $request->file('file_dokumen');
                foreach ($file as $key => $value) {
                    $dokumen = $value->getClientOriginalName();
                    $filename = pathinfo($dokumen, PATHINFO_FILENAME);
                    $extension = $value->getClientOriginalExtension();
                    $filenameSimpan = $filename . '_' . time() . $this->genRandom() . '.' . $extension;
                    $path = $value->storeAs("public/docs", $filenameSimpan);
                    $docs = new QuestionDocs();
                    $docs->question_id = $request->get('pertanyaan');
                    $docs->doc_name = $request->get('nama_dokumen');
                    $docs->doc_info = $request->get('keterangan_dokumen');
                    $docs->doc_file = $filenameSimpan;
                    $docs->save();
                }
            }

            return redirect()->route('dokumen.index')->with('success', 'Data Dokumen berhasil disimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $docs = QuestionDocs::findOrFail($id);

        return view('backend.unggah_docs.show', ['docs' => $docs]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $docs = QuestionDocs::findOrFail($id);
        $pertanyaan = Question::get();
        return view('backend.unggah_docs.edit', ['docs' => $docs, 'pertanyaan' => $pertanyaan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_dokumen' => 'required',
            'keterangan_dokumen' => 'required',
            'file_dokumen.*' => 'nullable|file',
            'file_dokumen' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            $docs = QuestionDocs::findOrFail($id);

            $docs->question_id = $request->get('pertanyaan');
            $docs->doc_name = $request->get('nama_dokumen');
            $docs->doc_info = $request->get('keterangan_dokumen');
            
            if ($request->hasFile('file_dokumen')) {
                unlink(storage_path('app/public/docs/' . $docs->doc_file));
                $file = $request->file('file_dokumen');
                foreach ($file as $key => $value) {
                    $dokumen = $value->getClientOriginalName();
                    $filename = pathinfo($dokumen, PATHINFO_FILENAME);
                    $extension = $value->getClientOriginalExtension();
                    $filenameSimpan = $filename . '_' . time() . $this->genRandom() . '.' . $extension;
                    $path = $value->storeAs("public/docs", $filenameSimpan);
                    $docs->doc_file = $filenameSimpan;
                }
            }
            else{
                unlink(storage_path('app/public/docs/' . $docs->doc_file));
                $docs->doc_file = null;
            }
            $docs->save();
            return redirect()->route('dokumen.index')->with('success', 'Data Dokumen berhasil diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $docs = QuestionDocs::findOrFail($id);
            // unlink(storage_path('app/public/docs/'.$docs->doc_file));    
            $docs->delete();
            $request->session()->flash('success', 'Data Dokumen berhasil dihapus!');
            return response()->json(['status' => true]);
        }
    }

    public function genRandom()
    {
        $a = mt_rand(100000, 999999);
        return $a;
    }
}
