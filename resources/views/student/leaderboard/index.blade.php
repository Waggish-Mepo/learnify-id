@extends('layouts.app')

@section('content')
<div class="block-header">
    <h4 class="text-white my-sm-3 my-2 text-capitalize">papan prestasi learnify.id</h4>
    <div class="row clearfix mt-2">
        <div class="col-md-4 mt-2 mb-3">
           <div class="d-flex flex-column m-auto rounded bg-white shadow">
               <div class="bg-white color-black pt-3 px-3 text-center text-capitalize">
                   <img src="{{asset('assets/images/login-img.png')}}" alt="Avatar" class="rounded-circle d-block m-auto" width="100">
                   <h5 class="mt-1">Anak Mamah</h5>
                   <p>11907154</p>
                   <div class="mt-2 font-20 font-weight-bold d-flex flex-column">
                        <p>peringkat
                            <br>
                            #5
                        </p>
                   </div>
               </div>
               <div class="bg-blur-grey pt-3 pb-0 px-5 d-flex justify-content-between align-items-center">
                    <div class="pl-2">
                        <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded cursor-pointer ml-2" data-toggle="tooltip" data-placement="top" title="xp"><img src="{{asset('assets/images/xp.svg')}}"></div>
                        <p class="text-dark text-center pt-2 pl-2">3.200</p>
                    </div>
                    <div class="pr-2">
                        <div class="d-flex align-items-center justify-content-center w35 bg-blue-2 rounded cursor-pointer ml-2" data-toggle="tooltip" data-placement="top" title="level"><img src="{{asset('assets/images/level.svg')}}"></div>
                        <p class="text-dark text-center pt-2 pl-2">4</p>
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
                            <th></th>
                            <th>Nama</th>
                            <th>XP</th>
                            <th>Level</th>
                            <th>Kelas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#1</td>
                            <td>
                                <img src="{{asset('assets/images/xs/avatar3.jpg')}}" alt="Avatar" class="w35 h35 rounded">
                            </td>
                            <td>
                                <h6 class="mb-0">Marshall Nichols</h6>
                                <span>marshall-n@gmail.com</span>
                            </td>
                            <td>5000</td>
                            <td>25</td>
                            <td>12</td>
                        </tr>
                        <tr>
                            <td>#2</td>
                            <td>
                                <img src="{{asset('assets/images/xs/avatar5.jpg')}}" alt="Avatar" class="w35 h35 rounded">
                            </td>
                            <td>
                                <h6 class="mb-0">Susie Willis</h6>
                                <span>sussie-w@gmail.com</span>
                            </td>
                            <td>4800</td>
                            <td>25</td>
                            <td>12</td>
                        </tr>
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