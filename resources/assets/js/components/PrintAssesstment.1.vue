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
                                                <h2>Total Enrollees Sales</h2>
                                                
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
                                                    <th></th>
                                                    <th style="padding:15px;">Total Sales.</th>
                                                    <th style="width:150px; padding:15px;">{{ currencyFormat(totalsales,2) }} </th>
                                                    <th></th>
                                                    
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr >
                                                    <!-- <td style="width:3px; padding:15px;">{{ totalsales }}</td> -->
                                                    

                                                        
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
            // datetoday: new Date('2011-04-11T10:20:30Z'),
            totalrecord:'',
            querySY:'sy',
            form : new Form({
                sy:'0',
                sydesc:'',

       
          }),


          }
        },
        methods: {

            printme() {
              window.print();

          },

          loadList(){
            // if(this.$gate.isStudent()){
                                     
                axios.get("/api/paymentlist").then(({data}) =>(this.summaryassesstment = data))
                .then($data=>{this.totalrecord=this.summaryassesstment.meta.total});
            // }


            
          },
        //   roundFormat: function(value, decimals){
        //       return Number(Math.round(value+'e'+decimals)+'e-'+decimals).toFixed(decimals);
        //   },
          currencyFormat: function(value,decimals,symbol='PHP'){
              let val = (value/1).toFixed(2).replace(',',',')
              return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g,",") + ' ' + symbol
            //   return this.roundFormat(value,2) + ' ' + symbol;
          }

         
        },

        created() {
           this.loadList();
          
          //  setInterval(() => this.loadUsers(), 15000);
        },
        computed: {
           totalsales:function(){
               let sum = 0;
               for (let i = 0; i < this.totalrecord; i++){
                   if(this.summaryassesstment.data[i].total_amount_fee!=null){
                        sum += parseFloat(this.summaryassesstment.data[i].total_amount_fee);
                   }  
               }

               return sum;
           },
        }
       

    }
</script>
