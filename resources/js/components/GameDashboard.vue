<template>
  <div class="col-12">
    <div class="row">
      <game-dashboard-table
        :game-matrix="gameMatrix"
        v-on:player-clicked-on-line="playerClickedOnLine"
      />
      <game-dashboard-sidebar
        :game-players="gamePlayers"
        :current-player="currentPlayer"
        v-on:restart-game="$emit( 'restart-game' )"
        v-on:end-game="$emit( 'end-game' )"
      />
    </div>
  </div>
</template>
<script>
  import GameDashboardTable from './GameDashboardTable.vue';
  import GameDashboardSidebar from './GameDashboardSidebar.vue';

  export default {
    name: 'GameDashboard',
    components: {
      'game-dashboard-table': GameDashboardTable,
      'game-dashboard-sidebar': GameDashboardSidebar,
    },
    props: {
      gameMatrix: {
        type: Array,
        required: true,
      },
      gamePlayers: {
        type: Object,
        required: true,
      },
      currentPlayer: {
        type: Number,
        required: true,
      }
    },
    methods: {
      playerClickedOnLine: function( row, column, position ) {
        this.$emit( 'player-clicked-on-line', row, column, position );
      },
    }
  }
</script>
