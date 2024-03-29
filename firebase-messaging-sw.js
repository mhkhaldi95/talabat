// Scripts for firebase and firebase messaging
importScripts("https://www.gstatic.com/firebasejs/8.2.0/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/8.2.0/firebase-messaging.js");

// Initialize the Firebase app in the service worker by passing the generated config
const firebaseConfig = {
    apiKey: "AIzaSyDbY1oznSAopxqU8_E1cLgoaTW5AkdwgPc",
    authDomain: "break-c2fcb.firebaseapp.com",
    projectId: "break-c2fcb",
    storageBucket: "break-c2fcb.appspot.com",
    messagingSenderId: "347344716657",
    appId: "1:347344716657:web:ba18dc5f43bf59e46bacd0",
    measurementId: "G-95W5H13PKS"

};

firebase.initializeApp(firebaseConfig);

// Retrieve firebase messaging
const messaging = firebase.messaging();

messaging.onBackgroundMessage(function(payload) {
    console.log("Received background message ", payload);

    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body,
    };

    self.registration.showNotification(notificationTitle, notificationOptions);
});
