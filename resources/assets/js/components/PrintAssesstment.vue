<template>
    <div class="col-12">
        <!-- <div class="row mt-2"> -->
                    <!-- <div class="container" >
                            <div class="row" > -->
                                <!-- <div class="col-12" > -->
                                            <!-- this row will not appear when printing -->
                                            <div class="row no-print">
                                               
                                                <div class="col-12">
                                                <a href="" @click.prevent="printme" target="_blank" class="btn btn-danger"><i class="fa fa-print"></i> Print</a>

                                                </div>
                                            </div>
                                            <!-- Main content -->
                                    <div class="invoice p-3 mb-3" style="background-image:url('/img/logo_ptcbw.png');  background-position:relative; background-size: auto; "  >
                                            <!-- title row -->
                                            <div class="row" >

                                        <div class="col-md-1">
                                            <img src="/img/logo.png" style="width:100px" class="img-circle elevation-2" >
                                        </div>
                                        
                                        <div class="col-md-9">
                                                <h2><strong>P</strong>ateros <strong>T</strong>echnological <strong>C</strong>ollege</h2>
                                                <template v-if="summaryassesstment">
                                                <h2>Summary Assesstment from Enrollees SY: 2019 - 2020
                                                    1st Semester

                                                </h2>
                                                </template>
                                                
                                        </div>
                                        <div class="col-md-2">
                                             <small class="float-right">Printed Date: {{Date.now() | setDate}}</small>
                                                <br>
                                        </div>
                                        
                                                <!-- /.col -->
                                            </div>
                                        <br>

                                            <!-- Table row -->
                                            <div class="row" >
                                                <div class="col-12 table-responsive" >
                                                <table class="table table-bordered" >
                                                    <thead>
                                                    <tr>
                                                    <th style="padding:13px; text-align:center;">No.</th>
                                                    <th style="padding:13px; text-align:left;">Student ID</th>
                                                    <th style="padding:13px; text-align:center;">Fullname</th>
                                                    <th style="padding:13px; text-align:center;">Sex</th>
                                                    <th style="padding:13px; text-align:center;">Status</th>
                                                    <th style="padding:13px; text-align:center;">Program & Level</th>
                                                    <th style="padding:13px; text-align:center;">Category</th>
                                                    <th style="padding:1px; text-align:center;">Course <br>Units</th>
                                                    <th style="padding:1px; text-align:center;">Laboratory <br>Hours</th>
                                                    <th style="padding:1px; text-align:center;">Total <br>Assessment</th>
                                                    <th style="padding:13px; text-align:center;">Downpayment</th>
                                                    <th style="padding:1px; text-align:center;">Prelim <br>Balance</th>
                                                    <th style="padding:1px; text-align:center;">Midterm <br>Balance</th>
                                                    <th style="padding:1px; text-align:center;">Finals <br>Balance</th>
                                                    <th style="padding:1px; text-align:center;">Total <br>Balance</th>
                                                    </tr>
                                                    <!-- <th style="padding:15px;">Total Sales.</th>
                                                    <th style="width:150px; padding:15px;">{{ currencyFormat(this.sum,2) }} </th> -->
                                                    </thead>
                                                    <tbody>  
                                                    <tr v-for="(sa, index) in orderedLastname" :key = "sa.id" :index="index">
                                                    <td style="width:1px; padding:11px; text-align:center; ">{{index+1}}</td>
                                                    <td style="width:100px; padding:11px; ">{{sa.payment_id_num}}</td>
                                                    <td style="width:300px; padding:11px;">{{sa.py_s_i.lastname}} {{sa.py_s_i.suffixname}} , {{sa.py_s_i.firstname}} {{sa.py_s_i.middlename | firstletter}}.</td>
                                                    <td style="width:1px; padding:11px; text-align:center;">{{sa.py_s_i.stud_info.sex | firstletter }}</td>
                                                    <td style="width:1px; padding:11px; text-align:center;">{{sa.py_f_i_d.isStatus }}</td>
                                                    <td style="width:200px; padding:11px; text-align:center;">{{sa.py_f_i_d.enrollprograms.program_code}} - {{sa.pyyl.description}} </td>
                                                    <td style="width:1px; padding:11px; text-align:center;">{{sa.category}}</td>
                                                    <td style="width:1px; padding:11px; text-align:center;">{{sa.py_f_i_d.total_course_unit }}</td>
                                                    <td style="width:1px; padding:11px; text-align:center;">{{sa.py_f_i_d.total_lab }}</td>
                                                    <td style="width:1px; padding:11px; text-align:center;">{{currencyFormat(sa.total_amount_fee)}}</td>
                                                    <template v-if="sa.adding_amount_paid == 0 || sa.adding_amount_paid != null" >
                                                            <td colspan="5" style="width:10px; padding:11px; text-align:center;">Adding Fullpayment - {{currencyFormat(sa.adding_amount_paid)}}</td>

                                                        </template>
                                                        <template v-else-if="sa.finals_amount_paid == 0 || sa.finals_amount_paid != null" >
                                                            <td colspan="5" style="width:10px; padding:11px; text-align:center;">Fullpayment - {{currencyFormat(sa.finals_amount_paid)}}</td>

                                                        </template>
                                                     <template v-else>  
                                                    
                                                    <td style="width:10px; padding:11px; text-align:center;">{{currencyFormat(sa.downpayment_amount_paid)}}</td>
                                                    <td style="width:100px; padding:11px; text-align:center;">{{currencyFormat(sa.prelim_topaid)}}</td>
                                                    <td style="width:10px; padding:11px; text-align:center;">{{currencyFormat(sa.midterm_topaid)}}</td>
                                                    <td style="width:10px; padding:11px; text-align:center;">{{currencyFormat(sa.finals_topaid)}}</td>
                                                    <td style="width:10px; padding:11px; text-align:center;">{{currencyFormat(sa.balance_fee)}}</td>
                                                    </template>
                                                    </tr>
                                                    <th style="padding:1px; text-align:center;"></th>
                                                    <th style="padding:1px; text-align:left;"></th>
                                                    <th style="padding:1px; text-align:center;"></th>
                                                    <th style="padding:1px; text-align:center;"></th>
                                                    <th style="padding:1px; text-align:center;"></th>
                                                    <th style="padding:1px; text-align:center;"></th>
                                                    <th style="padding:1px; text-align:center;"></th>
                                                    <th style="padding:1px; text-align:center;"></th>
                                                    <th style="padding:1px; text-align:center;"></th>
                                                    <th style="padding:1px; text-align:center;">Grand Total Assessment : {{ currencyFormat(this.sum) }}</th>
                                                    <th style="padding:1px; text-align:center;">Grand Total Downpayment : {{ currencyFormat(this.dp) }}</th>
                                                    <th style="padding:1px; text-align:center;">Grand Total Fullpayment : {{ currencyFormat(this.fp) }}</th>
                                                    <th style="padding:1px; text-align:center;">Grand Total Adding : {{ currencyFormat(this.ap) }}</th>
                                                    <th colspan="2" style="padding:1px; text-align:center;">Grand Total <br>Balance : <br>{{ currencyFormat(this.bal) }}</th>
                                                    
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
        <!-- </div>  -->
    </div>
