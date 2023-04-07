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

function startFCM() {
    Notification.requestPermission()
        .then(function () {
            return getToken(messaging);
        })
        .then(function (response) {
            axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            axios.post('/store-token', {fcm_token: response}).then(function (response) {
                if (response.data.status)
                    window.localStorage.setItem('fcm_token', response.data.fcm_token);
            })

        }).catch(function (error) {
        console.log(error)
    });
}
var xInterval = null;
onMessage(messaging, (payload) => {
    if(payload.data.type == 'new_order'){
        countDown(payload.data)
    }else if(payload.data.type == 'branch_accept_order'){
        $('#countDownWebsite').modal('hide')
        var x = localStorage.getItem('xInterval'+payload.data.order_id)
        window.clearInterval(x);
        localStorage.removeItem('xInterval_'.order_id)
        toastr.success('تم قبول الطلبية بنجاح')
    }else if(payload.data.type == 'branch_accept_order2'){
        $('#countDownWebsite').modal('hide')
        var x = localStorage.getItem('xInterval'+payload.data.order_id)
        window.clearInterval(x);
        localStorage.removeItem('xInterval_'.order_id)
        toastr.warning('تم رفض الطلبية بنجاح')
    }

    console.log('Message received. ', payload);
});

if (!window.localStorage.getItem('fcm_token')) {
    startFCM();
}

function  countDown(data){

    $('#modal_order_id').val(data.order_id)
    $('#modal_branch_id').val(data.branch_id)
    $("#countDown").modal({ backdrop: "static ", keyboard: false });
    $('#countDown').modal('show')
    var countDownDate = 30;
    document.getElementById("countDown-modal-body").innerHTML = countDownDate+'<br/>سيتم قبول الطلب تلقائيا بعد 30 ثانية';

     xInterval = setInterval(function() {
        countDownDate = countDownDate - 1;
         document.getElementById("countDown-modal-body").innerHTML = countDownDate+'<br/>سيتم قبول الطلب تلقائيا بعد 30 ثانية';
        if(countDownDate <= 0){
            axios.post(data.order_accept_url,{
                order_id: data.order_id,
                branch_id:data.branch_id
            }).then(response => {
                $('#countDown').modal('hide')
                clearInterval(xInterval);
                toastr.success("تم قبول الطلبية بنجاح");
            }).catch(error => {
                toastr.warning("حدث خطا ما");
            });
        }


    }, 1000);
    localStorage.setItem("xInterval_"+data.order_id,xInterval)
    window.onbeforeunload = function() {
        return "Dude, are you sure you want to leave? Think of the kittens!";
    }
}
function getBranch(){
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    var branch_id = urlParams.get('branch_id')
    return branch_id;
}
