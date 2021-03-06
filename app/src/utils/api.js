import axios from 'axios'
import apiconfig from '../utils/api.config.json'

export default axios.create({
	baseURL: apiconfig.login,
	timeout: 5000,
	headers: {
		'Content-Type': 'multipart/form-data'
	}
})
