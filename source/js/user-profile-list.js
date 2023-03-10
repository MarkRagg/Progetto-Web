getParameter = (key) => {
    
    address = window.location.search
    
    parameterList = new URLSearchParams(address)
    
    return parameterList.get(key)
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
                showPostList(response.data["userPosts"], response.data["viewingLoggedUserPosts"]);
            }
        });
    }
}

const main = document.querySelector("main");
const followersLink = document.querySelector("a#followers");
const followingLink = document.querySelector("a#following");
const postsLink = document.querySelector("a#posts");
const profileUsername = getParameter("username");
const linkList = [postsLink, followersLink, followingLink];
const userImagePath = document.querySelector("img#profileImage").getAttribute("src");
followersLink.addEventListener("click", function(event) {
    event.preventDefault();
    makeRequestAndEdit(profileUsername, "followers");
    updateLinks(linkList, followersLink);
});
followingLink.addEventListener("click", function(event) {
    event.preventDefault();
    makeRequestAndEdit(profileUsername, "following");
    updateLinks(linkList, followingLink);
});
postsLink.addEventListener("click", function(event) {
    event.preventDefault();
    makeRequestAndEdit(profileUsername, "posts");
    updateLinks(linkList, postsLink);
});
makeRequestAndEdit(profileUsername, "posts");
updateLinks(linkList, postsLink);