export interface Measurement {
  id: number;
  value: number;
  createdAt: string;
  sensor: string;
}

export type Module = {
  id: number;
  name: string;
  status: boolean | number;
  sensors: string[];
  measurements?: Measurement[];
  startedAt?: string;
  stoppedAt?: string;
};

export type ModulePut = {
  name: string;
};

export type Sensor = {
  id: number;
  name: string;
};

export type UserLogin = {
  email: string;
  password: string;
  role?: string[];
};

export type LoggedUser = {
  id: number;
  email: string;
  pseudo: string;
  roles: string[];
};

export type LoginResponse = {
  token: string;
  user: LoggedUser;
};

export type User = {
  email: string;
  password: string;
};
