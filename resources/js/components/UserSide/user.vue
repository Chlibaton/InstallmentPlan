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

.v_img{
  cursor: pointer !important;
}
.preview_image {
     background: white !important;
}
.image-preview {
    width: 100%;
    max-width: 600px;
    margin: auto;
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
           <!-- MODAL FOR TRACKING DETAILS -->
            <v-dialog v-model="trackingAdd" > 
              <template v-slot:activator="{ on }">
              <v-btn color="primary" class="mb-2" v-on="on">Update Tracking</v-btn>
              </template>
              <v-form ref="form" lazy-validation  @submit.prevent class="bg-light"> 
                   <v-card-title>
                    <span class="headline">Update Payment</span>
                  </v-card-title>
                  <v-card-text>
                    <v-container grid-list-md>
                      <v-layout wrap>
                         <v-flex xs12>
                             <v-menu v-model="menu3" :close-on-content-click="false" full-width max-width="290" offset-y >
                              <template v-slot:activator="{ on }">
                                <v-text-field clearable readonly label="Date of Payment" v-on="on"  :value="date3"></v-text-field>
                              </template>
                              <v-date-picker v-model="date3">
                              </v-date-picker>
                            </v-menu>
                         </v-flex>
                          <v-flex xs12>
                            <v-text-field v-model="editedPaymentItems.ordered_product" filled label="Ordered Product" readonly></v-text-field>
                         </v-flex>
                           <v-flex xs12>
                            <v-text-field v-model="editedPaymentItems.product_price" label="Product Price" filled readonly></v-text-field>
                         </v-flex>
                          <v-flex xs6 >
                            <v-text-field v-model="down_payment" @keyup='getbalance' label="Partial Payment" v-mask="mask"></v-text-field>
                         </v-flex>
                          <v-flex xs6>
                            <v-text-field v-model="item_balance" label="Balance" filled readonly></v-text-field>
                         </v-flex>
                           <v-flex xs12>
                            <v-text-field v-model="editedPaymentItems.remittance_details" label="Remittance Details"></v-text-field>
                         </v-flex>
                        <!-- <v-flex xs12>
                          <v-text-field v-model="editedPaymentItems.upload_pic" label="Proof of Payment"></v-text-field>
                        </v-flex> -->
                        <v-flex xs12>
                            <v-label>Upload Photo</v-label>
                            <input type="file" @change="uploadImage" accept="image/*">
                        </v-flex>
                        <v-flex xs12>
                          <v-text-field v-model="editedPaymentItems.remarks" label="Remarks"></v-text-field>
                         </v-flex>
                      </v-layout>
                    </v-container>
                  </v-card-text>
                  <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="close(2)">Cancel</v-btn>
                    <v-btn color="blue darken-1" text @click="save(2)">Save</v-btn>
                  </v-card-actions>
              </v-form>
            </v-dialog>
          <!-- MODAL VIEW RECEIPT -->
           <v-dialog v-model="preview_image" class="preview_image">
                    <div class="container" align="center" justify="center">
                        <div class="row" >
                          <div class="col-sm">
                          </div>
                          <div class="col-sm image-preview" >
                            <v-img
                              :src="dataImage"
                              class="grey lighten-2" ></v-img>
                          </div>
                          <div class="col-sm">
                          </div>
                        </div>
                        
                  <v-spacer></v-spacer>
                  <input type="file" ref="file" style="display:none" @change="updateImage" accept="image/*"  />
                  <v-btn v-if="payment_status==0" color="blue darken-1" text @click="$refs.file.click()" >Change Image</v-btn>
                  <v-btn color="white darken-1" text @click="close(2)" >Close</v-btn>
                    </div>

            </v-dialog>
           <!-- END MODAL VIEW RECEIPT -->
            <v-data-table :headers="paymentHeader" :items="paymentItems" class="elevation-1" loading="true">
               <template v-slot:item.balance="{ item }" > 
                <v-chip :color="getColor(item.payment_percent)" > {{ item.balance }}</v-chip> 
              </template>
               <template v-slot:item.upload_pic="{ item }" > 
                 <div v-if="item.approve_pay==0">
                  <input v-if="item.upload_pic==null"  @change="updateImage(item)" type="file" ref="file" style="display:none" accept="image/*"/>
                  <v-icon v-if="item.upload_pic==null"  @click="editedItems.id=item.id,$refs.file.click()" dark color="blue">add_a_photo</v-icon>
                  <label v-else small class="mr-2 v_img" @click="preview_receipt(item)" >  View Receipt </label>
                 </div>
                 <label v-else small class="mr-2 v_img" @click="preview_receipt(item)" >  View Receipt </label>
              </template>
                   <template v-slot:item.approve_pay="{ item }">
                  <v-icon v-if="item.approve_pay==0" dark color="red">block</v-icon>
                  <v-icon v-else color="green" class="mr-2">check_circle</v-icon>
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
        
      <v-data-table :headers="headers" :items="dataItems" :search="search" class="elevation-1" >
        <template v-slot:item.payment_percent="{ item }" > 
          <v-chip :color="getColor(item.payment_percent)" > {{ item.payment_percent }}</v-chip> 
        </template>
        <template v-slot:item.payment_tracking="{ item }">
          <v-chip small class="mr-2" @click="trackingPayment(item)" > View</v-chip>
        </template>
     
      </v-data-table>
  </div>
</template>

<script>
import { setTimeout } from 'timers';
  export default {
    data: () => ({
      tracking:false,
      preview_image:false,
      trackingAdd:false,
      dataImage:'',
      payment_status:'',
      menu3:false,
      search: '',
      mask: '################',
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
        { text: 'Approval Status', value: 'approve_pay', },
      ],
      dataItems:[],
      paymentItems:[],
      customerDetails:{
        name:'',
        contact:'',
        address:'',
        user_id:'',
      },
      editedItems:{
        id:'',
        upload_pic:''
      },
      editedPaymentItems:{},
      date3:new Date().toISOString().substr(0, 10),
    }),
    
    watch: {
       tracking (val) {
        val || this.close()
        
      },
        trackingAdd (val) {
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
       preview_receipt(item){
        this.preview_image = true
        this.payment_status=item.approve_pay
        this.editedItems.id =item.id
        if(item.upload_pic == null){
          this.dataImage = '/img/no-image.jpg'
        }else{
          this.dataImage = '/img/pay_rcpt/'+item.upload_pic
        }
      },
      close (a) {
        if(a==2){
        this.preview_image = false
         this.trackingAdd = false
        }else{
        this.tracking = false
        this.paymentItems=[]
        }
      
      },
       getColor (a) {
          const Percent = parseInt(a)
        if (Percent >= 50 && Percent <= 74 ) return '#ffed4a'
        // else if  (Percent >= 51 && Percent <= 74) return '#6cb2eb'
        else if (Percent >= 75 && Percent <= 99) return 'red'
        else if (Percent == 100) return 'green'
        else return 'none'
      },
      updateImage(item){
        console.log('image will be updated')
            var input = event.target;
            if (input.files && input.files[0]) {
                  var reader = new FileReader();
                  reader.onload = (e) => {
                  this.editedItems.upload_pic = e.target.result;
                    axios.put('/api/u_u_receipt',this.editedItems)
                    .then((res)=>{
                      if(this.preview_image){
                        this.dataImage = '/img/pay_rcpt/'+res.data
                      }else{
                           axios.get('/api/trackingpaymentinit/'+item.tracking_id)
                          .then((response)=>{
                              this.paymentItems = response.data
                          })
                      }
                    
                    })
                      .catch(function (error) {
                          console.log(error);
                      })
                }
                reader.readAsDataURL(input.files[0]);
          }
      }
       
    },
    
  }
</script>