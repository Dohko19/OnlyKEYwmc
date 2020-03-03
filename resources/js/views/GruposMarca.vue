<template>
	<div>
		<div class="container-fluid">
                  <div class="row">
                        <div class="col-md-12 col-lg-12">
                              <div class="card card-primary card-outline">
                                    <div class="card-header">
                                          <h3 class="card-title">
                                                <i class="fas fa-users-cog"></i>
                                                Grupos de Marca
                                          </h3>
                                          <!-- {{-- @can('create', $grupomarcas->first()) --}}
                                                <a href="{{ route('admin.gruposm.create') }}" class="btn btn-info float-right"><i class="fas fa-plus"></i> Crear Grupo de Marca</a>
                                          {{-- @endcan --}} -->
                                    </div>
                              <div class="card-body">
                              <table id="example2" class="table table-bordered table-hover">
                              <thead>
                                    <tr>
                                          <th>ID</th>
                                          <th>Nombre</th>
                                          <th>Descripcion</th>
                                          <th>Logo</th>
                                          <th>Creado el:</th>
                                          <!-- <th>Acciones</th> -->
                                    </tr>
                              </thead>
                              <tbody v-for="grupoMarca in gmarca">
                                          <tr>
                                                <td>{{ grupoMarca.id }}</td>
                                                <td>{{ grupoMarca.name }}</td>
                                                <td>{{ grupoMarca.description }}</td>
                                                <td><img :src="'grupomarcas/'+grupoMarca.logo" alt="" width="100px" height="100px"></td>
                                                <td>{{ grupoMarca.created_at }}</td>
                                                <!-- <td>
                                                      @can('update', $grupoMarca)
                                                <a class="btn" href="{{ route('admin.gruposm.edit', $grupoMarca) }}" style="color: blue;"><i class="far fa-edit"></i></a>
                                                      @endcan
                                                      @can('delete', $grupoMarca)
                                                            <form action="{{ route('admin.gruposm.destroy', $grupoMarca) }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                                  <button class="btn "
                                                                  onclick="return confirm('Estas seguro de Eliminar este grupo de marca?')"
                                                                  ><i class="fas fa-trash" style="color: red"></i></button>
                                                      </form>
                                                @endcan
                                                </td> -->
                                          </tr>
                              </tbody>
                              </table>
                        </div>
                        <!-- /.card-body -->
                              </div>
                        </div>
                  </div>
            </div>
	</div>
</template>

<script>
	export default {
		data(){
			return {
				gmarca: [],
			}
		},
		mounted(){
			axios.get('/admin/gmarca')
				.then(res => {
					this.gmarca = res.data;
				})
				.catch(err => {
					console.log(err);
				})
		}
	}
</script>