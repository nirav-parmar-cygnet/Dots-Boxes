<template>
  <div class="col-12">
    <div class="row">
      <div class="col-9">
        <table id="matrix-table">
          <tr v-for="(row, rowIndex) in matrix" :key="`row-${rowIndex}`">
            <td v-for="(column, columnIndex) in row" :key="`td-${rowIndex}-${columnIndex}`">
              <span type="button" :class="{
                  'top': true,
                  'bg-light': column.top === null,
                  'btn-primary': column.top === 0, 
                  'btn-success': column.top === 1,
                  'btn-danger': column.top === 2,
                  'btn-info': column.top === 3,
                }" v-on:click="$emit( 'line-clicked', rowIndex, columnIndex, 'top' )" />
              <span type="button" :class="{
                  'left': true,
                  'bg-light': column.left === null,
                  'btn-primary': column.left === 0, 
                  'btn-success': column.left === 1,
                  'btn-danger': column.left === 2,
                  'btn-info': column.left === 3,
                }" v-on:click="$emit( 'line-clicked', rowIndex, columnIndex, 'left' )" />
              <span type="button" :class="{
                  'bottom': true,
                  'bg-light': column.bottom === null,
                  'btn-primary': column.bottom === 0, 
                  'btn-success': column.bottom === 1,
                  'btn-danger': column.bottom === 2,
                  'btn-info': column.bottom === 3,
                }" v-on:click="$emit( 'line-clicked', rowIndex, columnIndex, 'bottom' )" v-show="( rowIndex + 1 ) == matrix.length" />
              <span type="button" :class="{
                  'right': true,
                  'bg-light': column.right === null,
                  'btn-primary': column.right === 0, 
                  'btn-success': column.right === 1,
                  'btn-danger': column.right === 2,
                  'btn-info': column.right === 3,
                }" v-on:click="$emit( 'line-clicked', rowIndex, columnIndex, 'right' )" v-show="( columnIndex + 1 ) == row.length"  />
                {{ column.player }}
            </td>
          </tr>
        </table>
      </div>
      <div class="col-3 mt-2">
        <div class="d-grid gap-3">
          <div :class="{
            'input-group': true,
            'border': true,
            'border-5': currentPlayer == (playerId + 1)
          }" v-for="(player, playerId) in players" :key="playerId">
            <button type="button" :class="{
                'btn': true,
                'btn-primary': playerId === 0, 
                'btn-success': playerId === 1,
                'btn-danger': playerId === 2,
                'btn-info': playerId === 3,
              }">
              {{ player.name }}
            </button> 
            <input type="text" class="form-control" v-model="players[playerId].score" readonly>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'game-dashboard',
  props: {
    matrix: {
      type: Array,
      required: true,
    },
    players: {
      type: Array,
      required: true,
    },
    currentPlayer: {
      type: Number,
      required: true,
    }
  }
}
</script>
