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
.v_img{
  cursor: pointer !important;
}
.file-upload-form, .image-preview {
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    padding: 20px;
}
img.preview {
    width: 200px;
    background-color: white;
    border: 1px solid #DDD;
    padding: 5px;
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
      <!-- ADD TRACK MODAL -->
        <v-dialog v-model="dialog" max-width="500px">
          <template v-slot:activator="{ on }">
            <v-btn color="primary" dark class="mb-2" v-on="on">Add Tracking</v-btn>
          </template>
          <v-form ref="form" v-model="valid" lazy-validation  @submit.prevent>
          <v-card>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container grid-list-md>
                <v-layout wrap>
                  <v-flex xs12>
                    <v-select v-model="selectedEmail" label="Email" :items="userEmails" @change="displayDetails" item-text="email" item-value="email"></v-select>
                  </v-flex>
                  <v-flex xs12>
                    <v-text-field v-model="editedItem.name" label="Name" filled readonly></v-text-field>
                  </v-flex>
                  <v-flex xs12>
                    <v-text-field v-model="editedItem.contact" label="Contact" filled readonly></v-text-field>
                  </v-flex>
                  <v-flex xs12>
                    <v-text-field v-model="editedItem.address" label="Address" filled readonly></v-text-field>
                  </v-flex>
                   <v-flex xs12>
                    <v-text-field v-model="editedItem.ordered_product" label="Ordered Product" :rules="ruleRequired"></v-text-field>
                  </v-flex>
                  <v-flex xs6>
                    <!-- <v-text-field v-model="editedItem.payment_date" label="Payment Date" ></v-text-field> -->
                            <v-menu v-model="menu1" :close-on-content-click="false" full-width max-width="290" offset-y >
                              <template v-slot:activator="{ on }">
                                <v-text-field clearable readonly label="Payment Date" v-on="on"  :value="date1"></v-text-field>
                              </template>
                              <v-date-picker v-model="date1"  @change="generateDate()">
                              </v-date-picker>
                            </v-menu>
                  </v-flex>
                  <v-flex xs6>
                    <!-- <v-text-field v-model="editedItem.due_date" label="Due Date"></v-text-field> -->
                            <v-menu v-model="menu2"  :close-on-content-click="false" full-width max-width="290" offset-y >
                              <template v-slot:activator="{ on }">
                                <v-text-field clearable filled readonly label="Due Date" v-on="on"  :value="date2"></v-text-field>
                              </template>
                              <v-date-picker v-model="date2" @change="menu2 = false"  readonly>
                              </v-date-picker>
                            </v-menu>
                  </v-flex>
                  <v-flex xs6>
                    <v-text-field v-model="editedItem.total_price" label="Total Price"  v-mask="mask" :rules="ruleRequired"></v-text-field>
                  </v-flex>
                  <!-- <v-flex xs6>
                    <v-text-field v-model="editedItem.balance" label="Balance" v-mask="mask" filled readonly></v-text-field>
                  </v-flex> -->
                </v-layout>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
              <v-btn color="blue darken-1" text @click="save">Save</v-btn>
            </v-card-actions>
          </v-card>
             </v-form>
        </v-dialog>
      <!--END  ADD TRACK MODAL -->

        <!-- MODAL FOR PAYMENT TRACKING -->
        <v-dialog v-model="tracking" light>
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
            <!-- END MODAL FOR TRACKING DETAILS -->
            <v-dialog v-model="preview_image" light>
                  <!-- <div class="image-preview" v-if="imageData.length > 0"> -->
                    <div class="image-preview" align="center" justify="center" >
                    <v-img 
                    :src="dataImage"
                    class="grey lighten-2 preview"
                  ></v-img>
                  <v-btn color="blue darken-1" text @click="close(3)">Close</v-btn>
                </div>
            </v-dialog>
            <v-data-table :headers="paymentHeader" :items="paymentItems" class="elevation-1" loading="true">
               <template v-slot:item.balance="{ item }" > 
                <v-chip :color="getColor(item.payment_percent)" > {{ item.balance }}</v-chip> 
              </template>
               <template v-slot:item.upload_pic="{ item }" > 
                 <label small class="mr-2 v_img" @click="preview_receipt(item)" >  View Receipt </label>
              </template>
              
                <template v-slot:item.approve_pay="{ item }">
                  <v-icon v-if="item.created_at==true" dark color="red">block</v-icon>
                  <label v-if="item.created_at==true" class="text-danger">Previous Payment not Settled</label>
                  <v-icon v-else :color="ApproveColor(item.approve_pay)" class="mr-2" @click="approve_payment(item)" >check_circle</v-icon>
                </template>

                 <template v-slot:item.pay_action="{ item }">
                  <v-icon v-if="item.approve_pay==0" small class="mr-2" @click="editItem(item,2)"> edit </v-icon>
                  <!-- <v-icon v-if="item.approve_pay==0" small> delete </v-icon> -->
                </template>
            </v-data-table>
        </v-dialog>
      <!-- END MODAL FOR PAYMENT TRACKING -->
      </v-toolbar>
      <v-data-table :headers="headers" :items="dataItems" :search="search" class="elevation-1" >
            <template v-slot:top>
          <label class=" bg-warning textpads">50% - 74% TOTAL PAYMENTS</label>
           <!-- <label class=' bg-info textpads'>51%-74% TOTAL PAYMENTS</label> -->
          <label class=' bg-danger textpads'>75%-99% TOTAL PAYMENTS</label>
          <label class='bg-success textpads'>100% TOTAL PAYMENTS</label>
        </template>
          <template v-slot:item.payment_percent="{ item }" > 
            <v-chip :color="getColor(item.payment_percent)" > {{ item.payment_percent }}</v-chip> 
        </template>
        <template v-slot:item.payment_tracking="{ item }">
          <v-icon small class="mr-2" @click="trackingPayment(item)" > View</v-icon>
        </template>
        <template v-slot:item.action="{ item }">
          <v-icon small class="mr-2" @click="editItem(item)" > edit </v-icon>
          <v-icon small  @click="deleteItem(item)" > delete </v-icon>
        </template>
        
  </v-data-table>
  </div>
</template>

<script>
  export default {
    data: () => ({
      dialog: false,
      tracking:false,
      trackingAdd:false,
      preview_image:false,
      valid:false,
      search: '',
      show1:false,
      menu1:false,
      menu2:false,
      menu3:false,
      headers: [
        { text: 'Name', value: 'name',  },
        { text: 'Address', value: 'address',  },
        { text: 'Contact', value: 'contact',  },
        { text: 'Email', value: 'email',  },
        { text: 'Ordered Product', value: 'ordered_product',  },
        { text: 'Payment Date', value: 'payment_date', },
        { text: 'Due Date', value: 'due_date', },
        { text: 'Total Price', value: 'total_price', },
        { text: 'Balance', value: 'balance', },
        { text: 'Payment Percent', value: 'payment_percent', },
        { text: 'Payment history', value: 'payment_tracking', sortable: false },
        { text: 'Actions', value: 'action', sortable: false },
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
        { text: 'Approve Payment', value: 'approve_pay', },
        { text: 'Actions', value: 'pay_action', sortable: false },
      ],
      ruleRequired: [
        v => !!v || 'Field is required',
      ],
      dataItems:[],
      paymentItems:[],
      editedPaymentItems:{},
      down_payment:'',
      item_balance:'',
      addedItems:{},
      userEmails:[],
      editedIndex: -1,
      editedItem: {
      },
      defaultItem: {},
      toBeUpdated:{},
      mask: '################',
      date1:new Date().toISOString().substr(0, 10),
      date2:new Date(new Date().getTime()+(120*24*60*60*1000)).toISOString().substr(0, 10),
      date3:new Date().toISOString().substr(0, 10),
      selectedEmail:'',
      dataImage:'',
    }),
    
    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'Add Tracking' : 'Edit Tracking'
      },
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
       tracking (val) {
        val || this.close(2)
      },
      trackingAdd (val) {
        val || this.close()
      },
    },

    async mounted(){
        axios.get('/api/trackinginit')
        .then((response)=>{
            this.dataItems = response.data
        })
        axios.get('/api/user')
        .then((response)=>{
            this.userEmails = response.data
        })
    },
