<template>
  <div id="modal"
    :style="{ display: validateForm.showModal ? 'flex' : 'none' }"
  >
    <div class="modal-content" :class="validateForm.type ? 'border-sucesso' : 'border-erro'">
        <div id="sucesso" v-if="validateForm.type">
            <h1>Agendamento registrado!</h1>
            <icon-sucesso></icon-sucesso>
        </div>
        <div id="erro" v-else>
            <h1>Ocorreu algum erro.</h1>
            <h2>Tente mais tarde</h2>
            <icon-erro></icon-erro>
        </div>
    </div>
  </div>
</template>

<script>
import IconSucesso from './elements/Sucesso'
import IconErro from './elements/Erro'
export default {
  name: 'Modal',
  props: {
    validateForm: {
      type: Object,
      required: true
    }
  },
  components: {
    IconSucesso,
    IconErro
  }
}
</script>

<style lang="scss" scoped>
@import '../assets/scss/variables';
#modal {
    align-items: center;
    background-color: rgba(0, 0, 0, 0.747);
    color: $preto;
    display: none;
    justify-content: center;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    position: fixed;
    overflow: auto;
    z-index: 11;
    .modal-content {
        align-items: center;
        background-color: #FFF;
        border-radius: 16px;
        display: flex;
        flex-direction: column;
        max-width: 400px;
        padding: 30px;
        #sucesso, #erro {
            h1 {
              font-size: 1.6rem;
            }

            width: 100%;
            align-items: center;
            display: flex;
            flex-direction: column;
        }
    }
    .border-sucesso {
        border-top: 16px solid $verde;
    }
    .border-erro {
        border-top: 16px solid $vermelho;
    }
}
</style>
