<template>
 <div class="row justify-content-center">
   <!-- schoolyear -->
   <div class="col-md-12">
      <div class="card">
          <div class="card-header">
            <h3 class="card-title">School Year Information</h3>
            <div class="card-tools" style="position: absolute;right:1rem;top:.5rem;">
              <button type="button" class="btn btn-success" @click="createSY">Add New <i class="fas fa-plus"></i></button>
              <button type="button" class="btn btn-primary" @click="reloadSY">Reload <i class="fas fa-sync"></i></button>
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
                  <select v-model="queryFieldSY" class="form-control" id="fields">
                    <option value="title" selected>Title</option>
                  </select>
                </div>
                <div class="col-md-7">
                  <input v-model="querySY" type="text" class="form-control" placeholder="Search">
                </div>
              </div>
            </form>
            </div>
              <table class="table table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-show="!schoolyear.length" v-for="(schoolyear, index) in schoolyear" :key="schoolyear.id">
                    <td>{{ index + 1}}</td>
                    <td hidden>{{ schoolyear.id }}</td>
                    <td>{{ schoolyear.title }}</td>
                    <td class="text-center">
                        <button type="button" @click="showSY(schoolyear)" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button type="button" @click="editSY(schoolyear)" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" @click="destroySY(schoolyear)" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        
                    </td>


                </tr>
                <tr v-show="!schoolyear.length">
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
                <th>Title</th>
                <th class="text-center">Action</th>
              </tr>
              </tfoot>
            </table>
            <pagination v-if="pagination.last_page > 1"
                          :pagination="pagination"
                          :offset="5"
                          @paginate="querySY == ''?getSYData():searchSYData()"
                            ></pagination>
          </div>
          <!-- /.card-body -->
      </div>
   </div>
    <!-- semester -->
    <div class="col-md-12">
      <div class="card">
          <div class="card-header">
            <h3 class="card-title">Semester Information</h3>
            <div class="card-tools" style="position: absolute;right:1rem;top:.5rem;">
              <button type="button" class="btn btn-success" @click="createSEM">Add New <i class="fas fa-plus"></i></button>
              <button type="button" class="btn btn-primary" @click="reloadSEM">Reload <i class="fas fa-sync"></i></button>
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
                  <select v-model="queryFieldSEM" class="form-control" id="fields">
                    <option value="title" selected>Title</option>
                  </select>
                </div>
                <div class="col-md-7">
                  <input v-model="querySEM" type="text" class="form-control" placeholder="Search">
                </div>
              </div>
            </form>
            </div>
              <table class="table table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-show="!semester.length" v-for="(semester, index) in semester" :key="semester.id">
                    <td>{{ index + 1}}</td>
                    <td hidden>{{ semester.id }}</td>
                    <td>{{ semester.title }}</td>
                    <td class="text-center">
                        <button type="button" @click="showSEM(semester)" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button type="button" @click="editSEM(semester)" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" @click="destroySEM(semester)" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        
                    </td>


                </tr>
                <tr v-show="!semester.length">
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
                <th>Title</th>
                <th class="text-center">Action</th>
              </tr>
              </tfoot>
            </table>
            <pagination v-if="pagination.last_page > 1"
                          :pagination="pagination"
                          :offset="5"
                          @paginate="querySEM == ''?getSEMData():searchSEMData()"
                            ></pagination>
          </div>
          <!-- /.card-body -->
      </div>
   </div>
   <!-- yearlevel -->
    <div class="col-md-12">
      <div class="card">
          <div class="card-header">
            <h3 class="card-title">Year Level Information</h3>
            <div class="card-tools" style="position: absolute;right:1rem;top:.5rem;">
              <button type="button" class="btn btn-success" @click="createYL">Add New <i class="fas fa-plus"></i></button>
              <button type="button" class="btn btn-primary" @click="reloadYL">Reload <i class="fas fa-sync"></i></button>
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
                  <select v-model="queryFieldYL" class="form-control" id="fields">
                    <option value="title" selected>Title</option>
                  </select>
                </div>
                <div class="col-md-7">
                  <input v-model="queryYL" type="text" class="form-control" placeholder="Search">
                </div>
              </div>
            </form>
            </div>
              <table class="table table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-show="!yearlevel.length" v-for="(yearlevel, index) in yearlevel" :key="yearlevel.id">
                    <td>{{ index + 1}}</td>
                    <td hidden>{{ yearlevel.id }}</td>
                    <td>{{ yearlevel.title }}</td>
                    <td class="text-center">
                        <button type="button" @click="showYL(yearlevel)" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button type="button" @click="editYL(yearlevel)" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" @click="destroyYL(yearlevel)" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        
                    </td>


                </tr>
                <tr v-show="!yearlevel.length">
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
                <th>Title</th>
                <th class="text-center">Action</th>
              </tr>
              </tfoot>
            </table>
            <pagination v-if="pagination.last_page > 1"
                          :pagination="pagination"
                          :offset="5"
                          @paginate="queryYL == ''?getYLData():searchYLData()"
                            ></pagination>
          </div>
          <!-- /.card-body -->
      </div>
   </div>
   <!-- section -->
    <div class="col-md-12">
      <div class="card">
          <div class="card-header">
            <h3 class="card-title">Section Information</h3>
            <div class="card-tools" style="position: absolute;right:1rem;top:.5rem;">
              <button type="button" class="btn btn-success" @click="createSEC">Add New <i class="fas fa-plus"></i></button>
              <button type="button" class="btn btn-primary" @click="reloadSEC">Reload <i class="fas fa-sync"></i></button>
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
                  <select v-model="queryFieldSEC" class="form-control" id="fields">
                    <option value="title" selected>Title</option>
                  </select>
                </div>
                <div class="col-md-7">
                  <input v-model="querySEC" type="text" class="form-control" placeholder="Search">
                </div>
              </div>
            </form>
            </div>
              <table class="table table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-show="!section.length" v-for="(section, index) in section" :key="section.id">
                    <td>{{ index + 1}}</td>
                    <td hidden>{{ section.id }}</td>
                    <td>{{ section.title }}</td>
                    <td class="text-center">
                        <button type="button" @click="showSEC(section)" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button type="button" @click="editSEC(section)" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" @click="destroySEC(section)" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        
                    </td>


                </tr>
                <tr v-show="!section.length">
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
                <th>Title</th>
                <th class="text-center">Action</th>
              </tr>
              </tfoot>
            </table>
            <pagination v-if="pagination.last_page > 1"
                          :pagination="pagination"
                          :offset="5"
                          @paginate="querySEC == ''?getSECData():searchSECData()"
                            ></pagination>
          </div>
          <!-- /.card-body -->
      </div>
   </div>

   <!-- Modal SY-->
    <div class="modal fade" id="syModalLong" tabindex="-1" role="dialog" aria-labelledby="syModalTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="syModalTitle">{{ editMode ? "Edit":"Add New"}} School Year</h5>

          </div>
            
          <form @submit.prevent="editMode ? updateSY() : storeSY()" @keydown="form.onKeydown($event)">
          <div class="modal-body">
            <alert-error :form="form" message="There were some problems with your input."></alert-error>
              <div class="form-group">
                <label>Title</label>
                <input v-model="form.title" type="text" name="title"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">
                <has-error :form="form" field="title"></has-error>
              </div>
              

          </div>
          <div class="modal-footer">
            <button :disabled="form.busy" type="submit" class="btn btn-primary">Save changes</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Modal SEM-->
    <div class="modal fade" id="semModalLong" tabindex="-1" role="dialog" aria-labelledby="semModalTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="semModalTitle">{{ editMode ? "Edit":"Add New"}} Semester</h5>

          </div>
            
          <form @submit.prevent="editMode ? updateSEM() : storeSEM()" @keydown="form.onKeydown($event)">
          <div class="modal-body">
            <alert-error :form="form" message="There were some problems with your input."></alert-error>
              <div class="form-group">
                <label>Title</label>
                <input v-model="form.title" type="text" name="title"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">
                <has-error :form="form" field="title"></has-error>
              </div>
              

          </div>
          <div class="modal-footer">
            <button :disabled="form.busy" type="submit" class="btn btn-primary">Save changes</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Modal YearLevel-->
    <div class="modal fade" id="ylModalLong" tabindex="-1" role="dialog" aria-labelledby="ylModalTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ylModalTitle">{{ editMode ? "Edit":"Add New"}} Year Level</h5>

          </div>
            
          <form @submit.prevent="editMode ? updateYL() : storeYL()" @keydown="form.onKeydown($event)">
          <div class="modal-body">
            <alert-error :form="form" message="There were some problems with your input."></alert-error>
              <div class="form-group">
                <label>Title</label>
                <input v-model="form.title" type="text" name="title"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">
                <has-error :form="form" field="title"></has-error>
              </div>
              

          </div>
          <div class="modal-footer">
            <button :disabled="form.busy" type="submit" class="btn btn-primary">Save changes</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Modal Section-->
    <div class="modal fade" id="secModalLong" tabindex="-1" role="dialog" aria-labelledby="secModalTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="secModalTitle">{{ editMode ? "Edit":"Add New"}} Section</h5>

          </div>
            
          <form @submit.prevent="editMode ? updateSEC() : storeSEC()" @keydown="form.onKeydown($event)">
          <div class="modal-body">
            <alert-error :form="form" message="There were some problems with your input."></alert-error>
              <div class="form-group">
                <label>Title</label>
                <input v-model="form.title" type="text" name="title"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">
                <has-error :form="form" field="title"></has-error>
              </div>
              

          </div>
          <div class="modal-footer">
            <button :disabled="form.busy" type="submit" class="btn btn-primary">Save changes</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal Show-->
    <div class="modal fade" id="showModalLong" tabindex="-1" role="dialog" aria-labelledby="showModalTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="showModalTitle">{{ form.title }}</h5>

          </div>
          <div class="modal-body">
            <alert-error :form="form" message="There were some problems with your input."></alert-error>
              <div class="form-group">
                <label>Title</label>
                <input v-model="form.title" type="text" name="title"
                  class="form-control" readonly>
              </div>
          </div>
          <div class="modal-footer">
            <button :disabled="form.busy" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
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
          querySY:'',
          queryFieldSY:'title',
          querySEM:'',
          queryFieldSEM:'title',
          queryYL:'',
          queryFieldYL:'title',
          querySEC:'',
          queryFieldSEC:'title',
          schoolyear:[],
          semester:[],
          yearlevel:[],
          section:[],
          totalcount:'',
          form : new Form({
            id:'',
            title:'',

          }),
          pagination:{
            current_page:1,
          }
        }
      },
      watch: {
        querySY:function(newQuery,old){
          if(newQuery == ''){
            this.getSYData()
          }else{
            // console.log(newQuery)
            this.searchSYData()
          }
        },
        querySEM:function(newQuery,old){
          if(newQuery == ''){
            this.getSEMData()
          }else{
            // console.log(newQuery)
            this.searchSEMData()
          }
        },
        queryYL:function(newQuery,old){
          if(newQuery == ''){
            this.getYLData()
          }else{
            // console.log(newQuery)
            this.searchYLData()
          }
        },
        querySEC:function(newQuery,old){
          if(newQuery == ''){
            this.getSECData()
          }else{
            // console.log(newQuery)
            this.searchSECData()
          }
        }

      },
        mounted() {
            // console.log('Component mounted.')
            this.getSYData();
            this.getSEMData();
            this.getYLData();
            this.getSECData();
        },
        methods:{
            //schoolyear
          getSYData(){
            //load data
            this.$Progress.start()
            axios.get('/api/schoolyear?page='+this.pagination.current_page)
              .then(response=>{
                // console.log(response)
                this.schoolyear = response.data.data
                this.pagination = response.data.meta
                this.totalcount = this.pagination.total
                this.$Progress.finish()
              })
              .catch(e => {
                console.log(e)
                this.$Progress.fail()
              })
          },
          searchSYData(){
            this.$Progress.start()
            axios.get('/api/search/sy/'+this.queryFieldSY+'/'+this.querySY+'?page='+this.pagination.current_page)
            .then(response =>{
              this.schoolyear = response.data.data
              this.pagination = response.data.meta
              this.$Progress.finish()
            })
            .catch(e => {
              console.log(e)
              this.$Progress.fail()
            })
          },
          reloadSY(){
            this.getSYData()
            this.querySY=''
            this.queryFieldSY='title'
            this.$snotify.success('Data Successfully Refresh','Success', {
                  timeout: 1000,
                  showProgressBar: false,
                  closeOnClick: false,
                  pauseOnHover: false,
                  position: "rightTop",
                });
          },
          createSY(){
            this.editMode = false
            this.form.reset()
            this.form.clear()
            $('#syModalLong').modal('show')

          },
          storeSY(){
            // console.log('Hello')
            this.$Progress.start()
            this.form.busy = true
            this.form
              .post('/api/schoolyear')
              .then(response => {
                this.getSYData()
                $('#syModalLong').modal('hide')
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
          showSY(schoolyear) {
            this.form.reset();
            this.form.fill(schoolyear);
            $("#showModalLong").modal("show");
          },
          editSY(schoolyear){
            $('#syModalLong').modal('show')
            this.editMode = true
            this.form.reset()
            this.form.clear()
            this.form.fill(schoolyear)
          },
          updateSY(){
            this.$Progress.start()
            this.form.busy = true
            this.form
              .put('/api/schoolyear/'+this.form.id)
              .then(response => {
                this.getSYData()
                $('#syModalLong').modal('hide')
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
          destroySY(schoolyear){
            this.form.id = schoolyear.id
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
                          .delete('/api/schoolyear/'+this.form.id)
                          .then(response =>{
                            this.getSYData()
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

          },
          //semester
        getSEMData(){
            //load data
            this.$Progress.start()
            axios.get('/api/semester?page='+this.pagination.current_page)
              .then(response=>{
                // console.log(response)
                this.semester = response.data.data
                this.pagination = response.data.meta
                this.totalcount = this.pagination.total
                this.$Progress.finish()
              })
              .catch(e => {
                console.log(e)
                this.$Progress.fail()
              })
          },
          searchSEMData(){
            this.$Progress.start()
            axios.get('/api/search/sem/'+this.queryFieldSEM+'/'+this.querySEM+'?page='+this.pagination.current_page)
            .then(response =>{
              this.semester = response.data.data
              this.pagination = response.data.meta
              this.$Progress.finish()
            })
            .catch(e => {
              console.log(e)
              this.$Progress.fail()
            })
          },
          reloadSEM(){
            this.getSEMData()
            this.querySEM=''
            this.queryFieldSEM='title'
            this.$snotify.success('Data Successfully Refresh','Success', {
                  timeout: 1000,
                  showProgressBar: false,
                  closeOnClick: false,
                  pauseOnHover: false,
                  position: "rightTop",
                });
          },
          createSEM(){
            this.editMode = false
            this.form.reset()
            this.form.clear()
            $('#semModalLong').modal('show')

          },
          storeSEM(){
            // console.log('Hello')
            this.$Progress.start()
            this.form.busy = true
            this.form
              .post('/api/semester')
              .then(response => {
                this.getSEMData()
                $('#semModalLong').modal('hide')
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
          showSEM(semester) {
            this.form.reset();
            this.form.fill(semester);
            $("#showModalLong").modal("show");
          },
          editSEM(semester){
            $('#semModalLong').modal('show')
            this.editMode = true
            this.form.reset()
            this.form.clear()
            this.form.fill(semester)
          },
          updateSEM(){
            this.$Progress.start()
            this.form.busy = true
            this.form
              .put('/api/semester/'+this.form.id)
              .then(response => {
                this.getSEMData()
                $('#semModalLong').modal('hide')
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
          destroySEM(semester){
            this.form.id = semester.id
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
                          .delete('/api/semester/'+this.form.id)
                          .then(response =>{
                            this.getSEMData()
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

          },
          //yearlevel
          getYLData(){
            //load data
            this.$Progress.start()
            axios.get('/api/yearlevel?page='+this.pagination.current_page)
              .then(response=>{
                // console.log(response)
                this.yearlevel = response.data.data
                this.pagination = response.data.meta
                this.totalcount = this.pagination.total
                this.$Progress.finish()
              })
              .catch(e => {
                console.log(e)
                this.$Progress.fail()
              })
          },
          searchYLData(){
            this.$Progress.start()
            axios.get('/api/search/yearlevel/'+this.queryFieldYL+'/'+this.queryYL+'?page='+this.pagination.current_page)
            .then(response =>{
              this.yearlevel = response.data.data
              this.pagination = response.data.meta
              this.$Progress.finish()
            })
            .catch(e => {
              console.log(e)
              this.$Progress.fail()
            })
          },
          reloadYL(){
            this.getYLData()
            this.queryYL=''
            this.queryFieldYL='title'
            this.$snotify.success('Data Successfully Refresh','Success', {
                  timeout: 1000,
                  showProgressBar: false,
                  closeOnClick: false,
                  pauseOnHover: false,
                  position: "rightTop",
                });
          },
          createYL(){
            this.editMode = false
            this.form.reset()
            this.form.clear()
            $('#ylModalLong').modal('show')

          },
          storeYL(){
            // console.log('Hello')
            this.$Progress.start()
            this.form.busy = true
            this.form
              .post('/api/yearlevel')
              .then(response => {
                this.getYLData()
                $('#ylModalLong').modal('hide')
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
          showYL(yearlevel) {
            this.form.reset();
            this.form.fill(yearlevel);
            $("#showModalLong").modal("show");
          },
          editYL(yearlevel){
            $('#ylModalLong').modal('show')
            this.editMode = true
            this.form.reset()
            this.form.clear()
            this.form.fill(yearlevel)
          },
          updateYL(){
            this.$Progress.start()
            this.form.busy = true
            this.form
              .put('/api/yearlevel/'+this.form.id)
              .then(response => {
                this.getYLData()
                $('#ylModalLong').modal('hide')
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
          destroyYL(yearlevel){
            this.form.id = yearlevel.id
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
                          .delete('/api/yearlevel/'+this.form.id)
                          .then(response =>{
                            this.getYLData()
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

          },
          //section
          getSECData(){
            //load data
            this.$Progress.start()
            axios.get('/api/section?page='+this.pagination.current_page)
              .then(response=>{
                // console.log(response)
                this.section = response.data.data
                this.pagination = response.data.meta
                this.totalcount = this.pagination.total
                this.$Progress.finish()
              })
              .catch(e => {
                console.log(e)
                this.$Progress.fail()
              })
          },
          searchSECData(){
            this.$Progress.start()
            axios.get('/api/search/section/'+this.queryFieldSEC+'/'+this.querySEC+'?page='+this.pagination.current_page)
            .then(response =>{
              this.section = response.data.data
              this.pagination = response.data.meta
              this.$Progress.finish()
            })
            .catch(e => {
              console.log(e)
              this.$Progress.fail()
            })
          },
          reloadSEC(){
            this.getSECData()
            this.querySEC=''
            this.queryFieldSEC='title'
            this.$snotify.success('Data Successfully Refresh','Success', {
                  timeout: 1000,
                  showProgressBar: false,
                  closeOnClick: false,
                  pauseOnHover: false,
                  position: "rightTop",
                });
          },
          createSEC(){
            this.editMode = false
            this.form.reset()
            this.form.clear()
            $('#secModalLong').modal('show')

          },
          storeSEC(){
            // console.log('Hello')
            this.$Progress.start()
            this.form.busy = true
            this.form
              .post('/api/section')
              .then(response => {
                this.getSECData()
                $('#secModalLong').modal('hide')
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
          showSEC(section) {
            this.form.reset();
            this.form.fill(section);
            $("#showModalLong").modal("show");
          },
          editSEC(section){
            $('#secModalLong').modal('show')
            this.editMode = true
            this.form.reset()
            this.form.clear()
            this.form.fill(section)
          },
          updateSEC(){
            this.$Progress.start()
            this.form.busy = true
            this.form
              .put('/api/section/'+this.form.id)
              .then(response => {
                this.getSECData()
                $('#secModalLong').modal('hide')
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
          destroySEC(section){
            this.form.id = section.id
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
                          .delete('/api/section/'+this.form.id)
                          .then(response =>{
                            this.getSECData()
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
