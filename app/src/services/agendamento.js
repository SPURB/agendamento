import { http } from './http'

export default {
  get: () => {
    return http.get('agenda')
  },
  post: agenda => {
    return http.post('agenda', agenda)
  }
}
