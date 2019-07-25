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
    .main-container {
    padding: 0px !important;
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
