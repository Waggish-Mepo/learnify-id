@extends('layouts.app')

@section('content')
<div class="block-header">
    <div class="row clearfix mb-4">
        <div class="col-md-6 col-sm-12">
            <a href="{{ route('teacher.progress-siswa') }}" class="text-dark"><i class="icon-arrow-left text-dark mr-2"></i>Kembali</a>
            <nav aria-label="breadcrumb" class="mt-2">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('teacher.progress-siswa') }}">Progress Siswa</a></li>
                <li class="breadcrumb-item"><a href="{{ route('teacher.progress.subject.course', ['subject_id' => $subject['id'],'course_id' => $course['id']]) }}">List Bab</a></li>
                <li class="breadcrumb-item active" aria-current="page">Progress Siswa</li>
                </ol>
            </nav>
        </div>
    </div>
        <div class="row mt-3">
            <div class="col-lg-12">
            <h5 class="color-blue-2 font-weight-bold text-uppercase">Progress Siswa Bab {{$topic['name']}}</h5>
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#content">Ulasan</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#exercise">Latihan</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#exam">Ulangan</a></li>
                </ul>
                <div class="tab-content mt-0">
                    <div class="tab-pane show active" id="content">
                        <div class="table-responsive">
                            <table class="table table-hover table-custom spacing8">
                                @if ($contents)
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Ulasan</th>
                                        <th>Status</th>
                                        <th>Tanggal Baca</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contents as $content)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            <h6 class="mb-0">{{$content['student_name']}}</h6>
                                            <span>{{$content['student_email']}}</span>
                                        </td>
                                        <td>{{$content['name']}}</td>
                                        <td><span class="badge badge-success">Sudah Dibaca</span></td>
                                        <td>{{date('d-m-Y', strtotime($content['created_at']))}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                @else
                                    <h5 class="color-blank my-3 text-center">Data Kosong</h5>
                                @endif
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="exercise">
                        <div class="table-responsive">
                            <table class="table table-hover table-custom spacing8">
                                @if ($activities)
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Latihan</th>
                                        <th>Skor</th>
                                        <th>Predikat</th>
                                        <th>Tanggal Pengerjaan</th>
                                        {{-- <th>Latihan Terselesaikan</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($activities as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            <h6 class="mb-0">{{$item['student_name']}}</h6>
                                            <span>{{$item['student_email']}}</span>
                                        </td>
                                        <td>{{$item['name']}}</td>
                                        <td>{{$item['score']}}</td>
                                        @if ($item['score'] >= 85)
                                            <td>A</td>
                                        @elseif ($item['score'] >= 75)
                                            <td>B</td>
                                        @else
                                            <td>C</td>
                                        @endif
                                        {{-- <td>
                                            <div class="progress ml-1 rounded-0 w-progress">
                                                <div class="progress-bar-info" role="progressbar" style="width : {{$item['percen']*100/$item['total_exercise']}}%" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td> --}}
                                        <td>{{date('d-m-Y', strtotime($item['created_at']))}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                @else
                                    <h5 class="color-blank my-3 text-center">Data Kosong</h5>
                                @endif
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="exam">
                        <div class="table-responsive">
                            <table class="table table-hover table-custom spacing8">
                                @if ($exams)
                                <a href="{{ route('sendNotif', ['activity_id'=>$exams[0]["activity_id"]]) }}" class="btn bg-blue-2 text-white my-3 float-left text-capitalize"><i class="fa fa-upload mr-2"></i>Bagikan Nilai</a>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Ulangan</th>
                                        <th>Skor</th>
                                        <th>Predikat</th>
                                        <th>Tanggal Pengerjaan</th>
                                        {{-- <th>Latihan Terselesaikan</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($exams as $exam)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            <h6 class="mb-0">{{$exam['student_name']}}</h6>
                                            <span>{{$exam['student_email']}}</span>
                                        </td>
                                        <td>{{$exam['name']}}</td>
                                        <td>{{$exam['score']}}</td>
                                        @if ($exam['score'] >= 85)
                                            <td>A</td>
                                        @elseif ($exam['score'] >= 75)
                                            <td>B</td>
                                        @else
                                            <td>C</td>
                                        @endif
                                        <td>{{date('d-m-Y', strtotime($exam['created_at']))}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                @else
                                    <h5 class="color-blank my-3 text-center">Data Kosong</h5>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
</div>
@endsection

@section('script')

@endsection
