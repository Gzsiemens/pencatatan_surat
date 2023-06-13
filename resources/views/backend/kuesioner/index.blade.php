@extends('backend.main')
@section('title')
    Kuesioner
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
                        <h4 class="card-title">Isi Kuesioner</h4>
                        <form class="mt-4" method="post" action="{{route('kuesioner.store')}}" enctype="multipart/form-data">
                            @csrf

                            @include('backend.include.alert')

                            @forelse ($pertanyaan as $data)
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="pertanyaan">{{$loop->iteration}}. {{ $data->name }}</label>

                                        </div>
                                    </div>
                                </div>

                                @php($tempValue = 0)
                                @forelse ($data->detail_jawaban as $item)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="jawaban"> <input type="radio" 
                                                    @isset($data->total_docs)
                                                        @isset($item->nilai_minimal)
                                                            @if($item->nilai_minimal <= ($data->dokumen_count / $data->total_docs) * 100 && $tempValue == 0)
                                                                checked 
                                                                {{ $tempValue = 1 }}
                                                            @endif 
                                                        @endisset
                                                    @endisset
                                                    name="jawaban_{{$data->id}}" 
                                                    value="{{$item->id}}" id="jawaban_{{$data->id}}"> ({{ $item->status }}). {{ $item->name }}</label>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                @endforelse
                            @empty
                            @endforelse


                            <div class="row  mt-2">
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
        $(document).ready(function() {
            $('#table-siswa').DataTable()
        })
    </script>
@endpush
