import api from './api';
import { Building } from '../types';

export const getBuildings = async (): Promise<Building[]> => {
  const response = await api.get<Building[]>('/buildings');
  return response.data;
};

export const getBuilding = async (id: number): Promise<Building> => {
  const response = await api.get<Building>(`/buildings/${id}`);
  return response.data;
};

export const createBuilding = async (building: Omit<Building, 'id' | 'created_at' | 'updated_at'>): Promise<Building> => {
  const response = await api.post<Building>('/buildings', building);
  return response.data;
};

export const updateBuilding = async (id: number, building: Partial<Building>): Promise<Building> => {
  const response = await api.put<Building>(`/buildings/${id}`, building);
  return response.data;
};

export const deleteBuilding = async (id: number): Promise<void> => {
  await api.delete(`/buildings/${id}`);
}; 