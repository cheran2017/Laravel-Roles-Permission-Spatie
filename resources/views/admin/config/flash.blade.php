@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))
    <div class="row">
		<div class="col-12">
			<div class="alert alert-{{ $msg }} alert-dismissible">
			    <button type="button" class="close" data-dismiss="alert">&times;</button>
			    <strong>{{ Session::get('alert-' . $msg) }}</strong>
			</div>
		</div>
	</div>
    @endif
@endforeach
