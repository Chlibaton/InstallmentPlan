<style scoped>
    .sidebarBackground{
        background: black;
        position: absolute;
    }
    .navList{
        color: white;
        font-size: 18px !important;
    }
</style>



<template>
    <v-navigation-drawer  permanent class='sidebarBackground'>
      <v-list-item>
        <v-list-item-content>
          <v-list-item-title class="title"> 
            Application
          </v-list-item-title>
          <v-list-item-subtitle>
            subtext
          </v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>

      <v-divider></v-divider>

      <v-list
        dense
        nav
      >
        <v-list-item
          v-for="item in items"
          :key="item.title"
          link
        >
          <v-list-item-icon>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title class='navList'>{{ item.title }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
</template>

<<script>
export default {
    data(){
        return {
            items: [
                { title: 'Dashboard', icon: 'mdi-view-dashboard' },
                { title: 'Photos', icon: 'mdi-image' },
                { title: 'About', icon: 'mdi-help-box' },
            ],
            right: null,
            
        }
    }
   
}
</script>
