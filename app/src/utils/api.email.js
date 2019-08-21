import apiconfig from '../utils/api.config.json'

export default axios.create({
	url: apiconfig.email.url,
	timeout: 11000,
	headers: {
		'Content-type': 'application/x-www-form-urlencoded; charset=UTF-8'
	}
})


    // url: "https://someurl.com",
    // username: 'm$',
    // password: 'stinks',
    // workstation: 'choose.something',
    // domain: ''