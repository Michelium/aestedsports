import Vue from 'vue';
import VueRouter from "vue-router";
import Routes from './routes.js';

import '../css/app.scss';
import 'bootstrap';

const $ = require('jquery');

import App from "./views/App";

const app = new Vue({
    el: '#app',
    router: Routes,
    render: h => h(App),
});