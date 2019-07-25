<style scoped>
.theme--light.v-data-table {
    background-color: #fff;
    color: rgba(0,0,0,.87);
    margin: 10px;
}
</style>


<template>
<v-card>
  <v-data-table :headers="headers" :items="dataItems"  class="elevation-1">

      <v-toolbar flat color="white">
        <v-toolbar-title>System Users</v-toolbar-title>
        <v-divider class="mx-4" inset vertical></v-divider>
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog" max-width="500px">
          <template v-slot:activator="{ on }">
            <v-btn color="primary" dark class="mb-2" v-on="on">New Item</v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container grid-list-md>
                <v-layout wrap>
                  <v-flex xs12 sm6 md4>
                    <v-text-field v-model="editedItem.name" label="Dessert name"></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field v-model="editedItem.calories" label="Calories"></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field v-model="editedItem.fat" label="Fat (g)"></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field v-model="editedItem.carbs" label="Carbs (g)"></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field v-model="editedItem.protein" label="Protein (g)"></v-text-field>
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
        </v-dialog>
      </v-toolbar>
      <v-data-table :headers="headers" :items="dataItems"  class="elevation-1">
    <template v-slot:items="props">

        <td>{{props.item.first_name}}</td>
        <td>{{props.item.last_name}}</td>
        <td>{{props.item.address}}</td>
        <td>{{props.item.mobileno}}</td>
        <td>{{props.item.email}}</td>
        <td>{{props.item.password}}</td>
        <td>
            <v-icon small class="mr-2" @click="editItem(item)">
                 edit
            </v-icon>
            <v-icon small @click="deleteItem(item)">
                delete
            </v-icon>
        </td>
      
    </template>
</v-data-table>
  </v-data-table>
  </v-card>
</template>

<script>
  export default {
    data: () => ({
      dialog: false,
      headers: [
        { text: 'First Name', value: 'first_name', },
        { text: 'Last Name', value: 'last_name', },
        { text: 'Address', value: 'address', },
        { text: 'Mobile No.', value: 'mobileno', },
        { text: 'Email', value: 'email', },
        { text: 'Password', value: 'password', },
        { text: 'Actions', value: 'action', sortable: false },
      ],
      dataItems:[],
      editedIndex: -1,
      editedItem: {
        first_name: '',
        last_name: '',
        address: '',
        mobileno: '',
        email: '',
        password:''
      },
      defaultItem: {
        first_name: '',
        last_name: '',
        address: '',
        mobileno: '',
        email: '',
        password:''
      },
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

    created () {
      this.initialize()
    },

    mounted(){
        axios.get('/api/user')
        .then((response)=>{
            this.dataItems = respons.data
        })
    },

    methods: {
      initialize () {
      },

      editItem (item) {
        this.editedIndex = this.desserts.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        const index = this.desserts.indexOf(item)
        confirm('Are you sure you want to delete this item?') && this.desserts.splice(index, 1)
      },

      close () {
        this.dialog = false
        setTimeout(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        }, 300)
      },

      save () {
        if (this.editedIndex > -1) {
          Object.assign(this.desserts[this.editedIndex], this.editedItem)
        } else {
          this.desserts.push(this.editedItem)
        }
        this.close()
      },
    },
  }
</script>