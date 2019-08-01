<style scoped>
    .sidebarBackground{
        background: black;
        top: 214px !important;
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
        padding: 216px 0px 0px 0px !important;
    }
    /* LOGO */
    .main-header.wrap {
       background-image: linear-gradient(to right, #fff138 30%, #e83530);
      position: absolute;
      width: 100%;
    } 
    .header-img {
    display: inline-flex;
    }
    .header-img>div>img {
        width: 300px;
        max-width: 100%;
        float: left;
    }
    .header-title {
        font-family: Century;
        margin-top: 15px;
    }
    .hdr-main-title {
        font-family: Century;
        font-size: 40px;
        text-transform: uppercase;
    }
    .hdr-main-subtitle {
        font-family: Century;
        font-size: 20px;
        font-weight: 400;
        text-transform: uppercase;
    }
    .hdr-main-subtitle-1 {
        font-weight: bold;
    }
    
@media only screen and (max-width: 792px) {
    .hdr-main-title {
        font-size: 35px;
    }
    .hdr-main-subtitle {
        font-size: 18px;
    }
}

@media only screen and (max-width: 762px) {
    .hdr-main-title {
        font-size: 28px;
    }
    .hdr-main-subtitle {
        font-size: 15px;
    }
}

@media only screen and (max-width: 562px) {
    .hdr-main-title {
        font-size: 20px;
    }
    .hdr-main-subtitle {
        font-size: 10px;
    }
    .header-img>div>img {
        width: 200px
    }
    .hdr-main-subtitle-1 {
        font-size: 8px;
    }
}

@media only screen and (max-width: 426px) {
     .hdr-main-title {
        font-size: 18px;
    }
    .hdr-main-subtitle {
        font-size: 10px;
    }
    .header-img>div>img {
        width: 200px
    }
    .hdr-main-subtitle-1 {
        font-size: 8px;
    }
}

@media only screen and (max-width: 354px) {
     .hdr-main-title {
        font-size: 14px;
    }
    .hdr-main-subtitle {
        font-size: 8px;
    }
    .header-img>div>img {
        width: 200px
    }
    .hdr-main-subtitle-1 {
        font-size: 8px;
    }
}
        
</style>

<template>
<v-app>
      <v-layout wrap class="main-header">
            <v-flex class="header-img">
                <div>
                    <img src="img/vy-logo-header.png" alt="" @click.stop="drawer = !drawer">
                </div>
                <div class="header-title">
                    <div class="hdr-main-title">V.Y Domingo Jewellers</div>
                     <div class="hdr-main-subtitle">Manufacturer • Wholesaler • Designers</div>
                     <div class="hdr-main-subtitle-1">Factory Since 1928</div>
                </div>
            </v-flex>
      </v-layout>
       <!-- <v-app-bar class='v-header' dark prominent absolute >
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      </v-app-bar> -->

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
        <v-list-item class='navContent' href='/historylog'>
          <v-list-item-content>
            <v-list-item-title class='navList'>History Logs</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item class='navContent' href='/logout'>
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
