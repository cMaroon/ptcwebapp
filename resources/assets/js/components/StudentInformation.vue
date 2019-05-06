<template>
 <div class="row justify-content-center">
   <div class="col-md-12">
      <div class="card">
          <div class="card-header">
            <h3 class="card-title">Student Personal Information</h3>
            <div class="card-tools" style="position: absolute;right:1rem;top:.5rem;">
              <!-- <button type="button" class="btn btn-success" @click="create">Add New <i class="fas fa-plus"></i></button> -->
              <button type="button" class="btn btn-primary" @click="reload">Reload <i class="fas fa-sync"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <div class="col-md-12 mt-3">
            <form class="mb-3">
              <div class="row">
                <div class="col-md-3" style="text-align:right">
                  <strong>Search By : </strong>
                </div>
                <div class="col-md-2">
                  <select v-model="queryField" class="form-control" id="fields">
                    <option value="id_num" selected>ID Number</option>
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
                  <th>ID Number</th>
                  <th>Fullname</th>
                  <th>Address</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-show="!studentuser.length" v-for="(studentuser, index) in studentuser" :key="studentuser.id">
                    <td>{{ index + 1}}</td>
                    <td hidden>{{ studentuser.id }}</td>
                    <td>{{ studentuser.id_num }}</td>
                    <td>{{ studentuser.lastname }} {{ studentuser.suffixname }}, {{ studentuser.firstname }} {{ studentuser.middlename }}</td>
                    <td>{{ studentuser.ca_st_num }} {{ studentuser.ca_st_name }} {{ studentuser.ca_subd }} {{ studentuser.ca_brgy }} {{ studentuser.ca_city }}</td>
                    <td class="text-center">
                        <!-- <button type="button" @click="show(studentuser)" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </button> -->
                        <button type="button" @click="edit(studentuser)" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                        </button>
                        <!-- <button type="button" @click="destroy(studentuser)" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i>
                        </button> -->
                        
                    </td>


                </tr>
                <tr v-show="!studentuser.length">
                  <td colspan="5">
                    <div class="alert alert-danger" role="alert">
                      No Data Found!
                    </div>
                  </td>
                </tr>
              </tbody>
              <tfoot>
              <tr>
                <th>#</th>
                <th>ID Number</th>
                <th>Fullname</th>
                <th>Address</th>
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
   <!-- Modal -->
    <div class="modal fade" id="studentuserModalLong" tabindex="-1" role="dialog" aria-labelledby="studentuserModalTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="studentuserModalTitle">{{ editMode ? "Edit":"Add New"}} Address - {{ this.form.id_num }}
              <br>Fullname : {{ this.form.lastname }} {{ this.form.suffixname }}, {{ this.form.firstname }} {{ this.form.middlename }}
            </h5>

          </div>
            
          <form @submit.prevent="editMode ? update() : store()" @keydown="form.onKeydown($event)">
          <div class="modal-body">
            <alert-error :form="form" message="There were some problems with your input."></alert-error>
              
              <div class="form-group">
                <label>Street Number</label>
                <input v-model="form.ca_st_num" type="text" name="ca_st_num"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('ca_st_num') }">
                <has-error :form="form" field="ca_st_num"></has-error>
              </div>
              <div class="form-group">
                <label>Street Name</label>
                <input v-model="form.ca_st_name" type="text" name="ca_st_name"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('ca_st_name') }">
                <has-error :form="form" field="ca_st_name"></has-error>
              </div>
              <div class="form-group">
                <label>Subdivision</label>
                <input v-model="form.ca_subd" type="text" name="ca_subd"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('ca_subd') }">
                <has-error :form="form" field="ca_subd"></has-error>
              </div>
              <div class="form-group">
                <label>Barangay</label>
                <input v-model="form.ca_brgy" type="text" name="ca_brgy"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('ca_brgy') }">
                <has-error :form="form" field="ca_brgy"></has-error>
              </div>
              <div class="form-group">
                <label>City</label>
                <input v-model="form.ca_city" type="text" name="ca_city"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('ca_city') }">
                <has-error :form="form" field="ca_city"></has-error>
              </div>
              

          </div>
          <div class="modal-footer">
            <button :disabled="form.busy" type="submit" class="btn btn-primary">Save changes</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    

   <vue-progress-bar></vue-progress-bar>
   <vue-snotify></vue-snotify>
 </div>
</template>

