function showNotifications(response) {
  document.querySelectorAll("div.list-element")?.forEach(x => x.remove());
  response["notification-list"].forEach(element => {
    const html_string = getHtmlFromTipology(element["tipologia"] , element);
    const new_notification = document.createElement("div");
    new_notification.classList = "list-element";
    new_notification.innerHTML = `
    <div class="container mt-5 mb-5 bg-light">
      <div class="row d-flex align-items-center">`
       + html_string +   
      `</div>
      <button type="submit" data-toggle="button" class="btn btn-outline-danger m-1">Delete</button>
    </div> 
    `;
    updateBtn(element["user_1_id"], response["following-list"]);
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
        <button type="button" data-toggle="button" class="bottone btn btn-outline-primary"></button>
      </div>`;
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
        // TODO error message
      } else {
        showNotifications(response.data);
        //post info to php
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

function updateBtn(user_follower, following_list) {
  document.querySelectorAll('.bottone')?.forEach(elem => {
    if(!following_list.includes(user_follower)) {
      elem.innerText = "Follow";
      addOrReplace(elem, "btn-outline-primary", "btn-primary");
      elem.addEventListener('click', function abstractFunct() {
        followOrUnfollow(user_follower, "follow");
      });
    } else {
      elem.innerText = "Unfollow";
      addOrReplace(elem, "btn-primary", "btn-outline-primary");
      elem.addEventListener('click', function abstractFunct() {
        followOrUnfollow(user_follower, "unfollow");
      });
    }
  });
}

const main = document.querySelector("main");
  axios.get("api-notification.php").then(response => {
    if (!response.data["new-notification"]) {
      // TODO error message
    } else {
      showNotifications(response.data);
      //post info to php
    }
  });
