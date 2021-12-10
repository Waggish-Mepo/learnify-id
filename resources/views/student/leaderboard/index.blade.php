@extends('layouts.app')

@section('content')
<div class="block-header">
    <h4 class="text-white my-sm-3 my-2 text-capitalize">leaderboard {{$schoolDetail['name']}} kelas {{$user->grade}}</h4>
    <div class="row clearfix mt-2">
        <div class="col-md-4 mt-2 mb-3">
            <div class="d-flex flex-column m-auto rounded bg-white shadow">
                <div class="bg-white color-black pt-3 px-3 text-center text-capitalize">
                    <h5 class="mt-1">{{ $user->name }}</h5>
                    <p>{{ $user->nis ? $user->nis : '-'  }} </p>
                    <div class="mt-2 font-20 font-weight-bold d-flex flex-column">
                        <p>peringkat
                            <br>
                            #{{ $currentUserRank}}
                        </p>
                    </div>
                </div>
                <div class="bg-blur-grey pt-3 pb-0 px-5 d-flex justify-content-between align-items-center">
                    <div class="pl-2">
                        <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded cursor-pointer ml-2" data-toggle="tooltip" data-placement="top" title="xp"><img src="{{asset('assets/images/xp.svg')}}"></div>
                        <p class="text-dark text-center pt-2 pl-2">{{$experience->experience_point}}</p>
                    </div>
                    <div class="pr-2">
                        <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded cursor-pointer ml-2" data-toggle="tooltip" data-placement="top" title="level"><img src="{{asset('assets/images/level.svg')}}"></div>
                        <p class="text-dark text-center pt-2 pl-2">{{$experience->level}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="table-responsive">
                <table class="table table-hover table-custom spacing8">
                    <thead>
                        <tr>
                            <th>Peringkat</th>
                            <th>Nama</th>
                            <th>XP</th>
                            <th>Level</th>
                            <th>Kelas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>#{{$student['rank_order']}}</td>
                                <td>
                                    <h6 class="mb-0">{{$student['user']['name']}}</h6>
                                    <span>{{$student['user']['nis'] ? $student['user']['nis'] : '-'}}</span>
                                </td>
                                <td>{{$student['experience_point']}}</td>
                                <td>{{$student['level']}}</td>
                                <td>{{$student['grade']}}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/pages/custom.js')}}"></script>
@endsection
