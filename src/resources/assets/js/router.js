import VueRouter from 'vue-router'

// import Login from './views/Login.vue'
import auth from './auth'

import Home from './views/Home'
import Info from './views/Info'
import Setting from './views/Setting'
import BookProductionManage from './views/Book/Production/Manage'
import BookProductionCreate from './views/Book/Production/Create'

import BundleManage from './views/Bundle/Manage'
import BundleCreate from './views/Bundle/Create'

function requireAuth (to, from, next) {
if (!auth.user.authenticated) {
		next({
			path: '/',
		query: { redirect: to.fullPath }
		})
	} else {
		next()
	}
}

let routes = [
	{
		path: '/',
	component: Home
	},
	{
		path: '/logout',
		beforeEnter (to, from, next) {
			auth.logout()
			next({ path: '/', query: { user: 'loggedout' } })
		}
	},
	{
		path: '/info',
		name: 'info',
		component: Info
	},
	{
		path: '/setting',
		name: 'setting',
		component: Setting
	},
	{
		path: '/bundle/',
		component: BundleManage, beforeEnter: requireAuth
	},
	{
		path: '/bundle/create',
		component: BundleCreate, beforeEnter: requireAuth
	},
	{
		path: '/bundle/:id/edit',
		component: BundleCreate, beforeEnter: requireAuth
	},
	{
		path: '/:type/',
		component: BookProductionManage, beforeEnter: requireAuth
	},
	{
		path: '/:type/create',
		component: BookProductionCreate, beforeEnter: requireAuth
	},
	{
		path: '/:type/:id/edit',
		component: BookProductionCreate, beforeEnter: requireAuth
	},
];

export default new VueRouter({
	routes
});