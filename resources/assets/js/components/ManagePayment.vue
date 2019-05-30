<template>
 <div class="row justify-content-center">
   <div class="col-md-12">
      <div class="card">
          <div class="card-header">
            <h3 class="card-title">Manage Payment Information</h3>
            <div class="card-tools" style="position: absolute;right:1rem;top:.5rem;">
              <!-- <button type="button" class="btn btn-success" @click="create">Add New <i class="fas fa-plus"></i></button> -->
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
                  <th>ID Number</th>
                  <th>Form ID</th>
                  <th>Fullname</th>
                  <th>School Year</th>
                  <th>Semester</th>
                  <th>Year Level</th>
                  <th>Assessed By</th>
                  <th>Downpayment OR Number</th>
                  <th>Downpayment Amount Paid</th>
                  <th>Downpayment Paid Date</th>
                  <th>Downpayment Issued By</th>
                  <th>Prelim OR Number</th>
                  <th>Prelim Amount Paid</th>
                  <th>Prelim Paid Date</th>
                  <th>Prelim Issued By</th>
                  <th>Midterm OR Number</th>
                  <th>Midterm Amount Paid</th>
                  <th>Midterm Paid Date</th>
                  <th>Midterm Issued By</th>
                  <th>Finals OR Number</th>
                  <th>Finals Amount Paid</th>
                  <th>Finals Paid Date</th>
                  <th>Finals Issued By</th>
                  <th>Adding OR Number</th>
                  <th>Adding Amount Paid</th>
                  <th>Adding Paid Date</th>
                  <th>Adding Issued By</th>       
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-show="!payment.length" v-for="(payment, index) in payment" :key="payment.id">
                    <td>{{ index + 1}}</td>
                    <td hidden>{{ payment.id }}</td>
                    <td>{{ payment.payment_id_num }}</td>
                    <td>{{ payment.payment_form_id }}</td>
                    <td>{{ payment.py_s_i.lastname }} {{ payment.py_s_i.suffixname }}, {{ payment.py_s_i.firstname }} {{ payment.py_s_i.middlename }}</td>
                    <td>{{ payment.pysy.title }}</td>
                    <td>{{ payment.pysem.title }}</td>
                    <td>{{ payment.pyyl.title }}</td>
                    <td>{{ payment.assessed_by }}</td>
                    <td>{{ payment.downpayment_or_num }}</td>
                    <td>{{ payment.downpayment_amount_paid }}</td>
                    <td>{{ payment.downpayment_paid_date }}</td>
                    <td>{{ payment.downpayment_issued_by }}</td>
                    <td>{{ payment.prelim_or_num }}</td>
                    <td>{{ payment.prelim_amount_paid }}</td>
                    <td>{{ payment.prelim_paid_date }}</td>
                    <td>{{ payment.prelim_issued_by }}</td>
                    <td>{{ payment.midterm_or_num }}</td>
                    <td>{{ payment.midterm_amount_paid }}</td>
                    <td>{{ payment.midterm_paid_date }}</td>
                    <td>{{ payment.midterm_issued_by }}</td>
                    <td>{{ payment.finals_or_num }}</td>
                    <td>{{ payment.finals_amount_paid }}</td>
                    <td>{{ payment.finals_paid_date }}</td>
                    <td>{{ payment.finals_issued_by }}</td>
                    <td>{{ payment.adding_or_num }}</td>
                    <td>{{ payment.adding_amount_paid }}</td>
                    <td>{{ payment.adding_paid_date }}</td>
                    <td>{{ payment.adding_issued_by }}</td>
                    
                    
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
                  <td colspan="25">
                    <div class="alert alert-danger" role="alert">
                      <center>No Data Found!</center>
                    </div>
                  </td>
                </tr>
              </tbody>
              <tfoot>
              <tr>
                  <th>#</th>
                  <th>ID Number</th>
                  <th>Form ID</th>
                  <th>Fullname</th>
                  <th>School Year</th>
                  <th>Semester</th>
                  <th>Year Level</th>
                  <th>Assessed By</th>
                  <th>Downpayment OR Number</th>
                  <th>Downpayment Amount Paid</th>
                  <th>Downpayment Paid Date</th>
                  <th>Downpayment Issued By</th>
                  <th>Prelim OR Number</th>
                  <th>Prelim Amount Paid</th>
                  <th>Prelim Paid Date</th>
                  <th>Prelim Issued By</th>
                  <th>Midterm OR Number</th>
                  <th>Midterm Amount Paid</th>
                  <th>Midterm Paid Date</th>
                  <th>Midterm Issued By</th>
                  <th>Finals OR Number</th>
                  <th>Finals Amount Paid</th>
                  <th>Finals Paid Date</th>
                  <th>Finals Issued By</th>
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
              Total Amount Fee : {{ form.total_amount_fee }}
              
            </h5>

          </div>
            
          <form @submit.prevent="editMode ? update() : store()" @keydown="form.onKeydown($event)">
          <div class="modal-body">
            <alert-error :form="form" message="There were some problems with your input."></alert-error>

            <div class="form-group">
                <select  type="text" name="assess" class="form-control"  required v-model="form.assess" >
                    <option value="Downpayment">Downpayment</option>
                    <option value="Adding">Adding</option>
                    <option value="Prelim">Prelim</option>
                    <option value="Midterm">Midterm</option>
                    <option value="Finals">Finals</option>
                </select>
              </div>

            <template v-if="form.assess == 'Downpayment'">
            <div class="form-group">
                <label>Downpayment OR Number</label>
                <input v-model="form.downpayment_or_num" type="text" name="downpayment_or_num"
                  class="form-control" >
              </div>

              <div class="form-group">
                <label>Downpayment Amount Paid</label>
                <input v-model="form.downpayment_amount_paid" type="text" name="downpayment_amount_paid"
                  class="form-control" >
              </div>

              <div class="form-group">
                <label>Downpayment Paid Date</label>
                <input v-model="form.downpayment_paid_date" name="downpayment_paid_date" type="text" class="form-control" placeholder="mm/dd/yyyy">
                
              </div>

              <div class="form-group">
                <label>Downpayment Issued By</label>
                <input v-model="form.downpayment_issued_by" type="text" name="downpayment_issued_by"
                  class="form-control" >
              </div>
                </template>

            <template v-if="form.assess == 'Adding'">
              <div class="form-group">
                <label>Adding OR Number</label>
                <input v-model="form.adding_or_num" type="text" name="adding_or_num"
                  class="form-control" >
              </div>

              <div class="form-group">
                <label>Adding Amount Paid</label>
                <input v-model="form.adding_amount_paid" type="text" name="adding_amount_paid"
                  class="form-control" >
              </div>

              <div class="form-group">
                <label>Adding Paid Date</label>
                <input v-model="form.adding_paid_date" name="adding_paid_date" type="text" class="form-control" placeholder="mm/dd/yyyy">
                
              </div>

              <div class="form-group">
                <label>Adding Issued By</label>
                <input v-model="form.adding_issued_by" type="text" name="adding_issued_by"
                  class="form-control" >
              </div>
                </template>

            <template v-if="form.assess == 'Prelim'">
              <div class="form-group">
                <label>Prelim OR Number</label>
                <input v-model="form.prelim_or_num" type="text" name="prelim_or_num"
                  class="form-control" >
              </div>

              <div class="form-group">
                <label>Prelim Amount Paid</label>
                <input v-model="form.prelim_amount_paid" type="text" name="prelim_amount_paid"
                  class="form-control" >
              </div>

              <div class="form-group">
                <label>Prelim Paid Date</label>
                <input v-model="form.prelim_paid_date" name="prelim_paid_date" type="text" class="form-control" placeholder="mm/dd/yyyy">
                
              </div>

              <div class="form-group">
                <label>Prelim Issued By</label>
                <input v-model="form.prelim_issued_by" type="text" name="prelim_issued_by"
                  class="form-control" >
              </div>
            </template>

            <template v-if="form.assess == 'Midterm'">
              <div class="form-group">
                <label>Midterm OR Number</label>
                <input v-model="form.midterm_or_num" type="text" name="midterm_or_num"
                  class="form-control" >
              </div>

              <div class="form-group">
                <label>Midterm Amount Paid</label>
                <input v-model="form.midterm_amount_paid" type="text" name="midterm_amount_paid"
                  class="form-control" >
              </div>

              <div class="form-group">
                <label>Midterm Paid Date</label>
                <input v-model="form.midterm_paid_date" name="midterm_paid_date" type="text" class="form-control" placeholder="mm/dd/yyyy">
                
              </div>

              <div class="form-group">
                <label>Midterm Issued By</label>
                <input v-model="form.midterm_issued_by" type="text" name="midterm_issued_by"
                  class="form-control" >
              </div>
            </template>

            <template v-if="form.assess == 'Finals'">
              <div class="form-group">
                <label>Finals OR Number</label>
                <input v-model="form.finals_or_num" type="text" name="finals_or_num"
                  class="form-control" >
              </div>

              <div class="form-group">
                <label>Finals Amount Paid</label>
                <input v-model="form.finals_amount_paid" type="text" name="finals_amount_paid"
                  class="form-control" >
              </div>

              <div class="form-group">
                <label>Finals Paid Date</label>
                <input v-model="form.finals_paid_date" name="finals_paid_date" type="text" class="form-control" placeholder="mm/dd/yyyy">
                
              </div>

              <div class="form-group">
                <label>Finals Issued By</label>
                <input v-model="form.finals_issued_by" type="text" name="finals_issued_by"
                  class="form-control" >
              </div>
            </template>

              <div class="form-group">
                <label>Assessed By</label>
                <input v-model="form.assessed_by" type="text" name="assessed_by"
                  class="form-control" readonly>
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
          payment:[],
          totalcount:'',
          form : new Form({
            id:'',
            payment_id_num:'',
            sy:'',
            semester:'',
            yearlevel:'',
            payment_form_id:'',
            balance_fee:'',
            // tuition_fee:'',
            // registration_fee:'',
            // library_fee:'',
            // medical_fee:'',
            // cultural_fee:'',
            // athletic_fee:'',
            // bookrental_fee:'',
            // laboratory_fee:'',
            // penalty_fee:'',
            // other_fee:'',
            total_amount_fee:'',
            assessed_by:'',
            adding_or_num:'',
            adding_amount_paid:'',
            adding_paid_date:'',
            adding_issued_by:'',
            downpayment_or_num:'',
            downpayment_amount_paid:'',
            downpayment_paid_date:'',
            downpayment_issued_by:'',
            prelim_or_num:'',
            prelim_amount_paid:'',
            prelim_paid_date:'',
            prelim_issued_by:'',
            midterm_or_num:'',
            midterm_amount_paid:'',
            midterm_paid_date:'',
            midterm_issued_by:'',
            finals_or_num:'',
            finals_amount_paid:'',
            finals_paid_date:'',
            finals_issued_by:'',
            assess:'',
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
            this.form
              .post('/api/managepayment')
              .then(response => {
                this.getData()
                this.query=''
                this.queryField='payment_id_num'
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
            this.form.clear()
            this.form.fill(payment)
          },
          update(){
            this.$Progress.start()
            this.form.busy = true
            this.form.balance_fee = parseFloat(this.form.total_amount_fee) - parseFloat(this.form.downpayment_amount_paid)
            this.form
              .put('/api/managepayment/'+this.form.id)
              .then(response => {
                this.getData()
                this.query=''
                this.queryField='payment_id_num'
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
