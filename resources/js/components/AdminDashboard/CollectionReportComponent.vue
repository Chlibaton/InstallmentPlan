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
.foot-balance {
    text-align: right;
    max-width: 60%;
    margin: auto;
}
._balance{
  font-size: 25px;
}
.radiOPTS{
  padding-left:15px;
  padding-top:15px;
}

</style>


<template>
<v-card>
      <v-toolbar flat color="white">
        <v-toolbar-title>Collections Reports</v-toolbar-title>
        <v-divider class="mx-4" inset vertical></v-divider>
        <v-text-field v-model="search" append-icon="search" label="Search" single-line hide-details></v-text-field>
      <v-spacer></v-spacer>
      </v-toolbar>
      <v-data-table :headers="headers" :items="dataItems" :search="search" class="elevation-1" >
            <template v-slot:top>
          <div class="radiOPTS">
            <input type="radio" name="optradio" v-on:click="displayData(50)" checked><label class=" bg-warning textpads">50%-74% TOTAL PAYMENTS</label>
            <input type="radio" name="optradio" v-on:click="displayData(70)"><label class=' bg-danger textpads'>75%-99% TOTAL PAYMENTS</label>
            <input type="radio" name="optradio" v-on:click="displayData(100)"> <label class='bg-success textpads'>100% TOTAL PAYMENTS</label>
          </div>
        </template>
          <template v-slot:item.payment_percent="{ item }" > 
            <v-chip :color="getColor(item.payment_percent)" > {{ item.payment_percent }}</v-chip> 
          </template>
  </v-data-table>
  <div class="foot-balance">
    <span class="_balance"> Balance:<b> {{balance}} </b></span>
  </div>
  </v-card>
</template>

<script>
  export default {
    data: () => ({
      dialog: false,
      valid:false,
      checkboxesData:{
        box50:[],
        box70:[],
        box100:[]
      },
      checkboxesBalance:{
        box50:0,
        box70:0,
        box100:0
      },
      balance:'',
      search: '',
      show1:false,
      menu1:false,
      menu2:false,
      headers: [
        { text: 'Name', value: 'name',  },
        { text: 'Contact', value: 'contact',  },
        { text: 'Address', value: 'address',  },
        { text: 'Email', value: 'email',  },
        { text: 'Payment Date', value: 'payment_date', },
        { text: 'Due Date', value: 'due_date', },
        { text: 'Total Price', value: 'total_price', },
        { text: 'Balance', value: 'balance', },
        { text: 'Payment Percent', value: 'payment_percent', },
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
      mask: '################',
      date1:new Date().toISOString().substr(0, 10),
      date2:new Date().toISOString().substr(0, 10),
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
          if(response.data.length > 0){
                for(var a = 0; a<response.data.length; a++){
                var b = response.data[a]['payment_percent'].split('%')[0]
                if(b >= 50 && b <= 74){
                  this.checkboxesData.box50.push(response.data[a])
                  this.checkboxesBalance.box50+=parseInt(response.data[a]['balance'])
                }else if(b >= 75 && b <= 99){
                  this.checkboxesData.box70.push(response.data[a])
                  this.checkboxesBalance.box70+=parseInt(response.data[a]['balance'])
                }else if(b == 100){
                  this.checkboxesData.box100.push(response.data[a])
                   this.checkboxesBalance.box100+=parseInt(response.data[a]['balance'])
                }
              }
              this.balance =  this.checkboxesBalance.box50
              this.dataItems =  this.checkboxesData.box50
          }else{
            this.dataItems = response.data
          }
          

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

      displayData(a){
        //radio button when clicked. shows only data needed
        switch(a){
          case 50:
              this.dataItems = this.checkboxesData.box50
              this.balance =  this.checkboxesBalance.box50
            break;
          case 70:
              this.dataItems = this.checkboxesData.box70
              this.balance =  this.checkboxesBalance.box70
            break;
          case 100:
              this.dataItems = this.checkboxesData.box100
              this.balance =  this.checkboxesBalance.box100
            break;
        }
      }
        
    },
    
  }
</script>