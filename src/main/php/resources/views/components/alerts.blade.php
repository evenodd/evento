<div id="alertPanel">
    @if(isset($status) && isset($msg))                            
        <div id="alert-with-view" class="fade-in alert alert-{{ $status }}">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            {{ $msg }}
        </div>
        {{ $slot }}
    @endif
</div>