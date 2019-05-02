<template>
 <div class="row justify-content-center">
   <div class="col-md-12">
      <div class="card">
          <div class="card-header">
            <h3 class="card-title">Manage Courses Information</h3>
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
                    <option value="course_code" selected>Course Code</option>
                    <option value="descriptive_title">Descriptive Title</option>
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
                  <th>Course Code</th>
                  <th>Descriptive Title</th>
                  <th>Lecture Hour</th>
                  <th>Laboratory Hour</th>
                  <th>Course Unit</th>
                  <th>Course Prerequisite</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-show="!courses.length" v-for="(courses, index) in courses" :key="courses.id">
                    <td>{{ index + 1}}</td>
                    <td hidden>{{ courses.id }}</td>
                    <td>{{ courses.course_code }}</td>
                    <td>{{ courses.descriptive_title }}</td>
                    <td>{{ courses.lec_hr }}</td>
                    <td>{{ courses.lab_hr }}</td>
                    <td>{{ courses.course_unit }}</td>
                    <td>{{ courses.course_pre_req }}</td>
                    <td class="text-center">
                        <button type="button" @click="show(courses)" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button type="button" @click="edit(courses)" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" @click="destroy(courses)" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        
                    </td>


                </tr>
                <tr v-show="!courses.length">
                  <td colspan="8">
                    <div class="alert alert-danger" role="alert">
                      <center>No Data Found!</center>
                    </div>
                  </td>
                </tr>
              </tbody>
              <tfoot>
              <tr>
                  <th>#</th>
                  <th>Course Code</th>
                  <th>Descriptive Title</th>
                  <th>Lecture Hour</th>
                  <th>Laboratory Hour</th>
                  <th>Course Unit</th>
                  <th>Course Prerequisite</th>
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
    <div class="modal fade" id="coursesModalLong" tabindex="-1" role="dialog" aria-labelledby="coursesModalTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="coursesModalTitle">{{ editMode ? "Edit":"Add New"}} Course</h5>

          </div>
            
          <form @submit.prevent="editMode ? update() : store()" @keydown="form.onKeydown($event)">
          <div class="modal-body">
            <alert-error :form="form" message="There were some problems with your input."></alert-error>
              <div class="form-group">
                <label>Course Code</label>
                <input v-model="form.course_code" type="text" name="course_code"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('course_code') }">
                <has-error :form="form" field="course_code"></has-error>
              </div>
              <div class="form-group">
                <label>Descriptive Title</label>
                <input v-model="form.descriptive_title" type="text" name="descriptive_title"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('descriptive_title') }">
                <has-error :form="form" field="descriptive_title"></has-error>
              </div>
              <div class="form-group">
                <label>Lecture Hour</label>
                <input v-model="form.lec_hr" type="text" name="lec_hr"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('lec_hr') }">
                <has-error :form="form" field="lec_hr"></has-error>
              </div>
              <div class="form-group">
                <label>Laboratory Hour</label>
                <input v-model="form.lab_hr" type="text" name="lab_hr"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('lab_hr') }">
                <has-error :form="form" field="lab_hr"></has-error>
              </div>
              <div class="form-group">
                <label>Course Unit</label>
                <input v-model="form.course_unit" type="text" name="course_unit"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('course_unit') }">
                <has-error :form="form" field="course_unit"></has-error>
              </div>
              <div class="form-group">
                <label>Course Prerequisite</label>
                <input v-model="form.course_pre_req" type="text" name="course_pre_req"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('course_pre_req') }">
                <has-error :form="form" field="course_pre_req"></has-error>
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
            <h5 class="modal-title" id="showModalTitle">{{ form.descriptive_title }}</h5>

          </div>
            
          <form @submit.prevent="editMode ? update() : store()" @keydown="form.onKeydown($event)">
          <div class="modal-body">
            <alert-error :form="form" message="There were some problems with your input."></alert-error>
              <div class="form-group">
                <label>Program Code</label>
                <input v-model="form.program_code" type="text" name="program_code"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('program_code') }" readonly>
                <has-error :form="form" field="program_code"></has-error>
              </div>
              <div class="form-group">
                <label>Descriptive Title</label>
                <input v-model="form.descriptive_title" type="text" name="descriptive_title"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('descriptive_title') }" readonly>
                <has-error :form="form" field="descriptive_title"></has-error>
              </div>
              <div class="form-group">
                <label>Lecture Hour</label>
                <input v-model="form.lec_hr" type="text" name="lec_hr"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('lec_hr') }" readonly>
                <has-error :form="form" field="lec_hr"></has-error>
              </div>
              <div class="form-group">
                <label>Laboratory Hour</label>
                <input v-model="form.lab_hr" type="text" name="lab_hr"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('lab_hr') }" readonly>
                <has-error :form="form" field="lab_hr"></has-error>
              </div>
              <div class="form-group">
                <label>Course Unit</label>
                <input v-model="form.course_unit" type="text" name="course_unit"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('course_unit') }" readonly>
                <has-error :form="form" field="course_unit"></has-error>
              </div>
              <div class="form-group">
                <label>Course Prerequisite</label>
                <input v-model="form.course_pre_req" type="text" name="course_pre_req"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('course_pre_req') }" readonly>
                <has-error :form="form" field="course_pre_req"></has-error>
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
          queryField:'course_code',
          courses:[],
          totalcount:'',
          form : new Form({
            id:'',
            course_code:'',
            descriptive_title:'',
            lec_hr:'',
            lab_hr:'',
            course_unit:'',
            course_pre_req:'',
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
            // console.log('Component mounted.')
            this.getData();
        },
        methods:{
          getData(){
            //load data
            this.$Progress.start()
            axios.get('/api/managecourses?page='+this.pagination.current_page)
              .then(response=>{
                // console.log(response)
                this.courses = response.data.data
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
            axios.get('/api/search/courses/'+this.queryField+'/'+this.query+'?page='+this.pagination.current_page)
            .then(response =>{
              this.courses = response.data.data
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
            this.queryField='course_code'
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
            $('#coursesModalLong').modal('show')

          },
          store(){
            // console.log('Hello')
            this.$Progress.start()
            this.form.busy = true
            this.form
              .post('/api/managecourses')
              .then(response => {
                this.getData()
                $('#coursesModalLong').modal('hide')
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
          show(courses) {
            this.form.reset();
            this.form.fill(courses);
            $("#showModalLong").modal("show");
          },
          edit(courses){
            $('#coursesModalLong').modal('show')
            this.editMode = true
            this.form.reset()
            this.form.clear()
            this.form.fill(courses)
          },
          update(){
            this.$Progress.start()
            this.form.busy = true
            this.form
              .put('/api/managecourses/'+this.form.id)
              .then(response => {
                this.getData()
                $('#coursesModalLong').modal('hide')
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
          destroy(courses){
            this.form.id = courses.id
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
                          .delete('/api/managecourses/'+this.form.id)
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
