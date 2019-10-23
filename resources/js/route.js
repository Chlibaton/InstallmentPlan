const sidePanel = require('./components/AdminDashboard/SidePanelComponent.vue').default;
const systemUser = require('./components/AdminDashboard/SystemUserComponent.vue').default;
const superAdmin = require('./components/AdminDashboard/SuperAdminComponent.vue').default;
const tracking = require('./components/AdminDashboard/TrackingComponent.vue').default;
const collectionReport = require('./components/AdminDashboard/CollectionReportComponent.vue').default;
const completedOrder = require('./components/AdminDashboard/CompletedOrdersComponent.vue').default;

// accounting
const accounting = require('./components/AdminDashboard/AccountingComponent.vue').default;

const historyLogs = require('./components/AdminDashboard/HistoryLogsComponent.vue').default;
const emailtemplate = require('./components/AdminDashboard/EmailTemplateComponent.vue').default;

const usertracking = require('./components/UserSide/UserTrackingComponent.vue').default;
const partialpayment = require('./components/UserSide/PartialPaymentComponent.vue').default;
const orderhistory = require('./components/UserSide/OrderHistoryComponent.vue').default;
const changepass = require('./components/UserSide/ChangePasswordComponent.vue').default;

const landingPage = require('./components/Landing/HomeComponent.vue').default;

export default{
    mode:'history',
    routes: [
        { path: '/side-panel', name:'admin', component: sidePanel, 
            meta: { 
                title: "Side Panel" 
            } 
        },
        { path: '/vy-installment', name:'home', component: landingPage, 
        meta: { 
            title: "Home Page" 
         }
        }, 
        { path: '/systemuser', name:'systemuser', component: systemUser, 
        meta: { 
            title: "System User" 
            }
        },
        { path: '/', name:'superadmin', component: superAdmin, 
        meta: { 
            title: "Dashboard" 
            } 
        },
        { path: '/tracking', name:'tracking', component: tracking, 
        meta: { 
            title: "Tracking of Payments" 
            } 
        },
        { path: '/accounting', name:'accounting', component: accounting, 
        meta: { 
            title: "accounting" 
            } 
        },
        { path: '/collectionreport', name:'collectionReport', component: collectionReport, 
        meta: { 
            title: "Collections of Report" 
            } 
        },
        { path: '/historylog', name:'historylog', component: historyLogs, 
        meta: { 
            title: "History Logs" 
            } 
        },
        { path: '/emailtemplate', name:'emailtemplate', component: emailtemplate, 
        meta: { 
            title: "Email Template" 
            } 
        },
        { path: '/mytracking', name:'mytracking', component: usertracking, 
        meta: { 
            title: "Tracking" 
            } 
        },
        { path: '/partialpayment', name:'partialpayment', component: partialpayment, 
        meta: { 
            title: "partialpayment" 
            } 
        },
        { path: '/orderhistory', name:'orderhistory', component: orderhistory, 
        meta: { 
            title: "orderhistory" 
            } 
        },
        { path: '/changepassword', name:'changepassword', component: changepass, 
        meta: { 
            title: "Change Password" 
            } 
        },
        { path: '/completedorder', name:'completedOrder', component: completedOrder, 
        meta: { 
            title: "completedOrder" 
            } 
        },

        
    ]
}