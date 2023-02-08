getParameter = (key) => {
    
    address = window.location.search
    
    parameterList = new URLSearchParams(address)
    
    return parameterList.get(key)
}

function showClassList(classList) {
    if (classList.length > 0) {
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
    } else {
        showErrorMsg("Non sono presenti esami in questo corso");
    }
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
            showUserList(response.data["subscribers"]);
            console.log(response.data);
        }
    });
}

const main = document.querySelector("main");
const classesLink = document.querySelector("a#classes");
const subscribersLink = document.querySelector("a#subscribers");
const linkSet = new Set([classesLink, subscribersLink]);
const courseId = getParameter("course_id");
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