<template>
  <div id="agendamento">

    <logo-spurb :fill-type="'#FFF'" :fill-brand="'#038375'" />

    <h1>Formulário de Agendamento</h1>

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
          v-model="form.email"
          required>
      </div>

      <div class="form-section">
        <label>Operação Urbana:</label>
        <select
          class="select-form"
          v-model="form.operacaourbana"
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
          required>
      </div>

      <div class="form-section">
        <label>Horário do agendamento:</label>
        <div class="content-radios">
          <div
            :key="horario.id"
            class="custom-radio"
            v-for="(horario, index) in horarios"
          >
            <input
              type="radio"
              v-model="form.horario"
              :value="horario.id"
              :disabled="horariosL[index].livre"
              class="input-radio"
              required>
            <label>{{horario.nome}}</label>
          </div>
        </div>
      </div>

      <div class="form-section">
        <button
          type="submit"
          class="btn-submit">
          Agendar
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import LogoSpurb from '../components/LogoSpurb'
import OperacaoUrbana from '../../../static/operacoesurbanas.json'
import Horarios from '../../../static/horarios.json'

export default {
  name: 'Agendamento',
  components: {
    LogoSpurb
  },
  data () {
    return {
      form: {
        nome: null,
        email: null,
        operacaourbana: '',
        horario: null,
        data: null
      },
      horariosL: [{ id: 1, livre: true }, { id: 2, livre: true }, { id: 3, livre: true }, { id: 4, livre: true }, { id: 5, livre: true }]
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
        this.form.data = ''
      })
    },
    handleData () {
      return new Promise(resolve => {
        setTimeout(() => {
          if (this.form.data === '2020-03-17') {
            this.horariosL = [{ id: 1, livre: false }, { id: 2, livre: false }, { id: 3, livre: true }, { id: 4, livre: true }, { id: 5, livre: false }]
          } else {
            this.horariosL = [{ id: 1, livre: false }, { id: 2, livre: false }, { id: 3, livre: false }, { id: 4, livre: false }, { id: 5, livre: false }]
          }
          resolve(this.horariosF)
        }, 500)
      })
    },
    handleSubmit () {
      try {
        if (this.form.nome !== null && this.form.email !== null && this.form.operacaourbana !== '' && this.form.horario !== null && this.form.data !== null) {
          console.log(this.form)
        } else {
          const invalid = true
          throw invalid
        }
      } catch (err) {
        console.log(err)
      }
    }
  }
}
</script>

<style lang="scss" scoped>

#agendamento {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 100%;
  padding: 50px;
  justify-content: center;

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
          background-color: var(--verde);
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
        background-color: var(--verde);
        border: 1px var(--verde-claro) solid;
        border-radius: 5px;
        color: var(--branco);
        font-size: 15pt;
        margin-top: 7px;
        padding: 5px;
        height: 40px;

        &:hover {
          cursor: pointer;
          background-color: var(--verde-escuro);
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
