<template>
    <div class="container">
                <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <a href="#" style="text-decoration:none;" v-bind:class="showMore" @click="showMore">
            <div class="small-box bg-info-gradient">
              <div class="inner">
                <h3>Profile</h3>
                <p>Check your <br>information here</p>
              </div>
              <div class="icon">
                <i class="fas fa-id-card"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
            </div>
            </a>
          </div>
          <!-- ./col -->
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <router-link :to="{ name: 'student-myenroll'}" style="text-decoration:none;">
            <div class="small-box bg-success-gradient">
              <div class="inner">
                <h3>Enroll Now</h3>

                <p>You may <br>enroll your subjects here</p>
              </div>
              <div class="icon">
                <i class="fas fa-calendar-check"></i>
              </div>
              
            </div>
            </router-link>
          </div>
          <!-- ./col -->
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <a href="#" style="text-decoration:none;">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Class Schedule</h3>

                <p>Check your <br> current schedule here</p>
              </div>
              <div class="icon">
                <i class="fas fa-calendar-alt"></i>
              </div>
              
            </div>
            </a>
          </div>
          <!-- ./col -->
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <a href="#" style="text-decoration:none;">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>My Grades</h3>

                <p>Check your <br>current grades here</p>
              </div>
              <div class="icon">
                <i class="fab fa-stack-exchange"></i>
              </div>
              
            </div>
            </a>
          </div>
          <!-- ./col -->
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <a href="#" style="text-decoration:none;">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>My Accounts</h3>

                <p>Check your <br> assesstment and balance here</p>
              </div>
              <div class="icon">
                <i class="fas fa-wallet"></i>
              </div>
             
            </div>
            </a>
          </div>
          <!-- ./col -->
    
        </div>
    </div>
</template>

<script>
    export default {
      data(){
        return{
          csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          editMode: false,

          enrollment:[],
          schoolyear:[],
          querySY:'sy',
          form : new Form({
            id:'',
            sy:'0',
            sydesc:'',

       
          }),
          pagination:{
            current_page:1,
          }
        }
      },
      mounted() {
            console.log('Component mounted.')
            this.getData();
            
        },
        methods:{
          showMore: function(){
            alert('showmore');
          },
         
          getData(){
            //load data
            this.$Progress.start()
           
            axios.get('/api/schoolyearlist').then(response=>{
              this.schoolyear = response.data.data
                  for (let i = 0; i < this.schoolyear.length; i++){                 
                      if(this.schoolyear[i].isActive==1){
                        this.form.sy = this.schoolyear[i].id;
                        this.form.sydesc = this.schoolyear[i].title;

                        axios.get('/api/search/studentenrolledlist/'+this.querySY+'/'+this.form.sy)
                          .then(response=>{
                            // console.log(response)
                            this.enrollment = response.data.data
                            // this.pagination = response.data.meta
                            // this.totalcount = this.pagination.total
                            this.$Progress.finish()
                          })
                          .catch(e => {
                            console.log(e)
                            this.$Progress.fail()
                          })
                   }   
                    }
              })
            // axios.get("/api/schoolyearlist").then(({data}) =>(this.schoolyear = data))
              
              
          }               
      },
      computed: {
       
           resultCount(){
            //  return Object.keys(this.enrollment).length
             return this.enrollment.length
           },
           sycount(){
            return this.schoolyear.length
            // this.sycounts = Object.keys(this.schoolyear).length

            
           }
        }, 
    }
</script>
