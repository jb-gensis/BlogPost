import axios from 'axios'
import store from '../store'
import router from '../router.js'

const webClient = axios.create({
    baseURL : '/api',
});

webClient.interceptors.request.use(function (config) {
    // Do something before request is sent
    return config;
}, function (error) {
    // Do something with request error
    return Promise.reject(error);
});

webClient.interceptors.response.use(
	response => {
		if (response.status === 200 || response.status === 201) {
			return Promise.resolve(response);
		} else {
			return Promise.reject(response);
		}
	}, error => {
		if (error.response.status === 401) {
            // console.clear();
            console.log(error.response.status == 401 ? 'Session Expired' : error.response.statusText);

            setTimeout(() => {
                store.commit('logoutUser');
                router.replace('/').catch(() => {});
            }, 1000);

            return Promise.reject(error.response);
        }
	}
);

export default {
    auth: {
        setBearerToken() {
            return {
                headers: {
                    Authorization: `Bearer ${store.state.auth.token}`
                }
            }
        },
        isAuthenticate(){
            return webClient.get('authenticate',this.setBearerToken())
        },
        getAllPost() {
            if(store.state.auth.token){
                return webClient.get('blogs', this.setBearerToken())
            }
        },
        getPostByBlogId(id) {
            if(store.state.auth.token){
                return webClient.get(`blogs/${id}`, this.setBearerToken())
            }
        },
        getAllPostByUser() {
            if(store.state.auth.token){
                return webClient.get(`user-posts`, this.setBearerToken())
            }
        },
        createPost(payload) {
            if(store.state.auth.token){
                return webClient.post('blogs', payload, this.setBearerToken())
            }
        },
        editPost(payload, id) {
            if(store.state.auth.token){
                return webClient.put(`blogs/${id}`, payload, this.setBearerToken())
            }
        },
        deletePost(id) {
            if(store.state.auth.token){
                return webClient.delete(`blogs/${id}`, this.setBearerToken())
            }
        },
        logout(){
            return webClient.post('logout',this.setBearerToken());
        }
    },
    login(payload) {
        return webClient.post('login',payload)
    },
    addUser(payload) {
        return webClient.post('register',payload)
    }
}
