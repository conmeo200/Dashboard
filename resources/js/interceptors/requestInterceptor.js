  import axios from 'axios';

  const requestInterceptor = axios.interceptors.request.use(
    config => {
      config.headers['X-Client-Type'] = 'app';
      config.withCredentials          = true;
      return config;
    },
    error => {
      return Promise.reject(error);
    }
  );

  export default requestInterceptor;
