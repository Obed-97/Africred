function main() {
    const permission = document.getElementById('push-permission')
    if (
        !permission ||
        !('Notification' in window) ||
        !('serviceWorker' in navigator) ||
        Notification.permission !== 'default'
    ) {
        return;
    }
    const button = document.createElement('button');
    button.classList.add('btn', 'header-item', 'noti-icon', 'waves-effect');
    button.innerText = 'Cliquer ici pour recevoir les notifications !';
    permission.appendChild(button);

    button.addEventListener('click', askPermission);
}

async function askPermission() {
    const permission = await Notification.requestPermission()
    if (permission == 'granted') {
        console.log(permission)
        registerServiceWorker()
    }
}

async function registerServiceWorker() {
    const registration = await navigator.serviceWorker.register("/sw.js");
    let subscription = await registration.pushManager.getSubscription();
    if (!subscription) {
        subscription = await registration.pushManager.subscribe({
            userVisibleOnly: true,
            applicationServerKey: await getPublicKey()
         });
    }
    await saveSubscription(subscription);
}

async function saveSubscription(subscription) {

    const token = document.querySelector('meta[name=csrf-token]').getAttribute('content');
    fetch("/push/subscribe", {
        method: 'post',
        headers: {
            'Content-Type': 'application/json',
            Accept: "application/json",
            'X-CSRF-Token': token
        },
        body: JSON.stringify(subscription)
    })
}


async function getPublicKey() {
    const { key } = await fetch("/push/key", {
      headers: {
        Accept: "application/json",
      },
    }).then((r) => r.json());
    return key;
  }

main()
