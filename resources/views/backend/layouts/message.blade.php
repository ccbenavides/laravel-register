<!-- message -->
<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))
      <p class="alert alert-{{ $msg }} capa_error">
		<span class="mif-bell mif-ani-ring mif-ani-slow"></span> &nbsp;
      	{{ Session::get('alert-' . $msg) }}
		<span class="mif-cross move_x"></span>
      </p>
      @endif
    @endforeach

</div> <!-- end .flash-message -->