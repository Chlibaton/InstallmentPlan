<style scoped>
    .sidebarBackground{
        background: black;
        position: absolute;
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
        font-size: 35px;
        position: relative;
        
    }
    .dash-head{
        top: 24px;
        padding: 7px;
        margin-bottom: 15px;
        background: linear-gradient(to left, gray, black)
    }

    .bg{
      background-color: white;
    }
    
</style>



<template>
<v-app>
    <v-navigation-drawer app permanent class='sidebarBackground'>
      <v-list-item class='bg'>
        <v-list-item-content >
         
        </v-list-item-content>
      </v-list-item>

      <v-divider></v-divider>

      <v-list dense nav>
        <v-list-item
          v-for="item in items"
          :key="item.title"
          link
           class='navContent'
        >
          <v-list-item-content>
            

            <v-list-item-title class='navList'>{{ item.title }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-content>
      <v-container fluid>
        <router-view></router-view>
      </v-container>
          <div class="dashboard-header dash-head"></div>
          <div class="dashboard-header ">DASHBOARD - SUPER ADMIN</div>
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
            
        }
    }
   
}
</script>
