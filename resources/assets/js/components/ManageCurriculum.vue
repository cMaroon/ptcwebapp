<template>
 <div class="row justify-content-center">
   <div class="col-md-12">
      <div class="card">
          <div class="card-header">
            <h3 class="card-title">Manage Curriculum Information</h3>
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
                    <option value="curr_program_id" selected>Program</option>
                    <!-- <option value="descriptive_title">Descriptive Title</option> -->
                  </select>
                </div>
                <div class="col-md-7">
                  <!-- <input v-model="query" type="text" class="form-control" placeholder="Search"> -->
                <select  type="text" name="curr_program_id" class="form-control"  required v-model="query" >
                    <option value="">Please select program*</option>
                    <option v-for="program in program" :key="program.id" v-bind:value="program.id">{{program.program_code}}</option>
                </select>
                </div>
              </div>
            </form>
            </div>
              <table class="table table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>School Year</th>
                  <th>Semester</th>
                  <th>Year Level</th>
                  <th>Program</th>
                  <th>Course</th>
                  <th>Section</th>
                  <th>Student Count</th>
                  <th>Limit Count</th>
                  <th>Days</th>
                  <th>Time</th>
                  <th>Room</th>
                  <th>Instructor</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-show="!curriculum.length" v-for="(curriculum, index) in curriculum" :key="curriculum.id">
                  <template v-if="curriculum.currsy.isActive === 1" >
                  
                    <td>{{ index + 1}}</td>
                    <td hidden>{{ curriculum.id }}</td>
                    <td>{{ curriculum.currsy.title }}</td>
                    <td>{{ curriculum.currsemester.title }}</td>
                    <td>{{ curriculum.curryearlevel.title }}</td>
                    <td>{{ curriculum.currprograms.program_code }}</td>
                    <td>{{ curriculum.currcourses.course_code }} - {{ curriculum.currcourses.descriptive_title }}</td>
                    <td>{{ curriculum.currsection.title }}</td>
                    <td>{{ curriculum.curr_stud_count }}</td>
                    <td>{{ curriculum.curr_limit_persec }}</td>
                    <td>{{ curriculum.sched_days }}</td>
                    <td>{{ curriculum.sched_time }}</td>
                    <td>{{ curriculum.sched_room }}</td>
                    <td>Prof. {{ curriculum.currinstructor.firstname }} {{ curriculum.currinstructor.lastname }}</td>
                    <td class="text-center">
                        <button type="button" @click="show(curriculum)" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button type="button" @click="edit(curriculum)" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                        </button>
                        <router-link :to="{name: 'printclass', params:{id:curriculum.id}}" class="btn btn-success btn-sm" >
                           <i class="fas fa-print"></i>
                        </router-link>
                        <button type="button" @click="destroy(curriculum)" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        
                    </td>

                </template>
                </tr>
                <tr v-show="!curriculum.length">
                  <td colspan="14">
                    <div class="alert alert-danger" role="alert">
                      <center>No Data Found!</center>
                    </div>
                  </td>
                </tr>
              </tbody>
              <tfoot>
              <tr>
                  <th>#</th>
                  <th>School Year</th>
                  <th>Semester</th>
                  <th>Year Level</th>
                  <th>Program</th>
                  <th>Course</th>
                  <th>Section</th>
                  <th>Student Count</th>
                  <th>Limit Count</th>
                  <th>Days</th>
                  <th>Time</th>
                  <th>Room</th>
                  <th>Instructor</th>
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
    <div class="modal fade" id="curriculumModalLong" tabindex="-1" role="dialog" aria-labelledby="curriculumModalTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="curriculumModalTitle">{{ editMode ? "Edit":"Add New"}} Curriculum</h5>

          </div>
            
          <form @submit.prevent="editMode ? update() : store()" @keydown="form.onKeydown($event)">
          <div class="modal-body">
            <alert-error :form="form" message="There were some problems with your input."></alert-error>

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
                <select  type="text" name="curr_year" class="form-control"  required v-model="form.curr_year" >
                    <option value="">Please select year level*</option>
                    <option v-for="yearlevel in yearlevel" :key="yearlevel.id" v-bind:value="yearlevel.id">{{yearlevel.title}}</option>
                </select>
              </div>

              <div class="form-group">
                <select  type="text" name="curr_program_id" class="form-control"  required v-model="form.curr_program_id" >
                    <option value="">Please select program*</option>
                    <option v-for="program in program" :key="program.id" v-bind:value="program.id">{{program.program_code}} - {{program.descriptive_title}}</option>
                </select>
              </div>

              <div class="form-group">
                <select  type="text" name="curr_course_id" class="form-control"  required v-model="form.curr_course_id" >
                    <option value="">Please select course*</option>
                    <option v-for="course in course" :key="course.id" v-bind:value="course.id">{{course.course_code}} - {{course.descriptive_title}}</option>
                </select>
              </div>

              <div class="form-group">
                <select  type="text" name="curr_section_id" class="form-control"  required v-model="form.curr_section_id" >
                    <option value="">Please select section*</option>
                    <option v-for="section in section" :key="section.id" v-bind:value="section.id">{{section.title}}</option>
                </select>
              </div>

              <div class="form-group">
                <label>Limit Count</label>
                <input v-model="form.curr_limit_persec" type="text" name="curr_limit_persec"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('curr_limit_persec') }" >
                <has-error :form="form" field="curr_limit_persec"></has-error>
              </div>

              <div class="form-group">
                <label>Days</label>
                <input v-model="form.sched_days" type="text" name="sched_days"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('sched_days') }" >
                <has-error :form="form" field="sched_days"></has-error>
              </div>

              <div class="form-group">
                <label>Time</label>
                <input v-model="form.sched_time" type="text" name="sched_time"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('sched_time') }" >
                <has-error :form="form" field="sched_time"></has-error>
              </div>

              <div class="form-group">
                <label>Room</label>
                <input v-model="form.sched_room" type="text" name="sched_room"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('sched_room') }" >
                <has-error :form="form" field="sched_room"></has-error>
              </div>

              <div class="form-group">
                <select  type="text" name="curr_id_ins" class="form-control"  required v-model="form.curr_id_ins" >
                    <option value="">Please select instructor*</option>
                    <option v-for="instructor in instructor" :key="instructor.id" v-bind:value="instructor.id">Prof. {{instructor.firstname}} {{instructor.lastname}}</option>
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
    <div class="modal fade" id="showModalLong" tabindex="-1" role="dialog" aria-labelledby="showModalTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="showModalTitle">Curriculum</h5>
          </div>   
          <div class="modal-body">
            <alert-error :form="form" message="There were some problems with your input."></alert-error>
              
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
          query:'',
          queryField:'curr_program_id',
          curriculum:[],
          schoolyear:[],
          semester:[],
          yearlevel:[],
          program:[],
          course:[],
          section:[],
          instructor:[],
          totalcount:'',
          form : new Form({
            id:'',
            sy:'',
            semester:'',
            curr_year:'',
            curr_program_id:'',
            curr_course_id:'',
            curr_section_id:'',
            curr_stud_count:0,
            curr_limit_persec:'',
            sched_days:'',
            sched_time:'',
            sched_room:'',
            curr_id_ins:'',
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
             //other data
            axios.get('/api/schoolyearlist').then(response=>{this.schoolyear = response.data.data})
            axios.get('/api/semesterlist').then(response=>{this.semester = response.data.data})
            axios.get('/api/yearlevellist').then(response=>{this.yearlevel = response.data.data})
            axios.get('/api/programlist').then(response=>{this.program = response.data.data})
            axios.get('/api/courselist').then(response=>{this.course = response.data.data})
            axios.get('/api/sectionlist').then(response=>{this.section = response.data.data})
            axios.get('/api/instructorinfolist').then(response=>{this.instructor = response.data.data})

            axios.get('/api/managecurriculum?page='+this.pagination.current_page)
              .then(response=>{
                // console.log(response)
                this.curriculum = response.data.data
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
            axios.get('/api/search/curriculum/'+this.queryField+'/'+this.query+'?page='+this.pagination.current_page)
            .then(response =>{
              this.curriculum = response.data.data
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
            this.queryField='curr_program_id'
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
            $('#curriculumModalLong').modal('show')

          },
          store(){
            // console.log('Hello')
            this.$Progress.start()
            this.form.busy = true
            this.form
              .post('/api/managecurriculum')
              .then(response => {
                this.getData()
                $('#curriculumModalLong').modal('hide')
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
          show(curriculum) {
            this.form.reset();
            this.form.fill(curriculum);
            $("#showModalLong").modal("show");
          },
          edit(curriculum){
            $('#curriculumModalLong').modal('show')
            this.editMode = true
            this.form.reset()
            this.form.clear()
            this.form.fill(curriculum)
          },
          update(){
            this.$Progress.start()
            this.form.busy = true
            this.form
              .put('/api/managecurriculum/'+this.form.id)
              .then(response => {
                this.reload()
                $('#curriculumModalLong').modal('hide')
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
          destroy(curriculum){
            this.form.id = curriculum.id
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
                          .delete('/api/managecurriculum/'+this.form.id)
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
