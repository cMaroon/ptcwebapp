<template>
    <div class="container">
        <div class="row mt-2">
                    <!-- <div class="container" >
                            <div class="row" > -->
                                <!-- <div class="col-12" > -->
                                            <!-- this row will not appear when printing -->
                                            <div class="row no-print">
                                               
                                                <div class="col-2">
                                                <a href="" @click.prevent="printme" target="_blank" class="btn btn-danger"><i class="fa fa-print"></i> Print</a>

                                                </div>
                                            </div>
                                            <!-- Main content -->
                                    <div class="invoice p-3 mb-3" style="background-image:url('/img/logo_ptcbw.png');  background-position:relative; background-size: auto; "  >
                                            <!-- title row -->
                                            <div class="row" >

                                        <div class="col-md-2">
                                            <img src="/img/logo.png" style="width:100px" class="img-circle elevation-2" >
                                                <!-- </h4> -->
                                                </div>
                                        <div class="col-md-10">
                                                <small class="float-right">Printed Date: {{Date.now() | setDate}}</small>

                                            <br>
                                                <!-- <template v-if="currstud.data"> -->

                                                <h2>Pateros Technological College</h2>
                                                <h2>Summary Assesstment from ( {{ resultCount }} ) Enrollees</h2>
                                                
                                                <!-- </template> -->
                                        </div>
                                        
                                                <!-- /.col -->
                                            </div>
                                        <br>

                                            <!-- Table row -->
                                            <div class="row" >
                                                <div class="col-12 table-responsive" >
                                                <table class="table table-striped" >
                                                    <thead>
                                                    <tr>
                                                    <th style="padding:5px;">Program Code</th>
                                                    <th style="padding:5px; text-align:center; width:15%;">Year<br> Level</th>
                                                    <th style="padding:5px;">No. of Enrolled Student</th>
                                                    <th style="padding:5px;">Collection from Tuition Fee</th>
                                                    <th style="padding:5px;">Collection from Downpayment</th>
                                                    <th style="padding:5px;">Collection from Prelim</th>
                                                    <th style="padding:5px;">Collection from Midterm</th>
                                                    <th style="padding:5px;">Collection from Finals</th>
                                                    </tr>
                                                    <!-- <th style="padding:15px;">Total Sales.</th>
                                                    <th style="width:150px; padding:15px;">{{ currencyFormat(this.sum,2) }} </th> -->
                                                    </thead>
                                                    <tbody>  
                                                    <tr v-for="(program, index) in program" :key="program.id">
                                                        <td>{{ program.program_code }}</td>
                                                        
                                                        <td>
                                                            <p v-for="(yearlevel, index) in yearlevel" :key="yearlevel.id">
                                                                {{ yearlevel.title }}
                                                            </p>
                                                            
                                                        </td>
                                                           
                                                    </tr>  
                                                    </tbody>
                                                </table>
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.row -->

                                            </div>
                                            <small >College St., Brgy. Sto. Rosario-Kanluran, Pateros, Metro-Manila Telephone: 02-640-5375 / 02-640-5389</small>

                                            <!-- /.invoice --> 
                        <!-- </div> -->


                            <!-- </div> -->
                        <!-- </div> -->
        </div> 
    </div>
</template>

<script>
    export default {
        data(){
          return{
            summaryassesstment : [],
            program:[],
            yearlevel:[],
            yearcount:0,
            enrolledstudent:[],
            // datetoday: new Date('2011-04-11T10:20:30Z'),
            querySY:'sy',
            sum:0,
            form : new Form({
                sy:'0',
                sydesc:'',

       
          }),


          }
        },
        mounted() {
            console.log('Component mounted.')
            this.getData();
            
        },
        methods:{
            printme() {
              window.print();

            },
          getData(){
            //load data
            this.$Progress.start()
            axios.get('/api/programlist').then(response=>{this.program = response.data.data})
            axios.get('/api/yearlevellist').then(response=>{this.yearlevel = response.data.data})
            axios.get('/api/schoolyearlist').then(response=>{
              this.schoolyear = response.data.data
                  for (let i = 0; i < this.schoolyear.length; i++){                 
                      if(this.schoolyear[i].isActive==1){
                        
                        this.form.sy = this.schoolyear[i].id;
                        this.form.sydesc = this.schoolyear[i].title;

                        axios.get('/api/search/summarypayment/'+this.querySY+'/'+this.form.sy)
                          .then(response=>{
                            // console.log(response)
                            this.summaryassesstment = response.data.data
                            for (let i = 0; i < this.summaryassesstment.length; i++){
                                    if(this.summaryassesstment[i].total_amount_fee!=null){
                                            this.sum += parseFloat(this.summaryassesstment[i].total_amount_fee);
                                            
                                    }  
                                    
                                     for (let a = 0; a < this.yearlevel.length; a++){
                                           this.enrolledstudent[i] = this.program[i].program_code;
                                        }

                                }
                            
                            this.$Progress.finish()
                          })
                          .catch(e => {
                            console.log(e)
                            this.$Progress.fail()
                          })
                        }   
                    }
               
              })
              
              
          },
          currencyFormat: function(value,decimals,symbol='PHP'){
              let val = (value/1).toFixed(2).replace(',',',')
              return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g,",")
            //   return this.roundFormat(value,2) + ' ' + symbol;
          }              
      },
      computed: {

           resultCount(){
            //  return Object.keys(this.enrollment).length
             return this.summaryassesstment.length
           },
           sycount(){
            return this.schoolyear.length
            // this.sycounts = Object.keys(this.schoolyear).length

            
           }
        }, 
       

    }
</script>
