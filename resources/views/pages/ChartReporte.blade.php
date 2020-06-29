@extends('layouts.admin')
@section('content')
    @role('VIPS')
        <chart-cuestionario></chart-cuestionario>
    @else
        <h2>No cumples con los requisitos para ver esta seccion</h2>
    @endrole
@endsection
