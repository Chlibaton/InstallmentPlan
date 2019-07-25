<style scoped>
    .sidebarBackground{
        background: black;
    }
    .navList{
        color: white;
        font-size: 16px !important;
    }
   
    .navContent{
        border-width: 6px 0px 0px 0px;
        border-style: solid;
        border-color: white;
        margin-bottom: 0px !important;
        position: relative;
        top: 24px;
        padding: 12px
    }
    .dashboard-header {
        color: black;
        padding: 5px;
        font-size: 30px;
        position: relative;
        
    }
    .dash-head{
        top: 24px;
        padding: 4px;
        margin-bottom: 15px;
        background: linear-gradient(to left, gray, black)
    }
    .dash-card{
      color:white;
      background:black;
      position: relative;
      left: 20px;
    }

    .bg{
      background-color: white;
    }
    
</style>


<template>
<v-app>
     

    <v-navigation-drawer v-model="drawer" app class='sidebarBackground'>
      <v-list-item class='bg'>
        <v-list-item-content ></v-list-item-content>
      </v-list-item>
      <v-divider></v-divider>
      <v-list dense nav>
        <v-list-item v-for="item in items" :key="item.title" link class='navContent'>
          <v-list-item-content>
            <v-list-item-title class='navList'>{{ item.title }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-content>
      <v-container fluid>
        <v-app-bar>
          <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
        </v-app-bar>
        <router-view></router-view>
      </v-container>
          <div class="dashboard-header dash-head"></div>
          <div class="dashboard-header ">DASHBOARD - SUPER ADMIN</div>
          
          <div class="container">
            <div class="row">
              <div class="col-sm">
                 <v-card max-width="344" class="dash-card">
               <v-img class="white--text" height="200px" src="https://cdn.vuetifyjs.com/images/cards/docks.jpg">
              </v-img>
              <v-card-actions>
              <v-card-title>System Users</v-card-title>
              </v-card-actions>
              </v-card>
              </div>

              <div class="col-sm">
                <v-card max-width="344" class="dash-card">
                 <v-img class="white--text" height="200px" src="https://cdn.vuetifyjs.com/images/cards/docks.jpg">
              </v-img>
                <v-card-actions>
                <v-card-title>Collection Report</v-card-title>
                </v-card-actions>
                
                </v-card>
              </div>
             
              <div class="col-sm">
              <v-card max-width="344" class="dash-card">
               <v-img class="white--text" height="200px" src="https://cdn.vuetifyjs.com/images/cards/docks.jpg">
              </v-img>
              <v-card-actions>
              <v-card-title>Tracking</v-card-title>
              </v-card-actions>
              </v-card>
              </div>
            </div>

              <div class="row">
              <div class="col-sm">
                 <v-card max-width="344" class="dash-card">
               <v-img class="white--text" height="200px" src="https://cdn.vuetifyjs.com/images/cards/docks.jpg">
              </v-img>
              <v-card-actions>
              <v-card-title>Set Email Template</v-card-title>
              </v-card-actions>
              
              </v-card>
              </div>

              <div class="col-sm">
                <v-card max-width="344" class="dash-card">
                <v-img class="white--text" height="200px" src="https://cdn.vuetifyjs.com/images/cards/docks.jpg">
              </v-img>
                <v-card-actions>
                <v-card-title>History Logs</v-card-title>
                </v-card-actions>
                </v-card>
              </div>
             
              <div class="col-sm">
              <v-card max-width="344" class="dash-card">
                <v-img class="white--text" height="200px" src="https://cdn.vuetifyjs.com/images/cards/docks.jpg">
              </v-img>
              <v-card-actions>
              <v-card-title>Change Password</v-card-title>
              </v-card-actions>
              </v-card>
              </div>
            </div>
          </div>

    </v-content>

</v-app>
</template>

<<script>
export default {
    data(){
        return {
            items: [
                { title: 'Dashboard'},
                { title: 'System Users'},
                { title: 'Tracking'},
                { title: 'Collection Report'},
                { title: 'Set Email Template'},
                { title: 'Change Password'},
                { title: 'History Logs'},
                { title: 'Logout'},
            ],
            right: null,
            drawer:true,

            
        }
    }
   
}
</script>
