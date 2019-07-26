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
<v-card>
      <v-toolbar flat color="white">
        <v-toolbar-title>Tracking</v-toolbar-title>
        <v-divider class="mx-4" inset vertical></v-divider>
        <v-text-field v-model="search" append-icon="search" label="Search" single-line hide-details></v-text-field>
      <v-spacer></v-spacer>
        <v-dialog v-model="dialog" max-width="500px">
          <template v-slot:activator="{ on }">
            <v-btn color="primary" dark class="mb-2" v-on="on">Add Track</v-btn>
          </template>
          <v-form ref="form" v-model="valid" lazy-validation  @submit.prevent>
          <v-card>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container grid-list-md>
                <v-layout wrap>
                  <v-flex xs12 sm6 md4>
                    <v-text-field v-model="editedItem.customer_details" label="Name/Contact/Address/Email" :rules="ruleRequired"></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field v-model="editedItem.payment_date" label="Payment Date" ></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field v-model="editedItem.due_date" label="Due Date"></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field v-model="editedItem.total_price" label="Total Price"></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field v-model="editedItem.balance" label="Balance" ></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field v-model="editedItem.payment_percent"  label="Payment Percent" ></v-text-field>
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
          <label class=" bg-warning textpads">40%-%50% TOTAL PAYMENTS</label>
          <label class=' bg-danger textpads'>65%-75% TOTAL PAYMENTS</label>
          <label class='bg-success textpads'>100% TOTAL PAYMENTS</label>
        </template>
          <template v-slot:item.payment_percent="{ item }" > 
            <v-chip :color="getColor(item.payment_percent)" > {{ item.payment_percent }}</v-chip> 
          </template>

        <!-- <template v-slot:item="{ item }" :color="getColor(item.payment_percent)">
          <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>

          </tr>
        </template> -->

      <template v-slot:item.action="{ item }">
          <v-icon small class="mr-2" @click="editItem(item)"> edit </v-icon>
          <v-icon small @click="deleteItem(item)"> delete </v-icon>
        </template>
  </v-data-table>
  </v-card>
</template>

<script>
  export default {
    data: () => ({
      dialog: false,
      valid:false,
      search: '',
      show1:false,
      headers: [
        { text: 'Name/Contact/Address/Email', value: 'customer_details',  },
        { text: 'Payment Date', value: 'payment_date', },
        { text: 'Due Date', value: 'due_date', },
        { text: 'Total Price', value: 'total_price', },
        { text: 'Balance', value: 'balance', },
        { text: 'Payment Percent', value: 'payment_percent', },
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
      editedIndex: -1,
      editedItem: {
      },
      defaultItem: {},
      toBeUpdated:{},
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
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
            // console.log(this.dataItems)
        })
    },
    
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
              if (this.editedIndex > -1) {
                  this.toBeUpdated = this.dataItems[this.editedIndex]
                 axios.put('/api/trackingupdate',this.editedItem)
                 .then((res)=>this.editedItem = Object.assign(this.toBeUpdated, res.data))
                   .catch(function (error) {
                        console.log(error);
                    })

                    //  Object.assign(this.dataItems[this.editedIndex], this.editedItem)

                } else {
                    this.addedItems = this.editedItem
                    axios.post('/api/trackingcreate',this.editedItem)
                    .then(()=> this.dataItems.push(this.addedItems))
                }
                this.close()
        }
      },
       getColor (Percent) {
           console.log(Percent)
        if (Percent >= '40%' && Percent <= '59%' ) return '#ffed4a'
        else if (Percent >= '60%' && Percent <= '99%') return 'red'
        else if (Percent == '100%') return 'green'
        // else return 'green'
      },
          
      
    },
  }
</script>