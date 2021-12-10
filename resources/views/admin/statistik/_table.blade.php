<div class="table-responsive" id="panel-{{ request()->route('role') }}" style="display: none;">
    <table class="table table-hover table-custom spacing8">
        <thead>
            <tr>
                <th class="w60">#</th>
                <th>Name</th>
                @if(request()->route('role') === 'STUDENT')
                <th>NIS</th>
                @endif
                @if(request()->route('role') === "STUDENT")
                <th>Kelas</th>
                @endif
                <th>Username</th>
                <th>Status</th>
                <th class="w100">Action</th>
                </tr>
        </thead>
        <tbody id="render-accounts">
            <tr>
                <td class="width45">1</td>
                <td class="width45">
                    <div class="avtar-pic w35 bg-pink" data-toggle="tooltip" data-placement="top" title="Avatar Name"><span>MN</span></div>
                </td>
                <td>
                    <h6 class="mb-0">Marshall Nichols</h6>
                    <span>marshall-n@gmail.com</span>
                </td>
                <td>11220987</td>
                <td>marsha</td>
                <td>active</td>
                <td>
                    <button type="button" class="btn btn-sm btn-default" title="Edit" data-toggle="modal" data-target="#modal-edit-account"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-sm btn-primary js-sweetalert" title="Delete" data-type="reset-password"><i class="fa fa-lock text-white"></i></button>
                </td>
            </tr>
            <tr>
                <td class="width45">2</td>
                <td>
                    <img src="{{asset('assets/images/xs/avatar5.jpg')}}"  data-toggle="tooltip" data-placement="top" title="Avatar Name" alt="Avatar" class="w35 h35 rounded">
                </td>
                <td>
                    <h6 class="mb-0">Susie Willis</h6>
                    <span>sussie-w@gmail.com</span>
                </td>
                <td>11890765</td>
                <td>sussie</td>
                <td>active</td>
                <td>
                    <button type="button" class="btn btn-sm btn-default" title="Edit" data-toggle="modal" data-target="#modal-edit-account"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-sm btn-primary js-sweetalert" title="Delete" data-type="reset-password"><i class="fa fa-lock text-white"></i></button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div class="table-responsive" id="loading-{{ request()->route('role') }}" style="display: none;">
    <table class="table table-hover table-custom spacing8">
        <thead>
            <tr>
                <th class="w60">#</th>
                <th>Name</th>
                @if(request()->route('role') === 'STUDENT')
                <th>NIS</th>
                @endif
                @if(request()->route('role') === "STUDENT" || request()->route('role') === "TEACHER")
                <th>Kelas</th>
                @endif
                <th>Username</th>
                <th>Status</th>
                <th class="w100">Action</th>
                </tr>
        </thead>
        <tbody id="render-accounts">
            <tr>
                <td colspan="6" class="text-center">Mengambil data</td>
            </tr>
        </tbody>
    </table>
</div>

<div class="table-responsive" id="empty-{{ request()->route('role') }}" style="display: none;">
    <table class="table table-hover table-custom spacing8">
        <thead>
            <tr>
                <th class="w60">#</th>
                <th>Name</th>
                @if(request()->route('role') === 'STUDENT')
                <th>NIS</th>
                @endif
                @if(request()->route('role') === "STUDENT")
                <th>Kelas</th>
                @endif
                <th>Username</th>
                <th>Status</th>
                <th class="w100">Action</th>
                </tr>
        </thead>
        <tbody id="render-accounts">
            <tr>
                <td colspan="6" class="text-center">Tidak ada data</td>
            </tr>
        </tbody>
    </table>
</div>
