{{-- @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

@if (session()->has('info'))
	<div class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<span>{{ session('info') }}</span>
	</div>
@endif
@if ($errors->any())
	<ul class="list-group">
		@foreach ($errors->all() as $error)
			<li class="list-group-item list-group-item-danger">
				{{ $error }}
			</li>
		@endforeach
	</ul>
@endif --}}

@include('sweetalert::alert')