<template>
    <div class="col-12">
        <!-- this row will not appear when printing -->
        <div class="row no-print"> 
            <div class="col-2">
                <a href="" @click.prevent="printme" target="_blank" class="btn btn-danger"><i class="fa fa-print"></i> Print</a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="invoice p-3 mb-3" style="background-image:url('/img/logo_ptcbw.png');  background-position:relative; background-size: auto; "  >
            <!-- title row -->
            <div class="row" >
                <div class="col-md-2">
                    <img src="/img/logo.png" style="width:150px" class="img-circle elevation-2" >              
                </div>
                <div class="col-md-10">
                    <small class="float-right">
                        <!-- Registration Date: {{Date.now() | setDate}} -->
                    </small>
                    <br>
                    <h1><strong>Pateros Technological College</strong></h1>
                    <small class="float-left">College St. Sto Rosario-Kanluran Pateros Metro Manila | Tel no: 642-8896 / 640-5389</small><br>
                    <div class="row" >
                        <div class="col-md-2"></div>
                        <div class="col-md-8"><h1><strong>Certificate of Registration</strong></h1></div>
                        <div class="col-md-2"></div>
                    </div>     
                </div>    
            </div>
            <!-- end of title row -->
            <br>
            <!-- info row -->
            <template v-if="enrollmentassoc.data">
            <div class="row invoice-info" >
                <div class="col-sm-8 invoice-col" >
                    <strong>STUDENT INFORMATION</strong>
                    &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                    <!-- <strong>Scholarship: </strong> -->
                    <address>
                        <strong>Student Name: </strong>
                        {{enrollmentassoc.data[0].assocformid.studinfo.lastname}} 
                        {{enrollmentassoc.data[0].assocformid.studinfo.suffixname}}, 
                        {{enrollmentassoc.data[0].assocformid.studinfo.firstname}} 
                        {{enrollmentassoc.data[0].assocformid.studinfo.middlename}}
                        <strong>&emsp;&emsp;&emsp;&emsp;Student ID Number: </strong>
                        {{enrollmentassoc.data[0].assocformid.enr_id_num}}<br>
                        <strong>Address: </strong>
                        {{enrollmentassoc.data[0].assocformid.studinfo.stud_info.ca_st_num}} 
                        {{enrollmentassoc.data[0].assocformid.studinfo.stud_info.ca_st_name}} 
                        {{enrollmentassoc.data[0].assocformid.studinfo.stud_info.ca_subd}} 
                        {{enrollmentassoc.data[0].assocformid.studinfo.stud_info.ca_brgy}} 
                        {{enrollmentassoc.data[0].assocformid.studinfo.stud_info.ca_city}}
                    </address>
                </div>
                <div class="col-sm-4 invoice-col" >
                    <b>Form ID# {{enrollmentassoc.data[0].assocformid.enr_form_id}}</b><br>
                    <b>Program Code: </b> {{enrollmentassoc.data[0].assoccurrid.currprograms.program_code}}&emsp;
                    <b>YL: </b> {{enrollmentassoc.data[0].assoccurrid.curryearlevel.title}}<br>
                    <b>Semester: </b> {{enrollmentassoc.data[0].assoccurrid.currsemester.title}}&emsp;&emsp;
                    <b>Status: </b> {{enrollmentassoc.data[0].assocformid.isStatus}}<br>
                </div>  
            </div>
            </template>
            <!-- /.row -->
            <!-- Table row -->
            <div class="row" >
                <div class="col-12 table-responsive" >
                    <table class="table table-bordered" >
                        <thead>
                            <tr>
                                <th style="padding:1px;">Program Code</th>
                                <th style="padding:1px;">Year Level</th>
                                <th style="padding:1px;">Course Code</th>
                                <th style="padding:1px;">Description</th>
                                <th style="padding:1px;">Lec</th>
                                <th style="padding:1px;">Lab</th>
                                <th style="padding:1px;">Unit</th>
                                <th style="padding:1px; text-align:center;">Section</th>
                                <th style="padding:1px; text-align:center;">Day</th>
                                <th style="padding:1px; text-align:center;">Time</th>
                                <th style="padding:1px; text-align:center;">Room</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="enrollassoc in enrollmentassoc.data" :key = "enrollassoc.id">
                                <td style="padding:1px;">{{enrollassoc.assoccurrid.currprograms.program_code}}</td>
                                <td style="padding:1px;">{{enrollassoc.assoccurrid.curryearlevel.description}}</td>
                                <td style="padding:1px;">{{enrollassoc.assoccurrid.currcourses.course_code}}</td>
                                <td style="padding:1px;">{{enrollassoc.assoccurrid.currcourses.descriptive_title}}</td>
                                <td style="width:10px; text-align:center; padding:1px;">{{enrollassoc.assoccurrid.currcourses.lec_hr}}</td>
                                <td style="width:10px; text-align:center; padding:1px;">{{enrollassoc.assoccurrid.currcourses.lab_hr}}</td>
                                <td style="width:10px; text-align:center; padding:1px;">{{enrollassoc.assoccurrid.currcourses.course_unit}}</td>
                                <td style="width:10px; text-align:center; padding:1px;">{{enrollassoc.assoccurrid.currsection.title}}</td>
                                <td style="width:10px; padding:1px; text-align:center;">{{enrollassoc.assoccurrid.sched_days}}</td>
                                <td style="width:160px; padding:1px; text-align:center;">{{enrollassoc.assoccurrid.sched_time}}</td>
                                <td style="width:120px; text-align:center; padding:1px;">{{enrollassoc.assoccurrid.sched_room}}</td>                              
                            </tr>    
                        </tbody>
                    </table>
                    <template v-if="enrollmentassoc.data">
                    <p class="lead" style="font-weight:bold; font-size:24px;">
                            TOTAL FEE : {{currencyFormat(enrollmentassoc.data[0].assocformid.payment.total_amount_fee)}}
                            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                            Total Units : {{enrollmentassoc.data[0].assocformid.total_course_unit}}&emsp;&emsp;
                            Total Laboratory Hour/s : {{enrollmentassoc.data[0].assocformid.total_lab}}     
                    </p>
                    </template>
                </div>
                
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="row" >
                <div class="col-7">
                    <template v-if="enrollmentassoc.data">
                        
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th style="width:25%; padding:1px;">
                                            Tuition Fee:<br>
                                            Laboratory Fee:<br>
                                            Computer Fee:<br>
                                            Registration Fee:<br>
                                            Library Fee:<br>
                                            Medical and Dental Fee:<br>
                                            Cultural Fee:<br>
                                            Athletic Fee:<br>
                                            
                                            
                                        </th>
                                        <th style="width:30%; padding:1px; text-align:right; ">
                                            <template v-if="enrollmentassoc.data[0].assocformid.payment!=null">
                                                {{currencyFormat(enrollmentassoc.data[0].assocformid.payment.tuition_fee)}}<br>
                                                {{currencyFormat(enrollmentassoc.data[0].assocformid.payment.laboratory_fee)}}<br>
                                                {{currencyFormat(enrollmentassoc.data[0].assocformid.payment.computer_fee)}}<br>
                                                {{currencyFormat(enrollmentassoc.data[0].assocformid.payment.registration_fee)}}<br>
                                                {{currencyFormat(enrollmentassoc.data[0].assocformid.payment.library_fee)}}<br>
                                                {{currencyFormat(enrollmentassoc.data[0].assocformid.payment.medical_fee)}}<br>
                                                {{currencyFormat(enrollmentassoc.data[0].assocformid.payment.cultural_fee)}}<br>
                                                {{currencyFormat(enrollmentassoc.data[0].assocformid.payment.athletic_fee)}}<br>
                                                                                               
                                                
                                            </template>
                                        </th>
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th style="width:25%; padding:1px;">
                                            
                                            MISC / OTHERS<br>
                                            New ID (for New Student) / <br>Validation (for Old Student):<br>
                                            Guidance Fee:<br>
                                            PTC Cup:<br>
                                            Supreme Student Council (SSC):<br>
                                            <template v-if="enrollmentassoc.data[0].assoccurrid.curryearlevel.id!=1">
                                            Career Development:<br>
                                            </template>
                                            <template v-else>
                                            Student Handbook:<br>
                                            </template>
                                            Insurance Fee:<br>
                                        </th>
                                        <th style="width:30%; padding:1px; text-align:right; ">
                                            <template v-if="enrollmentassoc.data[0].assocformid.payment!=null">
                                                <br><br> 
                                                {{currencyFormat(enrollmentassoc.data[0].assocformid.payment.idval_fee)}}<br> 
                                                {{currencyFormat(enrollmentassoc.data[0].assocformid.payment.guidance_fee)}}<br> 
                                                {{currencyFormat(enrollmentassoc.data[0].assocformid.payment.ptccup_fee)}}<br> 
                                                {{currencyFormat(enrollmentassoc.data[0].assocformid.payment.ssc_fee)}}<br> 
                                                {{currencyFormat(enrollmentassoc.data[0].assocformid.payment.studenthb_fee)}}<br> 
                                                {{currencyFormat(enrollmentassoc.data[0].assocformid.payment.insurance_fee)}}<br>
                                                
                                            </template>
                                        </th>
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th style="width:25%; padding:1px;">
                                            Total Fee: 
                                        </th>
                                        <th style="width:30%; padding:1px; text-align:right; ">
                                            {{currencyFormat(enrollmentassoc.data[0].assocformid.payment.total_amount_fee)}} 
                                        </th>
                                    </tr>       
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th style="width:25%; padding:1px;">
                                            Assessed By:<br>
                                        </th>
                                        <th style="width:30%; padding:1px; text-align:right; ">
                                            {{enrollmentassoc.data[0].assocformid.payment.assessed_by}}<br>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th style="width:25%; padding:1px;">
                                            <template v-if="enrollmentassoc.data[0].assocformid.payment.finals_amount_paid!=null">
                                                Full-Payment:<br>
                                            </template>
                                            <template v-else>
                                                Partial Payment:<br>
                                            </template>
                                            OR#:<br>
                                            Amount Paid:<br>
                                            Date:<br>
                                        </th>
                                        <th style="width:30%; padding:1px; text-align:right; ">
                                            <template v-if="enrollmentassoc.data[0].assocformid.payment.finals_amount_paid!=null">
                                                <br>
                                                {{enrollmentassoc.data[0].assocformid.payment.finals_or_num}}<br>
                                                {{currencyFormat(enrollmentassoc.data[0].assocformid.payment.finals_amount_paid)}}<br>
                                                {{enrollmentassoc.data[0].assocformid.payment.finals_paid_date}}<br>
                                            </template>
                                            <template v-else>
                                                <br>
                                                {{enrollmentassoc.data[0].assocformid.payment.downpayment_or_num}}<br>
                                                {{currencyFormat(enrollmentassoc.data[0].assocformid.payment.downpayment_amount_paid)}}<br>
                                                {{enrollmentassoc.data[0].assocformid.payment.downpayment_paid_date}}<br>
                                            </template>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="width:25%; padding:1px;">
                                            &emsp;
                                        </th>
                                        <th style="width:30%; padding:1px; text-align:right; "></th>
                                    </tr>
                                    <tr>
                                        <th style="width:25%; padding:1px;">
                                            Collected By:<br>
                                        </th>
                                        <th style="width:30%; padding:1px; text-align:right; ">
                                            <template v-if="enrollmentassoc.data[0].assocformid.payment.finals_amount_paid!=null">
                                                {{enrollmentassoc.data[0].assocformid.payment.finals_issued_by}}<br>
                                            </template>
                                            <template v-else>
                                               {{enrollmentassoc.data[0].assocformid.payment.downpayment_issued_by}}<br>
                                            </template>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </template>
                </div>
                <!--  -->
               
                    <!--  -->
                <div class="col-5">
                    <template v-if="enrollmentassoc.data">   
                       
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th style="width:20%; padding:1px;">
                                            DUE FOR PRELIM<br>
                                            OR#:<br>
                                            Amount Paid:<br>
                                            Date:<br>
                                        </th>
                                        <th style="width:20%; padding:1px; text-align:right; ">
                                            <!-- <template v-if="enrollmentassoc.data[0].assocformid.payment.prelim_amount_paid!=null"> -->
                                                {{currencyFormat(enrollmentassoc.data[0].assocformid.payment.prelim_topaid)}}<br>
                                                <!-- {{enrollmentassoc.data[0].assocformid.payment.prelim_or_num}}<br>
                                                {{currencyFormat(enrollmentassoc.data[0].assocformid.payment.prelim_amount_paid)}}<br>
                                                {{enrollmentassoc.data[0].assocformid.payment.prelim_paid_date}}<br> -->
                                            <!-- </template> -->
                                        </th>
                                    </tr>                                
                                    <tr>
                                        <th style="width:20%; padding:1px;">
                                            &emsp;
                                        </th>
                                        <th style="width:20%; padding:1px; text-align:right; ">
                                            
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="width:20%; padding:1px;">
                                            Collected By:<br>
                                        </th>
                                        <th style="width:20%; padding:1px; text-align:right; ">
                                            <!-- <template v-if="enrollmentassoc.data[0].assocformid.payment.prelim_amount_paid!=null">
                                                {{enrollmentassoc.data[0].assocformid.payment.prelim_issued_by}}<br>
                                            </template> -->
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th style="width:20%; padding:1px;">
                                            DUE FOR MIDTERM<br>
                                            OR#:<br>
                                            Amount Paid:<br>
                                            Date:<br>
                                        </th>
                                        <th style="width:20%; padding:1px; text-align:right; ">
                                            {{currencyFormat(enrollmentassoc.data[0].assocformid.payment.midterm_topaid)}}<br>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="width:20%; padding:1px;">
                                            &emsp;
                                        </th>
                                        <th style="width:20%; padding:1px; text-align:right; ">
                                            
                                        </th>
                                    </tr> 
                                    <tr>
                                        <th style="width:20%; padding:1px;">
                                            Collected By:<br>
                                        </th>
                                        <th style="width:20%; padding:1px; text-align:right; ">
                                            <!-- <template v-if="enrollmentassoc.data[0].assocformid.payment.midterm_amount_paid!=null">
                                                {{enrollmentassoc.data[0].assocformid.payment.midterm_issued_by}}<br>
                                            </template> -->
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th style="width:20%; padding:1px;">
                                            DUE FOR FINALS<br>
                                            OR#:<br>
                                            Amount Paid:<br>
                                            Date:<br>
                                        </th>
                                        <th style="width:20%; padding:1px; text-align:right; ">
                                            {{currencyFormat(enrollmentassoc.data[0].assocformid.payment.finals_topaid)}}<br>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="width:20%; padding:1px;">
                                            &emsp;
                                        </th>
                                        <th style="width:20%; padding:1px; text-align:right; ">
                                            
                                        </th>
                                    </tr> 
                                    <tr>
                                        <th style="width:20%; padding:1px;">
                                            Collected By:<br>
                                        </th>
                                        <th style="width:20%; padding:1px; text-align:right; ">
                                            <!-- <template v-if="enrollmentassoc.data[0].assocformid.payment.finals_amount_paid!=null">
                                                {{enrollmentassoc.data[0].assocformid.payment.finals_issued_by}}<br>
                                            </template> -->
                                        </th>
                                    </tr>  
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th style="width:20%; padding:1px;">
                                            Total Balance:<br>
                                        </th>
                                        <th style="width:20%; padding:1px; text-align:right; ">
                                            {{currencyFormat(enrollmentassoc.data[0].assocformid.payment.balance_fee)}}
                                        </th>
                                    </tr>   
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th style="width:20%; padding:1px;">
                                            College Registrar<br>
                                        </th>
                                        <th style="width:20%; padding:1px; text-align:right; ">
                                            
                                        </th>
                                    </tr>   
                                </tbody>
                            </table>
                        </div>
                    </template> 
                </div>
                <!--  -->
               
            </div>
            <div class="col-3"><br>
                ______________________________<br>
                <center><p class="lead">Student's Signature</p></center>
            </div>

        
        </div>
        <!-- End of Main Content -->
                                 
                                        

    </div>
