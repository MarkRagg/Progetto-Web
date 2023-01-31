const subBtn = document.querySelector("button#subBtn");
const course_id = document.querySelector("h2").innerText;
const subClass = "btn-primary";
const unsubClass = "btn-danger";
subBtn.addEventListener("click", function(event) {
    event.preventDefault();
    const formData = new FormData();
    formData.append("course_id", course_id);
    if (subBtn.classList.contains(subClass)) {
        // User subscribes to course
        formData.append("action", "subscribe");
        axios.post("api-subscribe.php", formData).then(response => {
            if (!response.data["success"]) {
                showErrorMsg(response.data["errormsg"]);
            } else {
                subBtn.classList.replace(subClass, unsubClass);
                subBtn.innerText = "Annulla Iscrizione";
            }
        });
    } else {
        formData.append("action", "unsubscribe");
        axios.post("api-subscribe.php", formData).then(response => {
            if (!response.data["success"]) {
                showErrorMsg(response.data["errormsg"]);
            } else {
                subBtn.classList.replace(unsubClass, subClass);
                subBtn.innerText = "Iscriviti";
            }
        });
    }
});