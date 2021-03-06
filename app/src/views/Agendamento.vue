<template>
  <div id="agendamento">

    <Modal :validateForm="validateForm" />
    <div class="logo">
      <logo-spurb :fill-type="'#FFF'" :fill-brand="'#FFF'" />
    </div>
    <h1>Formulário de agendamento</h1>

    <form id="postForm" @submit.prevent="handleSubmit">

      <div class="form-section">
        <label>Nome:</label>
        <input
          type="text"
          class="input-form"
          v-model="form.nome"
          required>
      </div>

      <div class="form-section">
        <label>E-mail:</label>
        <input
          type="email"
          class="input-form"
          v-model="form.usuario"
          required>
      </div>

      <div class="form-section">
        <label>Processo:</label>
        <input
          type="text"
          class="input-form"
          v-model="form.processo"
          required>
      </div>

      <div class="form-section">
        <label>Operação Urbana:</label>
        <select
          class="select-form"
          @change="handleData"
          v-model="form.opUrbana"
          required>
          <option value="" disabled selected>Selecione um opção</option>
          <option
            :key="operacao.id"
            v-for="operacao in operacoes"
            :value="operacao.id"
          >
            {{operacao.nome}}
          </option>
        </select>
      </div>

      <div class="form-section">
        <label>Selecione a data:</label>
        <input
          type="date"
          @change="handleData"
          v-model="form.data"
          class="input-form"
          :disabled="form.opUrbana == '' ? true : false"
          required>
      </div>

      <div class="form-section agendamento">
        <label>Horário do agendamento:</label>
        <div class="content-radios">
          <div
            :key="index"
            class="custom-radio"
            v-for="(horario, index) in horarios"
          >
            <input
              type="radio"
              v-model="form.horario"
              :value="horario.id"
              :disabled="horariosL.length > 0 ? !horariosL[index].livre : true"
              class="input-radio"
              name="horario"
              required>
            <label>{{horario.nome}}</label>
          </div>
        </div>
      </div>

      <div class="form-section action">
        <button
          type="submit"
          class="btn-submit">
          agendar
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import LogoSpurb from '../components/LogoSpurb'
import Modal from '../components/Modal'
import OperacaoUrbana from '../../../static/operacoesurbanas.json'
import Horarios from '../../../static/horarios.json'
import Agendamento from '../services/agendamento'
import Status from '../services/status-data'

export default {
  name: 'Agendamento',
  components: {
    LogoSpurb,
    Modal
  },
  data () {
    return {
      form: {
        nome: null,
        usuario: null,
        opUrbana: '',
        processo: null,
        horario: null,
        data: null
      },
      horariosL: [],
      validateForm: {
        showModal: false,
        type: false
      }
    }
  },
  computed: {
    operacoes () {
      return OperacaoUrbana
    },
    horarios () {
      return Horarios
    }
  },
  methods: {
    clearInputRadios () {
      const radios = document.querySelectorAll('.input-radio')
      radios.forEach(r => {
        r.checked = false
        this.form.horario = null
      })
    },
    clearForms () {
      this.clearInputRadios()
      this.form.nome = null
      this.form.usuario = null
      this.form.opUrbana = ''
      this.form.processo = null
      this.form.data = null
    },
    async handleData () {
      if (this.form.data !== null && this.form.opUrbana !== null) {
        await Status.get(this.form.data, this.form.opUrbana).then(res => {
          this.clearInputRadios() // limpas as seleções caso haja mudança de data
          this.horariosL = [] // zera o array
          res.data.forEach(h => {
            this.horariosL.push({
              id: h.id,
              livre: JSON.parse(h.livre) // converte de string para boolean
            })
          })
        }).catch(() => {
          this.toggleModal(1)
          this.toggleModal()
        })
      }
    },
    async handleSubmit () {
      try {
        if (this.form.nome !== null && this.form.usuario !== null && this.form.opUrbana !== '' &&
        this.form.processo !== null && this.form.horario !== null && this.form.data !== null) {
          await Agendamento.post(this.form).then(res => {
            this.toggleModal(0)
            this.toggleModal()
          }).catch(() => {
            this.toggleModal(1)
            this.toggleModal()
          })
        } else {
          const invalid = true
          throw invalid
        }
      } catch (err) {
        this.toggleModal(1)
        this.toggleModal()
      }
    },
    toggleModal (i = 2) { // i é por padrão 2 que retorna o valor default de this.validateForm
      if (i === 0) {
        this.validateForm.showModal = true
        this.validateForm.type = true
      } else if (i === 1) {
        this.validateForm.showModal = true
        this.validateForm.type = false
      } else {
        setTimeout(() => {
          this.clearForms()
          this.validateForm.showModal = false
          this.validateForm.type = false
        }, 2500)
      }
    }
  }
}
</script>

<style lang="scss" scoped>
@import '../assets/scss/variables';

.logo {
  margin: 1rem;
}

.input-form,
.select-form {
  min-height: 2.75rem;
  padding: 0.5rem;
  font-family: $grot
}

.form-section.agendamento {
  margin: 1rem 0;
}

#agendamento {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  width: 100%;
  padding: 0;

  h1 {
    margin-top: 30px;
    margin-bottom: 25px;
  }

  #postForm {
    align-items: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
    width: 100%;
    .form-section {
      display: flex;
      flex-direction: column;
      width: 30%;
      margin-bottom: 15px;

      label {
        font-size: 15pt;
        margin-bottom: 5px;
      }

      .input-form, .select-form {
        border: none;
        height: 30px;
        font-size: 13pt;
      }

      .select-form:hover, .input-radio {
        cursor: pointer;
      }

      .content-radios {
        width: 100%;
        display: flex;

        .custom-radio {
          align-items: center;
          border-radius: 5px;
          background-color: $verde;
          display: flex;
          margin: 3px;
          width: 20%;
          text-align: center;
          justify-content: center;
          padding: 3px;

          label {
            font-size: 12pt;
            margin: 0px;
          }
        }
      }

      .btn-submit {
        background-color: $verde-escuro;
        border: 1px $verde solid;
        border-radius: 5px;
        color: $branco;
        font-size: 1.5rem;
        margin-top: 7px;
        padding: 0.5rem;

        &:hover {
          transition: all ease-in-out 0.15s;
          cursor: pointer;
          background-color: $verde;
          border-color: #fff;
        }
      }
    }
  }
}

@media (max-width: 1300px) {
  #agendamento {
    padding: 20px;

    h1 {
      font-size: 2rem;
    }

    #postForm .form-section {
      width: 95% !important;

      .content-radios {
        flex-direction: column;

        .custom-radio {
          margin: 0px 0px 3px 0px;
          width: 100%;
          height: 31px;
        }
      }
    }
  }
}

@media (max-width: 450px) {
  #agendamento {
    padding: 25px 10px;

    h1 {
      font-size: 1.6rem;
    }
  }
}
</style>