</template>

<script>
    export default {
        data(){
          return{
            editmode: false,

            enrollmentassoc : {},

            // datetoday: new Date('2011-04-11T10:20:30Z'),
            form: new Form({
                id : '',
                assoc_form_id:'',
                assoc_curr_id:'',
                enr_program_id:'',
            

            })

          }
        },
        
        methods: {
            

            printme() {
              window.print();

            },

            loadEnrollment(){
            // if(this.$gate.isStudent()){
                                     
                axios.get("/api/search/assoc/assoc_form_id/"+this.$route.params.id).then(({data}) =>(this.enrollmentassoc = data))
                .then($data=>{this.totalrecord=$data.total});
            // }


            
          },
          currencyFormat: function(value,decimals,symbol='₱'){
              let val = (value/1).toFixed(2).replace(',',',')
              return symbol+ ' '  +val.toString().replace(/\B(?=(\d{3})+(?!\d))/g,",") 
            //   return this.roundFormat(value,2) + ' ' + symbol;
          }

          

         
        },
        created() {
           this.loadEnrollment();
           
        },

        
        computed: {
           totalunits:function(){
               let sum = 0;
               for (let i = 0; i < this.enrollmentassoc.total; i++){
                   sum += (parseInt(this.enrollmentassoc.data[i].assoccurrid.currcourses.course_unit));
               }

               return sum;
           },
        totallab:function(){
               let sum = 0;
               for (let i = 0; i < this.enrollmentassoc.total; i++){
                   sum += (parseInt(this.enrollmentassoc.data[i].assoccurrid.currcourses.lab_hr));
               }

               return sum;
           }
        }

    }
</script>
