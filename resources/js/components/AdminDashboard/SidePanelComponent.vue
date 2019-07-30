<style scoped>
    .sidebarBackground{
        background: black;
        top: 142px !important;
        overflow: auto;
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
        padding: 10px
    }
    .main-container {
        padding: 142px 0px 0px 0px !important;
        
    }
    .v-header{
        color: #fff;
        background: linear-gradient( 75deg, black, #716161 20%, #fd0c0c 20%, #ffc800 100%)
    }
    
</style>

<template>
<v-app>
       <v-app-bar class='v-header' dark prominent absolute >
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      </v-app-bar>

    <v-navigation-drawer v-model="drawer" app class='sidebarBackground'>
      <v-list-item class='bg'>
        <v-list-item-content ></v-list-item-content>
      </v-list-item>
      <v-divider></v-divider>
      <v-list dense nav>
        <v-list-item class='navContent' href='/superadmin'>
          <v-list-item-content>
            <v-list-item-title class='navList'>Dashboard</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item class='navContent' href='/systemuser'>
          <v-list-item-content>
            <v-list-item-title class='navList'>System Users</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
         <v-list-item class='navContent' href='/tracking'>
          <v-list-item-content>
            <v-list-item-title class='navList'>Tracking</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item class='navContent' href='/collectionreport'>
          <v-list-item-content>
            <v-list-item-title class='navList'>Collection Report</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item class='navContent'>
          <v-list-item-content>
            <v-list-item-title class='navList'>Set Email Template</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item class='navContent'>
          <v-list-item-content>
            <v-list-item-title class='navList'>Change Password</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item class='navContent'>
          <v-list-item-content>
            <v-list-item-title class='navList'>History Logs</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item class='navContent'>
          <v-list-item-content>
            <v-list-item-title class='navList'>Logout</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-content class="overflow-hidden">
    <v-container class="main-container" fluid>
     
      <router-view></router-view>
    </v-container>
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
            drawer: true,
        }
    }
   
}
</script>
