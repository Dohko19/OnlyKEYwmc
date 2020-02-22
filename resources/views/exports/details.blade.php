<table>
	<thead>
		<tr>
			<th>Marca</th>
			<th>Zona</th>
			<th>Region</th>
			<th>Nombre de la Sucursal</th>
			<th>Calificación Riesgos Inminentes</th>
			<th>Calificación Criticos</th>
			<th>Fecha de Check list</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($dates as $date)
		@foreach ($date->qresults as $result)
		<tr>
			<td>{{ $date->marcas->name }}</td>
			<td>{{ $date->zone }}</td>
			<td>{{ $date->region }}</td>
			<td>{{ $date->name }}</td>
			<td>{{ $result->RI ?? 'Sin datos' }}</td>
			<td>{{ $result->C ?? 'Sin datos' }}</td>
			<td>{{ $result->created_at->format('m-Y') ?? 'Sin datos' }}</td>
		</tr>
		@endforeach
		@endforeach
	</tbody>
</table>