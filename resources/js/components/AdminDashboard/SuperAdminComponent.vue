<style scoped>
[v-cloak] { display: none; }
.v-card{
  box-shadow: 
    0 3px 1px -2px rgba(0, 0, 0, 0),
    0 2px 2px 0 rgba(0, 0, 0, 0),
    0 1px 5px 0 rgba(0, 0, 0, 0) !important;
  cursor: pointer;
}
</style>

<template >
    <div>
         <v-toolbar-title></v-toolbar-title>
        <div class='container' v-if="role==0" v-cloak>
            <div class="row">
              <div class="col-sm" >
                <v-card max-width="344" class="dash-card">
                  <v-img class="white--text" height="200px" src="img/tracking.png">
                  </v-img>
                </v-card>
              </div>
              <div class="col-sm">
                <v-card max-width="344" class="dash-card">
                  <v-img class="white--text" height="200px" src="img/changepass.png">
                  </v-img>
                </v-card>
              </div>
               <div class="col-sm">
               </div>
            </div>
        </div>
        <div class="container" v-if="role==1" v-cloak>
          <div class="row" >
            <div class="col-sm" @click="gotopage(1)">
                <v-card max-width="344" class="dash-card">
              <v-img class="white--text" height="200px" src="/img/systemuser.png">
            </v-img>
            </v-card>
            </div>

            <div class="col-sm" @click="gotopage(2)">
              <v-card max-width="344" class="dash-card">
                <v-img class="white--text" height="200px" src="/img/collectionreport.png">
              </v-img>
              </v-card>
            </div>
            
            <div class="col-sm" @click="gotopage(3)">
            <v-card max-width="344" class="dash-card">
              <v-img class="white--text" height="200px" src="/img/tracking.png">
            </v-img>
            </v-card>
            </div>
          </div>

            <div class="row">
            <div class="col-sm" @click="gotopage(4)">
                <v-card max-width="344" class="dash-card">
              <v-img class="white--text" height="200px" src="/img/emailtemplate.png">
            </v-img>
            </v-card>
            </div>
            <div class="col-sm" @click="gotopage(5)">
              <v-card max-width="344" class="dash-card">
              <v-img class="white--text" height="200px" src="/img/historylogs.png">
            </v-img>
              </v-card>
            </div>
            <div class="col-sm">
            </div>
          </div>
            
        </div>
    </div>
</template>

<<script>
export default {
    data(){
        return {
            role:'',
        }
    },
     async mounted(){
        axios.get('/userrole')
        .then((response)=>{
              this.role = response.data.role
              console.log(response.data.role)
        })
     },
     methods: {
       gotopage(e){
          switch (e) {
            case 1:
              location.href= '/systemuser'
              break;
            case 2:
               location.href= '/collectionreport'
              break;
            case 3:
               location.href= '/tracking'
              break;
            case 4:
               location.href= '/emailtemplate'
              break;
            case 5:
               location.href= '/historylog'
              break;
            case 6:
              location.href= '/mytracking'
              break;
            case 7:
              location.href= '/changepass'
              break;
          }
       }
     },
   
}
</script>