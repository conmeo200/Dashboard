import axios from 'axios';

const errorInterceptor = axios.interceptors.response.use(
  response => response,
  error => {
    // Xử lý các lỗi khác nếu cần
    console.error('Đã xảy ra lỗi: ', error);
    return Promise.reject(error);
  }
);

export default errorInterceptor;
