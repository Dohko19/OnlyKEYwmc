@csrf
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
	<label for="name">Identificador:</label>
	@if ($role->exists)
		<input type="text" value="{{ $role->name }}" class="form-control" disabled>
	@else
		<input name="name" type="text" value="{{ old('name', $role->name) }}" class="form-control">
	@endif
</div>
<div class="form-group {{ $errors->has('display_name') ? 'has-error' : '' }}">
	<label for="display_name">Nombre:</label>
	<input type="text" name="display_name" value="{{ old('display_name', $role->display_name) }}" class="form-control">
</div>
<div class="form-group col-md-6 {{ $errors->has('permissions') ? 'has-error' : '' }}">
	<label for="">Permisos</label>
	@include('admin.permissions.checkboxes', ['model' => $role])
</div>