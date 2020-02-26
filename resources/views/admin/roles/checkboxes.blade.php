@foreach ($roles as $role)
	<div class="checkbox">
		<label>
			<input name="roles[]" type="checkbox" value="{{ $role->name }}"
			{{ $user->roles->contains($role->id) ? 'checked' : '' }} >
			{{ $role->display_name }} <br>
			<small class="text-muted">{{ $role->permissions->pluck('display_name')->implode(', ') }}</small>
		</label>
	</div>
@endforeach