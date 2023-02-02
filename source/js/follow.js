const followBtn = document.querySelector("button#followBtn");
const user_id = document.querySelector("h2").innerText;
const followClass = "btn-primary";
const unfollowClass = "btn-danger";
followBtn.addEventListener("click", function(event) {
    event.preventDefault();
    const formData = new FormData();
    formData.append("followed_id", user_id);
    if (followBtn.classList.contains(followClass)) {
        // User follows profile their veiwing
        formData.append("action", "follow");
        axios.post("api-follow.php", formData).then(response => {
            if (!response.data["success"]) {
                showErrorMsg(response.data["errormsg"]);
            } else {
                followBtn.classList.replace(followClass, unfollowClass);
                followBtn.innerText = "Non seguire";
            }
        });
    } else {
        formData.append("action", "unfollow");
        axios.post("api-follow.php", formData).then(response => {
            if (!response.data["success"]) {
                showErrorMsg(response.data["errormsg"]);
            } else {
                followBtn.classList.replace(unfollowClass, followClass);
                followBtn.innerText = "Segui";
            }
        });
    }
});