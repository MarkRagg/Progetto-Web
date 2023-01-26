/**
 * Shows a list of users in the main section of html
 * @param {*} users The list of users to show
 */
function showUserList(users) {
    document.querySelectorAll("div#listElement")?.forEach(x => x.remove());
    users.forEach(element => {
        let newUser = document.createElement("div");
        newUser.innerHTML = `
        <div class="container mt-4 mb-5" id="listElement">
            <div class="d-flex justify-content-center row">
                <div class="col-md-8">
                    <div class="feed p-2">
                        <div class="bg-white border mt-2">
                            <div class="d-flex flex-row justify-content-between align-items-center p-2 border-bottom">
                                <div class="d-flex flex-row align-items-center feed-text px-2"><img src="${element["user_image"]}" width="50" height="50" alt=""/>
                                    <div class="d-flex flex-column flex-wrap ml-2"><a class="nav-link" href="profile.php?username=${element["follower_id"]}" > ${element["follower_id"]} </a></div>
                                </div>
                                <div class="feed-icon px-2"><em class="fa fa-ellipsis-v text-black-50"></em></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;
        main.appendChild(newUser);
    });
}
                        
/**
 * Shows a list of posts in the main section of html
 * @param {*} posts The list of posts to show
 */
function showPostList(posts) {
    document.querySelectorAll("div#listElement")?.forEach(x => x.remove());
    posts.forEach(element => {
        let newPost = document.createElement("div");
        newPost.innerHTML = `
            <div class="container mt-4 mb-5" id="listElement">
                <div class="d-flex justify-content-center row">
                    <div class="col-md-8">
                        <div class="feed p-2">
                            <div class="bg-white border mt-2">
                                <div>
                                    <div class="d-flex flex-row justify-content-between align-items-center p-2 border-bottom">
                                        <div class="d-flex flex-row align-items-center feed-text px-2"><img src="https://www.w3schools.com/html/workplace.jpg" width="50" height="50" alt=""/>
                                            <div class="d-flex flex-column flex-wrap ml-2"><a class="nav-link" href="profile.php?username=${element["author"]}" > ${element["author"]} </a></div>
                                        </div>
                                        <div class="feed-icon px-2"><em class="fa fa-ellipsis-v text-black-50"></em></div>
                                    </div>
                                </div>
                                <div class="p-2 px-3"><span>${element["string"]}</span></div>
                                <div class="d-flex justify-content-end socials p-2 py-3"><em class="fa fa-thumbs-up">LIKE</em><em class="fa fa-comments-o">COMMENTO</em><em class="fa fa-share">REACTION</em></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        main.appendChild(newPost);
    });
}

function showErrorMsg(errorMsg) {
    document.querySelectorAll("div#listElement")?.forEach(x => x.remove());
    let errorNode = document.createElement("div");
    errorNode.innerHTML = `
        <div id="listElement" class="bg-danger text-white border border-danger-subtle rounded-3 container-md">
            <h1 class="text-center">${errorMsg}</h1>
        </div>
    `;
    main.appendChild(errorNode);
}

/**
 * Makes a request to api-user-list.php and uses the result to populate the page
 * @param {string} username The username of the user of the current profile page
 * @param {string} requestedList The type of list requested either followers or following
*/
function makeRequestAndEdit(username, requestedList) {
    const formData = new FormData();
    formData.append("profileUsername", username);
    if (requestedList != "posts") {
        formData.append("requestedList", requestedList);
        axios.post("api-user-list.php", formData).then(response => {
            if (!response.data["success"]) {
                showErrorMsg(response.data["errormsg"]);
            } else {
                showUserList(response.data["userList"])
            }
        });
    } else {
        axios.post("api-show-user-posts.php", formData).then(response => {
            if (!response.data["success"]) {
                showErrorMsg(response.data["errormsg"]);
            } else {
                showPostList(response.data["userPosts"]);
            }
        });
    }
    // TODO show errormsg in case of error
}

const main = document.querySelector("main");
const followersLink = document.querySelector("a#followers");
const followingLink = document.querySelector("a#following");
const postsLink = document.querySelector("a#posts");
const profileUsername = document.querySelector("h2").innerText;
followersLink.addEventListener("click", function(event) {
    event.preventDefault();
    makeRequestAndEdit(profileUsername, "followers");
});
followingLink.addEventListener("click", function(event) {
    event.preventDefault();
    makeRequestAndEdit(profileUsername, "following");
});
postsLink.addEventListener("click", function(event) {
    event.preventDefault();
    makeRequestAndEdit(profileUsername, "posts");
});