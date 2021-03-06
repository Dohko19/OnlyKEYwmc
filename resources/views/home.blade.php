@extends('layouts.admin')
@section('content')
<section class="content">
  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Planes de Accion para la sucursal de La Cerveceria del Barrio</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fas fa-times"></i></button>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="container-fluid">
          <br>
          <table class="talbe">
            <tr>
              <th>Camapana Sucia</th>
              <td><input class="form-control" type="text" placeholder="Plan de accion"></td>
              <td class="pull-right"><button class="btn btn-info"><i class="far fa-save"></i> Guardar</button></td>
              <td>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-primary">
                  Ver Imagen...
                </button></td>
            </tr>
            <tr>
              <th>Area de Cochambre no desinfecatada</th>
              <td><input class="form-control" type="text" placeholder="Plan de accion"></td>
              <td class="pull-right"><button class="btn btn-info"><i class="far fa-save"></i> Guardar</button></td>
              <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-primary">
                  Ver Imagen...
                </button></td>
            </tr>
            <tr>
              <th>Personal no bien uniformado</th>
              <td><input class="form-control" type="text" placeholder="Plan de accion"></td>
              <td class="pull-right"><button class="btn btn-info"><i class="far fa-save"></i> Guardar</button></td>
              <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-primary">
                  Ver Imagen...
                </button></td>
            </tr>
            <tr>
              <th>Desconocimineto del proceso de desinfeccion</th>
              <td><input class="form-control" type="text" placeholder="Plan de accion"></td>
              <td class="pull-right"><button class="btn btn-info"><i class="far fa-save"></i> Guardar</button></td>
              <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-primary">
                  Ver Imagen...
                </button></td>
            </tr>
            <tr>
              <th>Equipos en mal estado</th>
              <td><input class="form-control" type="text" placeholder="Plan de accion"></td>
              <td class="pull-right"><button class="btn btn-info"><i class="far fa-save"></i> Guardar</button></td>
              <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-primary">
                  Ver Imagen...
                </button></td>
            </tr>
            <tr>
              <th>Falta de producto quimico</th>
              <td><input class="form-control" type="text" placeholder="Plan de accion"></td>
              <td class="pull-right"><button class="btn btn-info"><i class="far fa-save"></i> Guardar</button></td>
              <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-primary">
                  Ver Imagen...
                </button></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
    <!-- /.card-footer-->
  </div>
  <!-- /.card -->
</section>
@endsection
<div class="modal fade" id="modal-primary">
    <div class="modal-dialog">
      <div class="modal-content bg-primary">
        <div class="modal-header">
          <h4 class="modal-title">Evidencia de Auditoria</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="text-center">
              <img src="{{ url('imagen/campana-sucia.jpg') }}" width="350px" alt="">
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>