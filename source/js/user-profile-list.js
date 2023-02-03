/**
 * Shows a list of users in the main section of html
 * @param {*} users The list of users to show
 */
function showUserList(users) {
    document.querySelectorAll("div.listElement")?.forEach(x => x.remove());
    users.forEach(element => {
        const newUser = document.createElement("div");
        newUser.classList = "listElement";
        newUser.innerHTML = `
        <div class="container mt-4 mb-5 bg-white rounded-3">
            <div class="row">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <img src="${element["user_image"]}" class="rounded-circle" width="20%" hight="20%" alt="">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <a class="h5" href="profile.php?username=${element["username"]}">${element["name"]} ${element["surname"]} @${element["username"]}</a> 
                    </div>
                </div>
            </div>
        </div>`;
        main.appendChild(newUser);
    });
}
                        
/**
 * Shows a list of posts in the main section of html
 * @param {*} posts The list of posts to show
 */
function showPostList(posts) {
    document.querySelectorAll("div.listElement")?.forEach(x => x.remove());
    posts.forEach(element => {
        const newPost = document.createElement("div");
        newPost.classList = "listElement";
        newPost.innerHTML = `
        <div class="container mt-5 mb-5">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="d-flex justify-content-between p-2 px-3">
                            <div class="d-flex flex-row align-items-center"> <img src="https://www.w3schools.com/html/workplace.jpg" width="50" class="rounded-circle">
                                <div class="d-flex flex-column ml-2"> <a class="nav-link" href="profile.php?username=${element["author"]}">${element["author"]}</a> 
                                    <small class="text-primary">LINK AL CORSO/ESAME OPPURE NIENTE</small> 
                                </div>
                            </div>
                            <div class="d-flex flex-row mt-1 ellipsis"> <small class="mr-2">${element["data"]}</small> <i class="fa fa-ellipsis-h"></i> </div>
                        </div>
                        <div class="p-2">
                            <p class="text-justify">${element["string"]}</p>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-row muted-color">
                                <button id="bottone">Like</button>
                                </div>
                            </div>
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
    document.querySelectorAll("div.listElement")?.forEach(x => x.remove());
    const errorNode = document.createElement("div");
    errorNode.classList = "listElement";
    errorNode.innerHTML = `
        <div class="bg-danger text-white border border-danger-subtle rounded-3 container-md">
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
}

// For every element removes all classes and changes the badge color to blue 
function deactivateAll(listElements) {
    listElements.forEach(x => {
        x.parentElement.classList.replace("bg-dark", "bg-light");
        x.classList.replace("link-light", "link-dark");
        x.classList.remove("disabled");
        x.nextElementSibling.classList.replace("bg-light", "bg-dark");
        x.nextElementSibling.classList.replace("text-dark", "text-light");
    });
}

function activateElement(toActivate) {
    toActivate.parentElement.classList.remove("bg-light");
    toActivate.parentElement.classList.add("bg-dark");
    toActivate.classList.replace("link-dark", "link-light");
    toActivate.classList.add("disabled");
    toActivate.nextElementSibling.classList.replace("bg-dark", "bg-light");
    toActivate.nextElementSibling.classList.remove("text-light");
    toActivate.nextElementSibling.classList.add("text-dark");
}

function updateLinks(listElements, currentLink) {
    deactivateAll(listElements);
    activateElement(currentLink);
}

const main = document.querySelector("main");
const followersLink = document.querySelector("a#followers");
const followingLink = document.querySelector("a#following");
const postsLink = document.querySelector("a#posts");
const profileUsername = document.querySelector("h2").innerText;
const linkList = [postsLink, followersLink, followingLink];
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