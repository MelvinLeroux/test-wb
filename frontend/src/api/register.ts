import api from '../config/axios-client';
import { UserLogin } from '../types';

export const createUser = (user: UserLogin): Promise<UserLogin> =>
  api.post('/api/users', user).then(response => response.data);