//methods

    methods: {
      editItem (item,a) {
        if(a==2){
          this.editedIndex = this.paymentItems.indexOf(item)
          if(this.editedIndex == 0){
          this.item_balance = item.product_price
          console.log(this.editedPaymentItems)
          }else{
            this.item_balance = this.paymentItems[this.editedIndex-1].balance
          }
          this.editedPaymentItems = Object.assign({}, item)
          this.trackingAdd = true
        }else{
          this.editedIndex = this.dataItems.indexOf(item)
          this.editedItem = Object.assign({}, item)
          this.dialog = true
        }
       
      },
      deleteItem (item,a) {
        const index = this.dataItems.indexOf(item)
        confirm('Are you sure you want to delete this item?') && axios.delete('/api/trackingdelete/'+item.id).then(()=>this.dataItems.splice(index, 1));
      },
      trackingPayment(item){
        console.log(item)
         this.tracking = true
         this.editedPaymentItems.tracking_id = item.id
         this.editedPaymentItems.ordered_product = item.ordered_product
         this.editedPaymentItems.balance = item.pre_balance
         this.editedPaymentItems.product_price = item.total_price
         //holder of balance
         this.item_balance = this.editedPaymentItems.balance
          axios.get('/api/trackingpaymentinit/'+item.id)
          .then((response)=>{
              this.paymentItems = response.data
          })
      },
      preview_receipt(item){
        this.preview_image = true
        console.log(item)
        this.dataImage = '/img/pay_rcpt/'+item.upload_pic
      },
      getbalance(){
        //auto compute balance 
        // this.item_balance= this.editedPaymentItems.balance - this.editedPaymentItems.partial_payment
        if(this.editedIndex == 0){
          this.item_balance= this.editedPaymentItems.product_price - this.down_payment
        }else if(this.editedIndex > 0){
          this.item_balance= this.paymentItems[this.editedIndex-1].balance - this.down_payment
        }else{
          this.item_balance= this.editedPaymentItems.balance - this.down_payment
        }
      },
      uploadImage(){
             // Reference to the DOM input element
            var input = event.target;
            // Ensure that you have a file before attempting to read it
            if (input.files && input.files[0]) {
                // create a new FileReader to read this image and convert to base64 format
                var reader = new FileReader();
                // Define a callback function to run, when FileReader finishes its job
                reader.onload = (e) => {
                    // Note: arrow function used here, so that "this.imageData" refers to the imageData of Vue component
                    // Read image as base64 and set to imageData

                    // this.imageData = e.target.result;
                    this.editedPaymentItems.upload_pic = e.target.result;

                }
                console.log(this.editedPaymentItems)
                // Start the reader job - read file as a data url (base64 format)
                reader.readAsDataURL(input.files[0]);
            }
      },
      close (a) {
        if(a == 2){
          this.trackingAdd = false
          this.down_payment=''
        }else if(a==3){
           this.preview_image = false
        }else{
          this.dialog = false
          this.selectedEmail=''
        }
        setTimeout(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        }, 300)
      },

    async save (a) {
        if(this.$refs.form.validate()){
          if(a == 2){
            // SAVE TRACKING PAYMENTS
              this.editedPaymentItems.balance = this.item_balance
              this.editedPaymentItems.partial_payment = this.down_payment
              this.editedPaymentItems.date_of_payment = this.date3
              this.editedPaymentItems.payment_percent = Math.floor( (( this.editedPaymentItems.product_price - this.editedPaymentItems.balance ) / this.editedPaymentItems.product_price) * 100)+'%';
                  if (this.editedIndex > -1) {
                      var indx = this.editedIndex+1,
                      newBalance = this.item_balance,
                      costHolder = 0

                        axios.put('/api/trackingpaymentupdate',this.editedPaymentItems)
                      .then((res)=>{
                        console.log(res)})
                        .catch(function (error) {
                            console.log(error);
                        })
                    for(var x = indx; x<this.paymentItems.length; x++){
                          this.editedPaymentItems = this.paymentItems[x]
                          costHolder += parseInt(this.editedPaymentItems.partial_payment)
                          this.editedPaymentItems.balance = parseInt(newBalance) - costHolder

                           axios.put('/api/trackingpaymentupdate',this.editedPaymentItems)
                          .then((res)=>{
                            console.log(res)
                          })
                          .catch(function (error) {
                              console.log(error);
                          })
                      }
                      axios.get('/api/trackingpaymentinit/'+this.editedPaymentItems.tracking_id)
                              .then((response)=>{
                                  this.paymentItems = response.data
                              })
                  }else{
                   
                    //add items
                      this.addedItems = this.editedPaymentItems
                        axios.post('/api/trackingpaymentcreate',this.addedItems)
                        .then((res)=>{
                            axios.get('/api/trackingpaymentinit/'+this.editedPaymentItems.tracking_id)
                              .then((response)=>{
                                  this.paymentItems = response.data
                              })
                            axios.post('/api/updatebalance/1',this.editedPaymentItems)
                              .then(()=>{
                                  axios.get('/api/trackinginit')
                                  .then((response)=>{
                                    console.log(response)
                                      this.dataItems = response.data
                                  })
                              })
                        })
                    this.down_payment=''
                  }
              this.close(2)
          }else{
            // UPDATE/SAVE TRACKING
              this.editedItem.payment_date = this.date1
              this.editedItem.due_date = this.date2
              this.editedItem.balance =this.editedItem.total_price
              this.editedItem.pre_balance =this.editedItem.total_price
              //get percentage
              this.editedItem.payment_percent = Math.floor( (( this.editedItem.total_price - this.editedItem.balance ) / this.editedItem.total_price) * 100)+'%';
              if (this.editedIndex > -1) {
                this.toBeUpdated = this.dataItems[this.editedIndex]
                axios.put('/api/trackingupdate',this.editedItem)
                .then((res)=>this.editedItem = Object.assign(this.toBeUpdated, res.data))
                  .catch(function (error) {
                      console.log(error);
                  })
              } else {
                  console.log(this.editedItem)
                  this.addedItems = this.editedItem
                  axios.post('/api/trackingcreate',this.editedItem)
                    .then(()=>{  
                      axios.get('/api/trackinginit')
                        .then((response)=>{
                            this.dataItems = response.data
                        })
                      // this.dataItems.push(this.addedItems)
                      })
              }
               this.close()
          }
        }
      },

       getColor (a) {
           const Percent = parseInt(a)
        if (Percent >= 50 && Percent <= 74 ) return '#ffed4a'
        // else if  (Percent >= 51 && Percent <= 74) return '#6cb2eb'
        else if (Percent >= 75 && Percent <= 99) return 'red'
        else if (Percent == 100) return 'green'
        else return 'none'
        // else return 'green'
      },
      displayDetails(){
        var selectedId = this.userEmails.findIndex(x => x.email === this.selectedEmail)
        this.editedItem.name = this.userEmails[selectedId].first_name + ' ' + this.userEmails[selectedId].last_name
        this.editedItem.contact = this.userEmails[selectedId].mobileno
        this.editedItem.address = this.userEmails[selectedId].address
        this.editedItem.email = this.userEmails[selectedId].email
         this.editedItem.user_id = this.userEmails[selectedId].id
      },
      generateDate(event){
         this.date2 = new Date(new Date(this.date1).getTime()+(120*24*60*60*1000)).toISOString().substr(0, 10)
      },
      approve_payment(item){
        if(item.approve_pay == 0){
          const checkPrevPayment = (this.paymentItems.findIndex(x => x.id === item.id)) - 1
          var getApprovePay
          if(checkPrevPayment == -1 ){
            //first item in the table
            axios.post('/api/updatebalance/2',item)
            .then(()=>{
                axios.get('/api/trackinginit')
                  .then((response)=>{
                      this.dataItems = response.data
                  })
                  axios.get('/api/trackingpaymentinit/'+item.tracking_id)
                  .then((response)=>{
                      this.paymentItems = response.data
                  })
              })
            .catch(error => {
              console.log(error.message);
            })

          }else{
            //second to last item in the table
            getApprovePay = this.paymentItems[checkPrevPayment].approve_pay
            switch(getApprovePay){
              case '0':
                  console.log('previous payment is not yet settled')
                  item.created_at=true
                  console.log(item)
                  console.log(this.paymentItems)
                  
                break;
              case '1':
                  console.log('proceed for apporval')
                  axios.post('/api/updatebalance/2',item)
                          .then(()=>{
                              axios.get('/api/trackinginit')
                                .then((response)=>{
                                    this.dataItems = response.data
                                })
                                axios.get('/api/trackingpaymentinit/'+item.tracking_id)
                                .then((response)=>{
                                    this.paymentItems = response.data
                                })
                            })
                          .catch(error => {
                            console.log(error.message);
                          })
                break;
            }
          }
         
          
        }
      },
      ApproveColor(a){
        switch(a){
            case '0':
              return 'gray'
            break;
            case '1':
              return 'green'
            break
        }
      },
       
    },
   
   
    
  }
</script>