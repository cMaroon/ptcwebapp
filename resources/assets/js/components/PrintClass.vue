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
                                            <!-- <div class="row" > -->

                                                <!-- <div class="col-md-2">
                                                    <img src="/img/logo.png" style="width:100px; background-position:relative;" class="img-circle elevation-2" >
                                                </div> -->
                                                <div class="col-md-12">
                                                        <small class="float-right">Printed Date: {{Date.now() | setDate}}</small>

                                                        <template v-if="currstud.data">
                                                        <h2><strong>P</strong>ateros <strong>T</strong>echnological <strong>C</strong>ollege</h2>
                                                        <h4>Class List Course : {{currstud.data[0].assoccurrid.currcourses.course_code}} - {{currstud.data[0].assoccurrid.currcourses.descriptive_title}}<br>{{currstud.data[0].assoccurrid.currprograms.descriptive_title}} - ({{currstud.data[0].assoccurrid.currprograms.program_code}}) / 
                                                        {{currstud.data[0].assoccurrid.curryearlevel.title}} - Section {{currstud.data[0].assoccurrid.currsection.title}}</h4>
                                                        </template>
                                                </div>
                                        
                                                <!-- /.col -->
                                            <!-- </div> -->
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
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="(currstuds, index) in orderedLastname" :key = "currstuds.id" :index="index">
                                                    <td style="width:1px; padding:11px; text-align:center; ">{{index+1}}</td>
                                                    <td style="width:220px; padding:11px; ">({{currstuds.assocformid.isStatus }}) {{currstuds.assocformid.enr_id_num}}</td>
                                                    <td style="width:350px; padding:11px;">{{currstuds.assocformid.studinfo.lastname}} {{currstuds.assocformid.studinfo.suffixname}} , {{currstuds.assocformid.studinfo.firstname}} {{currstuds.assocformid.studinfo.middlename | firstletter}}.</td>
                                                    <td style="width:10px; padding:11px; text-align:center;">{{currstuds.assocformid.studinfo.stud_info.sex | firstletter }}</td>
                                                    <td style="width:10px; padding:11px; text-align:center;">{{currstuds.assocformid.payment.category }}</td>
                                                    <td style="width:10px; padding:11px; text-align:center;">{{currstuds.assocformid.total_course_unit }}</td>
                                                    <td style="width:10px; padding:11px; text-align:center;">{{currstuds.assocformid.total_lab }}</td>
                                                    <td style="width:10px; padding:11px; text-align:center;">{{currencyFormat(currstuds.assocformid.payment.total_amount_fee) }}</td>
                                                        <template v-if="currstuds.assocformid.payment.adding_amount_paid == 0 || currstuds.assocformid.payment.adding_amount_paid != null" >
                                                            <td style="width:10px; padding:11px; text-align:center;">Adding Fullpayment</td>

                                                        </template>
                                                        <template v-else-if="currstuds.assocformid.payment.finals_amount_paid == 0 || currstuds.assocformid.payment.finals_amount_paid != null" >
                                                            <td style="width:10px; padding:11px; text-align:center;">Fullpayment</td>

                                                            </template>
                                                     <template v-else>       
                                                    <td style="width:10px; padding:11px; text-align:center;">{{currencyFormat(currstuds.assocformid.payment.downpayment_amount_paid) }}

                                                    </td>
                                                     
                                                    <td style="width:10px; padding:11px; text-align:center;">{{currencyFormat(currstuds.assocformid.payment.prelim_topaid) }}</td>
                                                    <td style="width:10px; padding:11px; text-align:center;">{{currencyFormat(currstuds.assocformid.payment.midterm_topaid) }}</td>
                                                    <td style="width:10px; padding:11px; text-align:center;">{{currencyFormat(currstuds.assocformid.payment.finals_topaid) }}</td>
                                                    <td style="width:10px; padding:11px; text-align:center;">{{currencyFormat(currstuds.assocformid.payment.balance_fee) }}</td>
                                                    </template>


                                                        
                                                    </tr>
                                                        
                                                    </tbody>
                                                </table>
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                    </div>
                                            <small >&emsp;College St., Brgy. Sto. Rosario-Kanluran, Pateros, Metro-Manila Telephone: 02-640-5375 / 02-640-5389</small>

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
            currstud : {},
            datetoday: new Date('2011-04-11T10:20:30Z'),

          }
        },
        methods: {

            printme() {
              window.print();

          },

          loadClass(){
            // if(this.$gate.isStudent()){
                                     
                axios.get("/api/search/classlist/assoc_curr_id/"+this.$route.params.id).then(({data}) =>(this.currstud = data))
                .then($data=>{this.totalrecord=$data.total});
            // }


            
          },
        //     roundFormat: function(value, decimals){
        //       return Number(Math.round(value+'e'+decimals)+'e-'+decimals).toFixed(decimals);
        //   },
          currencyFormat: function(value,decimals,symbol='₱'){
              let val = (value/1).toFixed(2).replace(',',',')
              return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g,",") 
          },

          

         
        },

        created() {
           this.loadClass();
          
          //  setInterval(() => this.loadUsers(), 15000);
        },
        computed: {
           orderedLastname: function(){
                return _.orderBy(this.currstud.data,'assocformid.studinfo.stud_info.sex' && 'assocformid.studinfo.lastname')
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
