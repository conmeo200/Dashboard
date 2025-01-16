import { reactive } from 'vue';

export const authState = reactive({
  isAuth: localStorage.getItem('isAuth') === 'true',
  user  : null, // Thông tin người dùng (nếu có)
});