<template>
<div class="container">
        <div class="padding">
          <div class="card card-default">

              <div class="card-body">
                  <moviesList></moviesList>
              </div>
          </div>
        </div>
    </div>
</template>

<script>
  import moviesList from './components/movies-index.vue'
  export default {
    mounted() {
      //
    },
    components: {
      moviesList
    }
  }
</script>
<style scoped>
.container {
  padding-top: 20px;
  justify-content: center;
  width: 700px;
}
.padding {
  padding-top: 20px;
}
</style>