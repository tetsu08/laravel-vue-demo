import axios from 'axios'
import { Router } from 'vue-router'

const api = axios.create({
  baseURL: location.origin + '/api',
  headers: { 'Content-Type': 'application/json' }
})

export default (resource: string, version: string, context: any) => {
  return {
    setIntercepter(router: Router) {
      api.interceptors.response.use(
        (success) => {
          return success;
        },
        (error) => {
          if (String(error.response.status).startsWith('40')) {
            router.replace('/');
          }
          return Promise.reject(error);
        }
      )
      return this;
    },
    get(query: string, token: string): Promise<any> {
      api.defaults.headers.Authorization = `Bearer ${token}`
      return new Promise((resolve, reject) => {
        api.get([version, resource, query].join('/'))
          .then(success => {
            resolve(success.data);
          })
          .catch(error => {
            context.emit('errorHandler', error.response.data);
            reject();
          });
      });
    },
    post(payload: Object, token: string): Promise<any> {
      api.defaults.headers.Authorization = `Bearer ${token}`
      return new Promise((resolve, reject) => {
        api.post([version, resource].join('/'), payload)
          .then(success => {
            resolve(success.data);
          })
          .catch(error => {
            context.emit('errorHandler', error.response.data);
            reject();
          });
      });
    }
  }
}