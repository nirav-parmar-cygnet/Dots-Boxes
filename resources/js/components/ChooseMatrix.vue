<template>
  <div class="col-12 d-flex flex-column align-items-center justify-content-center">
    <div class="d-grid gap-3">
      <div class="p-2 bg-light border" v-for="(matrixOption, matrixIndex) in matrixOptions" :key="matrixIndex">
        <button class="btn btn-success" type="button" v-on:click="$emit( 'save', matrixOption )">
          {{ matrixOption.rows }} x {{ matrixOption.columns }}
        </button>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'choose-matrix',
  props: {
    matrixOptions: {
      type: Array,
      required: true,
    }
  }
}
</script>
