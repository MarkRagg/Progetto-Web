/**
 * Shows a list of posts in the main section of html
 * @param {*} posts The list of posts to show
 */
function showPostList(posts) {
    document.querySelectorAll("div.listElement")?.forEach(x => x.remove());
    let i = 0;
    posts.forEach(element => {
        let esame = "";
        let img = "";
        if (element["esame_id"] != null) {
            esame = `<a href="class.php?class_id=${element["esame_id"]}">${element["nome"]}</a>`;
        }
        if (element["immagine"] != null) {
            img = `<img src="${uploadDir}${element["immagine"]}" alt="" class="img-fluid">`;
        }
        const newPost = document.createElement("div");
        newPost.classList = "listElement";
        newPost.innerHTML = `
        <div class="container mb-5">
            <div class="row flex-row d-flex justify-content-center align-items-center bg-white p-3 m-3 rounded-3">
                <div class="col d-flex justify-content-between p-2 px-3">
                    <div class="d-flex flex-row align-items-center">
                        <img src="${uploadDir}${element["user_image"]}" width="50" class="rounded-circle" alt="">
                        <div class="d-flex flex-column ml-2">
                            <a class="nav-link" href="profile.php?username=${element["author"]}">@${element["author"]}</a>
                            ${esame}
                        </div>
                    </div>
                    <div class="d-flex flex-row mt-1 ellipsis">
                        <small class="mr-2">${element["data"]}</small>
                        <em class="fa fa-ellipsis-h"></em>
                    </div>
                    </div>
                    <div class="px-4 mt-3 mb-3">
                    ${img}
                <p class="text-justify">${element["string"]}.</p>
              </div>
              <div class="d-flex align-items-center mt-4">
                <button id="bottoneLikePost${i}" class="bottone bottoneL btn btn-outline-danger position-relative me-2 ms-4 "><em class="bi bi-hand-thumbs-up"></em>
                  <span class="numeroLike position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    id="numeroLikePost${i}">
                    ${element["num_like"]}
                  </span>
                </button>

                <button id="bottoneCommentPost${i}" class="btn btn-outline-danger position-relative me-2 ms-2 " onclick="location.href='../php/post-comment.php?post_id=${element["post_id"]}';"><em class="bi bi-chat-left-text-fill"></em>
                  <span class="numeroCommento position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    id="numeroCommentiPost${i}">
                    ${element["num_comments"]}
                  </span>
                </button>

                <button id="bottoneFirePost${i}" class="btnFire btnFireL btn btn-outline-danger position-relative me-2 ms-2 "><em class="bi bi-fire"></em>
                  <span class="numeroFire position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    id="numeroFirePost${i}">
                    ${element["num_fire"]}
                  </span>
                </button>

                <button class="btnSmile btnSmileL btn btn-outline-danger position-relative me-2 ms-2 "><em class="bi bi-emoji-smile-upside-down"></em>
                  <span class="numeroSmile position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    id="numeroSmilePost${i}">
                    ${element["num_smile"]}
                  </span>
                </button>

                <button class="btnCuore btnCuoreL btn btn-outline-danger position-relative me-2 ms-2 "><em class="bi bi-heart-fill"></em>
                  <span class="numeroCuore position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    id="numeroCuoriPost${i}">
                    ${element["num_cuore"]}
                  </span>
                </button>
                <button  class="btnBacio btn btn-outline-danger position-relative me-2 ms-2 "><em class="bi bi-emoji-kiss"></em>
                  <span class="numeroBacio position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    id="numeroBaciPost${i}">
                    ${element["num_baci"]}
                  </span>
                </button>
              </div>
            </div>
            </div>
        `;
        main.appendChild(newPost);
        updateButton(posts, btnLike, numeroLike, 1, -1, "btnlkd");
        updateButton(posts, btnFire, numeroFire, 2, -2, "btnFireLkd");
        updateButton(posts, btnSmile, numeroSmile, 3, -3, "btnSmileLkd");
        updateButton(posts, btnCuore, numeroCuore, 4, -4, "btnCuoreLkd");
        i++;
    });
}

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
        <div class="container mt-4 mb-5 bg-white rounded-3 p-3">
            <div class="row">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <img src="${uploadDir}${element["user_image"]}" class="rounded-circle" width="50" hight="50" alt="">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <a href="profile.php?username=${element["username"]}">${element["name"]} ${element["surname"]} @${element["username"]}</a> 
                    </div>
                </div>
            </div>
        </div>`;
        main.appendChild(newUser);
    });
}

function showErrorMsg(errorMsg) {
    document.querySelectorAll("div.listElement")?.forEach(x => x.remove());
    const errorNode = document.createElement("div");
    errorNode.classList = "listElement";
    errorNode.innerHTML = `
        <div class="bg-danger text-white border border-danger-subtle rounded-3 container-md my-5">
            <p class="text-center">${errorMsg}</p>
        </div>
    `;
    main.appendChild(errorNode);
}

function deactivateAll(listElements) {
    listElements.forEach(x => {
        x.parentElement.classList.replace("bg-primary", "bg-light");
        x.classList.replace("link-light", "link-primary");
        x.classList.remove("disabled");
        x.nextElementSibling.classList.replace("bg-light", "bg-primary");
        x.nextElementSibling.classList.replace("text-primary", "text-light");
    });
}

function activateElement(toActivate) {
    toActivate.parentElement.classList.remove("bg-light");
    toActivate.parentElement.classList.add("bg-primary");
    toActivate.classList.replace("link-primary", "link-light");
    toActivate.classList.add("disabled");
    toActivate.nextElementSibling.classList.replace("bg-primary", "bg-light");
    toActivate.nextElementSibling.classList.replace("text-light", "text-primary");
}

function updateLinks(listElements, currentLink) {
    deactivateAll(listElements);
    activateElement(currentLink);
}
