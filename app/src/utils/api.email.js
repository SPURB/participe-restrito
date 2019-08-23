import axios from 'axios'
import apiconfig from '../utils/api.config.json'

export default axios.create({
	baseURL: apiconfig.email.url,
	headers: {
		'Access-Control-Allow-Credentials': true,
		'Content-Type': 'application/x-www-form-urlencoded',
		'Authorization': apiconfig.email.hash
	}
})
