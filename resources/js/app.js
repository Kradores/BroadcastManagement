/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

require('./components/Example');

var Vue = require('vue');
 
new Vue({
 el: '#upload-progress',
 created() {
    Echo.channel('broadcast-channel').listen('UploadEvent', (e) => {
        var bar = document.getElementById("upload-progress");
        bar.setAttribute("aria-valuenow", e.message);
        bar.setAttribute("style", "width: " + e.message + "%;");
        bar.innerText = e.message + "%";
    });
 }
});