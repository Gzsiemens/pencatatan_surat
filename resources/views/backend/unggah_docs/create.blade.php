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
                        <h4 class="card-title">Tambah Dokumen</h4>
                        <form class="mt-4" method="post" action="{{ route('dokumen.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @include('backend.include.alert')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nama_dokumen">Nama Dokumen</label>
                                        <input type="text" value=""
                                            class="form-control" id="nama_dokumen" name="nama_dokumen"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="pertanyaan">Pertanyaan</label><br>
                                        <select name="pertanyaan" id="pertanyaan" class="form-control">
                                            <option value="" selected hidden disabled>Pilih Pertanyaan</option>
                                            @foreach($pertanyaan as $row)
                                                <option value="{{ $row->id }}">{{$loop->iteration}}. A{{ $row->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="keterangan_dokumen">Keterangan</label>
                                        <textarea class="form-control" id="keterangan_dokumen" name="keterangan_dokumen" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="dokumen">File Dokumen</label>
                                    </div>
                                </div>
                            </div>
                            <div id="datasub">
                                <div class="row">
                                    <input type="hidden" name="nilai" id="nilai" value="1">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="file">File</label>
                                            <input type="file" class="form-control" required id="file" name="file_dokumen[]">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-block btntambah">Tambah
                                Dokumen</button>

                            <div class="row mt-3">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
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
    $(document).ready(function () {
        $('#table-siswa').DataTable()

        $('.btntambah').on('click', function () {
            // var nilai = $('#nilai').val()
                var nilai = 0
                var hide = $('#datasub').find('input[type=hidden]')
                var maxIndex;
                maxIndex = hide.length - 1;
                nilai = maxIndex+2
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
            })

            $(document).on('click', '.btnHapus',function () {
                $(this).closest('.row').remove();
             })
     })
</script>
@endpush
