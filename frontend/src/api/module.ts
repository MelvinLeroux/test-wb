import api from '../config/axios-client';
import { Module, ModulePut } from '../types';

export const getCurrentModule = (id: string) =>
  api.get(`/api/modules/${id}`).then(response => response.data);

export const addNewModule = (newModule: Partial<Module>): Promise<Module> =>
  api.post('/api/modules', newModule).then(response => response.data);

export const deleteModule = (id: number) =>
  api.delete(`/api/modules/${id}`).then(response => response.data);

export const updateModule = (id: number, data: ModulePut) =>
  api.put(`/api/modules/${id}`, data).then(response => response.data);
