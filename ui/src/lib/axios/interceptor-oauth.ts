import instance from './instance'
import { AuthContainer } from '~/containers';

instance.interceptors.request.use((config) => {
  if (AuthContainer.state.token != null) {
    config.headers['Authorization'] = `Bearer ${AuthContainer.state.token}`;
  }

  return config;
})