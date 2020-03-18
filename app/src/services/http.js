import axios from 'axios'

export const http = axios.create({
  baseURL: 'http://spurbsp163:7080/agendamento/api.php/',
  headers: {
    Current: 'default'
  }
})
