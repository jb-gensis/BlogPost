import Vue from 'vue';
import VueRouter from 'vue-router';
import store from './store';
import api from './api'

Vue.use(VueRouter);

const logout = (to, from, next) => {
	console.log("LOGOTU")
	store.commit('logoutUser');
    api.auth.logout();
	router.replace('/').catch(() => {});
	next();
};

const routes = [
	{
		name: 'index',
		path: '/',
		component: () => import('./components/pages/login')
	},
	{
		name: 'dashboard',
		path: '/dashboard',
		component: () => import('./components/pages/Dashboard'),
		meta: {
			requiresAuth: true,
		},
	},
	{
		name: 'create',
		path: '/create',
		component: () => import('./components/pages/blog/create'),
		meta: {
			requiresAuth: true,
		},
	},
	{
		name: 'edit',
		path: '/edit/:id',
		component: () => import('./components/pages/blog/edit'),
		meta: {
			requiresAuth: true,
		},
	},
	{
		path: '/logout',
		beforeEnter: logout,
	},
	{
		name: 'myposts',
		path: '/myposts',
		component: () => import('./components/pages/blog/myposts'),
		meta: {
			requiresAuth: true,
		},
	},
	{ 
		path: "*", 
		component: () => import('./components/pages/PageNotFound'), 
	}
	// {
	// 	name: 'history-company',
	// 	path: '/history/:id',
	// 	component: () => import('./components/pages/History'),
	// 	meta: {
	// 		requiresAuth: true,
	// 	},
	// },
	// {
	// 	name: 'detail',
	// 	path: '/detail',
	// 	component: () => import('./components/pages/Detail'),
	// 	meta: {
	// 		requiresAuth: true,
    //         role: 'guest'
	// 	},
	// },
	// {
	// 	name: 'admin',
	// 	path: '/admin',
	// 	component: () => import('./components/pages/Admin'),
	// 	meta: {
	// 		requiresAuth: true,
    //         role: 'admin'
	// 	},
	// },
	// {
	// 	name: 'upload',
	// 	path: '/upload',
	// 	component: () => import('./components/pages/upload'),
	// 	meta: {
	// 		requiresAuth: true,
    //         role: 'guest'
	// 	},
	// },
	
];

const router = new VueRouter({
	mode: 'history',
	base: process.env.BASE_URL,
	routes,
});

router.beforeEach((to, from, next) => {
	console.log("store: ",store.state.auth)
	let isLoggedIn = !!store.state.auth.isLogin;
    let user = store.state.auth.name;
    let requiresAuth = to.matched.some(record => record.meta.requiresAuth);

	if (to.path === '/' && isLoggedIn) {
		next({
			path: '/dashboard',
			params: { nextUrl: to.fullPath }
		});
	}

	if (requiresAuth && isLoggedIn && user) {
		if (to.path === '/') {
			next({
				path: '/dashboard',
				params: { nextUrl: to.fullPath }
			});
		} else {
			next();
		}
    } else if (requiresAuth && !isLoggedIn && !user) {
        next('index');
    } else {
		console.log("log")
        next();
    }
})

export default router;


