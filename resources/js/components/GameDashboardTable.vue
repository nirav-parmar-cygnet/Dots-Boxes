<template>
  <div class="col-12 col-md-9">
    <table id="matrix-table">
      <tr v-for="(row, rowIndex) in gameMatrix" :key="`row-${rowIndex}`">
        <td v-for="(column, columnIndex) in row" :key="`td-${rowIndex}-${columnIndex}`" :class="{
            'text-center': true,
            'text-primary': column.player === 0,
            'text-success': column.player === 1,
            'text-danger': column.player === 2,
            'text-info': column.player === 3,
          }" :width="`${100 / gameMatrix.length}%`">
          <span :class="{
              'top': true,
              'bg-light': column.top === null,
              'btn-primary': column.top === 0, 
              'btn-success': column.top === 1,
              'btn-danger': column.top === 2,
              'btn-info': column.top === 3,
            }" v-on:click="$emit( 'player-clicked-on-line', rowIndex, columnIndex, 'top' )" />
          <span :class="{
              'left': true,
              'bg-light': column.left === null,
              'btn-primary': column.left === 0, 
              'btn-success': column.left === 1,
              'btn-danger': column.left === 2,
              'btn-info': column.left === 3,
            }" v-on:click="$emit( 'player-clicked-on-line', rowIndex, columnIndex, 'left' )" />
          <span :class="{
              'bottom': true,
              'bg-light': column.bottom === null,
              'btn-primary': column.bottom === 0, 
              'btn-success': column.bottom === 1,
              'btn-danger': column.bottom === 2,
              'btn-info': column.bottom === 3,
            }" v-on:click="$emit( 'player-clicked-on-line', rowIndex, columnIndex, 'bottom' )" />
          <span :class="{
              'right': true,
              'bg-light': column.right === null,
              'btn-primary': column.right === 0, 
              'btn-success': column.right === 1,
              'btn-danger': column.right === 2,
              'btn-info': column.right === 3,
            }" v-on:click="$emit( 'player-clicked-on-line', rowIndex, columnIndex, 'right' )"  />
          <span class="player" v-if="column.player !== null">P{{ column.player + 1 }}</span>
        </td>
      </tr>
    </table>
  </div>
</template>
<script>
  export default {
    name: 'GameDashboardTable',
    props: {
      gameMatrix: {
        type: Array,
        required: true,
      },
    }
  }
</script>