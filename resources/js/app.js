require('./bootstrap');
import Vue from 'vue'
window.Vue = require('vue');

import axios from "axios";

window.Vue = require('vue');
window.Vue = Vue;
window.http = axios
import {initializeApp} from "firebase/app";
import {getMessaging, getToken, onMessage} from "firebase/messaging";

const firebaseConfig = {
    apiKey: "AIzaSyDbY1oznSAopxqU8_E1cLgoaTW5AkdwgPc",
    authDomain: "break-c2fcb.firebaseapp.com",
    projectId: "break-c2fcb",
    storageBucket: "break-c2fcb.appspot.com",
    messagingSenderId: "347344716657",
    appId: "1:347344716657:web:ba18dc5f43bf59e46bacd0",
    measurementId: "G-95W5H13PKS"
};

const app = initializeApp(firebaseConfig);

const messaging = getMessaging(app);


