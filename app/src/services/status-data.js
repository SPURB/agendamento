import { http } from './http'

export default {
  get: (data, opUrbana) => {
    return http.get(`status?data=${data}&opUrbana=${opUrbana}`)
  }
}
