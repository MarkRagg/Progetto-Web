function showClassList(classList) {
    document.querySelectorAll(".listElement")?.forEach(x => x.remove());
    const classTable = document.createElement("div");
    classTable.classList = "listElement container";
    classTable.innerHTML = `
    <div class="row bg-white flex-row d-flex justify-content-center align-items-center p-3 m-3 rounded-3">
        <table class="table col-6">
            <thead>
                <tr>
                    <th id="name" scope="col">Nome</th>
                    <th id="section" scope="col">Sezione</th>
                    <th id="id" scope="col">Id</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    `;
    main.appendChild(classTable);
    const tbody = document.querySelector("tbody");
    classList.forEach(element => {
        const headId = element["nome"].toLowerCase().replaceAll(" ", "");
        const newClass = document.createElement("tr");
        newClass.innerHTML = `
        <th id="${headId}" headers="name" scope="row"><a href="class.php?class_id=${element["esame_id"]}">${element["nome"]}</a></th>
        <td headers="section ${headId}">${element["sezione"]}</td>
        <td headers="id ${headId}">${element["esame_id"]}</td>
        `;
        tbody.appendChild(newClass);
    });
}

function showSubscribers(subList) {
    document.querySelectorAll(".listElement")?.forEach(x => x.remove());
    subList.forEach(element => {
        const newSub = document.createElement("div");
        newSub.classList = "listElement";
        newSub.innerHTML = `
        <div class="container my-5 bg-white rounded-3 p-3">
            <div class="row">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <img src="${uploadDir}${element["user_image"]}" class="rounded-circle" width="20%" hight="20%" alt="">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <a class="h5" href="profile.php?username=${element["user_id"]}">${element["name"]} ${element["surname"]} @${element["user_id"]}</a> 
                    </div>
                </div>
            </div>
        </div>`;
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
const uploadDir = "../img/";

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