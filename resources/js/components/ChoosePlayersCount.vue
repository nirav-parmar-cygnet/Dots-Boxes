<template>
  <div class="col-12 d-flex flex-column align-items-center justify-content-center">
    <div class="d-grid gap-3">
      <div class="p-2 bg-light border"
           v-for="playersCount in maximumPlayersOptions()"
           :key="playersCount">
        <button type="button" class="btn btn-success"
          v-on:click="$emit( 'save-players-count', playersCount )">
          {{ playersCount }} Player
        </button> 
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    name: 'ChoosePlayersCount',
    data: function() {
      return {
        maximumPlayers: 4
      }
    },
    methods: {
      maximumPlayersOptions: function( ) {
        var maximumPlayersOptions = [];
        for( var i = 2; i <= this.maximumPlayers; i++ )
        {
          maximumPlayersOptions.push( i );
        }
        return maximumPlayersOptions;
      },
    }
  }
</script>
