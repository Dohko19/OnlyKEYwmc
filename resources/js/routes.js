import Vue from 'vue';

import Router from 'vue-router';

Vue.use(Router);

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
	linkExactActiveClass: 'active',
    mode: 'history',
    scrollBehavior (to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition
        } else {
            return { x: 0, y: 0 }
        }
    }
});
