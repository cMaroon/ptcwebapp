<template>
 <div class="row justify-content-center">
   <div class="col-md-12">
      <div class="card">
          <div class="card-header">
            <h3 class="card-title">Manage Enrollment</h3>
            <div class="card-tools" style="position: absolute;right:1rem;top:.5rem;">
              <button type="button" class="btn btn-success" @click="create">Add New <i class="fas fa-plus"></i></button>
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
                    <option value="enr_form_id" selected>Form ID</option>
                    <option value="enr_id_num">ID Number</option>
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
                  <th>Form ID</th>
                  <th>ID Number</th>
                  <th>School Year</th>
                  <th>Semester</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-show="!studentuser.length" v-for="(studentuser, index) in studentuser" :key="studentuser.id">
                    <td>{{ index + 1}}</td>
                    <td hidden>{{ studentuser.id }}</td>
                    <td>{{ studentuser.id_num }}</td>
                    <td>{{ studentuser.email }}</td>
                    <td>{{ studentuser.lastname }} {{ studentuser.suffixname }}, {{ studentuser.firstname }} {{ studentuser.middlename }}</td>
                    <td class="text-center">
                        <button type="button" @click="show(studentuser)" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button type="button" @click="edit(studentuser)" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" @click="destroy(studentuser)" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        
                    </td>


                </tr>
                <tr v-show="!studentuser.length">
                  <td colspan="6">
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
                <th>Email</th>
                <th>Fullname</th>
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
            <h5 class="modal-title" id="studentuserModalTitle">{{ editMode ? "Edit":"Add New"}} Student User</h5>

          </div>
            
          <form @submit.prevent="editMode ? update() : store()" @keydown="form.onKeydown($event)">
          <div class="modal-body">
            <alert-error :form="form" message="There were some problems with your input."></alert-error>
              <div class="form-group">
                <!-- <label>User ID</label> -->
                <input v-model="form.user_id" type="text" name="user_id"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('user_id') }" readonly hidden>
                <has-error :form="form" field="user_id"></has-error>
              </div>
              <div class="form-group">
                <label>ID Number</label>
                <input v-model="form.id_num" type="text" name="id_num"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('id_num') }">
                <has-error :form="form" field="id_num"></has-error>
              </div>
              <div class="form-group">
                <label>Email</label>
                <input v-model="form.email" type="text" name="email"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                <has-error :form="form" field="email"></has-error>
              </div>
              <div class="form-group">
                <label>First Name</label>
                <input v-model="form.firstname" type="text" name="firstname"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('firstname') }">
                <has-error :form="form" field="firstname"></has-error>
              </div>
              <div class="form-group">
                <label>Middle Name</label>
                <input v-model="form.middlename" type="text" name="middlename"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('middlename') }">
                <has-error :form="form" field="middlename"></has-error>
              </div>
              <div class="form-group">
                <label>Last Name</label>
                <input v-model="form.lastname" type="text" name="lastname"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('lastname') }">
                <has-error :form="form" field="lastname"></has-error>
              </div>
              <div class="form-group">
                <label>Suffix Name</label>
                <input v-model="form.suffixname" type="text" name="suffixname"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('suffixname') }">
                <has-error :form="form" field="suffixname"></has-error>
              </div>
              <div class="form-group">
                <label>Password</label>
                <input v-model="form.password" type="password" name="password"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                <has-error :form="form" field="password"></has-error>
              </div>

          </div>
          <div class="modal-footer">
            <button :disabled="form.busy" type="submit" class="btn btn-primary">Save changes</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="showModalLong" tabindex="-1" role="dialog" aria-labelledby="showModalTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="showModalTitle">{{ form.lastname }} {{ form.suffixname }}, {{ form.firstname }} {{ form.middlename }}</h5>

          </div>
            
          <form @submit.prevent="editMode ? update() : store()" @keydown="form.onKeydown($event)">
          <div class="modal-body">
            <alert-error :form="form" message="There were some problems with your input."></alert-error>
              <div class="form-group">
                <!-- <label>User ID</label> -->
                <input v-model="form.user_id" type="text" name="user_id"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('user_id') }" readonly hidden>
                <has-error :form="form" field="user_id"></has-error>
              </div>
              <div class="form-group">
                <label>ID Number</label>
                <input v-model="form.id_num" type="text" name="id_num"
                  class="form-control" readonly>
              </div>
              <div class="form-group">
                <label>Email</label>
                <input v-model="form.email" type="text" name="email"
                  class="form-control" readonly>
              </div>
              <div class="form-group">
                <label>First Name</label>
                <input v-model="form.firstname" type="text" name="firstname"
                  class="form-control" readonly>
              </div>
              <div class="form-group">
                <label>Middle Name</label>
                <input v-model="form.middlename" type="text" name="middlename"
                  class="form-control" readonly>
              </div>
              <div class="form-group">
                <label>Last Name</label>
                <input v-model="form.lastname" type="text" name="lastname"
                  class="form-control" readonly>
              </div>
              <div class="form-group">
                <label>Suffix Name</label>
                <input v-model="form.suffixname" type="text" name="suffixname"
                  class="form-control" readonly>
              </div>
          </div>
          <div class="modal-footer">
            <button :disabled="form.busy" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
            email:'',
            cd_email:'',
            password:'123456',
            usertype:'student',
            user_id:'',
            firstname:'',
            middlename:'',
            lastname:'',
            suffixname:'',

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
            axios.get('/api/studentuser?page='+this.pagination.current_page)
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
            axios.get('/api/search/studentuser/'+this.queryField+'/'+this.query+'?page='+this.pagination.current_page)
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
              .post('/api/studentuser')
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
            this.form.user_id = this.form.id
            this.form.password = '123456'
            this.form.cd_email = this.form.email


          },
          update(){
            this.$Progress.start()
            this.form.busy = true
            this.form
              .put('/api/studentuser/'+this.form.id)
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
                          .delete('/api/studentuser/'+this.form.id)
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
