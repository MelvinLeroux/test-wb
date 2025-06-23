import api from '../config/axios-client';
import { Module } from '../types';

export const getCurrentModule = (id: string) =>
  api.get(`/api/modules/${id}`).then(response => response.data);

export const addNewModule = (newModule: Partial<Module>): Promise<Module> =>
  api.post('/api/modules', newModule).then(response => response.data);

export const deleteModule = (id: number) =>
  api.delete(`/api/modules/${id}`).then(response => response.data);