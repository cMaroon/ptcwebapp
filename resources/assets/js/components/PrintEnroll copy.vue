<template>
    <div class="col-12">
        <!-- <div class="row mt-2" > -->
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
                                                <small class="float-right">Registration Date: 
                                                    {{Date.now() | setDate}}
                                                    </small>

                                            <br>
                                                <h2><strong>Pateros Technological College</strong></h2>
                                                <h4><strong>Certificate of Registration</strong></h4>
                                                
                                        </div>
                                        
                                                <!-- /.col -->
                                            </div>
                                        <br>

                                            <!-- info row -->
                                            <template v-if="enrollmentassoc.data">
                                            <div class="row invoice-info" >
                                                <div class="col-sm-8 invoice-col" >
                                                <strong>Student Information : <template v-if="enrollmentassoc.data[0].assocformid.payment!=null"></template></strong>
                                                &emsp;&emsp;&emsp;
                                                <strong>Student ID Number: </strong>
                                                     {{enrollmentassoc.data[0].assocformid.enr_id_num}}
                                                <address>
                                                    <strong>Scholarship: </strong>
                                                    <strong>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Student Name: </strong>
                                                    {{enrollmentassoc.data[0].assocformid.studinfo.lastname}} 
                                                    {{enrollmentassoc.data[0].assocformid.studinfo.suffixname}}, 
                                                    {{enrollmentassoc.data[0].assocformid.studinfo.firstname}} 
                                                    {{enrollmentassoc.data[0].assocformid.studinfo.middlename}}<br>
                                                    <strong>Address: </strong>
                                                    {{enrollmentassoc.data[0].assocformid.studinfo.stud_info.ca_st_num}} 
                                                    {{enrollmentassoc.data[0].assocformid.studinfo.stud_info.ca_st_name}} 
                                                    {{enrollmentassoc.data[0].assocformid.studinfo.stud_info.ca_subd}} 
                                                    {{enrollmentassoc.data[0].assocformid.studinfo.stud_info.ca_brgy}} 
                                                    {{enrollmentassoc.data[0].assocformid.studinfo.stud_info.ca_city}}<br>
                                                </address>
                                                </div>

                                                <!-- /.col -->
                                                <div class="col-sm-4 invoice-col" >
                                                
                                                <b>Form ID# {{enrollmentassoc.data[0].assocformid.enr_form_id}}</b><br>
                                                <b>Program Code: </b> {{enrollmentassoc.data[0].assoccurrid.currprograms.program_code}}&emsp;
                                                <b>YL: </b> {{enrollmentassoc.data[0].assoccurrid.curryearlevel.title}}<br>
                                                <b>Semester: </b> {{enrollmentassoc.data[0].assoccurrid.currsemester.title}}&emsp;&emsp;
                                                <b>Status: </b> {{enrollmentassoc.data[0].assocformid.isStatus}}<br>
                                                <!-- <b>Student Status: </b> Regular<br> -->
                                                

                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            </template>
                                            <!-- /.row -->

                                            <!-- Table row -->
                                            <div class="row" >
                                                <div class="col-12 table-responsive" >
                                                <table class="table table-striped" >
                                                    <thead>
                                                    <tr>
                                                    <th style="padding:1px;">Course Code</th>
                                                    <th style="padding:1px; text-align:center;">Description</th>
                                                    <th style="padding:1px;">Unit</th>
                                                    <th style="padding:1px;">Lec</th>
                                                    <th style="padding:1px;">Lab</th>
                                                    <th style="padding:1px; text-align:center;">Section</th>
                                                    <th style="padding:1px; text-align:center;">Day</th>
                                                    <th style="text-align:center; padding:1px;">Time</th>
                                                    <th style="padding:1px;">Room</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="enrollassoc in enrollmentassoc.data" :key = "enrollassoc.id">
                                                    <td style="width:130px; padding:15px;">{{enrollassoc.assoccurrid.currcourses.course_code}}</td>
                                                    <td style="padding:15px;">{{enrollassoc.assoccurrid.currcourses.descriptive_title}}</td>
                                                    <td style="width:10px; text-align:center; padding:15px;">{{enrollassoc.assoccurrid.currcourses.course_unit}}</td>
                                                    <td style="width:10px; text-align:center; padding:15px;">{{enrollassoc.assoccurrid.currcourses.lec_hr}}</td>
                                                    <td style="width:10px; text-align:center; padding:15px;">{{enrollassoc.assoccurrid.currcourses.lab_hr}}</td>
                                                    <td style="width:10px; text-align:center; padding:15px;">{{enrollassoc.assoccurrid.currsection.title}}</td>
                                                    <td style="width:10px; text-align:center; padding:15px; ">{{enrollassoc.assoccurrid.sched_days}}</td>
                                                    <td style="width:160px; text-align:center; padding:15px;">{{enrollassoc.assoccurrid.sched_time}}</td>
                                                    <td style="width:10px; text-align:center; padding:15px;">{{enrollassoc.assoccurrid.sched_room}}</td>
                                                        
                                                    </tr>
                                                        
                                                    </tbody>
                                                </table>
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.row -->

                                            <div class="row" >
                                                <div class="col-4">
                                            <template v-if="enrollmentassoc.data">
                                                <p class="lead">Semestral Fees: <br>
                                                    <h2>{{enrollmentassoc.data[0].assocformid.payment.pycat.description}}</h2>
                                                </p>
                                                    <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody><tr>
                                                            <th style="width:50%;">
                                                            
                                                            Tuition Fee:<br>
                                                            Reg Fee:<br>
                                                            Library Fee:<br>
                                                            Medical Fee:<br>
                                                            Cultural Fee:
                                                            </th>

                                                            <th style="text-align:right; ">
                                                            <template v-if="enrollmentassoc.data[0].assocformid.payment!=null">
                                                            {{currencyFormat(enrollmentassoc.data[0].assocformid.payment.tuition_fee)}}<br>
                                                            {{currencyFormat(enrollmentassoc.data[0].assocformid.payment.registration_fee)}}<br>
                                                            {{currencyFormat(enrollmentassoc.data[0].assocformid.payment.library_fee)}}<br>
                                                            {{currencyFormat(enrollmentassoc.data[0].assocformid.payment.medical_fee)}}<br>
                                                            {{currencyFormat(enrollmentassoc.data[0].assocformid.payment.cultural_fee)}} 
                                                            </template>
                                                            </th>
                                                            <td></td>

                                                        </tr>
                                                        <!-- <tr>
                                                            <th style="width:90%">Reg Fee: {{enrollmentassoc.data[0].assocformid.payment.registration_fee}} </th>
                                                            <td></td>
                                                        </tr> -->
                                                        <!-- <tr>
                                                            <th style="width:90%"></th>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:90%"></th>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <th style="width:90%"></th>
                                                            <td></td>
                                                            </tr> -->
                                                         <tr>
                                                            <th style="width:50%">Advising Officer: </th>
                                                            <td></td>
                                                            </tr> 
                                                              

                                                        </tbody></table>
                                                </div>
                                        </template>
                                                </div>
                                             
                                                <!-- /.col -->
                                                <div class="col-4">
                                                <template v-if="enrollmentassoc.data">
                                                    
                                                <p class="lead" style=" text-align: left">Total Units: {{enrollmentassoc.data[0].assocformid.total_course_unit}} </p>
                                                    </template> 
                                                
                                                    <div class="table-responsive">
                                                        <template v-if="enrollmentassoc.data">
                                                    <table class="table">
                                                        <tbody><tr>
                                                        <th style="width:60%">
                                                            Athletic:<br>
                                                            Book Rental:<br>
                                                            Laboratory:<br>
                                                            Penalty:<br>
                                                            Others:
                                                            </th>

                                                            <th style="text-align:right;">
                                                            <template v-if="enrollmentassoc.data[0].assocformid.payment!=null">
                                                            {{currencyFormat(enrollmentassoc.data[0].assocformid.payment.athletic_fee)}}<br>
                                                            {{currencyFormat(enrollmentassoc.data[0].assocformid.payment.bookrental_fee)}}<br>
                                                            {{currencyFormat(enrollmentassoc.data[0].assocformid.payment.laboratory_fee)}}<br>
                                                            {{currencyFormat(enrollmentassoc.data[0].assocformid.payment.penalty_fee)}}<br>
                                                            {{currencyFormat(enrollmentassoc.data[0].assocformid.payment.other_fee)}}
                                                            </template>
                                                            </th>
                                                            <td></td>

                                                        </tr>
                                                        <!-- <tr>
                                                            <th style="width:90%"></th>
                                                            <td></td>
                                                            </tr>
                                                            <tr>
                                                                <th style="width:90%"></th>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <th style="width:90%"></th>
                                                                <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <th style="width:90%"> </th>
                                                                    <td></td>
                                                                </tr> -->
                                                                <tr>
                                                        <th style="width:60%;">Assessed By:<br>
                                                         <template v-if="enrollmentassoc.data[0].assocformid.payment!=null">
                                                        {{enrollmentassoc.data[0].assocformid.payment.assessed_by}}
                                                        </template>
                                                        </th>

                                                                    <td></td>

                                                    </tr>
                    
                                                    </tbody></table>
                                                        </template>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                <template v-if="enrollmentassoc.data">
                                                    
                                                <p class="lead" style=" text-align: left">Total Lab: {{enrollmentassoc.data[0].assocformid.total_lab}} </p>
                                                    </template> 
                                                    <td></td>
                                                <div class="table-responsive">
                                                <template v-if="enrollmentassoc.data">
                                                    <table class="table">
                                                    <tbody><!-- <tr>
                                                        <th style="width:90%">
                                                        </th><td></td>
                                                       
                                                    </tr> -->
                                                    <tr>
                                                        <th style="width:50%">
                                                        Total Amount:<br>
                                                        DP OR#:<br>
                                                        Amount Paid:<br>
                                                        Date:<br>
                                                        Issued By: </th>

                                                        <th style="text-align:right;">
                                                        <template v-if="enrollmentassoc.data[0].assocformid.payment!=null">
                                                        {{currencyFormat(enrollmentassoc.data[0].assocformid.payment.total_amount_fee)}}<br>
                                                        {{enrollmentassoc.data[0].assocformid.payment.downpayment_or_num}}<br>
                                                        <template v-if="enrollmentassoc.data[0].assocformid.payment.downpayment_amount_paid!=null">{{currencyFormat(enrollmentassoc.data[0].assocformid.payment.downpayment_amount_paid)}}</template><br>
                                                        {{enrollmentassoc.data[0].assocformid.payment.downpayment_paid_date}}<br>
                                                        {{enrollmentassoc.data[0].assocformid.payment.downpayment_issued_by}}
                                                        </template>

                                                        </th>
                                                                    <td></td>

                                                    </tr>
                                                    <tr>
                                                            <th style="width:50%">College Registrar: </th>
                                                            <td></td>
                                                            </tr>   
                                                    <!-- <tr>
                                                        <th style="width:90%"></th>
                                                                    <td></td>

                                                    </tr>
                                                    <tr>
                                                        <th style="width:90%"></th>
                                                                    <td></td>

                                                    </tr>
                                                    <tr>
                                                        <th style="width:90%"></th>
                                                                    <td></td>

                                                    </tr>
                                                    <tr>
                                                        <th style="width:90%"></th>
                                                                    <td></td>

                                                    </tr> -->


                                                    </tbody></table>
                                    </template>

                                                </div>
                                                </div>
                                            <!-- OR NO -->
                                                <template v-if="enrollmentassoc.data">

                                                <div class="col-4">      
                                                <p class="lead">Prelim:</p>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                    <tbody>
                                                        <tr>
                                                        <th style="width:90%">
                                                            
                                                       OR #:  <template v-if="enrollmentassoc.data[0].assocformid.payment!=null">
                                                           {{enrollmentassoc.data[0].assocformid.payment.prelim_or_num}}
                                                           </template><br>
                                                       Amount Paid:  <template v-if="enrollmentassoc.data[0].assocformid.payment!=null">
                                                           <template v-if="enrollmentassoc.data[0].assocformid.payment.prelim_amount_paid!=null">{{currencyFormat(enrollmentassoc.data[0].assocformid.payment.prelim_amount_paid)}}</template>
                                                           </template> <br>
                                                       Date:  <template v-if="enrollmentassoc.data[0].assocformid.payment!=null">
                                                           {{enrollmentassoc.data[0].assocformid.payment.prelim_paid_date}} 
                                                           </template><br>
                                                       Issued By:  <template v-if="enrollmentassoc.data[0].assocformid.payment!=null">
                                                           {{enrollmentassoc.data[0].assocformid.payment.prelim_issued_by}}
                                                           </template>
                                                       </th>
                                                        
                                                    </tr>
                                                    <!-- <tr>
                                                        <th></th>
                                                    </tr>
                                                    <tr>
                                                        <th></th>
                                                    </tr>
                                                    <tr>
                                                        <th></th>
                                                    </tr> -->


                                                    </tbody></table>
                                                </div>
                                                </div>

                                                <div class="col-4">      
                                                <p class="lead">Midterm:</p>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                    <tbody><tr>
                                                        <th style="width:90%">
                                                       OR #:  <template v-if="enrollmentassoc.data[0].assocformid.payment!=null">
                                                           {{enrollmentassoc.data[0].assocformid.payment.midterm_or_num}}
                                                           </template><br>
                                                       Amount Paid:  <template v-if="enrollmentassoc.data[0].assocformid.payment!=null">
                                                           <template v-if="enrollmentassoc.data[0].assocformid.payment.midterm_amount_paid!=null">{{currencyFormat(enrollmentassoc.data[0].assocformid.payment.midterm_amount_paid)}}</template>
                                                           </template><br>
                                                       Date:  <template v-if="enrollmentassoc.data[0].assocformid.payment!=null">
                                                           {{enrollmentassoc.data[0].assocformid.payment.midterm_paid_date}}
                                                           </template><br>
                                                       Issued By: 
                                                        <template v-if="enrollmentassoc.data[0].assocformid.payment!=null">
                                                            {{enrollmentassoc.data[0].assocformid.payment.midterm_issued_by}}
                                                            </template>
                                                       </th>
                                                        
                                                    </tr>
                                                    <!-- <tr>
                                                        <th> </th>
                                                    </tr>
                                                    <tr>
                                                        <th> </th>
                                                    </tr>
                                                    <tr>
                                                        <th> </th>
                                                    </tr> -->


                                                    </tbody></table>
                                                </div>
                                                </div>

                                                <div class="col-4">      
                                                <p class="lead">Finals:</p>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                    <tbody><tr>
                                                        <th style="width:90%">
                                                       OR #:  <template v-if="enrollmentassoc.data[0].assocformid.payment!=null">
                                                           {{enrollmentassoc.data[0].assocformid.payment.finals_or_num}}
                                                           </template><br>
                                                       Amount Paid:  <template v-if="enrollmentassoc.data[0].assocformid.payment!=null">
                                                           <template v-if="enrollmentassoc.data[0].assocformid.payment.finals_amount_paid!=null">
                                                               {{currencyFormat(enrollmentassoc.data[0].assocformid.payment.finals_amount_paid)}}</template>
                                                           </template><br>
                                                       Date:  <template v-if="enrollmentassoc.data[0].assocformid.payment!=null">
                                                           {{enrollmentassoc.data[0].assocformid.payment.finals_paid_date}}
                                                           </template><br>
                                                       Issued By: 
                                                        <template v-if="enrollmentassoc.data[0].assocformid.payment!=null">
                                                            {{enrollmentassoc.data[0].assocformid.payment.finals_issued_by}}
                                                            </template>
                                                       </th>
                                                        
                                                    </tr>
                                                    <!-- <tr>
                                                        <th> </th>
                                                    </tr>
                                                    <tr>
                                                        <th> </th>
                                                    </tr>
                                                    <tr>
                                                        <th> </th>
                                                    </tr> -->


                                                    </tbody></table>
                                                </div>
                                                </div>
                                                </template>

                                                <!-- /.col -->
                                            </div>

                                            <div class="col-3"><br>
                                                ______________________________<br>
                                                <center><p class="lead">Student's Signature</p></center>
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
