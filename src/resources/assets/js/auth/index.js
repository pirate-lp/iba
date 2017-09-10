import app from '../configs/app'

const API_URL = app.host
const LOGIN_URL = API_URL + '/oauth/token'
const SIGNUP_URL = API_URL + '/users/'

export default {

	// User object will let us check authentication status
	user: {
		authenticated: false
	},
	
	// Send a request to the login URL and save the returned JWT
	login(context, creds) {
		let self = this;
		var formData = new FormData();
		formData.append('username', creds.username);
		formData.append('password', creds.password);
		formData.append('grant_type', 'password');
		formData.append('client_id', app.client_id);
		formData.append('client_secret',app.client_secret);
		formData.append('scope', '*');
		
		
		return new Promise((resolve, reject) => {
            context.$http.post(LOGIN_URL, formData)
                .then(response => {
					localStorage.setItem('access_token', response.data.access_token);
					this.user.authenticated = true
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
	},

	signup(context, creds, redirect) {
		context.$http.post(SIGNUP_URL, creds, (data) => {
			localStorage.setItem('id_token', data.id_token)
			localStorage.setItem('access_token', data.access_token)

			this.user.authenticated = true

			if(redirect) {
				router.replace(redirect)				
			}

		}).error((err) => {
			context.error = err
		})
	},

	// To log out, we just need to remove the token
	logout() {
// 		localStorage.removeItem('id_token')
		localStorage.removeItem('access_token')
		this.user.authenticated = false
	},

	checkAuth() {
		var jwt = localStorage.getItem('access_token')
		if(jwt) {
			this.user.authenticated = true
		}
		else {
			this.user.authenticated = false			
		}
	},

	// The object to be passed as a header for authenticated requests
	getAuthHeader() {
		return {
			'Authorization': 'Bearer ' + localStorage.getItem('access_token')
		}
	}
}