<!DOCTYPE html>
<html>
  <head>
    <title>Push Notification</title>
  </head>
  <body>
    <script>
    // (A) OBTAIN USER PERMISSION TO SHOW NOTIFICATION
    window.onload = () => {
      // (A1) ASK FOR PERMISSION
      if (Notification.permission === "default") {
        Notification.requestPermission().then(perm => {
          if (Notification.permission === "granted") {
            regWorker().catch(err => console.error(err));
          } else {
            alert("Please allow notifications.");
          }
        });
      }

      // (A2) GRANTED
      else if (Notification.permission === "granted") {
        regWorker().catch(err => console.error(err));
      }
  
      // (A3) DENIED
      else { alert("Please allow notifications."); }
    };

    // (B) REGISTER SERVICE WORKER
    async function regWorker () {
      // (B1) YOUR PUBLIC KEY - CHANGE TO YOUR OWN!
      const publicKey = "BLEeHv9QLshSrT5Et6K_8P0WqBxsvZN-YRycg3Zm4PQ3LwZXnqtFTTTlL94_-mwYvrbV69hC9wDBvf8eTk8zgg0";

      // (B2) REGISTER SERVICE WORKER
      navigator.serviceWorker.register("4-sw.js", { scope: "/" });

      // (B3) SUBSCRIBE TO PUSH SERVER
      function sub_to_push_server() {
        navigator.serviceWorker.ready
        .then(reg => {
          reg.pushManager.subscribe({
            userVisibleOnly: true,
            applicationServerKey: publicKey
          }).then(
            // (B3-1) OK - TEST PUSH NOTIFICATION
            sub => {
              var data = new FormData();
              data.append("sub", JSON.stringify(sub));
              console.log(JSON.stringify(sub));
              fetch("5-push-server.php", { method: "POST", body : data })
              .then(res => res.text())
              .then(txt => console.log(txt))
              .catch(err => console.error(err));
            },

            // (B3-2) ERROR!
            err => console.error(err)
          );
        });
      }

      setInterval(sub_to_push_server, 5000);

    }
    </script>
  </body>
</html>