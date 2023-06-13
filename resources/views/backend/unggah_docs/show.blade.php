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
                        <h4 class="card-title">Detail Dokumen</h4>
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
                                        <input type="text" readonly value="{{ $docs->doc_name }}"
                                            class="form-control" id="nama_dokumen" name="nama_dokumen">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="pertanyaan">Pertanyaan</label>
                                        <input type="text" readonly value="{{ $docs->pertanyaan->name }}"
                                            class="form-control" id="pertanyaan" name="pertanyaan">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="keterangan_dokumen">Keterangan</label>
                                        <textarea class="form-control" readonly id="keterangan_dokumen" name="keterangan_dokumen" rows="3">{{ $docs->doc_info }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div id="datasub">
                                <div class="row">
                                    <input type="hidden" name="file_dokumen" value="{{ $docs->doc_file }}">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="file">File</label>
                                            <br>
                                            <a href="{{ asset('storage/docs/' . $docs->doc_file) }}"
                                                target="blank">{{ $docs->doc_file }}</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12 text-center">
                                    <a href="{{ route('dokumen.index') }}" class="btn btn-primary">Close</a>

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
            $('#table-siswa').DataTable()
        })
    </script>
@endpush
