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

Vue.prototype.$userId = document.querySelector("div[name='current-user-id']").getAttribute('content');
 
// new Vue({
//     el: '#upload-progress',
//     created() {
//         Echo.channel('channel-broadcast').listen('UploadEvent', (e) => {
//             var bar = document.getElementById("upload-progress");
//             bar.setAttribute("aria-valuenow", e.message);
//             bar.setAttribute("style", "width: " + e.message + "%;");
//             bar.innerText = e.message + "%";
//         });
//     },
// });

new Vue({
    el: '#notification',
    created() {
       Echo.private('App.User.' + this.$userId)
       .notification((notification) => {
           var template = document.getElementById("notification");
           template.removeAttribute("hidden");

           if(template.classList.length > 2) {
            template.classList.remove("alert-info", "alert-success", "alert-warning", "alert-danger");
            textToChange.nodeValue = notification.message;
            } else {
                template.innerHTML = notification.message + template.innerHTML;
            }

           template.classList.add(notification.alertType);
       });

       Echo.private('Upload.Progress.' + this.$userId).listen('UploadEvent', (e) => {
            var bar = document.getElementById("upload-progress");
            bar.setAttribute("aria-valuenow", e.message);
            bar.setAttribute("style", "width: " + e.message + "%;");
            bar.innerText = e.message + "%";
        });

        Echo.private('Count.Broadcast.List.' + this.$userId).listen('CountRowsEvent', (e) => {
            var notification = document.getElementById("notification");
            var textToChange = notification.childNodes[0];

            var prepareResult = document.getElementById("prepare-result");
            var before = document.getElementsByName("before")[0];
            var after = document.getElementsByName("after")[0];

            notification.removeAttribute("hidden");
            prepareResult.removeAttribute("hidden");

            if(notification.classList.length > 2) {
                notification.classList.remove("alert-info", "alert-success", "alert-warning", "alert-danger");
                textToChange.nodeValue = e.message;
            } else {
                notification.innerHTML = e.message + notification.innerHTML;
            }
            notification.classList.add(e.alertType);
            
            if(e.before === 0) {
                after.value = e.after;
            } else {
                before.value = e.before;
            }
        });
    },
});