<style lang="scss" scoped>
.v-card{
  box-shadow: 
    0 3px 1px -2px rgba(0, 0, 0, 0),
    0 2px 2px 0 rgba(0, 0, 0, 0),
    0 1px 5px 0 rgba(0, 0, 0, 0) !important;
  cursor: pointer;
}
</style>

<template>
    <div>
         <v-toolbar-title>SET EMAIL TEMPLATE</v-toolbar-title>
         <v-dialog
      v-model="dialog"
      max-width="560"
    >
      <v-card>
        <v-card-title class="headline">Email Template</v-card-title>

        <v-card-text>
          <v-select
            v-model="value"
            :items="items"
            attach
            chips
            label="Select Email"
            multiple
          ></v-select>
        </v-card-text>

        <v-card-actions>
          <div class="flex-grow-1"></div>

          <v-btn
            color="green darken-1"
            text
            @click="dialog = false"
          >
            Cancel
          </v-btn>

          <v-btn
            color="green darken-1"
            text
            @click="dialog = false"
          >
            Send
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
        <div class='container'>
            <div class="row">
              <div class="col-sm" @click.stop="dialog = true" >
                <v-card max-width="344" class="dash-card">
                  <v-img class="white--text" height="200px" src="/img/50_emailtemplate.png">
                  </v-img>
                </v-card>
              </div>

              <div class="col-sm" @click.stop="dialog = true">
                <v-card max-width="344" class="dash-card">
                  <v-img class="white--text" height="200px" src="/img/75_emailtemplate.png">
                  </v-img>
                </v-card>
              </div>

              <div class="col-sm" @click.stop="dialog = true">
                <v-card max-width="344" class="dash-card">
                  <v-img class="white--text" height="200px" src="/img/100_emailtemplate.png">
                  </v-img>
                </v-card>
              </div>

              <div class="col-sm" @click.stop="dialog = true">
                <v-card max-width="344" class="dash-card">
                  <v-img class="white--text" height="200px" src="/img/for_delivery.jpg">
                  </v-img>
                </v-card>
              </div>

            </div>
        </div>
  </div>
</template>

<script>
export default {
  data () {
      return {
        dialog: false,
        items: ['Jude@gmail.com', 'Jerald@gmail.com', 'Charlie@gmail.com'],
        value: ['foo', 'bar', 'fizz', 'buzz'],
      }
   },
}
</script>
