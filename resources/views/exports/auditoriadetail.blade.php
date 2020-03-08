<table>
	<thead>
		<tr>
			<th>Marca</th>
			<th>Cedula</th>
			<th>Puntuacion Total</th>
			<th>Nombre de la Sucursal</th>
			<th>Promedio de Cada Sucursal</th>
			<th>Fecha de Auditoria</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($dates as $date)
		@foreach ($date->audres as $result)
		<tr>
			<td>{{ $date->marcas->name ?? 'Sin datos' }}</td>
			<td>{{ $date->cedula ?? 'Sin datos' }}</td>
			<td>{{ $date->puntuacion_total ?? 'Sin datos' }}</td>
			<td>{{ $date->name ?? 'Sin datos' }}</td>
			<td>{{ $result->Promedio ?? 'Sin datos' }}</td>
			<td>{{ $result->created_at ?? 'Sin datos' }}</td>
		</tr>
		@endforeach
		@endforeach
	</tbody>
</table>