<style scoped>
.main-header.wrap {
       background-image: linear-gradient(to right, #fff138 30%, #e83530);
}
.container {
    padding: 0px !important;
}

.container.grid-list-md .layout .flex{
    padding: 0px !important;
    font-family: arial;

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
.layout.content-main {
    display: block;
}
.content-main {
    background: black;
}
.flex:nth-child(2) {
    color: white !important;
    margin-right: 5px;
}
.flex:nth-child(3) {
    color: #DDA354 !important;
}
.flex:nth-child(3) {
    font-size: 30px;
    font-weight: bold;
}
</style>


<template>
  <v-container fluid grid-list-md text-center>
    <v-layout wrap class="main-header">
            <v-flex class="header-img">
                <div><img src="img/vy-logo-header.png" alt=""></div>
                <div class="header-title">
                    <div class="hdr-main-title">V.Y Domingo Jewellers</div>
                     <div class="hdr-main-subtitle">Manufacturer • Wholesaler • Designers</div>
                     <div class="hdr-main-subtitle-1">Factory Since 1928</div>
                </div>
            </v-flex>
    </v-layout>
    <v-layout class="content-main" pa-4 mb-2>
          <v-divider></v-divider>
            <v-flex xs4 offset-xs8>
                Already have an account? Log in
            </v-flex>
            <v-flex xs4>
                Easy Installment Plan
            </v-flex>
            <v-layout>
                <v-flex xs8>
                    <div>
                        <video src="https://sample-videos.com/video123/mp4/240/big_buck_bunny_240p_10mb.mp4" type="video/mp4"></video>
                    </div>
                </v-flex>
                <v-flex xs4>
                </v-flex>
            </v-layout>
    </v-layout>
  </v-container>
</template>