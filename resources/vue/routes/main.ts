import { createRouter, createWebHistory, type RouteRecordRaw } from 'vue-router'
import Home from '@/pages/Home.vue'
import Results from "@/pages/Results.vue";


const routes: RouteRecordRaw[] = [
    {
    	path: '/',
    	name: 'Home',
    	component: Home
    },
	{
		path: '/results',
		name: 'Results',
		component: Results
	},
]
const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
