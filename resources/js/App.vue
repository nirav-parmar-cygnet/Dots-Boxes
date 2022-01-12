<template>
  <div class="container">
    <div v-if="!players.length">
      <select-players :maximum-players="maximumPlayers" v-on:init-players="initPlayers" />
    </div>
    <div v-else-if="!playersNamingDone">
      <player-names :players="players" v-on-save-players-name="savePlayersName" />
      <ul>
        <li v-for="(player, index) in players" :key="player">
          <input type="text" v-model="players[index][name]">
        </li>
      </ul>
      <button type="button" v-on:click="savePlayerNames()">Start Game!</button>
    </div>
    <div v-else-if="!selectedMatrix">
      <ul>
        <li v-for="matrixOption in matrixOptions" :key="matrixOption">
          <button type="button" v-on:click="selectMatrix( maxtrixOption )">
            {{ matrixOption.rows }} x {{ matrixOption.columns }}
          </button>
        </li>
      </ul>
    </div>
    <div v-else>
      Dots & Boxes
    </div>
  </div>
</template>
<script>
  import SelectPlayers from './components/SelectPlayers';
  import PlayerNames from '.components/PlayerNames';
  export default {
    components: {
      'select-players': SelectPlayers,
      'player-names': PlayerNames
    },
    data: function() {
      return {
        maximumPlayers: 4,
        players: [],
        playersNamingDone: false,
        matrixOptions: [
          {
            rows: 10,
            columns: 15,
          },
          {
            rows: 18,
            columns: 24,
          },
          {
            rows: 32,
            columns: 48,
          }
        ],
        selectedMatrix: null,
      }
    },
    methods: {
      initPlayers: function( playersCount ) {
        var players = [];
        for( var i = 0; i < playersCount; i++ ) {
          players.push({
            name: 'Player ' + ( i + 1 ),
            score: 0,
          });
        }
        this.players = players;
      },
      savePlayersName: function( ) {
        this.playersNamingDone = true;
      },
      selectMatrix: function( maxtrixOption ) {
        this.selectedMatrix = maxtrixOption;
      },
    }
  }
</script>