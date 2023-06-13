@extends('backend.main')
@section('title')
Dokumen
@endsection
@section('content')
    <div class="page-content container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <!-- basic table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Dokumen</h4>
                        <form class="mt-4" method="post"
                            action="{{ route('dokumen.update', [$docs->id]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @include('backend.include.alert')
                            @method('put')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nama_dokumen">Nama Dokumen</label>
                                        <input type="text" value="{{ $docs->doc_name }}"
                                            class="form-control" id="nama_dokumen" name="nama_dokumen">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="pertanyaan">Pertanyaan</label><br>
                                        <select name="pertanyaan" id="pertanyaan" class="form-control">
                                            <option value="" hidden disabled>Pilih Pertanyaan</option>
                                            @foreach($pertanyaan as $row)
                                                <option value="{{ $row->id }}" @if($row->id === $docs->question_id) selected @endif>{{$loop->iteration}}. {{ $row->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="keterangan_dokumen">Keterangan</label>
                                        <textarea class="form-control" id="keterangan_dokumen" name="keterangan_dokumen" rows="3">{{ $docs->doc_info }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="Dokumen">File Dokumen</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="file">File</label>
                                        <br>
                                        <a href="{{ asset('storage/docs/' . $docs->doc_file) }}"
                                            target="blank">{{ $docs->doc_file }}</a>
                                    </div>
                                </div>
                                <div class="col-md-2" style="margin-top:30px">
                                    <button type="button" class="btn btn-danger btnHapus btn-block"><i
                                            class="fas fa-trash"></i></button>
                                </div>

                            </div>
                            <div id="datasub">

                            </div>
                            <button type="button" id="btnTambah" class="btn btn-outline-primary btn-block btntambah mt-3" hidden disabled>Tambah
                                Dokumen</button>

                            <div class="row mt-3">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            
            $('#btnTambah').on('click', function(){
            })

            $('#table-siswa').DataTable()

            $('.btntambah').on('click', function() {
                // var nilai = $('#nilai').val()
                $('.btnHapus').prop('disabled', false);
                $('.btnHapus').prop('hidden', false);
                var nilai = 0
                var hide = $('#datasub').find('input[type=hidden]')
                var maxIndex;
                maxIndex = hide.length - 1;
                nilai = maxIndex + 2
                var tambah = parseInt(nilai);
                var datahtml = `<div class="row">
                                <input type="hidden" name="nilai" id="nilai" value="${tambah}">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="file">File</label>
                                        <input type="file" class="form-control" required id="file"
                                            name="file_dokumen[]">
                                    </div>
                                </div>

                                <div class="col-md-2" style="margin-top:30px" >
                                    <button type="button" class="btn btn-danger btnHapus btn-block"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>`
                $('#datasub').append(datahtml)
                $(this).prop('disabled', false);
                $(this).prop('hidden', false);
            })

            $(document).on('click', '.btnHapus', function() {
                $('#btnTambah').prop('disabled', false);
                $('#btnTambah').prop('hidden', false);
                $(this).closest('.row').remove();
            })
        })
    </script>
@endpush
