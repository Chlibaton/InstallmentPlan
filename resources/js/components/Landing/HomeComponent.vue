<style scoped>
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
.container {
    max-width: 100%;
    background: black;
}


.row.t-row>.col-md-4.offset-md-8>p {
    text-align: center;
    color: white;
}

.row.t-row>.t-row-2.col-md-4>p {
    color: #DDA354;
    font-family: Arial;
    font-size: 30px;
    font-weight: bold;
}
.embed-responsive.embed-responsive-16by9 {
    border: 1px Solid white;
}

.form-header {
    padding: 8px !important;
    margin: 15px -15px;
    background: #FCBD11;
    text-align: center;
    font-size: 29px;
}

input.form-control {
    background: transparent;
    color: black;
    border-radius: 0px !important;
    border: 2px solid black;
}

.t-row-2.col-md-5>form {
    background: gray;
    padding: 15px;
}

::placeholder {
  color: black;
  opacity: 1; /* Firefox */
}

:-ms-input-placeholder { /* Internet Explorer 10-11 */
 color: black;
}

::-ms-input-placeholder { /* Microsoft Edge */
 color: black;
}

.row.t-row>.col-md-5.offset-md-7 {
    text-align: center;
}

.row.t-row>.col-md-5.offset-md-7>p {
    display: inline;
    color: white;
    border: 1px solid;
    padding: 10px;
    border-radius: 20px;
}

.row.t-row>.col-md-5.offset-md-7>p:hover {
    color: black;
    background: white;
    border: 1px solid #FCBD11;
    cursor: pointer;
}

button.btn.mt-3.btn-secondary.btn-block {
    width: 125px;
    margin: auto;
    background: #FCBD11;
    border: 1px solid #FCBD11;
    color: black;
    font-weight: 500;
}

.m-desc.col>p {
    text-align: center;
    color: white;
    margin: 30px 30px;
    font-size: 20px;
}