<script>
    export default {
      data(){
        return{
          editMode: false,
          query:'',
          queryField:'id_num',
          studentuser:[],
          totalcount:'',
          form : new Form({
            id:'',
            id_num:'',
            firstname:'',
            middlename:'',
            lastname:'',
            suffixname:'',
            ca_st_num:'',
            ca_st_name:'',
            ca_subd:'',
            ca_brgy:'',
            ca_city:'',

          }),
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
            //load data
            this.$Progress.start()
            axios.get('/api/studentinfo?page='+this.pagination.current_page)
              .then(response=>{
                // console.log(response)
                this.studentuser = response.data.data
                this.pagination = response.data.meta
                this.totalcount = this.pagination.total
                this.$Progress.finish()
              })
              .catch(e => {
                console.log(e)
                this.$Progress.fail()
              })
          },
          searchData(){
            this.$Progress.start()
            axios.get('/api/search/studentinfo/'+this.queryField+'/'+this.query+'?page='+this.pagination.current_page)
            .then(response =>{
              this.studentuser = response.data.data
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
            this.$snotify.success('Data Successfully Refresh','Success', {
                  timeout: 1000,
                  showProgressBar: false,
                  closeOnClick: false,
                  pauseOnHover: false,
                  position: "rightTop",
                });
          },
          create(){
            this.editMode = false
            this.form.reset()
            this.form.clear()
            this.form.user_id = this.totalcount + 1
            $('#studentuserModalLong').modal('show')

          },
          store(){
            // console.log('Hello')
            this.$Progress.start()
            this.form.busy = true
            this.form.cd_email = this.form.email
            this.form
              .post('/api/studentinfo')
              .then(response => {
                this.getData()
                $('#studentuserModalLong').modal('hide')
                  if(this.form.successful){
                    this.$Progress.finish()
                    this.$snotify.success('Data Successfully Saved','Success', {
                          timeout: 3000,
                          showProgressBar: false,
                          closeOnClick: false,
                          pauseOnHover: false,
                          position: "rightTop",
                        });
                  }else{
                    this.$Progress.fail()
                    this.$snotify.error('Something went wrong try again later','Error', {
                          timeout: 3000,
                          showProgressBar: false,
                          closeOnClick: false,
                          pauseOnHover: false,
                          position: "rightTop",
                        });
                  }
              })
              .catch(e => {
                this.$Progress.fail()
                // console.log(e)
              })
          },
          show(studentuser) {
            this.form.reset();
            this.form.fill(studentuser);
            $("#showModalLong").modal("show");
            // console.log(studentuser);
          },
          edit(studentuser){
            $('#studentuserModalLong').modal('show')
            this.editMode = true
            this.form.reset()
            this.form.clear()
            this.form.fill(studentuser)



          },
          update(){
            this.$Progress.start()
            this.form.busy = true
            this.form
              .put('/api/studentinfo/'+this.form.id)
              .then(response => {
                this.getData()
                $('#studentuserModalLong').modal('hide')
                  if(this.form.successful){
                    this.$Progress.finish()
                    this.$snotify.success('Data Successfully Updated','Success', {
                          timeout: 3000,
                          showProgressBar: false,
                          closeOnClick: false,
                          pauseOnHover: false,
                          position: "rightTop",
                        });
                  }else{
                    this.$Progress.fail()
                    this.$snotify.error('Something went wrong try again later','Error', {
                          timeout: 3000,
                          showProgressBar: false,
                          closeOnClick: false,
                          pauseOnHover: false,
                          position: "rightTop",
                        });
                  }
              })
              .catch(e => {
                this.$Progress.fail()
                // console.log(e)
              })
          },
          destroy(studentuser){
            this.form.id = studentuser.id
            this.$snotify.clear()
            this.$snotify.confirm(
              "You will not be able to recover this data!",
              "Are you sure?",{
                showProgressBar: false,
                closeOnClick: false,
                pauseOnHover: true,
                position: "rightTop",
                buttons: [
                  {
                    text: "Yes",
                    action: toast => {
                      this.$snotify.remove(toast.id);
                      axios
                          .delete('/api/studentinfo/'+this.form.id)
                          .then(response =>{
                            this.getData()
                            this.$Progress.finish()
                            this.$snotify.success('Data Successfully Deleted','Success', {
                                timeout: 3000,
                                showProgressBar: false,
                                closeOnClick: false,
                                pauseOnHover: false,
                                position: "rightTop",
                              })
                              
                          })
                          .catch(e => {
                            this.$Progress.fail()
                            // console.log(e)
                          })
                    },
                    bold: true
                  },
                  {
                    text: "No",
                    action: toast => {
                      this.$snotify.remove(toast.id);
                    },
                    bold: true
                  },
                ]
              }
            )

          }
        }
    }
</script>
