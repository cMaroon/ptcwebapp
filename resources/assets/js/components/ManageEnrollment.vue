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
                    <!-- <option value="enr_program_id">Program</option> -->
                  </select>
                </div>
                <div v-show="queryField != 'enr_program_id'" class="col-md-7">
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
                  <th>Fullname</th>
                  <th>School Year</th>
                  <th>Semester</th>
                  <th>Year Level</th>
                  <th>Program</th>
                  <th>Total Course Unit</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-show="!enrollment.length" v-for="(enrollment, index) in enrollment" :key="enrollment.id">
                  <template v-if="enrollment.sy === 2" >
                    <td>{{ index + 1}}</td>
                    <td hidden>{{ enrollment.id }}</td>
                    <td>{{ enrollment.enr_form_id }}</td>
                    <td>{{ enrollment.enr_id_num }}</td>
                    <td>{{ enrollment.studinfo.lastname }} {{ enrollment.studinfo.suffixname }}, {{ enrollment.studinfo.firstname }} {{ enrollment.studinfo.middlename }}</td>
                    <td>{{ enrollment.enrsy.title }}</td>
                    <td>{{ enrollment.enrsem.title }}</td>
                    <td>{{ enrollment.enryearlevel.title }}</td>
                    <td>{{ enrollment.enrollprograms.program_code }}</td>
                    <td>{{ enrollment.total_course_unit }}</td>
                    
                    <td class="text-center">
                        <button type="button" @click="show(enrollment)" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button type="button" @click="edit(enrollment)" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                        </button>
                        <router-link :to="{name: 'printenroll', params:{id:enrollment.id}}" >
                           <i class="fas fa-print icon-green"></i>
                        </router-link>
                        <!-- <button type="button"  class="btn btn-success btn-sm">
                            <i class="fas fa-print"></i>
                        </button> -->
                        <button type="button" @click="destroy(enrollment)" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        
                    </td>

                  </template>
                </tr>
                <tr v-show="!enrollment.length">
                  <td colspan="10">
                    <div class="alert alert-danger" role="alert">
                      <center>No Data Found!</center>
                    </div>
                  </td>
                </tr>
              </tbody>
              <tfoot>
              <tr>
                <th>#</th>
                  <th>Form ID</th>
                  <th>ID Number</th>
                  <th>Fullname</th>
                  <th>School Year</th>
                  <th>Semester</th>
                  <th>Year Level</th>
                  <th>Program</th>
                  <th>Total Course Unit</th>
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

    <!-- Show Modal -->
    <div class="modal fade" id="showModalLong" tabindex="-1" role="dialog" aria-labelledby="showModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="showModalTitle">
              <!-- ID: {{form.id}} -->
              Form ID: {{ form.enr_form_id }} |
              ID Number: {{ form.enr_id_num }} |
              Fullname: {{ form.fullname }} |
              Year Level: {{ form.yltitle }} |
              Program: {{ form.progtitle }}

              </h5>

          </div>
            
          <div class="modal-body">
              <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">My Curriculum</h3>
                      <div class="card-tools" style="position: absolute;right:1rem;top:.5rem;">
                        <button type="button" class="btn btn-success" @click="createAssoc">Add Curriculum <i class="fas fa-plus"></i></button>
                        <button type="button" class="btn btn-primary" @click="reloadAssoc">Reload <i class="fas fa-sync"></i></button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                      <div class="col-md-12 mt-3">
                      
                      </div>
                        <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Form ID</th>
                            <th>Course</th>
                            <th>Description</th>
                            <th>Section</th>
                            <th>Days</th>
                            <th>Time</th>
                            <th>Room</th>
                            <th class="text-center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-show="!assoc.length" v-for="(assoc, index) in assoc" :key="assoc.id">
                            <template v-if="assoc.assocformid.sy === 2" >
                              <td>{{ index + 1}}</td>
                              <td hidden>{{ assoc.id }}</td>
                              <td>{{ assoc.assocformid.enr_form_id }}</td>
                              <td>{{ assoc.assoccurrid.currcourses.course_code }}</td>
                              <td>{{ assoc.assoccurrid.currcourses.descriptive_title }}</td>
                              <td>{{ assoc.assoccurrid.currsection.title }}</td>
                              <td>{{ assoc.assoccurrid.sched_days }}</td>
                              <td>{{ assoc.assoccurrid.sched_time }}</td>
                              <td>{{ assoc.assoccurrid.sched_room }}</td>
                                                            
                              <td class="text-center">
                                  
                                  
                                  <button type="button" @click="destroyAssoc(assoc)" class="btn btn-danger btn-sm">
                                      <i class="fas fa-trash-alt"></i>
                                  </button>
                                  
                              </td>

                            </template>
                          </tr>
                          <tr v-show="!assoc.length">
                            <td colspan="9">
                              <div class="alert alert-danger" role="alert">
                                <center>No Data Found!</center>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                          <th>#</th>
                          <th>Form ID</th>
                          <th>Course</th>
                          <th>Description</th>
                          <th>Section</th>
                          <th>Days</th>
                          <th>Time</th>
                          <th>Room</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </tfoot>
                      </table>
                      
                    </div>
                    <!-- /.card-body -->
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button :disabled="form.busy" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

  <!-- Modal -->
    <div class="modal fade" id="assocModalLong" tabindex="-1" role="dialog" aria-labelledby="assocModalTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="assocModalTitle">{{ editMode ? "Edit":"Add New"}} Student Curriculum</h5>

          </div>
            
          <form @submit.prevent="editMode ? updateAssoc() : storeAssoc()" @keydown="form.onKeydown($event)">
          <div class="modal-body">
            <alert-error :form="form" message="There were some problems with your input."></alert-error>
              
              <div class="form-group">
                <label>Select Section First</label>
                <select  type="text" name="section_id" class="form-control"  required v-model="form.section_id" >
                    <option selected value="">Please select section first*</option>
                    <option v-for="section in section" :key="section.id" v-bind:value="section.id">{{section.title}}</option>
                </select>
              </div>

              <div class="form-group">
                <label>Select Curriculum</label>
                <select  type="text" name="assoc_curr_id" class="form-control"  required v-model="form.assoc_curr_id" >
                    <option value="">Please select curriculum*</option>
                    <option v-for="currlist in currlist" v-if="currlist.sy === form.sy && currlist.semester === form.semester && currlist.curr_year === form.yearlevel && currlist.curr_section_id === form.section_id && currlist.curr_program_id === form.enr_program_id" :key="currlist.id" v-bind:value="currlist.id">
                    {{ currlist.currcourses.course_code}} - {{ currlist.currcourses.descriptive_title}} 
                    </option>
                </select>
              </div>

              <div class="form-group">
                <label>Course Unit</label>
                <select  type="text" name="assoc_curr_id" class="form-control"  required v-model="form.course_unit" >
                    <option v-for="currlist in currlist" v-if="currlist.id === form.assoc_curr_id" :key="currlist.id" v-bind:value="currlist.currcourses.course_unit">{{ currlist.currcourses.course_unit}} Units
                    </option>
                </select>
              </div>

              <div class="form-group">
                <label>Student Count</label>
                <select  type="text" name="assoc_curr_id" class="form-control"  required v-model="form.curr_stud_count" >
                    <option v-for="currlist in currlist" v-if="currlist.id === form.assoc_curr_id" :key="currlist.id" v-bind:value="currlist.curr_stud_count">{{ currlist.curr_stud_count}} Student/s
                    </option>
                </select>
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
    <div class="modal fade" id="enrollmentModalLong" tabindex="-1" role="dialog" aria-labelledby="enrollmentModalTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="enrollmentModalTitle">{{ editMode ? "Edit":"Add New"}} Enrollment - {{form.enr_form_id}}</h5>

          </div>
            
          <form @submit.prevent="editMode ? update() : store()" @keydown="form.onKeydown($event)">
          <div class="modal-body">
            <alert-error :form="form" message="There were some problems with your input."></alert-error>
              
              <div class="form-group">
                <input v-model="form.enr_form_id" type="text" name="enr_form_id"
                placeholder="Form ID" class="form-control" readonly hidden>
              </div>

              <div class="form-group">
                <select  type="text" name="sy" class="form-control"  required v-model="form.sy" >
                    <option value="">Please select school year*</option>
                    <option v-for="schoolyear in schoolyear" :key="schoolyear.id" v-bind:value="schoolyear.id">{{schoolyear.title}}</option>
                </select>
              </div>

              <div class="form-group">
                <select  type="text" name="semester" class="form-control"  required v-model="form.semester" >
                    <option value="">Please select semester*</option>
                    <option v-for="semester in semester" :key="semester.id" v-bind:value="semester.id">{{semester.title}}</option>
                </select>
              </div>

              <div class="form-group">
                <select  type="text" name="enr_id_num" class="form-control"  required v-model="form.enr_id_num" >
                    <option value="">Please select student*</option>
                    <option v-for="studentlist in studentlist" :key="studentlist.id" v-bind:value="studentlist.id_num">{{studentlist.lastname}}, {{studentlist.firstname}} ( {{studentlist.id_num}} ) </option>
                </select>
              </div>
              
              <div class="form-group">
                <select  type="text" name="yearlevel" class="form-control"  required v-model="form.yearlevel" >
                    <option value="">Please select year level*</option>
                    <option v-for="yearlevel in yearlevel" :key="yearlevel.id" v-bind:value="yearlevel.id">{{yearlevel.title}}</option>
                </select>
              </div>

              <div class="form-group">
                <select  type="text" name="enr_program_id" class="form-control"  required v-model="form.enr_program_id" >
                    <option value="">Please select program*</option>
                    <option v-for="program in program" :key="program.id" v-bind:value="program.id">{{program.program_code}}-{{program.descriptive_title}} </option>
                </select>
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
          queryField:'enr_form_id',
          enrollment:[],
          studentlist:[],
          currlist:[],
          schoolyear:[],
          semester:[],
          yearlevel:[],
          program:[],
          assoc:[],
          section:[],
          totalcount:'',
          form : new Form({
            id:'',
            enr_form_id:'',
            enr_id_num:'',
            sy:'',
            semester:'',
            yearlevel:'',
            enr_program_id:'',
            total_course_unit:0,
            fullname:'',
            yltitle:'',
            progtitle:'',
            payment_id_num:'',
            payment_form_id:'',
            assoc_form_id:'',
            assoc_curr_id:'',
            section_id:'',
            course_unit:'',
            curr_stud_count:'',
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
            axios.get('/api/currlist').then(response=>{this.currlist = response.data.data})
            axios.get('/api/sectionlist').then(response=>{this.section = response.data.data})
            axios.get('/api/schoolyearlist').then(response=>{this.schoolyear = response.data.data})
            axios.get('/api/semesterlist').then(response=>{this.semester = response.data.data})
            axios.get('/api/yearlevellist').then(response=>{this.yearlevel = response.data.data})
            axios.get('/api/programlist').then(response=>{this.program = response.data.data})
            axios.get('/api/studentlist').then(response=>{this.studentlist = response.data.data})
            axios.get('/api/manageenrollment?page='+this.pagination.current_page)
              .then(response=>{
                // console.log(response)
                this.enrollment = response.data.data
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
            axios.get('/api/search/studentenrolled/'+this.queryField+'/'+this.query+'?page='+this.pagination.current_page)
            .then(response =>{
              this.enrollment = response.data.data
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
            this.queryField='enr_form_id'
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
            this.form.enr_form_id = '2019' + Math.floor(Math.random() * 100000);
            this.form.payment_form_id = this.form.enr_form_id
            $('#enrollmentModalLong').modal('show')

          },
          store(){
            // console.log('Hello')
            this.$Progress.start()
            this.form.busy = true
            this.form.payment_id_num = this.form.enr_id_num
            this.form
              .post('/api/manageenrollment')
              .then(response => {
                this.getData()
                $('#enrollmentModalLong').modal('hide')
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
            this.form.post('/api/managepayment')

          },
          show(enrollment) {
            this.form.reset();
            this.form.fill(enrollment);
            this.form.fullname = enrollment.studinfo.firstname +' '+ enrollment.studinfo.lastname
            this.form.yltitle = enrollment.enryearlevel.title
            this.form.progtitle = enrollment.enrollprograms.program_code
            this.form.total_course_unit = enrollment.total_course_unit
            this.form.assoc_form_id = enrollment.id
            axios.get('/api/search/assoc/assoc_form_id/'+enrollment.id)
                .then(response=>{
                // console.log(response)
                  this.assoc = response.data.data
                  })
                  .catch(e => {
                    this.$Progress.fail()
                    // console.log(e)
                  })
            $("#showModalLong").modal("show");
          },
          edit(enrollment){
            $('#enrollmentModalLong').modal('show')
            this.editMode = true
            this.form.reset()
            this.form.clear()
            this.form.fill(enrollment)
          },
          update(){
            this.$Progress.start()
            this.form.busy = true
            this.form.payment_id_num = this.form.enr_id_num
            this.form.put('/api/managepayment/'+this.form.id)
            this.form
              .put('/api/manageenrollment/'+this.form.id)
              .then(response => {
                this.getData()
                $('#enrollmentModalLong').modal('hide')
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
          destroy(enrollment){
            this.form.id = enrollment.id
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
                          .delete('/api/manageenrollment/'+this.form.id)
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

          },
          getAssocData(){
            //load data
            this.$Progress.start()
            axios.get('/api/search/assoc/assoc_form_id/'+this.form.assoc_form_id)
                .then(response=>{
                  this.assoc = response.data.data
                  this.$Progress.finish()
                })
                .catch(e => {
                console.log(e)
                this.$Progress.fail()
              })   
          },
          reloadAssoc(){
            this.getAssocData()
            this.$snotify.success('Data Successfully Refresh','Success', {
                  timeout: 1000,
                  showProgressBar: false,
                  closeOnClick: false,
                  pauseOnHover: false,
                  position: "rightTop",
                });
          },
          createAssoc(){
            this.editMode = false
            // this.form.reset()
            // this.form.clear()
            $('#assocModalLong').modal('show')

          },
          storeAssoc(){
            // console.log('Hello')
            this.$Progress.start()
            this.form.busy = true
            this.form.total_course_unit = this.form.total_course_unit + this.form.course_unit
            this.form.curr_stud_count = this.form.curr_stud_count + 1 
            this.form
              .post('/api/assoc')
              .then(response => {
                this.getAssocData()
                this.getData()
                $('#assocModalLong').modal('hide')
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
              this.form
              .put('/api/manageenrollment/'+this.form.id)
            this.form
              .put('/api/managecurriculum/'+this.form.assoc_curr_id)
              
          },
          showAssoc(assoc) {
            this.form.reset();
            this.form.fill(assoc);
            $("#showModalLong").modal("show");
          },
          editAssoc(assoc){
            $('#assocModalLong').modal('show')
            this.editMode = true
            // this.form.reset()
            // this.form.clear()
            this.form.fill(assoc)
          },
          updateAssoc(){
            this.$Progress.start()
            this.form.busy = true
            this.form
              .put('/api/assoc/'+this.form.id)
              .then(response => {
                this.getAssocData()
                $('#assocModalLong').modal('hide')
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
          destroyAssoc(assoc){
            this.form.course_unit = assoc.assoccurrid.currcourses.course_unit
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
                      this.form.total_course_unit = this.form.total_course_unit - this.form.course_unit
                      this.form
                      .put('/api/manageenrollment/'+this.form.id)
                       this.form.id = assoc.id
                      axios
                          .delete('/api/assoc/'+this.form.id)
                          .then(response =>{
                            this.getAssocData()
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