</template>

<script>
    export default {
        data(){
          return{
            summaryassesstment : [],
            sa:{},
            courses:[],
            status:[],
            program:[],
            yearlevel:[],
            // datetoday: new Date('2011-04-11T10:20:30Z'),
            querySY:'sy',
            sum:0,
            salength:0,
            bal:0,
            dp:0,
            fp:0,
            ap:0,
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
                                    if(this.summaryassesstment[i].total_amount_fee!=null ){
                                            this.sum += parseFloat(this.summaryassesstment[i].total_amount_fee);
                                            
                                    }
                                    if(this.summaryassesstment[i].balance_fee!=null && this.summaryassesstment[i].py_f_i_d.isStatus != "Adding"){
                                            this.bal += parseFloat(this.summaryassesstment[i].balance_fee);
                                            
                                    }  
                                    if(this.summaryassesstment[i].downpayment_amount_paid!=null && this.summaryassesstment[i].py_f_i_d.isStatus != "Adding"){
                                            this.dp += parseFloat(this.summaryassesstment[i].downpayment_amount_paid);
                                            
                                    }
                                    if(this.summaryassesstment[i].finals_amount_paid!=null && this.summaryassesstment[i].py_f_i_d.isStatus != "Adding"){
                                            this.fp += parseFloat(this.summaryassesstment[i].finals_amount_paid);
                                            
                                    }
                                    if(this.summaryassesstment[i].adding_amount_paid!=null && this.summaryassesstment[i].py_f_i_d.isStatus == "Adding"){
                                            this.ap += parseFloat(this.summaryassesstment[i].adding_amount_paid);
                                            
                                    }
                                    
                                      
                                    
                                    //  for (let a = 0; a < this.yearlevel.length; a++){
                                    //        this.enrolledstudent[i] = this.program[i].program_code;
                                    //     }

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

            
           },
           orderedLastname: function(){
                return _.orderBy(this.summaryassesstment,['py_f_i_d.isStatus'],['desc'])
            }
           
        }, 
        filters: {
            firstletter: function(value){
                if(!value) return ''
                value = value.toString()
                return value.charAt(0)
            },
            
        }
       

    }
</script>
