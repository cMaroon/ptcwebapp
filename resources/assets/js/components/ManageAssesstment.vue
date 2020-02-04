<template>
 <div class="row justify-content-center">
   <div class="col-md-12">
      <div class="card">
          <div class="card-header">
            <h3 class="card-title">Manage Assesstment Information</h3>
            <div class="card-tools" style="position: absolute;right:1rem;top:.5rem;">
              <!-- <button type="button" class="btn btn-success" @click="create">Add New <i class="fas fa-plus"></i></button> -->
              <router-link :to="{name: 'printsummarya'}" class="btn btn-success btn-md" >
                           Print Summary <i class="fas fa-print"></i>
              </router-link>
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
                    <option value="payment_id_num" selected>ID Number</option>
                    <option value="payment_form_id">Form ID</option>
                  </select>
                </div>
                <div class="col-md-7">
                  <input v-model="query" type="text" class="form-control" placeholder="Search">
                </div>
              </div>
            </form>
            </div>
              <table class="table table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th style="width:180; ">ID Num</th>
                  <th>Form ID</th>
                  <th style="width:130; ">Fullname</th>
                  <th>Address</th>
                  <th>Total Course Unit</th>
                  <th>Total Laboratory Hour</th>
                  <th>SY</th>
                  <th>Semester</th>
                  <th>Status</th>
                  <th>YL</th>
                  <th>Tuition Fee</th>
                  <th>Laboratory Fee</th>
                  <th>Down-payment to Paid</th>
                  <th>Partial Payment</th>
                  <th>Balance</th>
                  <th>Registration Fee</th>
                  <th>Library Fee</th>
                  <th>MF</th>
                  <th>CF</th>
                  <th>AF</th>
                  <th>BRF</th>
                  <th>PF</th>
                  <th>TAF</th>
                  <th>ABy</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-show="!payment.length" v-for="(payment, index) in payment" :key="payment.id">
                    <td>{{ index + 1}}</td>
                    <td hidden>{{ payment.id }}</td>
                    <td style="width:180; ">{{ payment.payment_id_num }}</td>
                    <td>{{ payment.payment_form_id }}</td>
                    <td style="width:130; ">{{ payment.py_s_i.lastname }} {{ payment.py_s_i.suffixname }}, {{ payment.py_s_i.firstname }} {{ payment.py_s_i.middlename }}</td>
                    <td>
                      <!-- {{ payment.py_s_i.stud_info.ca_st_num }} {{ payment.py_s_i.stud_info.ca_st_name }} {{ payment.py_s_i.stud_info.ca_subd }} {{ payment.py_s_i.stud_info.ca_brgy }} -->
                       {{ payment.py_s_i.stud_info.ca_city }}</td>
                    <td>{{ payment.py_f_i_d.total_course_unit }}</td>
                    <td>{{ payment.py_f_i_d.total_lab }}</td>
                    <td>{{ payment.pysy.title }}</td>
                    <td>{{ payment.pysem.title }}</td>
                    <td>{{ payment.py_f_i_d.isStatus }}</td>
                    <td>{{ payment.pyyl.title }}</td>
                    <td>{{ currencyFormat(payment.tuition_fee) }}</td>
                    <td>{{ currencyFormat(payment.laboratory_fee) }}</td>
                    <td>{{ currencyFormat(payment.downpayment_topaid) }}</td>
                    <td>{{ currencyFormat(payment.downpayment_amount_paid) }}</td>
                    <td>{{ currencyFormat(payment.balance_fee) }} </td>
                    <td>{{ currencyFormat(payment.registration_fee)}}</td>
                    <td>{{ currencyFormat(payment.library_fee) }}</td>
                    <td>{{ currencyFormat(payment.medical_fee) }}</td>
                    <td>{{ currencyFormat(payment.cultural_fee) }}</td>
                    <td>{{ currencyFormat(payment.athletic_fee) }}</td>
                    <td>{{ currencyFormat(payment.bookrental_fee) }}</td>
                    <td>{{ currencyFormat(payment.penalty_fee) }}</td>
                    <td>{{ currencyFormat(payment.total_amount_fee) }}</td>
                    <td>{{ payment.assessed_by }}</td>
                    
                    <td class="text-center">
                        <!-- <button type="button" @click="show(payment)" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </button> -->
                        <button type="button" @click="edit(payment)" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                        </button>
                        <!-- <button type="button" @click="destroy(payment)" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i>
                        </button> -->
                        
                    </td>


                </tr>
                <tr v-show="!payment.length">
                  <td colspan="28">
                    <div class="alert alert-danger" role="alert">
                      <center>No Data Found!</center>
                    </div>
                  </td>
                </tr>
              </tbody>
              <tfoot>
              <tr>
                  <th>#</th>
                  <th style="width:180; ">ID Num</th>
                  <th>Form ID</th>
                  <th style="width:130; ">Fullname</th>
                  <th>Address</th>
                  <th>Total Course Unit</th>
                  <th>Total Laboratory Hour</th>
                  <th>SY</th>
                  <th>Semester</th>
                  <th>Status</th>
                  <th>YL</th>
                  <th>Tuition Fee</th>
                  <th>Laboratory Fee</th>
                  <th>Down-payment to Paid</th>
                  <th>Partial Payment</th>
                  <th>Balance</th>
                  <th>Registration Fee</th>
                  <th>Library Fee</th>
                  <th>MF</th>
                  <th>CF</th>
                  <th>AF</th>
                  <th>BRF</th>
                  <th>PF</th>
                  <th>TAF</th>
                  <th>ABy</th>
                  <!-- <th>#</th>
                  <th>ID Number</th>
                  <th>Form ID</th>
                  <th>Fullname</th>
                  <th>Address</th>
                  <th>Total Course Unit</th>
                  <th>Total Lab Unit</th>
                  <th>School Year</th>
                  <th>Semester</th>
                  <th>Year Level</th>
                  <th>Tuition Fee</th>
                  <th>Registration Fee</th>
                  <th>Library Fee</th>
                  <th>Medical Fee</th>
                  <th>Cultural Fee</th>
                  <th>Athletic Fee</th>
                  <th>Book Rental Fee</th>
                  <th>Laboratory Fee</th>
                  <th>Penalty Fee</th>
                  <th>Other Fee</th>
                  <th>Total Amount Fee</th>
                  <th>Assessed By</th> -->
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
    <div class="modal fade" id="paymentModalLong" tabindex="-1" role="dialog" aria-labelledby="paymentModalTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="paymentModalTitle">{{ editMode ? "Edit":"Add New"}} Payment Info <br>
              Form ID: {{ form.payment_form_id }} |
              ID Number: {{ form.payment_id_num }} <br>
              Total Course Unit : {{ form.total_course_unit }} | Total Lab Unit : {{ form.total_lab }}
              
            </h5>

          </div>
            
          <form @submit.prevent="editMode ? update() : store()" @keydown="form.onKeydown($event)">
          <div class="modal-body">
            <alert-error :form="form" message="There were some problems with your input."></alert-error>

              

              <div class="form-group">
                <label>Tuition Fee</label>
                <input v-model="form.tuition_fee" type="text" name="tuition_fee"
                  class="form-control" >
              </div>
            <!-- <template v-if="form.isStatus != 'Adding'">    
              <div class="form-group">
                <label>Registration Fee</label>
                <input v-model="form.registration_fee" type="text" name="registration_fee"
                  class="form-control" >
              

              
                <label>Library Fee</label>
                <input v-model="form.library_fee" type="text" name="library_fee"
                  class="form-control" >
              
                <label>Medical Fee</label>
                <input v-model="form.medical_fee" type="text" name="medical_fee"
                  class="form-control" >
              
                <label>Cultural Fee</label>
                <input v-model="form.cultural_fee" type="text" name="cultural_fee"
                  class="form-control" >
              
                <label>Athletic Fee</label>
                <input v-model="form.athletic_fee" type="text" name="athletic_fee"
                  class="form-control" >
           
                <label>Book Rental Fee</label>
                <input v-model="form.bookrental_fee" type="text" name="bookrental_fee"
                  class="form-control" >
              </div>
            </template> -->

              <div class="form-group">
                <label>Laboratoy Fee</label>
                <input v-model="form.laboratory_fee" type="text" name="laboratory_fee"
                  class="form-control" >
              </div>

              <div class="form-group">
                <label>Misc / Others Fee</label>
                <input v-model="form.m_fee" type="text" name="penalty_fee"
                  class="form-control" >
              </div>

              <div class="form-group">
                <label>Penalty Fee</label>
                <input v-model="form.penalty_fee" type="text" name="penalty_fee"
                  class="form-control" >
              </div>

              <!-- <div class="form-group">
                <label>Total Amount Fee</label>
                <input v-model="form.total_amount_fee" type="text" name="total_amount_fee"
                  class="form-control" >
              </div> -->

              <div class="form-group">
                <label>Category</label>
                <select  type="text" name="category" class="form-control" v-model="category" >
                    <option v-for="residency in residency" :key="residency.id" v-bind:value="residency.id">{{residency.title}} - {{residency.description}}</option>
                </select>
              </div>

              <div class="form-group">
                <label>Assessed By</label>
                <input v-model="form.assessed_by" type="text" name="assessed_by"
                  class="form-control" >
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
          queryField:'payment_id_num',
          category:'',
          payment:[],
          residency:[],
          totalcount:'',
          form : new Form({
            id:'',
            payment_id_num:'',
            sy:'',
            semester:'',
            yearlevel:'',
            payment_form_id:'',
            category_id:'',
            tuition_fee:'',
            registration_fee:'75.00',
            library_fee:'40.00',
            medical_fee:'50.00',
            cultural_fee:'15.00',
            athletic_fee:'15.00',
            //
            bookrental_fee:'0.00',
            laboratory_fee:'',
            penalty_fee:'0.00',
            //
            idval_fee:'150.00',
            guidance_fee:'100.00',
            ptccup_fee:'75.00',
            ssc_fee:'75.00',
            studenthb_fee:'50.00',
            insurance_fee:'50.00',
            //
            total_amount_fee:'',
            assessed_by:'Rowena Del Rosario',
            total_course_unit:'',
            total_lab:'',
            downpayment_topaid:'',
            m_fee:'',
            isStatus:'',
            
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
        },
        // category:function(newCategory){
        //  if(newCategory!=null){
        //     this.form.tuition_fee = parseFloat(this.form.total_course_unit) * parseFloat(this.residency[newCategory-1].isTF)
        //     this.form.laboratory_fee = parseFloat(this.form.total_lab) * 100
        //     this.form.category_id = this.residency[newCategory-1].id
        //     this.form.m_fee = parseFloat(this.form.registration_fee)+parseFloat(this.form.library_fee)+parseFloat(this.form.medical_fee)+parseFloat(this.form.cultural_fee)+parseFloat(this.form.athletic_fee)+parseFloat(this.form.idval_fee)+parseFloat(this.form.guidance_fee)+parseFloat(this.form.ptccup_fee)+parseFloat(this.form.ssc_fee)+parseFloat(this.form.studenthb_fee)+parseFloat(this.form.insurance_fee)
        //     this.form.downpayment_topaid = ((parseFloat(this.form.tuition_fee) + parseFloat(this.form.laboratory_fee))*.30)+parseFloat(this.form.m_fee)
        //  }
            
          
        // }

        //  *for update for unifast and non unifast category *do not touch
      },
        mounted() {
            // console.log('Component mounted.')
            this.getData();
        },
        methods:{
          getData(){
            //load data
            this.$Progress.start()
            axios.get('/api/managepayment?page='+this.pagination.current_page)
              .then(response=>{
                // console.log(response)
                this.payment = response.data.data
                this.pagination = response.data.meta
                this.totalcount = this.pagination.total
                this.$Progress.finish()
              })
              .catch(e => {
                console.log(e)
                this.$Progress.fail()
              })
            axios.get('/api/rclist')
            .then(response=>{
              this.residency = response.data.data
            })

          },
          searchData(){
            this.$Progress.start()
            axios.get('/api/search/payment/'+this.queryField+'/'+this.query+'?page='+this.pagination.current_page)
            .then(response =>{
              this.payment = response.data.data
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
            this.queryField='payment_id_num'
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
            $('#paymentModalLong').modal('show')

          },
          store(){
            // console.log('Hello')
            this.$Progress.start()
            this.form.busy = true
            this.form.total_amount_fee = parseFloat(this.form.tuition_fee) + parseFloat(this.form.registration_fee) + parseFloat(this.form.library_fee) + parseFloat(this.form.medical_fee) + parseFloat(this.form.cultural_fee) + parseFloat(this.form.athletic_fee) + parseFloat(this.form.bookrental_fee) + parseFloat(this.form.laboratory_fee) + parseFloat(this.form.penalty_fee) +parseFloat(this.form.idval_fee)+parseFloat(this.form.guidance_fee)+parseFloat(this.form.ptccup_fee)+parseFloat(this.form.ssc_fee)+parseFloat(this.form.studenthb_fee)+parseFloat(this.form.insurance_fee)

            this.form
              .post('/api/managepayment')
              .then(response => {
                this.getData()
                $('#paymentModalLong').modal('hide')
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
          show(payment) {
            this.form.reset();
            this.form.fill(payment);
            $("#showModalLong").modal("show");
            // console.log(studentuser);
          },
          edit(payment){
            $('#paymentModalLong').modal('show')
            this.editMode = true
            this.form.reset()
            // this.form.clear()
            this.form.fill(payment)
            this.form.total_course_unit = payment.py_f_i_d.total_course_unit
            this.form.total_lab = payment.py_f_i_d.total_lab
            this.form.isStatus = payment.py_f_i_d.isStatus
            this.category = payment.category
            //
            this.form.tuition_fee = parseFloat(this.form.total_course_unit) * 300
            this.form.laboratory_fee = parseFloat(this.form.total_lab) * 100
            
            //
           
              this.form.registration_fee='75.00'
              this.form.library_fee='40.00'
              this.form.medical_fee='50.00'
              this.form.cultural_fee='15.00'
              this.form.athletic_fee='15.00'
              this.form.bookrental_fee='0.00'
              this.form.penalty_fee='0.00'
              //
              this.form.idval_fee='150.00'
              this.form.guidance_fee='100.00'
              this.form.ptccup_fee='75.00'
              this.form.ssc_fee='75.00'
              this.form.studenthb_fee='50.00'
              this.form.insurance_fee='50.00'

              this.form.m_fee = parseFloat(this.form.registration_fee)+parseFloat(this.form.library_fee)+parseFloat(this.form.medical_fee)+parseFloat(this.form.cultural_fee)+parseFloat(this.form.athletic_fee)+parseFloat(this.form.idval_fee)+parseFloat(this.form.guidance_fee)+parseFloat(this.form.ptccup_fee)+parseFloat(this.form.ssc_fee)+parseFloat(this.form.studenthb_fee)+parseFloat(this.form.insurance_fee)
              
              this.form.downpayment_topaid = ((parseFloat(this.form.tuition_fee) + parseFloat(this.form.laboratory_fee))*.30)+parseFloat(this.form.m_fee)
            
            // if(payment.tuition_fee==null && this.form.isStatus=='Adding'){
            //   this.form.registration_fee='0.00'
            //   this.form.library_fee='0.00'
            //   this.form.medical_fee='0.00'
            //   this.form.cultural_fee='0.00'
            //   this.form.athletic_fee='0.00'
            //   this.form.bookrental_fee='0.00'
            //   this.form.penalty_fee='0.00'
            //   //
            //   this.form.idval_fee='0.00'
            //   this.form.guidance_fee='0.00'
            //   this.form.ptccup_fee='0.00'
            //   this.form.ssc_fee='0.00'
            //   this.form.studenthb_fee='0.00'
            //   this.form.insurance_fee='0.00'
            // }
           
          },
          update(){
            this.$Progress.start()
            this.form.busy = true
            this.form.total_amount_fee = parseFloat(this.form.tuition_fee) + parseFloat(this.form.registration_fee) + parseFloat(this.form.library_fee) + parseFloat(this.form.medical_fee) + parseFloat(this.form.cultural_fee) + parseFloat(this.form.athletic_fee) + parseFloat(this.form.bookrental_fee) + parseFloat(this.form.laboratory_fee) + parseFloat(this.form.penalty_fee) +parseFloat(this.form.idval_fee)+parseFloat(this.form.guidance_fee)+parseFloat(this.form.ptccup_fee)+parseFloat(this.form.ssc_fee)+parseFloat(this.form.studenthb_fee)+parseFloat(this.form.insurance_fee)
              this.form.idval_fee='150.00'
              this.form.guidance_fee='100.00'
              this.form.ptccup_fee='75.00'
              this.form.ssc_fee='75.00'
              this.form.studenthb_fee='50.00'
              this.form.insurance_fee='50.00'
            this.form
              .put('/api/manageassesstment/'+this.form.id)
              .then(response => {
                this.getData()
                $('#paymentModalLong').modal('hide')
                  if(this.form.successful){
                    this.$Progress.finish()
                    this.$snotify.success('Data Successfully Updated','Success', {
                          timeout: 3000,
                          showProgressBar: false,
                          closeOnClick: false,
                          pauseOnHover: false,
                          position: "rightTop",
                        });
                      this.getData()
                      this.query=''
                      this.queryField='payment_id_num'
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
          destroy(payment){
            this.form.id = payment.id
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
                          .delete('/api/managepayment/'+this.form.id)
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
          currencyFormat: function(value,decimals,symbol='PHP'){
              let val = (value/1).toFixed(2).replace(',',',')
              return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g,",")
            //   return this.roundFormat(value,2) + ' ' + symbol;
          }
        }
    }
</script>
