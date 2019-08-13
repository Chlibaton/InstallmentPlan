.<style lang="scss" scoped>
.card-title{
      background-color: #fb8f0a;
}

</style>

<template>
    <div>
     <v-stepper v-model="e1">
    <v-stepper-header class="card-title">
      <v-stepper-step :complete="e1 > 1" step="1">Confirm Password</v-stepper-step>
      <v-divider></v-divider>
      <v-stepper-step :complete="e1 > 2" step="2">Set New Password</v-stepper-step>
      <v-divider></v-divider>
      <v-stepper-step step="3">Complete</v-stepper-step>
    </v-stepper-header>

    <v-stepper-items>

      <v-stepper-content step="1">
         <v-card flat height="100px" class="mb-12">
            <v-text-field v-model="login.current_password" prepend-icon="lock" name="Password" label="Enter Current Password" type="password"></v-text-field>
          </v-card>
        <v-btn color="primary" @click="verifylogin"> Verify</v-btn>
      </v-stepper-content>

      <v-stepper-content step="2">
         <v-card flat height="100px" class="mb-12">
            <v-text-field prepend-icon="lock" v-model="editedPassword.newpass" name="Password" label="New Password" type="password"></v-text-field>
            <v-text-field prepend-icon="lock" v-model="editedPassword.confirm_password" name="Password" label="Confirm New Password" type="password"></v-text-field>
          </v-card>
        <v-btn color="primary" @click="changepassword" >Change Password</v-btn>
      </v-stepper-content>

      <v-stepper-content step="3">
         <v-card flat height="100px" class="mb-12">

          </v-card>
        <v-btn color="primary" @click="completeChangePassword" >Reload</v-btn>

        <v-btn text>Cancel</v-btn>
      </v-stepper-content>

    </v-stepper-items>
  </v-stepper>
    
</div>
</template>

<script>
export default {
  data () {
      return {
        login:{
          current_password:'',
        },
        editedPassword:{
          newpass:'',
          confirm_password:''
        },  
        e1: 0,
      }
    },
  methods:{
    verifylogin(){
      axios.post('/changepass/1',this.login)
      .then((res)=>{
          if(res.data == 'Confirmed'){
            this.e1 = 2
          }
      })
    },
    changepassword(){
      if(this.editedPassword.newpass === this.editedPassword.confirm_password){
        axios.post('/changepass/2',this.editedPassword)
          .then((res)=>{
            if(res.data == 'Change Password Confirmed'){
              this.e1 = 3
            }
        })
      }else{
        console.log('password do not match')
      }
    },
    completeChangePassword(){
      location.href='/changepassword'
    }

  },
 
}
</script>

