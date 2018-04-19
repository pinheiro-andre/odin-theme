var OneSignal = window.OneSignal || [];
OneSignal.push(() => {
  OneSignal.init({
    appId: "000000000000",
    safari_web_id: 'web.onesignal.auto.00000000',
    path: '/blog/',
    autoRegister: false,
    persistNotification: false,
    allowLocalhostAsSecureOrigin: true,

    welcomeNotification: {
      title: 'Astrocentro',
      message: 'Você será informado das nossas atualizações'
    },
    notifyButton: {
        enable: false
    }
  })
})


function subscribe() {
    OneSignal.registerForPushNotifications();
    OneSignal.setSubscription(true);
    event.preventDefault();
}

function unsubscribe() {
    OneSignal.registerForPushNotifications();
    OneSignal.setSubscription(false);
    event.preventDefault();
}



//var OneSignal = OneSignal || [];
OneSignal.push(function() {

    OneSignal.SERVICE_WORKER_PARAM = { scope: '/blog/' };

    if (!OneSignal.isPushNotificationsSupported()) {
        return;
    }
    OneSignal.isPushNotificationsEnabled(function(isEnabled) {
        if (isEnabled) {
            var element = document.getElementById("subscribe-link");
            if (typeof(element) != 'undefined' && element != null) {
                jQuery('#subscribe-link').text('Desativar as notificações');
                jQuery('#subscribe-link').addClass('is-subscribed-to-push');
                document.getElementById("subscribe-link").addEventListener('click', unsubscribe);
                document.getElementById("subscribe-link").style.display = '';
                document.getElementById("pushes").style.display = '';
            } else {

            }
        } else {
            var element = document.getElementById("subscribe-link");
            if (typeof(element) != 'undefined' && element != null) {
                jQuery('#subscribe-link').text('Ativar as notificações');
                document.getElementById("subscribe-link").addEventListener('click', subscribe);
                document.getElementById("subscribe-link").style.display = '';
                document.getElementById("pushes").style.display = '';
            }
        }


    });
});
