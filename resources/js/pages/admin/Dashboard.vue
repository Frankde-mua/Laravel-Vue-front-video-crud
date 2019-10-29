<template>
    <div class="container">
        <div class="card card-default">
            <div class="card-header">Admin Dashboard</div>

            <div class="card-body">
                Welcome to your administrator dashboard
            </div>

        </div>
        <div class="padding">
          <div class="card card-default">
            <div class="card-header">Users List</div>

              <div class="card-body">
                  <userList></userList>
              </div>
          </div>
        </div>
    </div>
</template>

<script>
  import userList from '../../components/user-list.vue'
  export default {
    mounted() {
      //
    },
    components: {
      userList
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
