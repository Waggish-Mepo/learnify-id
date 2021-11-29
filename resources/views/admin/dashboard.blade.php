@extends('layouts.app')

@section('content')
<div class="block-header">
    <div class="row clearfix">
        <div class="col-md-6 col-sm-12">
            <h1 class="color-blue-2 font-weight-bold my-4" style="font-size: 1.8rem;">Dashboard</h1>
        </div>
    </div>
</div>

<div class="row clearfix">
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="body">
                <div class="d-flex align-items-center">
                    <div class="icon-in-bg bg-indigo text-white rounded-circle"><i class="icon-user"></i></div>
                    <div class="ml-4">
                        <span>Akun Siswa</span>
                        <h4 class="mb-0 font-weight-medium total-student">0</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="body">
                <div class="d-flex align-items-center">
                    <div class="icon-in-bg bg-azura text-white rounded-circle"><i class="icon-user"></i></div>
                    <div class="ml-4">
                        <span>Akun Guru</span>
                        <h4 class="mb-0 font-weight-medium total-teacher">0</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="body">
                <div class="d-flex align-items-center">
                    <div class="icon-in-bg bg-orange text-white rounded-circle"><i class="icon-user"></i></div>
                    <div class="ml-4">
                        <span>Akun Admin</span>
                        <h4 class="mb-0 font-weight-medium total-admin">0</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="body">
                <div class="d-flex align-items-center">
                    <div class="icon-in-bg bg-success text-white rounded-circle"><i class="icon-user"></i></div>
                    <div class="ml-4">
                        <span>Total Akun</span>
                        <h4 class="mb-0 font-weight-medium">{{count($users)}}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row clearfix">
    <div class="col-sm-12">
        <div class="card">
            <div class="body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">Statistik Akun</h6>
                    </div>
                    <ul class="nav nav-tabs2">
                        <li class="nav-item"><a class="nav-link active">Bulan</a></li>
                    </ul>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <small>Laporan kenaikan jumlah akun siswa dan guru perbulan</small>
                        <div class="d-flex justify-content-start mt-3">
                            <div class="mr-5">
                            <label class="mb-0">Siswa</label>
                            <h4 class="total-student">0</h4>
                            </div>
                            <div>
                            <label class="mb-0">Guru</label>
                            <h4 class="total-teacher">0</h4>
                            </div>
                        </div>
                        <div id="chart-donut-stats" style="height: 250px"></div>
                    </div>
                    <div class="col-lg-8 col-md-12 col-sm-12">
                        <div id="chart-flot-stats" class="flot-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/bundles/flotscripts.bundle.js')}}"></script>
<script src="{{asset('assets/bundles/jvectormap.bundle.js')}}"></script>
<script src="{{asset('assets/bundles/knob.bundle.js')}}"></script>

<script src="{{asset('assets/js/index4.js')}}"></script>

<script>
    const months = [01, 02, 03, 04, 05, 06, 07, 08, 09, 10, 11, 12];
    let teacher_stats = [[1,0], [2,0], [3,0], [4,0], [5,0], [6,0], [7,0], [8,0], [9,0], [10,0], [11,0], [12,0],];
    let student_stats = [[1,0], [2,0], [3,0], [4,0], [5,0], [6,0], [7,0], [8,0], [9,0], [10,0], [11,0], [12,0],];

    const users = {!! json_encode($users) !!};
    let totalAdmin = 0;
    let totalTeacher = 0;
    let totalStudent = 0;

    for (let i = 0; i < users.length; i++) {
        if (users[i]['role'] === 'ADMIN'){
            totalAdmin += 1;
            $('.total-admin').html(totalAdmin);
        }
        if (users[i]['role'] === 'TEACHER'){
            totalTeacher += 1;
            $('.total-teacher').html(totalTeacher);

            if (months.includes(parseInt(users[i]['created_at'].substr(5, 2)))) {
                let digit = 3
                let month = users[i]['created_at'].substr(5, 2);

                if (month < 10) digit = 2;
                let totalInMonth = String(teacher_stats[month - 1]).substr(digit);

                teacher_stats[month - 1] = [month, (parseInt(totalInMonth) + 1)];
            }
        }
        if (users[i]['role'] === 'STUDENT'){
            totalStudent += 1;
            $('.total-student').html(totalStudent);
            if (months.includes(parseInt(users[i]['created_at'].substr(5, 2)))) {
                let digit = 3;
                let month = parseInt(users[i]['created_at'].substr(5, 2));

                if (month < 10) digit = 2;
                let totalInMonth = String(student_stats[month - 1]).substr(digit);

                student_stats[month - 1] = [month, (parseInt(totalInMonth) + 1)];
            }
        }
    }


    c3.generate({
        bindto: '#chart-donut-stats',
        data: {
            columns: [
                ['data1', totalTeacher],
                ['data2', totalStudent]
            ],
            type: 'donut',
            colors: {
                'data1': '#17C2D7',
                'data2': '#9367B4',
            },
            names: {
                // name of each serie
                'data1': 'Guru',
                'data2': 'Murid'
            }
        },
        axis: {
        },
        legend: {
            show: false,
        },
        padding: {
            bottom: 20,
            top: 0
        },
    });


    $.plot('#chart-flot-stats', [{
            data: teacher_stats,
            color: '#17C2D7',
            lines: {
            fillColor: { colors: [{ opacity: 0 }, { opacity: 0.2 }]}
            }
        },{
            data: student_stats,
            color: '#9367B4',
            lines: {
            fillColor: { colors: [{ opacity: 0 }, { opacity: 0.2 }]}
            }
        }], 
        {
            series: {
                shadowSize: 0,
                lines: {
                    show: true,
                    lineWidth: 2,
                    fill: true
                }
            },
            grid: {
                borderWidth: 0,
                labelMargin: 8
            },
            yaxis: {
                show: true,
                        min: 0,
                        max: 100,
                ticks: [[0,''],[20,'25'],[50,'50'],[75,'75'],[100,'100']],
            
            },
            xaxis: {
                show: true,
                ticks: [[1, 'JAN'],[2,'FEB'],[3,'MAR'],[4,'APR'],[5,'MEI'],[6, 'JUN'],[7,'JUL'],[8,'AGU'],[9,'SEP'],[10,'OKT'],[11,'NOV'],[12,'DES']],
            }
        });
</script>
@endsection
