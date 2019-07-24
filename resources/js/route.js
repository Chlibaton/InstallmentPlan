const adminDashboard = require('./components/AdminDashboard/DashboardComponent.vue').default;
const systemUser = require('./components/AdminDashboard/SystemUserComponent.vue').default;
const landingPage = require('./components/Landing/HomeComponent.vue').default;

export default{
    mode:'history',
    routes: [
        { path: '/admin-dashboard', name:'admin', component: adminDashboard, 
            meta: { 
                title: "Admin Dashboard" 
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
    ]
}