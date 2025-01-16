import axios from 'axios';
import router from '../routes';

const responseInterceptor = axios.interceptors.response.use(
  response => {
    return response;
  },
  error => {
    if (error.response && error.response.status === 401) {
      localStorage.removeItem('isAuth');
      router.push({ name: 'Login' });
    }
    //return Promise.reject(error);
  }
);

export default responseInterceptor;
