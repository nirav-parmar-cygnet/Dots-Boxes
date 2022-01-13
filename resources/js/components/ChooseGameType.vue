<template>
  <div class="col-12 d-flex flex-column align-items-center justify-content-center">
    <div class="d-grid gap-3">
      <div class="p-2 bg-light border" v-for="gameType in gameTypes" :key="gameType.key">
        <button type="button" class="btn btn-success w-100"
          v-on:click="$emit( 'save-game-type', gameType.key )">
          {{ gameType.label }}
        </button>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    name: 'ChooseGameType',
    data: function() {
      return {
        gameTypes: [
          {
            'key': 'computer',
            'label': 'Play with Computer',
          },
          {
            'key': 'multiplayer',
            'label': 'Multi Player'
          }
        ],
      }
    },
  }
</script>
