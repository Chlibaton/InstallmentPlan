<style scoped>
.theme--light.v-data-table {
    background-color: #fff;
    color: rgba(0,0,0,.87);
    margin: 10px;
}
.textpads{
    padding: 5px;
    color: white;
    margin: 5px 10px;
}
.bg-warning{
  color:black !important;
}
.c-main>label{
    font-size: 30px;
    padding-left: 10px;
    font-weight: bold;
}
.c-sub>label{
    font-size: 18px;
    padding-left: 10px;
}

</style>


<template>
<div>
      <v-toolbar flat color="white">
        <v-toolbar-title>Tracking</v-toolbar-title>
        <v-divider class="mx-4" inset vertical></v-divider>
        <v-text-field v-model="search" append-icon="search" label="Search" single-line hide-details></v-text-field>
      <v-spacer></v-spacer>
        <!-- MODAL FOR PAYMENT TRACKING -->
        <v-dialog v-model="tracking">
            <v-data-table :headers="paymentHeader" :items="paymentItems" class="elevation-1" loading="true">
               <template v-slot:item.balance="{ item }" > 
                <v-chip :color="getColor(item.payment_percent)" > {{ item.balance }}</v-chip> 
              </template>
            </v-data-table>
        </v-dialog>
      <!-- END MODAL FOR PAYMENT TRACKING -->
      </v-toolbar>
             <div>
          <label class=" bg-warning textpads">50% - 74% TOTAL PAYMENTS</label>
          <label class=' bg-danger textpads'>75%-99% TOTAL PAYMENTS</label>
          <label class='bg-success textpads'>100% TOTAL PAYMENTS</label>
        </div>
        <!-- Customer Display -->
        <!-- <div class="row ">
            <div class="col-6 col-md-4 c-main">
                <label>{{customerDetails.name}}</label>
            </div>
            <div class="col text-right">
            Date of Order:
            </div>
        </div>
        <div class="row ">
            <div class="col-6 col-md-4 c-sub">
                <label>{{customerDetails.contact}}</label>
            </div>
            <div class="col text-right">
            Date of Order:
            </div>
        </div>
        <div class="row ">
            <div class="col-6 col-md-4 c-sub">
                <label>{{customerDetails.address}}</label>
            </div>
            <div class="col text-right">
            Date of Order:
            </div>
        </div> -->
        <!-- END Customer Display -->
      <v-data-table :headers="headers" :items="dataItems" :search="search" class="elevation-1" >
        <template v-slot:item.payment_percent="{ item }" > 
          <v-chip :color="getColor(item.payment_percent)" > {{ item.payment_percent }}</v-chip> 
        </template>
        <template v-slot:item.payment_tracking="{ item }">
          <v-icon small class="mr-2" @click="trackingPayment(item)" > View</v-icon>
        </template>
      </v-data-table>
  </div>
</template>

<script>
  export default {
    data: () => ({
      tracking:false,
      search: '',
      headers: [
        { text: 'Ordered Product', value: 'ordered_product',},
        { text: 'Payment Date', value: 'payment_date', },
        { text: 'Due Date', value: 'due_date', },
        { text: 'Total Price', value: 'total_price', },
        { text: 'Balance', value: 'balance', },
        { text: 'Payment Percent', value: 'payment_percent', },
        { text: 'Payment history', value: 'payment_tracking', sortable: false },
      ],
      paymentHeader:[
        { text: 'Date of Payment', value: 'date_of_payment',  },
        { text: 'Ordered Product', value: 'ordered_product',  },
        { text: 'Product Price', value: 'product_price',  },
        { text: 'Partial Payment', value: 'partial_payment',  },
        { text: 'Balance', value: 'balance',  },
        { text: 'Remittance Details', value: 'remittance_details', },
        { text: 'Proof of Payment', value: 'upload_pic', },
        { text: 'Remarks', value: 'remarks', },
      ],
      dataItems:[],
      paymentItems:[],
      customerDetails:{
        name:'',
        contact:'',
        address:'',
        user_id:'',
      },
    }),
    
    watch: {
       tracking (val) {
        val || this.close()
        
      },
    },

    async mounted(){
        axios.get('/usertracking')
        .then((response)=>{
              this.customerDetails.name=response.data.first_name +' '+response.data.last_name
              this.customerDetails.contact= response.data.mobileno
              this.customerDetails.address= response.data.address
              this.customerDetails.user_id= response.data.id
                axios.get('/api/customertracking/'+this.customerDetails.user_id)
                .then((response)=>{
                    this.dataItems = response.data
                })
        })
      
    },
//methods

    methods: {
      trackingPayment(item){
         this.tracking = true
          axios.get('/api/trackingpaymentinit/'+item.id)
          .then((response)=>{
              this.paymentItems = response.data
          })
      },
      close () {
        this.tracking = false
        this.paymentItems=[]
      },
       getColor (a) {
          const Percent = parseInt(a)
        if (Percent >= 50 && Percent <= 74 ) return '#ffed4a'
        // else if  (Percent >= 51 && Percent <= 74) return '#6cb2eb'
        else if (Percent >= 75 && Percent <= 99) return 'red'
        else if (Percent == 100) return 'green'
        else return 'none'
      },
       
    },
    
  }
</script>