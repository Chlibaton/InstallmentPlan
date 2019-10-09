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
.prod_name{
  font-size:25px;
  position: relative;
  top: 5px;
    color:#ccc5c5;
}
.due_date{
   font-size:25px;
  position: relative;
    top: 5px;
    color:#ccc5c5;
}



</style>


<template>
<div>
      <v-toolbar flat color="white">
        <v-toolbar-title>My Order</v-toolbar-title>
        <v-divider class="mx-4" inset vertical></v-divider>
        <label class='prod_name'>{{ProductName}}</label>
         <div class="flex-grow-1"></div>
         <label class='due_date'> {{DueDate}}</label>
        <!-- <v-text-field v-model="search" append-icon="search" label="Search" single-line hide-details></v-text-field> -->
            <!-- MODAL FOR TRACKING DETAILS -->
            <v-dialog v-model="trackingAdd" > 
              <template v-slot:activator="{ on }">
              <!-- <v-btn color="primary" class="mb-2" v-on="on">Add Partial Payment</v-btn> -->
              </template>
              <v-form ref="form" lazy-validation  @submit.prevent class="bg-light"> 
                   <v-card-title>
                    <span class="headline">Partial Payment</span>
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
                            <v-text-field v-model="down_payment" @keyup='getbalance' label="Partial Payment In Pesos" placeholder="Enter the amount in pesos" v-mask="mask" outlined></v-text-field>
                         </v-flex>
                          <v-flex xs6>
                            <v-text-field v-model="item_balance" label="Balance" filled readonly></v-text-field>
                         </v-flex>
                           <v-flex xs12>
                            <v-text-field v-model="moneyRemUsed" label="Money Remittance Used (Western Union, Palawan, Cebuana, M lhuillier, LBC, 7-11, Bayad Center, Any Bank Etc..)" placeholder="Enter the money Remittance that you used here" outlined></v-text-field>
                         </v-flex>
                           <v-flex xs12>
                            <v-text-field v-model="editedPaymentItems.remittance_details" label="Remittance Number" placeholder="Enter the remittance/reference number here" outlined></v-text-field>
                         </v-flex>
                        <!-- <v-flex xs12>
                          <v-text-field v-model="editedPaymentItems.upload_pic" label="Proof of Payment"></v-text-field>
                        </v-flex> -->
                        <v-flex xs12>
                            <v-label>Upload Payment Receipt</v-label>
                            <input type="file" @change="uploadImage" accept="image/*">
                        </v-flex>
                        <!-- <v-flex xs12>
                          <v-text-field v-model="editedPaymentItems.remarks" label="Remarks"></v-text-field>
                         </v-flex> -->
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
      <!-- END MODAL FOR PAYMENT TRACKING -->
      </v-toolbar>
      <v-data-table :headers="paymentHeader" :items="paymentItems" :search="search" class="elevation-1" >
          <template v-slot:top>
          <div class="radiOPTS">
            <label class='bg-warning textpads'><b>*NOTE</b> PLEASE WAIT 1-2 DAYS FOR THE VALIDATION OF YOUR PAYMENT UPDATES.</label>
          </div>
        </template>
          <template v-slot:item.dateOrdered="{ item }" > 
            <label class="mr-2 v_img"> {{dateOrdered}} </label>
        </template>
        <template v-slot:item.upload_pic="{ item }" > 
            <v-chip  class="mr-2 v_img" @click="preview_receipt(item)" >  View Receipt </v-chip>
        </template>
              
        <template v-slot:item.approve_pay="{ item }">
          <v-chip v-if="item.approve_pay==0" dark color="red">Pending for Approval</v-chip>
          <v-chip v-else dark color="green">Approved</v-chip>
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
        { text: 'Date Ordered', value: 'payment_date', },
        { text: 'Product/Item', value: 'ordered_product',  },
        { text: 'Total Contract Price', value: 'total_price', },
        { text: 'Balance', value: 'balance', },
        { text: 'Due Date', value: 'due_date', },
        { text: 'Payment Percent', value: 'payment_percent', },
        { text: 'Payment history', value: 'payment_tracking', sortable: false },
      ],
      paymentHeader:[
         {text: 'Date Ordered', value: 'dateOrdered', },
        { text: 'Product/Item', value: 'ordered_product',  },
        { text: 'Total Contract Price', value: 'product_price',  },
        { text: 'Payment Date', value: 'date_of_payment',  },
        { text: 'Partial Payment/s', value: 'partial_payment',  },
        { text: 'Balance', value: 'balance',  },
        { text: 'Remittance Number', value: 'remittance_details', },
        { text: 'Proof of Payment', value: 'upload_pic', },
        { text: 'Payment Status', value: 'approve_pay', },
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
      customerDetails:{
        name:'',
        contact:'',
        address:'',
        user_id:'',
      },
      dateOrdered:'',
      ProductName:'',
      DueDate:'',
      moneyRemUsed:'',
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
        axios.get('/usertracking')
        .then((response)=>{
              this.customerDetails.name=response.data.first_name +' '+response.data.last_name
              this.customerDetails.contact= response.data.mobileno
              this.customerDetails.address= response.data.address
              this.customerDetails.user_id= response.data.id
                axios.get('/api/customertracking/'+this.customerDetails.user_id)
                .then((response)=>{
                  this.editedPaymentItems.tracking_id =  response.data[0]['id']
                  this.editedPaymentItems.ordered_product =  response.data[0]['ordered_product']
                  this.editedPaymentItems.balance =  response.data[0]['pre_balance']
                  this.editedPaymentItems.product_price =  response.data[0]['total_price']
                  this.item_balance = this.editedPaymentItems.balance
                  this.dateOrdered = this.formatDate(response.data[0]['payment_date'])
                  this.ProductName = 'Kind of Order: '+response.data[0]['ordered_product']
                  this.DueDate = 'Three(3) Months Due Date: '+this.formatDate(response.data[0]['due_date'])
                    this.dataItems = response.data
                      axios.get('/api/trackingpaymentinit/'+this.editedPaymentItems.tracking_id)
                      .then((res)=>{
                          this.paymentItems = res.data
                      })
                })

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
        if(item.upload_pic == null){
          this.dataImage = '/img/no-image.jpg'
        }else{
          this.dataImage = '/img/pay_rcpt/'+item.upload_pic
        }
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
             this.editedPaymentItems.remarks = 'none'
              this.editedPaymentItems.remittance_details += '-'+this.moneyRemUsed
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
                                  axios.get('/api/customertracking/'+this.customerDetails.user_id)
                                    .then((response)=>{
                                        this.dataItems = response.data
                                    })
                              })
                        })
                    this.down_payment=''
                  }
              
              this.close(2)
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
      formatDate(genDate) {
          var monthNames = [
            "January", "February", "March",
            "April", "May", "June", "July",
            "August", "September", "October",
            "November", "December"
          ];
          var date = new Date(genDate);
          var day = date.getDate();
          var monthIndex = date.getMonth();
          var year = date.getFullYear();

          return monthNames[monthIndex]+ ' ' + day + ', ' + year;
        }
    },
   
   
    
  }
</script>