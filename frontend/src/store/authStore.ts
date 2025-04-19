import { create } from 'zustand';
import { persist } from 'zustand/middleware';
import api from '../services/api';
import { LoginCredentials, RegisterData, Admin } from '../types';

interface AuthState {
  isAuthenticated: boolean;
  user: {
    id: number;
    name: string;
    email: string;
  } | null;
  login: (email: string, password: string) => Promise<void>;
  logout: () => void;
}

export const useAuthStore = create<AuthState>()(
  persist(
    (set) => ({
      isAuthenticated: false,
      user: null,
      login: async (email: string, password: string) => {
        // TODO: Implement actual login logic
        set({
          isAuthenticated: true,
          user: {
            id: 1,
            name: 'Admin',
            email: email,
          },
        });
      },
      logout: () => {
        set({
          isAuthenticated: false,
          user: null,
        });
      },
    }),
    {
      name: 'auth-storage',
    }
  )
); 