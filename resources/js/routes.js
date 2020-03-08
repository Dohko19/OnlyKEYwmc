import Vue from 'vue';

//rutas

export default new Router({
	routes: [
		{
            path: '/',
            name: 'home',
			component: require('./views/Home').default
		},
		{
            path: '/gruposmarca',
            name: 'gmarca',
			component: require('./views/GruposMarca').default
		},
        // Siempre encima de esta ruta
		{
			path: '*',
			component:  require('./views/404').default
		}
	],
	linkExactActiveClass: 'active'
});