getParameter = (key) => {

  address = window.location.search

  parameterList = new URLSearchParams(address)

  return parameterList.get(key)
}

const classId = getParameter("class_id");
const main = document.querySelector("main");
const formData = new FormData();
formData.append("class_id", classId);
axios.post("api-class.php", formData).then(response => {
    console.log(response.data);
    if (response.data["success"]) {
        showPostList(response.data["posts"], false);
    } else {
        showErrorMsg(response.data["errormsg"]);
    }
});