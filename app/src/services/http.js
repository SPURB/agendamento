import axios from 'axios'
console.log(process.env)
const baseURLD = 'http://spurbsp163:7080/agendamento/api.php/' // baseURL em development
const baseURLP = 'https://servicos.spurbanismo.sp.gov.br/agendamento/api/' // baseURL em production
export const http = axios.create({
  baseURL: process.env.NODE_ENV === 'development' ? baseURLD : baseURLP,
  headers: {
    Current: 'default'
  }
})
