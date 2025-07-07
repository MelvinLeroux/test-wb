import humps from 'humps';
import axios, { AxiosResponse } from 'axios';

const api = axios.create({
  baseURL: import.meta.env.VITE_API_URL,
  headers: {
    'Content-Type': 'application/json',
    'X-Requested-With': 'XMLHttpRequest',
  },
});

api.interceptors.response.use(
  (response: AxiosResponse) => {
    const newData = humps.camelizeKeys(response.data);

    return {
      ...response,
      data: newData,
    };
  },
  error => {
    return Promise.reject(error);
  }
);

api.interceptors.request.use(
  request => {
    const token = localStorage.getItem('token');
    if (token) {
      request.headers.Authorization = `Bearer ${token}`;
    }

    if (request.data) {
      request.data = humps.decamelizeKeys(request.data);
    }
    return request;
  },
  error => Promise.reject(error)
);

// function test = () => {
//   return {
//     key: 'value',
//     value: 'value2',
//   };
// }

// function test2 = () => ({
//     key: 'value',
//     value: 'value2',
// })

// function test2() ({
//     key: 'value',
//     value: 'value2',
// })

export default api;
