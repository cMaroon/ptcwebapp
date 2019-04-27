<template>
 <div class="row justify-content-center">
   <div class="col-md-12">
      <div class="card">
          <div class="card-header">
            <h3 class="card-title">Admin Users Information</h3>
            <div class="card-tools" style="position: absolute;right:1rem;top:.5rem;">
              <button type="button" class="btn btn-primary" @click="reload">Reload <i class="fas fa-sync"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <div class="col-md-12 mt-3">
            <form class="mb-3">
              <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-1">
                  <strong>Search By : </strong>

                </div>
                <div class="col-md-2">
                  <select v-model="queryField" class="form-control" id="fields">
                    <option value="id_num" selected>ID Number</option>
                    <option value="email">Email</option>
                  </select>
                </div>
                <div class="col-md-7">
                  <input v-model="query" type="text" class="form-control" placeholder="Search">
                </div>
              </div>
            </form>
            </div>
              <table class="table table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Id Number</th>
                  <th>Email</th>
                  <th>Fullname</th>
                  <th>Usertype</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-show="!adminuser.length" v-for="(adminuser, index) in adminuser" :key="adminuser.id">
                    <td>{{ index + 1}}</td>
                    <td>{{ adminuser.id_num }}</td>
                    <td>{{ adminuser.email }}</td>
                    <td>{{ adminuser.admin_info.lastname }} {{ adminuser.admin_info.suffixname }}, {{ adminuser.admin_info.firstname }} {{ adminuser.admin_info.middlename }}</td>
                    <td>{{ adminuser.usertype }}</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button type="button" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        
                    </td>


                </tr>
                <tr v-show="!adminuser.length">
                  <td colspan="6">
                    <div class="alert alert-danger" role="alert">
                      No Data Found!
                    </div>
                  </td>
                </tr>
              </tbody>
              <tfoot>
              <tr>
                <th>Id Number</th>
                <th>Email</th>
                <th>Usertype</th>
                <th class="text-center">Action</th>
              </tr>
              </tfoot>
            </table>
            <pagination v-if="pagination.last_page > 1"
                          :pagination="pagination"
                          :offset="5"
                          @paginate="query == ''?getData():searchData()"
                            ></pagination>
          </div>
          <!-- /.card-body -->
      </div>
   </div>
   <vue-progress-bar></vue-progress-bar>
 </div>
          
    
</template>

<script>
    export default {
      data(){
        return{
          query:'',
          queryField:'id_num',
          adminuser:[],
          pagination:{
            current_page:1,
          }
        }
      },
      watch: {
        query:function(newQuery,old){
          if(newQuery == ''){
            this.getData()
          }else{
            // console.log(newQuery)
            this.searchData()
          }
        }
      },
        mounted() {
            console.log('Component mounted.')
            this.getData();
        },
        methods:{
          getData(){
            this.$Progress.start()
            axios.get('/api/adminuser?page='+this.pagination.current_page)
              .then(response=>{
                // console.log(response)
                this.adminuser = response.data.data
                this.pagination = response.data.meta
                this.$Progress.finish()
              })
              .catch(e => {
                console.log(e)
                this.$Progress.fail()
              })
          },
          searchData(){
            this.$Progress.start()
            axios.get('/api/search/adminuser/'+this.queryField+'/'+this.query+'?page='+this.pagination.current_page)
            .then(response =>{
              this.adminuser = response.data.data
              this.pagination = response.data.meta
              this.$Progress.finish()
            })
            .catch(e => {
              console.log(e)
              this.$Progress.fail()
            })
          },
          reload(){
            this.getData()
            this.query=''
            this.queryField='id_num'
          }
        }
    }
</script>
