
<template>
    <div>
        <div class="container">
        <div class="card card-default">
            <div class="card-header">Edit Movie</div>
                <form class="aline">
                        <div class="col-sm-12">
                            <label for="selectoption">Movie Genre</label>
                            <select class="custom-select" id="selectoption" v-model="movie.genre">
                                <label for="selectoption">Movie Genre</label>
                                <option v-for="selected in items" v-bind:value="selected">{{ selected }}</option>
                            </select>
                        </div>
                        <div class=" col-sm-12">
                            <label class="control-label">Movie Name</label>
                            <input type="text" v-model="movie.name" class="form-control">
                        </div>
                    <div class="row padding">
                        <div class="col ">
                            <router-link to="/dashboard">
                            <button type="submit" class="btn btn-success" @click="saveForm()">Update</button>
                            </router-link>
                        </div>
                        <div class="col ">
                            <router-link to="/dashboard"> 
                                <button class="btn btn-warning">Cancel</button>
                            </router-link>
                        </div>
                        <div class="padding"/>
                    </div>
                </form>
        </div>
    </div>
    </div>
</template>

<script>
     export default {
        mounted() {
            let app = this;
            let id = app.$route.params.id;
            app.movieId = id;
            axios.get('auth/editMovie/' + id)
                .then(function (resp) {
                    app.movie = resp.data;
                })
                .catch(function () {
                    alert("Could not load your company")
                });
        },
        data: function () {
            return {
                movieId: null,
                movie: {
                    name: '',
                    genre: '',   
                },
                selected:'',
                items: ['Horror', 'Comedy', 'Fantasy', 'Action', 'Anime', 'Romance']
            }
        },
        methods: {
            saveForm() {
                var app = this;
                var newMovie = app.movie;
                axios.patch('auth/editMovie/' + app.movieId, newMovie)
                    .then(function (resp) {
                        app.$router.replace('/');
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not create your company");
                    });
            }
        }
    }
</script>
<style>
.aline
    {
  -webkit-align-self: center; /* Safari 7.0+ */
  align-self: center;
}
.padding{
    padding-top: 10px
}
.btn{
    display: inline;
}
.card{
    padding-bottom: 20px
}
.container {
  padding-top: 20px;
  justify-content: center;
  width: 600px;
}
</style>