export interface LoginCredentials {
  email: string;
  password: string;
}

export interface RegisterData {
  name: string;
  email: string;
  password: string;
  password_confirmation: string;
}

export interface Admin {
  id: number;
  name: string;
  email: string;
  created_at: string;
  updated_at: string;
}

export interface Building {
  id: number;
  name: string;
  address: string;
  description: string;
  created_at: string;
  updated_at: string;
}

export interface Room {
  id: number;
  building_id: number;
  name: string;
  description: string;
  price: number;
  bed_count: number;
  amenities: string[];
  created_at: string;
  updated_at: string;
} 