<table>
	<thead>
		<tr>
			<th>Marca</th>
			<th>Cedula</th>
            <th>Nombre de la Sucursal</th>
            <th>Segmento</th>
			<th>Promedio de Cada Segmento</th>
			<th>Fecha de Auditoria</th>
		</tr>
	</thead>
	<tbody>
            @foreach ($dates as $date)
            @foreach ($date->audres as $result)
		<tr>
			<td>{{ $date->marcas->name ?? 'Sin datos' }}</td>
			<td>{{ $date->cedula ?? 'Sin datos' }}</td>
            <td>{{ $date->name ?? 'Sin datos' }}</td>
			<td>{{ $result->segmentos->NombreSegmento ?? 'Sin datos' }}</td>
			<td>{{ $result->Promedio ?? 'Sin datos' }}</td>
			<td>{{ $result->created_at ?? 'Sin datos' }}</td>
		</tr>
		@endforeach
		@endforeach
	</tbody>
</table>