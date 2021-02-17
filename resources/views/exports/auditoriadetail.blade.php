<table>
	<thead>
		<tr>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th style="background-color: #444444; color: #fff">Marca</th>
			<th style="background-color: #444444; color: #fff">Celula</th>
            <th style="background-color: #444444; color: #fff">Nombre de la Sucursal</th>
            <th style="background-color: #444444; color: #fff">Segmento</th>
			<th style="background-color: #444444; color: #fff">Promedio de Cada Segmento</th>
			<th style="background-color: #444444; color: #fff">Fecha de Auditoria</th>
		</tr>
	</thead>
	<tbody>
        @foreach ($dates as $date)
        @foreach ($date->audres as $result)
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td style="background-color: #444444; color: #fff">{{ $date->marcas->name ?? 'Sin datos' }}</td>
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