.gradient-divider {
    background-image: linear-gradient(black, #a2a2a2);
    padding: 10px;
    width: 100%;
}

.divider {
    color: grey;
    background: grey;
    width: 1px;
    margin: 10px;
}
p.l-row-address {
    margin-top: 15px;
    margin-left: 20px;
}
p.l-row-address-2 {
    margin-top: 15px;
    text-align: center;
}
p.l-row-address-2>span {
    color: white;
    font-size: 26px;
    font-weight: bold;
}
p.l-row-address>span:nth-child(1) {
    color: white;
    font-size: 24px;
}

p.l-row-address>span:nth-child(2) {
    color: white;
}

.l-sm-form>form {
    background: white;
    padding: 10px;
    margin: 15px;
}
.form-group.message-area>textarea.form-control {
    border-radius: 0px;
    border: 2px solid;
}
.contact-info.col {
    margin: auto;
}

.help-block{
    color: #e83530;
}

</style>



<template>
    <div>
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
        <b-container class="vy-main-cont">
            <b-row class="t-row">
                <b-col md="5" offset-md="7"><p v-b-modal.modal-1>Already have an account? Login</p></b-col>
                <b-col md="4" class="t-row-2"><p>Easy Installment Plan</p></b-col>
            </b-row>
            <b-row class="m-row">
                <b-col md="7" class="t-row-2">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/8EFp46Bw6MA?autoplay=1&loop=1&playlist=8EFp46Bw6MA&mute=1" allowfullscreen></iframe>
                    </div>
                </b-col>
                <b-col md="5" class="t-row-2">
                    <form>
                        <div class="form-header">Create an account to apply for Jewelry Easy Installment Plan</div>
                        <div class="form-row">
                            <div class="col">
                                <input type="text" v-model="signUpDetails.first_name" class="form-control" placeholder="First name">
                            </div> 
                            <div class="col">
                                <input type="text" v-model="signUpDetails.last_name" class="form-control" placeholder="Last name">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" v-model="signUpDetails.organization_name" class="form-control" placeholder="Orgranization Name">
                        </div>
                        <div class="form-group">
                            <input type="text" v-model="signUpDetails.address" class="form-control" placeholder="Address">
                        </div>
                        <div class="form-group">
                            <input type="text" v-model="signUpDetails.mobileno" class="form-control" placeholder="Mobile Number">
                        </div>
                        <div class="form-group">
                           <input type="email" v-model="signUpDetails.email" class="form-control" placeholder="Email">
                           <span class="help-block" v-if="RegisterEmailErr">
                                    {{RegisterEmailMsg}}
                            </span>
                        </div>
                        <div class="form-group">
                           <input type="password" v-model="signUpDetails.password" class="form-control" placeholder="Password">
                           <span class="help-block" v-if="RegisterPasswordErr">
                                    {{RegisterPasswordMsg}}
                            </span>
                        </div>
                        <div class="form-group">
                           <input type="password" v-model="signUpDetails.password_confirmation" class="form-control" placeholder="Confirm Password">
                        </div>
                        <div class="form-group">
                            <b-button class="mt-3" block @click="signUpPost()">Register</b-button>
                        </div>

                        <b-modal hide-footer id="modal-1" title="Login">
                            <div class="form-group">
                                <input v-model="loginDetails.email" type="email" class="form-control" placeholder="Email ">
                                <span class="help-block" v-if="errorsEmail">
                                        {{emailError}}
                                </span>
                            </div>
                            <div class="form-group">
                                <input v-model="loginDetails.password" type="password" class="form-control" placeholder="Password">
                                <span class="help-block" v-if="errorsPassword">
                                    {{passwordError}}
                                </span>
                            </div>
                                <label for="forgot-password">Forgot Password?</label>
                            <b-button class="mt-3" block @click="login()">Login</b-button>
                        </b-modal>
                    </form>
                </b-col>
            </b-row>
            <b-row class="m-row-2">
                 <b-col class="m-desc"><p>Welcome to V.Y.Domingo Jewellers Incorporated.<br>
                    World famous for customized and personalized Jewelry.<br>
                    We are the largest manufacturer ,supplier and exporter of Class Rings, Military Rings, Corporate Award Jewelry,<br>
                    Name Jewelry and Championship/Sports Rings from the Philippines to the whole World.<br>
                    Our excellent workmanship is the trademark of truly successful International Jewelry brands Worldwide.<br>
                    Our pieces are carefully handcrafted with masterpieces produced by our artisans and designers.<br>
                    Lowest Pricing – Direct Manufacturer Prices<br>
                    and Best Quality Assurance !<br>
                    Quality and Service is our Mission !<br>
                    Customer Satisfaction is our GOAL!</p></b-col>
            </b-row>
            <b-row>
                <div class="gradient-divider"></div>
            </b-row>
            <b-row class="l-row">
                <b-col>
                    <div class="l-sm-form">
                        <p class="l-row-address-2">
                            <span for="address">Send Us A Message</span>
                        </p>
                         <form>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group message-area">
                                <textarea class="form-control" placeholder="Message" rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                <b-button class="mt-3" block @click="$bvModal.hide('bv-modal-example')">Submit</b-button>
                            </div>
                         </form>
                    </div>
                </b-col>
                <div class="divider"></div>
                <b-col class="contact-info">
                    <div>
                        <p class="l-row-address">
                        <span for="address">Address <br></span>
                        <span for="address">#35 Emerald Street, Millionaires Village, <br> Novaliches, Quezon City, Philippines, 1117</span>
                        </p>
                    </div>
                    <div>
                        <p class="l-row-address">
                        <span for="address">Let's Talk <br></span>
                        <span for="address">(632) 938-4221</span>
                        </p>
                    </div>
                     <div>
                        <p class="l-row-address">
                        <span for="address">Sales Support <br></span>
                        <span for="address">vydomingo@gmail.com</span>
                        </p>
                    </div>
                </b-col>
            </b-row>
        </b-container>
    </div>
</template>

<script>
export default {
   data() {
        return {
            loginDetails: {
                email: '',
                password: '',
                remember: false
            },
              signUpDetails:{
                first_name: '',
                last_name: '',
                organization_name:'',
                address: '',
                mobileno: '',
                email: '',
                password: '',
            },
            errorsEmail: false,
            errorsPassword: false,
            emailError: null,
            passwordError: null,
            RegisterEmailErr: false,
            RegisterPasswordErr: false,
            RegisterEmailMsg: false,
            RegisterPasswordMsg: false,
        }
    },
    methods: {
        login(){
            let _self = this;
            axios.post('/login', _self.loginDetails)
            .then((response) => {
                axios.get('/userrole')
                .then((response) => {
                    if(response.data.role == 1){
                        location.href = "/";
                    }else{
                        location.href = "/mytracking";
                    }
                })
            })
            .catch((error) => {
                var errors = error.response;
                _self.errorsEmail = false;
                _self.errorsPassword = false;

                if(errors.statusText === "Unprocessable Entity" || errors.status === 422){
                    if(errors.data.errors) {
                        
                        if(errors.data.errors.email) {
                            _self.errorsEmail = true;
                            _self.emailError = _.isArray(errors.data.errors.email) ? errors.data.errors.email[0]: errors.data.errors.email;
                           console.log(errors.data.errors.email) 
                        }
                        if(errors.data.errors.password) {
                            _self.errorsPassword = true;
                            _self.passwordError = _.isArray(errors.data.errors.password) ? errors.data.errors.password[0]: errors.data.errors.password;
                        }
                    }
                }
            });
        },
         signUpPost() {
            let _self = this;
            axios.post('/register', _self.signUpDetails)
            .then((response) => {
                location.reload();
            })
            .catch((error)=> {
                var errors = error.response;

                _self.RegisterEmailErr = false;
                _self.RegisterPasswordErr = false;
                
                if(errors.statusText === 'Unprocessable Entity' || errors.status === 422) {
                    if(errors.data.errors) {
                        
                        if(errors.data.errors.email) {
                            _self.RegisterEmailErr = true;
                            _self.RegisterEmailMsg = _.isArray(errors.data.errors.email) ? errors.data.errors.email[0]: errors.data.errors.email;
                        }
                        if(errors.data.errors.password) {
                            _self.RegisterPasswordErr = true;
                            _self.RegisterPasswordMsg = _.isArray(errors.data.errors.password) ? errors.data.errors.password[0]: errors.data.errors.password;
                        }
                    }
                }
            });
        }
    }
}
</script>