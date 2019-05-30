<template>
    <div class="container">
                <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{totalcount}}</h3>

                <p>Enrollees By <br>School Year 2019-2020</p>
              </div>
              <div class="icon">
                <i class="fas fa-address-card"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>0<sup style="font-size: 20px">%</sup></h3>

                <p>Bounce Rate</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>0</h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>0</h3>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
    </div>
</template>

<script>
    export default {
      data(){
        return{
          editMode: false,

          enrollment:[],

          totalcount:'',
          form : new Form({
            id:'',
       
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
            axios.get('/api/enrolllist?page='+this.pagination.current_page)
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
          }
          
          
         
          
          
      } 
    }
</script>
