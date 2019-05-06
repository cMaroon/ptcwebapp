<template>
    <div class="container">
        <div class="row mt-2" >
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
                                                <small class="float-right">Registration Date: {{Date.now() | setDate}}</small>

                                            <br>
                                                <h2>Pateros Technological College</h2>
                                                <h4>Certificate of Registration</h4>
                                                
                                        </div>
                                        
                                                <!-- /.col -->
                                            </div>
                                        <br>

                                            <!-- info row -->
                                            <template v-if="enrollmentassoc.data">
                                            <div class="row invoice-info" >
                                                <div class="col-sm-8 invoice-col" >
                                                <strong>Student Information</strong>
                                                <address>
                                                    <strong>Student ID Number: </strong>
                                                     {{enrollmentassoc.data[0].assocformid.enr_id_num}}<br>
                                                    <strong>Name: </strong>
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
                                                <b>Program Code: </b> {{enrollmentassoc.data[0].assoccurrid.currprograms.program_code}}<br>
                                                <b>Year Level: </b> {{enrollmentassoc.data[0].assoccurrid.curryearlevel.title}}<br>
                                                <b>Semester: </b> {{enrollmentassoc.data[0].assoccurrid.currsemester.title}}<br>
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
                                                    <th style="padding:15px;">Course Code</th>
                                                    <th style="padding:15px; text-align:center;">Description</th>
                                                    <th style="padding:15px;">Unit</th>
                                                    <th style="padding:15px;">Lec</th>
                                                    <th style="padding:15px;">Lab</th>
                                                    <th style="padding:15px; text-align:center;">Section</th>
                                                    <th style="padding:15px; text-align:center;">Day</th>
                                                    <th style="text-align:center; padding:15px;">Time</th>
                                                    <th style="padding:15px;">Room</th>
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
                                                <p class="lead">Semestral Fees:</p>
                                                    <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody><tr>
                                                            <th style="width:50%">Tuition Fee: {{enrollmentassoc.data[0].assocformid.payment.tuition_fee}} </th>
                                                            <td></td>

                                                        </tr>
                                                        <tr>
                                                            <th style="width:50%">Reg Fee: {{enrollmentassoc.data[0].assocformid.payment.registration_fee}} </th>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Library Fee: {{enrollmentassoc.data[0].assocformid.payment.library_fee}} </th>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Medical Fee: {{enrollmentassoc.data[0].assocformid.payment.medical_fee}}</th>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Cultural Fee: {{enrollmentassoc.data[0].assocformid.payment.cultural_fee}}</th>
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
                                                        <th style="width:50%">
                                                            Athletic: {{enrollmentassoc.data[0].assocformid.payment.athletic_fee}}</th>
                                                            <td></td>

                                                        </tr>
                                                        <tr>
                                                            <th>Book Rental: {{enrollmentassoc.data[0].assocformid.payment.bookrental_fee}} </th>
                                                            <td></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Laboratory: {{enrollmentassoc.data[0].assocformid.payment.laboratory_fee}}</th>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Penalty: {{enrollmentassoc.data[0].assocformid.payment.penalty_fee}} </th>
                                                                <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Others: {{enrollmentassoc.data[0].assocformid.payment.other_fee}} </th>
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
                                
                                                <div class="table-responsive">
                                                <template v-if="enrollmentassoc.data">
                                                    <table class="table">
                                                    <tbody><tr>
                                                        <th style="width:50%">
                                                        Advising Officer: </th>
                                                        <!-- <template v-if="enrollmentassoc.data">
                                                        <td><small>{{enrollmentassoc.data[0].assocformid.studinfo.studprograms.advisingid.advising_officer_name}}</small></td>
                                                        </template> -->
                                                    </tr>
                                                    <tr>
                                                        <th>Assessed By: {{enrollmentassoc.data[0].assocformid.payment.assessed_by}} </th>
                                                                    <td></td>

                                                    </tr>
                                                    <tr>
                                                        <th>College Registrar: </th>
                                                                    <td></td>

                                                    </tr>
                                                    <tr>
                                                        <th>Total Amount: {{enrollmentassoc.data[0].assocformid.payment.total_amount_fee}}</th>
                                                                    <td></td>

                                                    </tr>
                                                    <tr>
                                                        <th>&nbsp;</th>
                                                                    <td></td>

                                                    </tr>


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
                                                    <tbody><tr>
                                                        <th style="width:55%">
                                                       OR #: {{enrollmentassoc.data[0].assocformid.payment.prelim_or_num}}
                                                       </th>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <th>Amount Paid: {{enrollmentassoc.data[0].assocformid.payment.prelim_amount_paid}} </th>
                                                    </tr>
                                                    <tr>
                                                        <th>Date: {{enrollmentassoc.data[0].assocformid.payment.prelim_paid_date}} </th>
                                                    </tr>
                                                    <tr>
                                                        <th>Issued By: {{enrollmentassoc.data[0].assocformid.payment.prelim_issued_by}}</th>
                                                    </tr>


                                                    </tbody></table>
                                                </div>
                                                </div>

                                                <div class="col-4">      
                                                <p class="lead">Midterm:</p>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                    <tbody><tr>
                                                        <th style="width:55%">
                                                       OR #: {{enrollmentassoc.data[0].assocformid.payment.midterm_or_num}}
                                                       </th>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <th>Amount Paid: {{enrollmentassoc.data[0].assocformid.payment.midterm_amount_paid}} </th>
                                                    </tr>
                                                    <tr>
                                                        <th>Date: {{enrollmentassoc.data[0].assocformid.payment.midterm_paid_date}} </th>
                                                    </tr>
                                                    <tr>
                                                        <th>Issued By: {{enrollmentassoc.data[0].assocformid.payment.midterm_issued_by}} </th>
                                                    </tr>


                                                    </tbody></table>
                                                </div>
                                                </div>

                                                <div class="col-4">      
                                                <p class="lead">Finals:</p>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                    <tbody><tr>
                                                        <th style="width:55%">
                                                       OR #: {{enrollmentassoc.data[0].assocformid.payment.finals_or_num}}
                                                       </th>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <th>Amount Paid: {{enrollmentassoc.data[0].assocformid.payment.finals_amount_paid}} </th>
                                                    </tr>
                                                    <tr>
                                                        <th>Date: {{enrollmentassoc.data[0].assocformid.payment.finals_paid_date}} </th>
                                                    </tr>
                                                    <tr>
                                                        <th>Issued By: {{enrollmentassoc.data[0].assocformid.payment.finals_issued_by}} </th>
                                                    </tr>


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
        </div> 
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
