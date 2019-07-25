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
        border-top: 6px;
        border-bottom: 0px;
        border-left: 0px;
        border-right: 0px;
        margin-bottom: 0px !important;
        border-style: solid;
        border-color: white;
        position: relative;
        top: 24px;
        padding: 12px
    }
    .main-container {
    padding: 0px !important;
}
</style>



<template>
<v-app>
   
    <v-navigation-drawer app v-model="drawer" class='sidebarBackground'>
      <v-list-item>
        <v-list-item-content >
          <v-list-item-title class="title"> 
            Application
          </v-list-item-title>
          <v-list-item-subtitle>
            subtext
          </v-list-item-subtitle>
        </v-list-item-content>
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
    <v-container class="main-container" fluid>
      <v-app-bar dark prominent>
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      </v-app-bar>
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
