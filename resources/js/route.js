const adminDashboard = require('./components/AdminDashboard/DashboardComponent.vue').default;
const landingPage = require('./components/Landing/HomeComponent.vue').default;

export default{
    mode:'history',
    routes: [
        { path: '/admin-dashboard', name:'admin', component: adminDashboard, 
            meta: { 
                title: "Admin Dashboard" 
            } 
        },
        { path: '/home', name:'home', component: landingPage, 
        meta: { 
            title: "Home Page" 
        } 
    },
    ]
}