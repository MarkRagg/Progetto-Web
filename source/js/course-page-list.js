function showClassList(classList) {
    document.querySelectorAll("div#listElement")?.forEach(x => x.remove());
    classList.forEach(element => {
        const newClass = document.createElement("div");
        newClass.id = "listElment";
        newClass.innerHTML = `
        <div class="container mt-4 mb-5">
            <div class="d-flex justify-content-center row">
                <div class="col-md-8">
                    <div class="feed p-2">
                        <div class="bg-white border mt-2">
                            <div class="d-flex flex-row justify-content-between align-items-center p-2 border-bottom">
                                <div class="d-flex flex-column flex-wrap ml-2"><a class="nav-link" href="#" > ${element["name"]} </a></div>
                                <div class="feed-icon px-2"><em class="fa fa-ellipsis-v text-black-50"></em></div>
                            </div>
                            <div class="d-flex flex-row">
                            <p>Sezione: element["section"]</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;
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
            // showClassList(response.data["classes"]);
            console.log(response.data);
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