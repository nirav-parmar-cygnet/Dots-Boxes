<template>
  <div class="col-12 d-flex flex-column align-items-center justify-content-center">
    <div class="d-grid gap-3">
      <div class="p-2 bg-light border" v-for="(gameMatrixOption, gameMatrixIndex) in gameMatrixOptions" :key="gameMatrixIndex">
        <button class="btn btn-success w-100" type="button"
          v-on:click="$emit( 'save-game-matrix', gameMatrixOption )">
          {{ gameMatrixOption.rows }} x {{ gameMatrixOption.columns }}
        </button>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    name: 'ChooseGameMatrix',
    props: {
      gameMatrixOptions: {
        type: Array,
        required: true,
      }
    }
  }
</script>
