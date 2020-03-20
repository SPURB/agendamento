import axios from 'axios'
import fechadura from '@spurb/fechadura'

const baseURLD = 'http://spurbsp163:7080/agendamento/api.php/' // baseURL em development
const baseURLP = 'https://servicos.spurbanismo.sp.gov.br/agendamento/api/' // baseURL em production

const baseURL = () => process.env.NODE_ENV === 'production' ? baseURLP : baseURLD
const Current = () => fechadura(JSON.parse(process.env.VUE_APP_API_TOKEN), 'bicho').encript

export const http = axios.create({
  baseURL: baseURL(),
  headers: {
    Current: Current()
  }
})
