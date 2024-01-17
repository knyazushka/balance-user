import axios from 'axios';

const instance = axios.create({
    baseURL: 'http://127.0.0.1:8001/api',
});

instance.interceptors.request.use(
    (config) => {
        config.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}` ?? '';
        return config;
    },
    (error) => Promise.reject(error),
);

export default instance;
