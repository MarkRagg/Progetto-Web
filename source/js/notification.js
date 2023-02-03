function removeAllNotifications() {
  document.querySelectorAll("div.list-element")?.forEach(x => x.remove());
}

function showNotifications(response) {
  removeAllNotifications();
  response["notification-list"].forEach(element => {
    const html_string = getHtmlFromTipology(element["tipologia"] , element);
    const new_notification = document.createElement("div");
    new_notification.classList = "list-element";
    new_notification.innerHTML = `
    <div class="container mt-5 mb-5 bg-light onclick="window.location='http://google.com';""> 
      <div class="row d-flex align-items-center">`
      + html_string + 
      `</div>
      <button type="submit" data-toggle="button" class="delete-btn btn btn-outline-danger m-1">Delete</button>
    </div> 
    `;
    updateBtn(element["user_1_id"], response["following-list"], element["notifica_id"], element["post_id"], new_notification);
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
        <button type="button" data-toggle="button" class="follow-btn btn btn-outline-primary"></button>
      </div>`;
      break;
    case 2:
      html_string = `<div class="d-flex justify-content-between bd-highlight p-2">
      <p><a href="profile.php?username=${element["user_1_id"]}">@${element["user_1_id"]}</a> has react your post!</p>
      <button type="button" data-toggle="button" class="post-btn btn btn-outline-primary">Go into</button>
      </div>`;
      break;
    case 3:
      html_string = `<div class="d-flex justify-content-between bd-highlight p-2">
      <p><a href="profile.php?username=${element["user_1_id"]}">@${element["user_1_id"]}</a> has comment your post!</p>
      <button type="button" data-toggle="button" class="post-btn btn btn-outline-primary">Go into</button>
      </div>`;
      break;
    default:
      break;
  }

  return html_string;
}

function deleteNotification(notification_id) {
  const formData = new FormData();
  console.log(notification_id);
  formData.append("notification_id", notification_id);
  axios.post("api-remove-notification.php", formData).then(response => {
    if(!response.data["success"]) {
      console.log(response.data["errormsg"]);
    }
    axios.get("api-notification.php").then(response => {
      if (!response.data["new-notification"]) {
        removeAllNotifications();
      } else {
        showNotifications(response.data);
      }
    });
  });
}

/**
 * Add a new follower if bolean is true
 * else unfollow
 * @param {*} user_followed 
 * @param {*} user_follower 
 * @param {*} bolean 
 */
function followOrUnfollow(user_follower, action){
  const formData = new FormData();

  formData.append("followed_id", user_follower);
  formData.append("action", action);
  axios.post("api-follow.php", formData).then(response => {
    if(!response.data["success"]) {
      console.log(response.data["errormsg"]);
    }
    axios.get("api-notification.php").then(response => {
      if (!response.data["new-notification"]) {
        removeAllNotifications();
      } else {
        showNotifications(response.data);
      }
    });
  });
}

function addOrReplace(btn, class_to_add, class_to_replace) {
  if(btn.classList.contains(class_to_replace)) {
    btn.classList.replace(class_to_replace, class_to_add);
  } else {
    btn.classList.add(class_to_add);
  }
}

/**
 * Update event listener for follow button, delete-btn
 * and post button
 * @param {*} user_follower 
 * @param {*} following_list 
 */
function updateBtn(user_follower, following_list, notification_id, post_id, div) {
  console.log("entra");

  followBtn = div.querySelector(".follow-btn");
  if(followBtn != null) {
    if(!following_list.includes(user_follower)) {
      followBtn.innerText = "Follow";
      addOrReplace(followBtn, "btn-outline-primary", "btn-primary");
      followBtn.addEventListener('click', function abstractFunct() {
        followOrUnfollow(user_follower, "follow");
      });
    } else {
      followBtn.innerText = "Unfollow";
      addOrReplace(followBtn, "btn-primary", "btn-outline-primary");
      followBtn.addEventListener('click', function abstractFunct() {
        followOrUnfollow(user_follower, "unfollow");
      });
    }
  }

  goIntoBtn = div.querySelector(".post-btn");
  if(goIntoBtn != null) {
    goIntoBtn.addEventListener('click', function abstractFunct() {
      window.location.href= "../php/post-comment.php?post_id=" + post_id;
    });
  }

  deleteBtn = div.querySelector(".delete-btn");
  deleteBtn.addEventListener('click', function abstractFunct() {
    deleteNotification(notification_id);
  });
}

const main = document.querySelector("main");
  axios.get("api-notification.php").then(response => {
    if (!response.data["new-notification"]) {
      removeAllNotifications();
    } else {
      showNotifications(response.data);
    }
  });
