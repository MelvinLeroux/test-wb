import api from '../config/axios-client';

export const getAllModules = (page: number = 1, limit: number = 6) => {
  return api.get(`/api/modules/?page=${page}&limit=${limit}`).then(response => {
    return response.data;
  });
};
