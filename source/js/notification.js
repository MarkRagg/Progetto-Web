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
      <button type="submit" data-toggle="button" class="btn btn-outline-danger m-1">Delete</button>
    </div> 
    `;
    updateBtn(element["user_2_id"], element["user_1_id"]);
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
if(element["post_id"] != null) {
  post_id = element["post_id"];
}

  switch(tipology) {
    case 1:
      html_string = `<div class="d-flex justify-content-between bd-highlight p-2">
        <p class="m-0"><a href="profile.php?username=${element["user_1_id"]}">@${element["user_1_id"]}</a> has followed you!</p>
        <button type="button" data-toggle="button" class="bottone follow_btn btn btn-outline-primary">Follow</button>
      </div>`;
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

function follow(user_followed, user_follower){
  const formData = new FormData();
  formData.append("user-followed", user_followed);
  formData.append("user-follower", user_follower);
  console.log("Entra");
  axios.post("api-notification.php", formData).then(response => {
    if(!response.data["new-notification"]) {
      if (!response.data["new-notification"]) {
        // TODO error message
      } else {
        showNotifications(response.data["notification-list"]);
        //post info to php
      }
    }
  });
}

function updateBtn(user_followed, user_follower) {
  const btn = document.querySelectorAll('.bottone');

  btn.forEach(elem => {
    //elem.classList.contains("follow_btn") ? elem.addEventListener('click',follow(user_followed, user_follower)) : elem.addEventListener('click',unfollow());
    if(elem.classList.contains("follow_btn")) {
      elem.addEventListener('click', function abstractFunct() {
        follow(user_followed, user_follower);
      });
    } else {
      elem.addEventListener('click',unfollow());
    }
  });
}

function unfollow() {

}

const main = document.querySelector("main");
  axios.get("api-notification.php").then(response => {
    if (!response.data["new-notification"]) {
      // TODO error message
    } else {
      showNotifications(response.data["notification-list"]);
      //post info to php
    }
  });
