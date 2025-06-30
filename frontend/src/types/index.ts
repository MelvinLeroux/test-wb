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

export type Sensor = {
  id: number;
  name: string;
};
