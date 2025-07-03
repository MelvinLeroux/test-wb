import api from '../config/axios-client';
import { User } from '../types';

export const createUser = (user: User): Promise<User> =>
  api.post('/api/users', user).then(response => response.data);
