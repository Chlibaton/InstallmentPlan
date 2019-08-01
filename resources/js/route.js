const sidePanel = require('./components/AdminDashboard/SidePanelComponent.vue').default;
const systemUser = require('./components/AdminDashboard/SystemUserComponent.vue').default;
const superAdmin = require('./components/AdminDashboard/SuperAdminComponent.vue').default;
const tracking = require('./components/AdminDashboard/TrackingComponent.vue').default;
const collectionReport = require('./components/AdminDashboard/CollectionReportComponent.vue').default;
const historyLogs = require('./components/AdminDashboard/HistoryLogsComponent.vue').default;

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
        { path: '/superadmin', name:'superadmin', component: superAdmin, 
        meta: { 
            title: "DASHBOARD - SUPERADMIN" 
            } 
        },
        { path: '/tracking', name:'tracking', component: tracking, 
        meta: { 
            title: "Tracking of Payments" 
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
    ]
}