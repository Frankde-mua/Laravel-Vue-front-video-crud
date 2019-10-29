<template>
<div>
    <div>
        <router-link :to="{name: 'createMovie'}" class="btn btn-success">Create new movie</router-link>
    </div>
    <div class="padding row">
        <div class="col">
            <select v-model="testVal" class="custom-select">
                <option value="" selected="selected">Please select one</option>
                <option v-for="item in items" :key="item">{{item}}</option>
            </select>
        </div>
        <div class="col">
            <input type="text" class="form-control" v-model="search" placeholder="Search...." />
        </div>
    </div>
    <div class="padding">
        <table class="table">
            <tr>
                <th scope="col" v-for="col in cols" :key="col">{{ col }}</th>
            </tr>
            <tr v-for="(row, index) in rows" :key="index" style="margin-bottom: 5px;">
                <td scope="row" v-for="col in cols" :key="col">{{ row[col] }}</td>
                <td>
                    <router-link :to="{name: 'editMovie', params: {id: row.id}}"> 
                        <button class="btn btn-xs btn-primary">
                                Edit
                        </button>
                            </router-link>
                </td>
                <td>
                    <button data-toggle="modal" data-target="#exampleModalLong" class="btn btn-xs btn-danger" @click="previewData(row.id, index)">
                            Delete
                    </button>
                </td>
            </tr>
        </table>
    </div>

    <!--- delete model --->
   <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="aline">
                        <div class="col-sm-12">
                            <label for="selectoption">Movie Genre</label>
                            <select class="custom-select" id="selectoption" v-model="testVal.genre" disabled>
                                <label for="selectoption">Movie Genre</label>
                                <option v-for="selected in items" v-bind:value="selected">{{ selected }}</option>
                            </select>
                        </div>
                        <div class=" col-sm-12">
                            <label class="control-label">Movie Name</label>
                            <input type="text" v-model="testVal.name" class="form-control" disabled>
                        </div>
                </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" @click="deleteEntry()" data-dismiss="modal">Delete</button>
      </div>
    </div>
  </div>
</div>

</div>
</template>

<script>
import moviesCreate from './movie-create.vue'
// import moviesEdit from './movie-edit.vue'
export default {
    data: function () {
        return {
            has_error: false,
            name: '',
            genre: '',
            item: 'Select Title',
            movies: [],
            selectedCategory: "All",
            search: null,
            items: [ 'Horror', 'Comedy', 'Fantasy', 'Action', 'Anime', 'Romance'],
            testVal: [],
            movieId: null
        }
    },
    beforeMount() {
        this.getMovies();
        this.movies = Array.from(Array(20), (x, i) => {
            return {
                id: i,
                name: Math.random().toString(36).substring(7),
                genre: Math.random().toString(36).substring(7),
            }
        })
    },
    computed: {
        cols() {
            return this.movies.length >= 1 ? Object.keys(this.movies[0]) : []
        },
        rows() {
            if (!this.movies.length) {
                return []
            }

            return this.movies.filter(movie => {
                let props = (this.search && this.column) ? [movie[this.column]] : Object.values(movie)

                return props.some(prop => !this.search || ((typeof prop === 'string') ? prop.includes(this.search) : prop.toString(10).includes(this.items)))
            })
        }
    },
    mounted() {
        // this.getMovies();
    },
    components: {
        moviesCreate
    },
    methods: {
        getMovies() {
            this.$http({
                    url: `auth/moviesList`,
                    method: 'GET'
                })
                .then((res) => {
                    this.movies = res.data,
                        console.log(this.movies)
                }, () => {
                    this.has_error = true
                })
        },
        previewData(id){
            let app = this;
            app.movieId = id;
            axios.get('auth/editMovie/' + id)
                .then(function (resp) {
                    app.testVal = resp.data;
                })
                .catch(function () {
                    alert("Could not load your company")
                });
        },
        deleteEntry() {
                var app = this;
                var id = app.movieId;
            if (confirm("Do you really want to delete it?")) {
                axios.delete('auth/delete/' + id)
                    .then(function (resp) {
                        const index = this.movies.findIndex(movie => movie.id === id)

                        if (~index) // if the post exists in array
                            this.movies.splice(index, 1); //delete the post
                    });
            }
    }
}
}
</script>

<style scoped>
.padding {
    padding-top: 20px;
}

.custom-select {
    position: relative;
    font-family: Arial;
}

.custom-select select {
    display: none;
    /*hide original SELECT element:*/
}

/*style the arrow inside the select element:*/
.select-selected:after {
    position: absolute;
    content: "";
    top: 14px;
    right: 10px;
    width: 0;
    height: 0;
    border: 6px solid transparent;
    border-color: #fff transparent transparent transparent;
}
.container {
    height: 600px;
}
</style>
