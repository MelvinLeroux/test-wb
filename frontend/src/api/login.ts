import api from '../config/axios-client';
import { User } from '../types';

export const login = (user: User): Promise<User> =>
  api.post('/api/login', user).then(response => response.data);
