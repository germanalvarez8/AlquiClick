import api from './api';
import { Room } from '../types';

interface RoomFilters {
  building_id?: number;
  min_price?: number;
  max_price?: number;
  bed_count?: number;
  amenities?: string[];
}

export const getRooms = async (filters?: RoomFilters): Promise<Room[]> => {
  const params = new URLSearchParams();
  
  if (filters) {
    Object.entries(filters).forEach(([key, value]) => {
      if (value !== undefined) {
        if (Array.isArray(value)) {
          params.append(key, value.join(','));
        } else {
          params.append(key, value.toString());
        }
      }
    });
  }

  const response = await api.get<Room[]>(`/rooms?${params.toString()}`);
  return response.data;
};

export const getRoom = async (id: number): Promise<Room> => {
  const response = await api.get<Room>(`/rooms/${id}`);
  return response.data;
};

export const createRoom = async (room: Omit<Room, 'id' | 'created_at' | 'updated_at'>): Promise<Room> => {
  const response = await api.post<Room>('/rooms', room);
  return response.data;
};

export const updateRoom = async (id: number, room: Partial<Room>): Promise<Room> => {
  const response = await api.put<Room>(`/rooms/${id}`, room);
  return response.data;
};

export const deleteRoom = async (id: number): Promise<void> => {
  await api.delete(`/rooms/${id}`);
}; 