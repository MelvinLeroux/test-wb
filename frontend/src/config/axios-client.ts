import humps from 'humps';
import axios, { AxiosResponse } from 'axios';

const api = axios.create({
  baseURL: import.meta.env.VITE_API_URL,
  headers: {
    'Content-Type': 'application/json',
    'X-Requested-With': 'XMLHttpRequest',
  },
});

/* const handleSuccess =  (response: AxiosResponse) => {
  console.log(response)
  return {
    ...response,
    data: humps.camelizeKeys(response.data),
  }} */

//   const handleError = error => {
//     return Promise.reject(error);
//   }

// api.interceptors.response.use(handleSuccess, handleError)
api.interceptors.response.use(
  (response: AxiosResponse) => {
    console.log(response.data);
    const newData = humps.camelizeKeys(response.data);
    console.log(newData, 'prout');
    return {
      ...response,
      data: newData,
    };
  },
  error => {
    return Promise.reject(error);
  }
);
// api.interceptors.request.use((request) => {
//   ...request,
//   data: humps.decamelizeKeys(request.data), }),
//   Promise.reject,
// }
api.interceptors.request.use(
  request => {
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
