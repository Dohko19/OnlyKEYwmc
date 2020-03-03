<template>
	<div>
		<div class="row">
	    <div class="col-lg-3 col-6">
	        <div class="small-box bg-info">
	          <div class="inner" v-for="g in gmarca">
	            	<h3>{{ g.gmarca }}</h3>
	            <p>Grupo de Marca</p>
	          </div>
	          <div class="icon">
	            <i class="fas fa-layer-group"></i>
	          </div>
	          <a href="#" class="small-box-footer">Mas información<i class="fas fa-arrow-circle-right"></i></a>
	        </div>
	    </div>
	    <div class="col-lg-3 col-6">
	        <div class="small-box bg-primary">
	          <div class="inner" v-for="m in marcas">
	            	<h3>{{ m.marca }}</h3>
	            <p>Marcas</p>
	          </div>
	          <div class="icon">
	            <i class="fas fa-layer-group"></i>
	          </div>
	          <a href="/admin/marcas" class="small-box-footer">Mas información <i class="fas fa-arrow-circle-right"></i></a>
	        </div>
	    </div>
	    <div class="col-lg-3 col-6">
	        <div class="small-box bg-danger">
	          <div class="inner" v-for="s in sucursales">

	            	<h3>{{ s.sucursals }}</h3>
	            <p>Sucursales</p>
	          </div>
	          <div class="icon">
	            <i class="fas fa-layer-group"></i>
	          </div>
	          <a href="/admin/sucursales" class="small-box-footer">Mas información <i class="fas fa-arrow-circle-right"></i></a>
	        </div>
	    </div>
	    <div class="col-lg-3 col-6">
	        <!-- small box -->
		    <div class="small-box bg-warning">
		      <div class="inner" v-for="user in users">
		        	<h3>{{ user.users }}</h3>
		        <p>Usuarios registrados</p>
		      </div>
		      <div class="icon">
		        <i class="ion ion-person-add"></i>
		      </div>
		      <a href="/admin/users" class="small-box-footer">Mas información <i class="fas fa-arrow-circle-right"></i></a>
		    </div>
	  	</div>
    </div>
	</div>
</template>
<script>
	export default {
		data(){
			return {
				users: [],
				gmarca: [],
				marcas: [],
				sucursales: [],
			}
		},
		mounted(){
			axios.get('/admin/datos')
				.then(res => {
					this.users = res.data[0];
					this.gmarca = res.data[1];
					this.marcas = res.data[2];
					this.sucursales = res.data[3];
				})
				.catch(err => {
					console.log(err);
				})
		}
	}
</script>