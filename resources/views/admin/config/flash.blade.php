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
@if(count($errors)>0)
@foreach ($errors->all() as $msg)
    <div class="row">
		<div class="col-12">
			<div class="alert alert-danger alert-dismissible">
			    <button type="button" class="close" data-dismiss="alert">&times;</button>
			    <strong>{{$msg}}</strong>
			</div>
		</div>
	</div>
@endforeach
@endif

