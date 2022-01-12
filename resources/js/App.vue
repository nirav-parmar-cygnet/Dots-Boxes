<template>
  <div class="col-12 d-flex">
    <template v-if="!players.length">
      <players-count :maximum-players="maximumPlayers" v-on:save="initPlayers" />
    </template>
    <template v-else-if="!playersNamingDone">
      <players-name :players="players" v-on:save="savePlayersName" />
    </template>
    <template v-else-if="!matrix.length">
      <choose-matrix :matrix-options="matrixOptions" v-on:save="saveMatrix" />
    </template>
    <template v-else>
      <game-dashboard :matrix="matrix" :players="players" :currentPlayer="currentPlayer" v-on:line-clicked="lineClicked" />
    </template>
  </div>
</template>
<script>
  import PlayersCount from './components/PlayersCount';
  import PlayersName from './components/PlayersName';
  import ChooseMatrix from './components/ChooseMatrix';
  import gameDashboard from './components/GameDashboard';
  export default {
    components: {
      'players-count': PlayersCount,
      'players-name': PlayersName,
      'choose-matrix': ChooseMatrix,
      'game-dashboard': gameDashboard,
    },
    data: function() {
      return {
        maximumPlayers: 4,
        players: [],
        playersNamingDone: false,
        currentPlayer: 1,
        matrixOptions: [
          {
            rows: 12,
            columns: 18,
          },
          {
            rows: 18,
            columns: 27,
          },
          {
            rows: 24,
            columns: 36,
          }
        ],
        matrix: [],
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
      saveMatrix: function( matrixOption ) {
        var matrix = []; 
        for( var i = 0; i < matrixOption.rows; i++ ) {
          matrix[i] = [];
          for( var j = 0; j < matrixOption.columns; j++ ) {
            matrix[i][j] = {
              top: null,
              left: null,
              bottom: null,
              right: null,
              player: null,
            };
          }
        }
        this.matrix = matrix;
      },
      lineClicked: function( row, column, position ) {

        var playerChanged = true;

        if( this.matrix[row][column][position] === null )
        {
          var matrixRow = this.matrix[row];
          matrixRow[column][position] = this.currentPlayer;
          if(matrixRow[column].top != null && matrixRow[column].left != null && matrixRow[column].bottom != null && matrixRow[column].right != null)
          {
            matrixRow[column].player = this.currentPlayer;
            playerChanged = false;
          }
          this.$set( this.matrix, row, matrixRow );

          if( position == 'top' && row != 0 )
          {
            matrixRow = this.matrix[row - 1];
            matrixRow[column].bottom = this.currentPlayer;
            if(matrixRow[column].top != null && matrixRow[column].left != null && matrixRow[column].bottom != null && matrixRow[column].right != null)
            {
              matrixRow[column].player = this.currentPlayer;
              playerChanged = false;
            }
            this.$set( this.matrix, (row - 1), matrixRow );
          }

          if( position == 'left' && column != 0 )
          {
            matrixRow = this.matrix[row];
            matrixRow[column - 1].right = this.currentPlayer;
            if(matrixRow[column].top != null && matrixRow[column].left != null && matrixRow[column].bottom != null && matrixRow[column].right != null)
            {
              matrixRow[column].player = this.currentPlayer;
              playerChanged = false;
            }
            this.$set( this.matrix, (row), matrixRow );
          }

          if( playerChanged )
          {
            if( this.players[ this.currentPlayer + 1 ] != null )
            {
              this.currentPlayer++;
            }
            else
            {
              this.currentPlayer = 0;
            }
          }
        }
      },
    },
    watch: {
      players( players ) {
        localStorage.players = JSON.stringify( players );
      },
      playersNamingDone( playersNamingDone ) {
        localStorage.playersNamingDone = playersNamingDone;
      },
      matrix( matrix ) {
        localStorage.matrix = JSON.stringify( matrix );
      },
      currentPlayer( currentPlayer ) {
        localStorage.currentPlayer = currentPlayer;
      }
    },
    mounted() {
      if( localStorage.players ) {
        this.players = JSON.parse( localStorage.players );
      }
      if( localStorage.playersNamingDone ) {
        this.playersNamingDone = JSON.parse( localStorage.playersNamingDone );
      }
      if( localStorage.matrix ) {
        this.matrix = JSON.parse( localStorage.matrix );
      }
      if( localStorage.currentPlayer ) {
        this.currentPlayer = localStorage.currentPlayer;
      }
    }
  }
</script>
<style>
  @import './assets/style.scss';
</style>