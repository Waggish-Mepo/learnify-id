<div class="d-flex py-2 xp-bar">
    <div class="d-flex align-items-center ml-2">
        <div class="d-md-flex d-none align-items-center justify-content-center w35 bg-blue-2 rounded cursor-pointer" data-toggle="tooltip" data-placement="top" title="XP"><span class="text-white font-weight-bol">XP</span></div>
        <div class="font-weight-bold ml-1 title-xp">{!! $experience->current_xp !!} XP</div>
    </div>
    <div class="d-flex align-items-center ml-sm-2 ml-1">
        <div class="d-flex align-items-center justify-content-center w-auto px-md-2 px-1 py-md-2 py-1 bg-warning rounded cursor-pointer" data-toggle="tooltip" data-placement="top" title="level XP"><span class="text-white font-weight-bold title-level">Level {!! $experience->level !!}</span></div>
        <div class="progress ml-1 rounded-0 w-progress">
            <div style="width: {!! $experience->current_xp !!}%" class="progress-bar-success" role="progressbar"aria-valuenow="{!! $experience->current_xp !!}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>
</div>
