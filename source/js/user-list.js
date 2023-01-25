/**
 * Shows a list of users in the main section of html
 * @param {*} users The list of users to show
 */
function showUserList(users) {
    document.getElementById("list")?.remove();
    users.forEach(element => {
        let newUser = document.createElement("div");
        newUser.innerHTML = `
        <div class="container mt-4 mb-5" id="list">
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
 * Makes a request to api-user-list.php and uses the result to populate the page
 * @param {string} username The username of the user of the current profile page
 * @param {string} requestedList The type of list requested either followers or following
 */
function makeRequestAndEdit(username, requestedList) {
    const formData = new FormData();
    formData.append("profileUsername", username);
    formData.append("requestedList", requestedList);
    axios.post("api-user-list.php", formData).then(response => {
        // TODO show errormsg in case of error
        showUserList(response.data["userList"])
    });
}

const main = document.querySelector("main");
const followersLink = document.querySelector("a#followers");
const followingLink = document.querySelector("a#following");
const profileUsername = document.querySelector("h2").innerText;
console.log(followersLink);
console.log(followingLink);
followersLink.addEventListener("click", function(event) {
    event.preventDefault();
    makeRequestAndEdit(profileUsername, "followers");
});
followingLink.addEventListener("click", function(event) {
    event.preventDefault();
    makeRequestAndEdit(profileUsername, "following");
});