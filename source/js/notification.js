function showNotifications(notifications) {
  document.querySelectorAll("div#listElement")?.forEach(x => x.remove());
  notifications.forEach(element => {
    const html_string = getHtmlFromTipology(element["tipologia"] , element);
    const new_notification = document.createElement("div");
    new_notification.id = "list-element";
    new_notification.innerHTML = `
    <div class="container mt-5 mb-5 bg-light">
      <div class="row d-flex align-items-center">`
       + html_string +   
      `</div>
    </div> 
    `;

    main.appendChild(new_notification);
  });

} 

/**
 * It returns a different output depending on the tipology
 * @param {*} tipology tipology of notification
 * @param {*} element 
 * @returns 
 */
function getHtmlFromTipology(tipology, element) {
  switch(tipology) {
    case 1:
      html_string = `<p><a href="profile.php?username=${element["user_1_id"]}">@${element["user_1_id"]}</a> has followed you!</p>`;
      console.log(tipology);
      break;
    case 2:
      html_string = `<p><a href="profile.php?username=${element["user_1_id"]}">@${element["user_1_id"]}</a> has react your post!</p>`;
      break;
    case 3:
      html_string = `<p><a href="profile.php?username=${element["user_1_id"]}">@${element["user_1_id"]}</a> has comment your post!</p>`
      break;
    default:
      break;
  }

  return html_string;
}

const main = document.querySelector("main");
  axios.get("api-notification.php").then(response => {
    if (!response.data["new-notification"]) {
      // TODO error message
    } else {
      showNotifications(response.data["notification-list"]);
    }
  });