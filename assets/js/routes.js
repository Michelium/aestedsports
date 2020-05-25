import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from './pages/Home';
import Catalogue from "./pages/Catalogue";
import ExerciseList from "./pages/ExerciseList";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {path: '/', name: 'home', component: Home},
        {path: '/catalogue', name: 'catalogue', component: Catalogue},
        {path: '/admin/exercises', name: 'exerciseList', component: ExerciseList},
    ]
});

export default router;