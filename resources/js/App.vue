<template>
  <div class="col-12 d-flex">
    <template v-if="!gameType">
      <choose-game-type v-on:save-game-type="saveGameType" />
    </template>
    <template v-else-if="!gamePlayers.players.length">
      <choose-players-count v-on:save-players-count="savePlayersCount" />
    </template>
    <template v-else-if="!gamePlayers.namingDone">
      <choose-players-name :game-players="gamePlayers" v-on:save-players-name="savePlayersName" />
    </template>
    <template v-else-if="!gameMatrix.length">
      <choose-game-matrix :game-matrix-options="gameMatrixOptions" v-on:save-game-matrix="saveGameMatrix" />
    </template>
    <template v-else>
      <game-dashboard
        :game-matrix="gameMatrix"
        :game-players="gamePlayers"
        :current-player="currentPlayer"
        v-on:player-clicked-on-line="playerClickedOnLine"
        v-on:restart-game="restartGame"
        v-on:end-game="endGame"
      />
    </template>
  </div>
</template>
<script>

  import ChooseGameType from './components/ChooseGameType';
  import ChoosePlayersCount from './components/ChoosePlayersCount';
  import ChoosePlayersName from './components/ChoosePlayersName';
  import ChooseGameMatrix from './components/ChooseGameMatrix';
  import GameDashboard from './components/GameDashboard';

  export default {
    components: {
      'choose-game-type': ChooseGameType,
      'choose-players-count': ChoosePlayersCount,
      'choose-players-name': ChoosePlayersName,
      'choose-game-matrix': ChooseGameMatrix,
      'game-dashboard': GameDashboard,
    },
    data: function() {
      return {
        gameType: '',
        gamePlayers: {
          namingDone: false,
          players: [],
        },
        gameMatrixOptions: [
          { rows: 9, columns: 9 },
          { rows: 12, columns: 12 },
          { rows: 15, columns: 15 },
          { rows: 18, columns: 18 }
        ],
        gameMatrix: [],
        currentPlayer: 0,
        isGameEnded: false,
      }
    },
    methods: {
      saveGameType: function( gameType ) {
        this.gameType = gameType;

        if( gameType === 'computer' )
        {
          this.gamePlayers = {
            namingDone: true,
            players: [{
              name: 'Computer',
              score: 0,
              isComputer: true,
            }, {
              name: 'You',
              score: 0,
              isComputer: false,
            }],
          };
        }
        else {
          this.gamePlayers = {
            namingDone: false,
            players: [],
          };
        }
      },
      savePlayersCount: function( playersCount ) {
        var players = [];
        for( var i = 0; i < playersCount; i++ ) {
          players.push({
            name: 'Player ' + ( i + 1 ),
            score: 0,
            isComputer: false,
          });
        }
        this.gamePlayers = {
          namingDone: false,
          players: players,
        };
      },
      savePlayersName: function( ) {
        this.$set( this.gamePlayers, 'namingDone', true );
      },
      saveGameMatrix: function( gameMatrixOption ) {
        var gameMatrix = []; 
        for( var i = 0; i < gameMatrixOption.rows; i++ ) {
          gameMatrix[i] = [];
          for( var j = 0; j < gameMatrixOption.columns; j++ ) {
            gameMatrix[i][j] = {
              top: null,
              left: null,
              bottom: null,
              right: null,
              player: null,
            };
          }
        }
        this.gameMatrix = gameMatrix;
        this.currentPlayer = 0;
      },
      playerClickedOnLine: function( row, column, position ) {
        if( this.gameMatrix[row][column][position] === null )
        {
          var changePlayer = true;
          var players  = this.gamePlayers.players;

          var matrixRow = this.gameMatrix[row];
          matrixRow[column][position] = parseInt( this.currentPlayer );
          if(matrixRow[column].top != null && matrixRow[column].left != null && matrixRow[column].bottom != null && matrixRow[column].right != null)
          {
            matrixRow[column].player = parseInt( this.currentPlayer );
            players[this.currentPlayer].score++;
            this.$set( this.gamePlayers, 'players', players );
            changePlayer = false;
          }
          this.$set( this.gameMatrix, row, matrixRow );

          switch( position )
          {
            case 'top':
              if( row > 0 ) {
                matrixRow = this.gameMatrix[row - 1];
                matrixRow[column].bottom = parseInt( this.currentPlayer );
                if(matrixRow[column].top != null && matrixRow[column].left != null && matrixRow[column].bottom != null && matrixRow[column].right != null)
                {
                  matrixRow[column].player = parseInt( this.currentPlayer );
                  players[this.currentPlayer].score++;
                  this.$set( this.gamePlayers, 'players', players );
                  changePlayer = false;
                }
                this.$set( this.gameMatrix, (row - 1), matrixRow );
              }
              break;
            case 'left':
              if( column > 0 ) {
                matrixRow = this.gameMatrix[row];
                matrixRow[column - 1].right = parseInt( this.currentPlayer );
                if(matrixRow[column - 1].top != null && matrixRow[column - 1].left != null && matrixRow[column - 1].bottom != null && matrixRow[column - 1].right != null)
                {
                  matrixRow[column - 1].player = parseInt( this.currentPlayer );
                  players[this.currentPlayer].score++;
                  this.$set( this.gamePlayers, 'players', players );
                  changePlayer = false;
                }
                this.$set( this.gameMatrix, (row), matrixRow );
              }
              break;
            case 'bottom':
              if( row < ( this.gameMatrix.length - 1 ) ) {
                matrixRow = this.gameMatrix[row + 1];
                matrixRow[column].top = parseInt( this.currentPlayer );
                if(matrixRow[column].top != null && matrixRow[column].left != null && matrixRow[column].bottom != null && matrixRow[column].right != null)
                {
                  matrixRow[column].player = parseInt( this.currentPlayer );
                  players[this.currentPlayer].score++;
                  this.$set( this.gamePlayers, 'players', players );
                  changePlayer = false;
                }
                this.$set( this.gameMatrix, (row - 1), matrixRow );
              }
              break;
            case 'right':
              if( column > ( this.gameMatrix[row].length - 1 ) ) {
                matrixRow = this.gameMatrix[row];
                matrixRow[column + 1].right = parseInt( this.currentPlayer );
                if(matrixRow[column + 1].top != null && matrixRow[column + 1].left != null && matrixRow[column + 1].bottom != null && matrixRow[column + 1].right != null)
                {
                  matrixRow[column + 1].player = parseInt( this.currentPlayer );
                  players[this.currentPlayer].score++;
                  this.$set( this.gamePlayers, 'players', players );
                  changePlayer = false;
                }
                this.$set( this.gameMatrix, (row), matrixRow );
              }
              break;
          }

          if( changePlayer )
          {
            if( this.currentPlayer < ( this.gamePlayers.players.length - 1 ) )
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
      restartGame: function( ) {
        this.saveGameMatrix({
          rows: this.gameMatrix.length,
          columns: this.gameMatrix[0].length,
        });
        var players = this.gamePlayers.players.map( player => {
          player.score = 0;
          return player;
        });
        this.$set( this.gamePlayers, 'players', players );
        this.currentPlayer = 0;
      },
      endGame: function() {
        
      },
    },
    watch: {
      gameType( gameType ) {
        localStorage.gameType = gameType;
      },
      gamePlayers : {
        handler( gamePlayers ) {
          localStorage.gamePlayers = JSON.stringify( gamePlayers );
        },
        deep: true,
      },
      gameMatrix: {
        handler( gameMatrix ) {
          localStorage.gameMatrix = JSON.stringify( gameMatrix );
        },
        deep: true,
      },
      currentPlayer( currentPlayer ) {
        localStorage.currentPlayer = parseInt( currentPlayer );
      }
    },
    mounted() {
      if( localStorage.gameType ) {
        this.gameType = localStorage.gameType;

        if( localStorage.gamePlayers ) {
          this.gamePlayers = JSON.parse( localStorage.gamePlayers );
        }

        if( localStorage.gameMatrix ) {
          this.gameMatrix = JSON.parse( localStorage.gameMatrix );

          if( localStorage.currentPlayer ) {
            this.currentPlayer = parseInt(localStorage.currentPlayer);
          }
        }
      }
    }
  }
</script>
<style>
  @import './assets/style.scss';
</style>