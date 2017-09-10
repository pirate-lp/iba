<template>
<div id="main">
	<nav class="tabs is-toggle">
		<ul class="pure-menu-list">
			<li><router-link class="pure-menu-link pure-menu-heading" to="/">Lost Ideas Lab's <b>IBA</b></router-link></li>
			<template v-for="bookType in bookTypes">
				<li><router-link class="pure-menu-link" :to="'/' + bookType + '/'">{{ bookType | capitalize }}</router-link></li>
				<li class="lil-menu-add"><router-link class="pure-menu-link" :to="'/' + bookType + '/create'"><span class="icon"><i class="fa fa-plus" aria-hidden="true"></i></span></router-link></li>
			</template>
			<template v-if="auth">
				<li><router-link class="pure-menu-link" :to="'/bundle/'">Bundle</router-link></li>
				<li class="lil-menu-add"><router-link class="pure-menu-link" :to="'/bundle/create'"><span class="icon"><i class="fa fa-plus" aria-hidden="true"></i></span></router-link></li>
			</template>
			<li><router-link class="pure-menu-link" to="/setting"><span class="icon"><i class="fa fa-cog" aria-hidden="true"></i></span></router-link></li>
			<li v-if="auth"><router-link class="pure-menu-link" to="/logout"><span class="icon"><i class="fa fa-sign-out" aria-hidden="true"></i></span></router-link></li>
			<li><router-link class="pure-menu-link" to="/info"><span class="icon"><i class="fa fa-info" aria-hidden="true"></i></span></router-link></li>
		</ul>
	</nav>
	<div id="start" class="pure-g" style="padding: 1rem;">
		<div class="pure-u-1-1 pure-u-md-23-24"	style="text-align: left;">
			<router-view template></router-view>
			<template v-if="( $route.path == '/' && !auth )">
				<div>
					<h2>Login</h2>
					<div class="alert alert-danger" v-if="error">
						<p>{{ JSON.stringify(error) }}</p>
					</div>
					<form class="pure-form form-group pure-form-stacked">
						<input
							type="text"
							placeholder="Email"
							v-model="credentials.username"
						>
						<input
							type="password"
							placeholder="Password"
							v-model="credentials.password"
						>
						<button class="pure-button pure-button-primary" @click="submit()">Login</button>
					</form>
				</div>
			</template>
		</div>
	</div>
</div>
</template>

<script>
/*
import axios from 'axios';

window.axios = require('axios');

window.axios.defaults.headers.common['Accept'] = 'application/json';
window.axios.defaults.headers.common['Authorization'] = 'Bearer ';
*/
import auth from './auth'
import app from './configs/app.js'
import axios from './configs/axios.js'

export default {
	name: 'App',
	data () {
		return {
			bookTypes: [],
			auth: auth.user.authenticated,
			credentials: {
						username: '',
				password: ''
					},
					error: '',
		}
	},
	mounted() {
		this.menu()
	},
	methods: {
		menu() {
			if (this.auth) {
				this.$http.get(app.host + '/api/')
					.then(response => this.bookTypes = response.data );
			} else {
				this.bookTypes = []
			}
		},
		submit() {
			var credentials = {
				username: this.credentials.username,
				password: this.credentials.password
			}
			let self = this;
			auth.login(this, credentials)
				.then(function() {
						self.auth = true
						self.menu()
						self.$http.defaults.headers.Authorization = 'Bearer ' + localStorage.access_token;
						self.$http.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.access_token;
					})
				.catch();
			this.$http.defaults.headers.Authorization = 'Bearer ' + localStorage.access_token;
			this.$http.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.access_token;
		},
	},
	filters: {
		capitalize: function(text) {
			return text[0].toUpperCase() + text.slice(1);
		}
	},
	watch: {
		$route: function () {
			auth.checkAuth();
			this.auth = auth.user.authenticated;
			this.menu();
			console.log(this.$http.headers)
		}
	}
}
</script>


<style lang="sass">
	@import "node_modules/purecss/build/pure-min";
	@import "node_modules/purecss/build/grids-responsive-min";
	@import "node_modules/bulma/bulma.sass";
</style>
<style>
.lil-menu-add > a {
	padding-right: 0px;
	padding-left: 0px;
}

.main {
	
}
.pure-menu-horizontal.pure-menu-scrollable.main-menu {
	padding: 0px;
	text-align: left;
}
.main-menu > * {
/* 	display: inline-block; */
/* 	font-size: 1.2em; */
}
.main-menu li {
	border: 1px solid rgba(0, 0, 0, 0.1);
	background-color: #5c5c5c;
/* 	display: inline-block; */
/* 	background-color: gray; */
/* 	border: 1px solid black; */
}
.main-menu li > a {
	display: inline-block;
	color: white;
	border: none;
/* 	margin: 0px; */
/* 	padding: 0.7rem 1rem; */
/* 	line-height: 1rem; */
}
.main-menu li > a:hover {
	color: black;
}
.main-menu li > a.router-link-exact-active {
	color: white;
	background-color: #333;
}
.main-menu li > a.new {
/* 	right: 0px; */
/* 	background-color:	 */
}
</style>
