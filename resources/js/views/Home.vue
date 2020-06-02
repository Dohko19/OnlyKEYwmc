<template>
	<div>
        <ul class="container-flex list-unstyled">
            <li>
                <router-link :to="{name: 'home'}" class="text-uppercase">Inicio</router-link>
            </li>
            <li>
                <router-link :to="{name: 'gmarca'}" class="text-uppercase">Grupo Marcas</router-link>
            </li>
        </ul>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-4" v-for="marca in marcas" :key="marca.id">
                        <span class="info-box-number" v-if="marca.photo">
                            <img :src="'/marcas/' +  marca.photo " width="300px" height="200px">
                        </span>
                    </div>
                </div>
            </div>
        </section>
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
				    console.log(res.data);
				    this.marcas = res.data.marca;
				    this.sucursales = res.data.sucursales;
				})
				.catch(err => {
					console.log(err);
				})
		}
	}
</script>
