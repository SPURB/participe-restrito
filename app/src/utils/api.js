import axios from 'axios'
import fechadura from '@spurb/fechadura'
import apiconfig from '../utils/api.config.json'

const current = fechadura(apiconfig.chave, 'bicho').encript

export default axios.create({
	baseURL: apiconfig.login,
	timeout: 5000,
	headers: {
		'Content-type': 'application/x-www-form-urlencoded; charset=UTF-8',
		'Current': current
	}
})
