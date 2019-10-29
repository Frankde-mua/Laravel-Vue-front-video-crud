
<template>
    <div>
        <div class="container">
        <div class="card card-default">
            <div class="card-header">New Movie</div>
                <form class="aline">
                        <div class="col-sm-12">
                            <label for="selectoption">Movie Genre</label>
                            <select class="custom-select" id="selectoption" v-model="genre">
                                <label for="selectoption">Movie Genre</label>
                                <option v-for="selected in items" v-bind:value="selected">{{ selected }}</option>
                            </select>
                        </div>
                        <div class=" col-sm-12">
                            <label class="control-label">Movie Name</label>
                            <input type="text" v-model="name" class="form-control">
                        </div>
                    <div class="row padding">
                        <router-link to="/dashboard">
                        <div class="col ">
                            <button class="btn btn-success" @click="saveForm()">Create</button>
                        </div>
                        </router-link>
                        <div class="col ">
                            <router-link to="/dashboard"> 
                                <button class="btn btn-warning">Cancel</button>
                            </router-link>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                    name: '',
                    selected:'',
                    genre: '',
                    test: '',   
                items: [ 'Horror', 'Comedy', 'Fantasy', 'Action', 'Anime', 'Romance'],
            }
        },
        methods: {
            saveForm() {
                var data = {
                    vname: this.name,
                    vgenre: this.genre
                }
                axios.post('auth/newMovie', data)
                    .then(function (resp) {
                        console.log(resp)
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not create your movie");
                    });
                // this.$http({
                // url: `auth/newMovie`, data,
                // method: 'POST'
                // })
                //     .then((res) => {
                //     console.log(this.movies)
                //     }, () => {
                //     this.has_error = true
                //     })
                    
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
