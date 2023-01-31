function showClassList(classList) {
    document.querySelectorAll("div.listElement")?.forEach(x => x.remove());
    classList.forEach(element => {
        const newClass = document.createElement("div");
        newClass.classList = "listElement";
        newClass.innerHTML = `
        <div class="container bg-light border rounded-3 text-center">
            <div class="row border">
                <div class="col">
                    <h1>${element["nome"]}</h1>
                </div>
            </div>
            <div class="row border">
            <table class="table table-info text-center">
                <thead>
                    <tr><th scope="column">Id</th><th scope="column">Sezione</th></tr>
                </thead>
                <tbody>
                    <td>${element["corso_id"]}</td><td>${element["sezione"]}</td>
                </tbody>
            </table>
            </div>
        </div>
        `;
        main.appendChild(newClass);
    });
}

function showSubscribers(subList) {
    document.querySelectorAll("div.listElement")?.forEach(x => x.remove());
    subList.forEach(element => {
        const newSub = document.createElement("div");
        newSub.classList = "listElement";
        newSub.innerHTML = `
        <div class="container mt-4 mb-5">
            <div class="d-flex justify-content-center row">
                <div class="col-md-8">
                    <div class="feed p-2">
                        <div class="bg-white border mt-2">
                            <div class="d-flex flex-row justify-content-between align-items-center p-2 border-bottom">
                                <div class="d-flex flex-row align-items-center feed-text px-2"><img src="${element["user_image"]}" width="50" height="50" alt=""/>
                                    <div class="d-flex flex-column flex-wrap ml-2"><a class="nav-link" href="profile.php?username=${element["user_id"]}" > ${element["user_id"]} </a></div>
                                </div>
                                <div class="feed-icon px-2"><em class="fa fa-ellipsis-v text-black-50"></em></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;
        main.appendChild(newSub);
    });
}

function showErrorMsg(errorMsg) {
    document.querySelectorAll("div.listElement")?.forEach(x => x.remove());
    let errorNode = document.createElement("div");
    errorNode.classList = "listElement";
    errorNode.innerHTML = `
        <div class="bg-danger text-white border border-danger-subtle rounded-3 container-md">
            <h1 class="text-center">${errorMsg}</h1>
        </div>
    `;
    main.appendChild(errorNode);
}

/**
 * 
 * @param {string} courseId 
 * @param {string} requestedList 
 */
function makeRequestAndEdit(courseId, requestedList) {
    const formData = new FormData();
    formData.append("courseId", courseId);
    formData.append("requestedList", requestedList);
    axios.post("api-course-list.php", formData).then(response => {
        if (!response.data["success"]) {
            showErrorMsg(response.data["errormsg"]);
        } else if (requestedList == "classes") {
            showClassList(response.data["classes"]);
        } else {
            showSubscribers(response.data["subscribers"]);
            console.log(response.data);
        }
    });
}

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
const classesLink = document.querySelector("a#classes");
const subscribersLink = document.querySelector("a#subscribers");
const linkSet = new Set([classesLink, subscribersLink]);
const courseId = document.querySelector("h2").innerText;

classesLink.addEventListener("click", function(event) {
    event.preventDefault();
    makeRequestAndEdit(courseId, "classes");
    updateLinks(linkSet, classesLink);
});

subscribersLink.addEventListener("click", function(event) {
    event.preventDefault();
    makeRequestAndEdit(courseId, "subscribers");
    updateLinks(linkSet, subscribersLink);
});