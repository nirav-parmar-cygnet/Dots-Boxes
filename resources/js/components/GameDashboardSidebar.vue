<template>
  <div class="col-12 col-md-3 mt-2">
    <div class="row mb-3">
      <div class="col-12">
        <div class="d-grid gap-3">
          <div :class="{
            'input-group': true,
            'border': true,
            'border-5': currentPlayer == playerId
          }" v-for="(player, playerId) in gamePlayers.players" :key="playerId">
            <span :class="{
                'btn': true,
                'w-50': true,
                'btn-primary': playerId === 0, 
                'btn-success': playerId === 1,
                'btn-danger': playerId === 2,
                'btn-info': playerId === 3,
              }">
              {{ player.name }}
            </span> 
            <input type="text" class="form-control text-end" v-model="gamePlayers.players[playerId].score" readonly>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="d-grid gap-3">
          <button type="button" class="btn btn-light" v-on:click="$emit( 'restart-game' )">RESTART GAME</button>
          <button type="button" class="btn btn-dark" v-on:click="$emit( 'end-game' )">END GAME</button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    name: 'GameDashboardSidebar',
    props: {
      gamePlayers: {
        type: Object,
        required: true,
      },
      currentPlayer: {
        type: Number,
        required: true,
      }
    }
  }
</script>
