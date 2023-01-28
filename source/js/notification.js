function showNotifications(notifications) {
  document.querySelectorAll("div#listElement")?.forEach(x => x.remove());
  notifications.forEach(element => {
    const new_notification = document.createElement("div");
    new_notification.id = "list-element";
    new_notification.innerHTML = `
    <h2>${element["user_1_id"]}</h2>
    `;
    main.appendChild(new_notification);
  });

} 


const main = document.querySelector("main");
  axios.get("api-notification.php").then(response => {
    if (!response.data["new-notification"]) {
      // TODO error message
    } else {
      showNotifications(response.data["notification-list"]);
    }
  });