import axios from 'axios';
import app from '../configs/app';

export default new axios.create({
	baseURL: app.host,
	headers: {
		Authorization: 'Bearer ' + localStorage.access_token,
	}
})