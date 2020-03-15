<table>
	<thead>
		<tr>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th style="background-color: #006391; color: #FFFFFF">Marca</th>
			<th style="background-color: #006391; color: #FFFFFF">Zona</th>
			<th style="background-color: #006391; color: #FFFFFF">Region</th>
			<th style="background-color: #006391; color: #FFFFFF">Nombre de la Sucursal</th>
			<th style="background-color: #006391; color: #FFFFFF">Calificación Riesgos Inminentes</th>
			<th style="background-color: #006391; color: #FFFFFF">Calificación Criticos</th>
			<th style="background-color: #006391; color: #FFFFFF">Fecha de Check list</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($dates as $date)
		@foreach ($date->qresults as $result)
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td style="background-color: #006391; color: #FFFFFF">{{ $date->marcas->name ?? 'Sin datos' }}</td>
			<td>{{ $date->zone ?? 'Sin datos' }}</td>
			<td>{{ $date->region ?? 'Sin datos' }}</td>
			<td>{{ $date->name ?? 'Sin datos' }}</td>
			<td>{{ $result->RI ?? 'Sin datos' }}</td>
			<td>{{ $result->C ?? 'Sin datos' }}</td>
			<td>{{ $result->created_at->format('m-Y') ?? 'Sin datos' }}</td>
		</tr>
		@endforeach
		@endforeach
	</tbody>
</table>