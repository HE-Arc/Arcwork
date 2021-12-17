import { createRouter, createWebHashHistory } from 'vue-router'
import Home from '../views/Home.vue'
import Projects from '../views/Projects.vue'
import Project from '../views/Project.vue'
import User from '../views/User.vue'

const routes = [{
        path: '/',
        name: 'Home',
        component: Home
    },
    {
        path: '/about',
        name: 'About',
        // route level code-splitting
        // this generates a separate chunk (about.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () =>
            import ( /* webpackChunkName: "about" */ '../views/About.vue')
    },
    {
        path: '/projects',
        name: 'projects',
        component: Projects
    },
    { path: '/project/:id', component: Project },
    { path: '/user/:id', component: User }


]

const router = createRouter({
    history: createWebHashHistory(),
    routes
})

export default router