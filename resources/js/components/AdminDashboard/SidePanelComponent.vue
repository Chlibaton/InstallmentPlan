<style scoped>
    .sidebarBackground{
        background: black;
        top: 179px !important;
        overflow: auto;
        height: 100% !important;
        position: fixed;
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
        padding: 0px 0px 0px 0px !important;
        margin: 0px;
        max-width: 100%;
    }
    /* LOGO */
    header.m-header>.m-h-img>img {
    width: 250px;
    max-width: 100%;
    }
    header.m-header {
        background-image: linear-gradient(to right, #fff138 30%, #e83530);
    }
    header.m-header {
        display: flex;
    }
    .m-title>p {
        padding: 0px !important;
        margin: 0px !important;
    }
    .m-title {
        text-align: center;
        margin-top: 10px;
    }
    .m-title>p>ul {
        display: inline-flex;
        margin-bottom: 0px !important;
        margin-left: 15px !important;
    }
    .m-title>p:nth-child(1) {
        font-family: Century;
        font-size: 40px;
    }
    .m-title>p:nth-child(2) {
        margin-right: 30px;
        font-size: 20px;
        font-family: Century;
    }
    .m-title>p:nth-child(3) {
        font-family: Century;
        font-weight: bold;
        margin-top: 5px !important;

    }
    
@media only screen and (max-width: 716px) {
    .m-title>p:nth-child(1) {
        font-size: 34px;
    }
    .m-title>p:nth-child(2) {
        font-size: 16px;
    }

    .m-title>p:nth-child(3) {
        font-size: 14px;
    }

    header.m-header>.m-h-img>img {
        width: 210px;
        max-width: 100%;
    }
}

@media only screen and (max-width: 600px) {
    .m-title>p:nth-child(1) {
        font-size: 26px;
    }
    .m-title>p:nth-child(2) {
        font-size: 14px;
    }
    .m-title>p:nth-child(3) {
        font-size: 12px;
    }

    header.m-header>.m-h-img>img {
        width: 170px;
        max-width: 100%;
    }
}

@media only screen and (max-width: 464px){
    .m-title>p:nth-child(1) {
        font-size: 18px;
    }
    .m-title>p:nth-child(2) {
        font-size: 10px;
    }
    .m-title>p:nth-child(3) {
        font-size: 8px;
    }

    header.m-header>.m-h-img>img {
        width: 140px;
        max-width: 100%;
    }
}

@media only screen and (max-width: 360px) {
    .m-title>p:nth-child(1) {
        font-size: 14px;
    }
    .m-title>p:nth-child(2) {
        font-size: 8px;
    }
    .m-title>p:nth-child(3) {
        font-size: 6px;
    }

    header.m-header>.m-h-img>img {
        width: 110px;
        max-width: 100%;
    }
}

        
</style>

<template>
<v-app>
      <header class="m-header">
          <div class="m-h-img">
              <img src="img/vy-logo-header.png" alt="">
          </div>
          <div class="m-title">
              <p>V.Y Domingo Jewellers</p>
              <p>• Manufacturer • Wholesaler • Designer</p>
              <p>Factory Since 1928</p>
          </div>
      </header>
       <!-- <v-app-bar class='v-header' dark prominent absolute >
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      </v-app-bar> -->
    <v-navigation-drawer v-model="drawer" app class='sidebarBackground' absolute >
      <v-list-item >
        <v-list-item-content ></v-list-item-content>
      </v-list-item>
      <v-divider></v-divider>
      <v-list dense nav>
        <div v-if="seen">
        <v-list-item v-if="role==1"  class='navContent' href='/'>
          <v-list-item-content>
            <v-list-item-title class='navList'>Dashboard</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item v-if="role==1"  class='navContent' href='/systemuser'>
          <v-list-item-content>
            <v-list-item-title class='navList'>System Users</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
         <v-list-item v-if="role==1"  class='navContent' href='/tracking'>
          <v-list-item-content>
            <v-list-item-title class='navList'>Tracking</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item v-if="role==1"   class='navContent' href='/collectionreport'>
          <v-list-item-content>
            <v-list-item-title class='navList'>Collection Report</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item v-if="role==1" class='navContent' href='/emailtemplate'>
          <v-list-item-content>
            <v-list-item-title class='navList'>Set Email Template</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item v-if="role==1" class='navContent' href='/historylog'>
          <v-list-item-content>
            <v-list-item-title class='navList'>History Logs</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item v-if="role==0" class='navContent' href='/mytracking'>
          <v-list-item-content>
            <v-list-item-title class='navList'>My Tracking</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item v-if="role==0" class='navContent' href="/changepassword">
          <v-list-item-content>
            <v-list-item-title class='navList'>Change Password</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item class='navContent' href='/logout'>
          <v-list-item-content>
            <v-list-item-title class='navList'>Logout</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        </div>
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
            role:'',
            seen:false
        }
    },
      async mounted(){
        axios.get('/userrole')
        .then((response)=>{
              this.role = response.data.role
              this.seen = true
        })
     }
   
}
</script>
