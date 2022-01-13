<template>
  <div class="col-12 d-flex flex-column align-items-center justify-content-center">
    <div class="d-grid gap-3">
      <div class="form-group" v-for="(player, playerIndex) in gamePlayers.players" :key="playerIndex">
        <input type="text" class="form-control" v-model="gamePlayers.players[playerIndex].name">
      </div>
    </div>
    <button type="button" class="mt-3 btn btn-success" v-on:click="$emit('save-players-name')">NEXT</button>
  </div>
</template>
<script>
  export default {
    name: 'ChoosePlayersName',
    props: {
      gamePlayers: {
        type: Object,
        required: true,
      }
    },
  }
</script>
