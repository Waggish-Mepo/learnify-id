{{-- ini nanti diganti aja request nya yaa sesuai data dr controller --}}
<li class="{{ Request::is('subject/*') && request()->route('subject_id') == 'matematika' ? 'active' : '' }}">
    <a href="{{ url('/subject/'.'matematika') }}"><i class="icon-book-open"></i><span>Matematika | XII</span></a>
</li>
<li class="{{ Request::is('subject/*') && request()->route('subject_id') == 'bahasa_indonesia' ? 'active' : '' }}">
    <a href=""><i class="icon-book-open"></i><span>Bahasa Indonesia | XII</span></a>
</li>