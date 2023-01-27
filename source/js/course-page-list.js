function showClassList(classList) {
    document.querySelectorAll("div#listElement")?.forEach(x => x.remove());
    classList.forEach(element => {
        const newClass = document.createElement("div");
        newClass.id = "listElement";
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

function showErrorMsg(errorMsg) {
    document.querySelectorAll("div#listElement")?.forEach(x => x.remove());
    let errorNode = document.createElement("div");
    errorNode.id = "listElement";
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
            // showSubscribers(response.data["subscribers"]);
            console.log(response.data);
        }
    });
}

const main = document.querySelector("main");
const classesLink = document.querySelector("a#classes");
const subscribersLink = document.querySelector("a#subscribers");
const linkSet = new Set([classesLink, subscribersLink]);
const courseId = document.querySelector("h2").innerText;

classesLink.addEventListener("click", function(event) {
    event.preventDefault();
    makeRequestAndEdit(courseId, "classes");
    // updateLinks(linkSet, classesLink);
});

subscribersLink.addEventListener("click", function(event) {
    event.preventDefault();
    makeRequestAndEdit(courseId, "subscribers");
    // updateLinks(linkSet, subscribersLink);
});