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
        <v-toolbar-title>History Logs</v-toolbar-title>
        <v-divider class="mx-4" inset vertical></v-divider>
        <v-text-field v-model="search" append-icon="search" label="Search" single-line hide-details></v-text-field>
        
        <v-spacer></v-spacer>
        </v-toolbar>

        <v-data-table :headers="headers" :items="dataItems" :search="search" class="elevation-1" >
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
      menu1:false,
      menu2:false,
      headers: [
        { text: 'Customer Name', value: 'name',  },
        { text: 'Login At', value: 'last_login_at',  },
        { text: 'Logout At', value: 'last_logout_at',  },
        
        // { text: 'Actions', value: 'action', sortable: false },
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
        return this.editedIndex === -1 ? 'Add Tracking' : 'Edit Tracking'
      },
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
    },

    async mounted(){
        axios.get('/api/historyinit')
        .then((response)=>{
            this.dataItems = response.data
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
        
    },
    
  }
</script>