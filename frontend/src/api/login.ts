import api from '../config/axios-client';
import { LoginResponse, UserLogin } from '../types';

export const login = (user: UserLogin): Promise<LoginResponse> =>
  api.post('/api/auth/login', user).then(response => {
    console.log(response, 'responseuh');
    return response.data;
  });
