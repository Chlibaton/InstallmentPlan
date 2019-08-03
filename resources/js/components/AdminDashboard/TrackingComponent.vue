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

</style>


<template>
<div>
      <v-toolbar flat color="white">
        <v-toolbar-title>Tracking</v-toolbar-title>
        <v-divider class="mx-4" inset vertical></v-divider>
        <v-text-field v-model="search" append-icon="search" label="Search" single-line hide-details></v-text-field>
      <v-spacer></v-spacer>
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
                    <v-text-field v-model="editedItem.name" label="Name" readonly></v-text-field>
                  </v-flex>
                  <v-flex xs12>
                    <v-text-field v-model="editedItem.contact" label="Contact" readonly></v-text-field>
                  </v-flex>
                  <v-flex xs12>
                    <v-text-field v-model="editedItem.address" label="Address" readonly></v-text-field>
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
                              <v-date-picker v-model="date1"  @change="test()">
                              </v-date-picker>
                            </v-menu>
                  </v-flex>
                  <v-flex xs6>
                    <!-- <v-text-field v-model="editedItem.due_date" label="Due Date"></v-text-field> -->
                            <v-menu v-model="menu2"  :close-on-content-click="false" full-width max-width="290" offset-y >
                              <template v-slot:activator="{ on }">
                                <v-text-field clearable readonly label="Due Date" v-on="on"  :value="date2"></v-text-field>
                              </template>
                              <v-date-picker v-model="date2" @change="menu2 = false">
                              </v-date-picker>
                            </v-menu>
                  </v-flex>
                  <v-flex xs6>
                    <v-text-field v-model="editedItem.total_price" label="Total Price" v-mask="mask" :rules="ruleRequired"></v-text-field>
                  </v-flex>
                  <v-flex xs6>
                    <v-text-field v-model="editedItem.balance" label="Balance" v-mask="mask" :rules="ruleRequired"></v-text-field>
                  </v-flex>
                  <v-flex xs12>
                    <v-text-field v-model="editedItem.remittance_details" label="Remittance Details" :rules="ruleRequired" ></v-text-field>
                  </v-flex>
                  <v-flex xs12>
                    <v-text-field v-model="editedItem.payment_proof" label="Proof of Payment" :rules="ruleRequired"></v-text-field>
                  </v-flex>
                  <v-flex xs12>
                    <v-text-field v-model="editedItem.remarks" label="Remarks" :rules="ruleRequired" ></v-text-field>
                  </v-flex>
                 
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
      valid:false,
      search: '',
      show1:false,
      menu1:false,
      menu2:false,
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
        { text: 'Remittance Details', value: 'remittance_details',  },
        { text: 'Proof of Payment', value: 'payment_proof',  },
        { text: 'Remarks', value: 'remarks',  },
        { text: 'Actions', value: 'action', sortable: false },
      ],
      ruleRequired: [
        v => !!v || 'Field is required',
      ],
      emailRules: [
        v => !!v || 'Field is required',
        v => /.+@.+/.test(v) || 'E-mail must be valid'
      ],
      emailExist:'',
      dataItems:[],
      addedItems:[],
      userEmails:[],
      editedIndex: -1,
      editedItem: {
      },
      defaultItem: {},
      toBeUpdated:{},
      mask: '################',
      date1:new Date().toISOString().substr(0, 10),
      // date2:new Date().toISOString().substr(0, 10),
      date2:new Date(new Date().getTime()+(120*24*60*60*1000)).toISOString().substr(0, 10),
      selectedEmail:'',
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
      editItem (item) {
          console.log( this.editedIndex)
        this.editedIndex = this.dataItems.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        const index = this.dataItems.indexOf(item)
        confirm('Are you sure you want to delete this item?') && axios.delete('/api/trackingdelete/'+item.id).then(()=>this.dataItems.splice(index, 1));
      },

      close () {
        this.dialog = false
        setTimeout(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        }, 300)
      },

     async save () {
        if(this.$refs.form.validate()){
           this.editedItem.payment_date = this.date1
           this.editedItem.due_date = this.date2
          //get percentage
            this.editedItem.payment_percent = Math.floor( (( this.editedItem.total_price - this.editedItem.balance ) / this.editedItem.total_price) * 100)+'%';
              if (this.editedIndex > -1) {
                  this.toBeUpdated = this.dataItems[this.editedIndex]
                 axios.put('/api/trackingupdate',this.editedItem)
                 .then((res)=>this.editedItem = Object.assign(this.toBeUpdated, res.data))
                   .catch(function (error) {
                        console.log(error);
                    })

                    //  Object.assign(this.dataItems[this.editedIndex], this.editedItem)

                } else {
                    console.log(this.editedItem)
                    this.addedItems = this.editedItem
                    axios.post('/api/trackingcreate',this.editedItem)
                    .then(()=> this.dataItems.push(this.addedItems))
                }
                this.close()
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
      },
      test(event){
         this.date2 = new Date(new Date(this.date1).getTime()+(120*24*60*60*1000)).toISOString().substr(0, 10)
      }
       
    },
   
    
  }
</script>