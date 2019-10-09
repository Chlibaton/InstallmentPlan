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
        <v-toolbar-title>Order History</v-toolbar-title>
        <v-divider class="mx-4" inset vertical></v-divider>
        <div class="flex-grow-1"></div>
        <v-text-field  v-model="search" append-icon="search" label="Search" single-line hide-details></v-text-field>
      </v-toolbar>
      <v-data-table :headers="headers" :items="dataItems" :search="search" class="elevation-1" >
    </v-data-table>
  </div>
</template>

<script>
  export default {
    data: () => ({
      search: '',
      headers: [
        { text: 'Date Ordered', value: 'payment_date', },
        { text: 'Product/Item', value: 'ordered_product',  },
        { text: 'Total Contract Price', value: 'total_price', },
        { text: 'Balance', value: 'balance', },
        { text: 'Due Date', value: 'due_date', },
        { text: 'Payment Percent', value: 'payment_percent', },
      ],
      dataItems:[],
      editedIndex: -1,
      editedItem: {
      },
      customerDetails:{
        name:'',
        contact:'',
        address:'',
        user_id:'',
      },
      defaultItem: {},
      toBeUpdated:{},
    }),
    

    async mounted(){
        axios.get('/usertracking')
        .then((response)=>{
              this.customerDetails.name=response.data.first_name +' '+response.data.last_name
              this.customerDetails.contact= response.data.mobileno
              this.customerDetails.address= response.data.address
              this.customerDetails.user_id= response.data.id
                axios.get('/api/orderHistory/'+this.customerDetails.user_id)
                .then((response)=>{
                    this.dataItems = response.data
                    console.log(dataItems)

                })
        })
    },
    
  }
</script>