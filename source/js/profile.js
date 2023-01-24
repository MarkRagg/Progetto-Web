function generateProfile(user_data) {
    let section = `
        <section>
            <div class="container">
                <img src="${user_data["user_image"]}" alt="immagine profilo"/>
            </div>
            <div class="container text-center">
                <div class="row">
                    <h1 class="col">${user_data["name"]} ${user_data["surname"]}</h1>
                </div>
                <div class="row">
                    <h2 class="col text-muted">${user_data["username"]}</h2>
                </div>
            </div>
            <div class="container text-center">
                <div class="row">
                    <ul class="list-group list-group-horizontal">
                        <li class="list-group-item col-6 h3">Data di nascita: ${user_data["date_of_birth"]}</li>
                        <li class="list-group-item col-6 h3">Residenza: ${user_data["uni_residence"]}</li>
                    </ul>
                </div>
                <div class="row">
                    <ul class="list-group list-group-horizontal">
                        <li class="col-4 list-group-item align-items-center h4"><a href="#">Post</a> <span class="badge bg-primary rounded-pill">14</span></li>
                        <li class="col-4 list-group-item align-items-center h4"><a href="#">Seguaci</a> <span class="badge bg-primary rounded-pill">14</span></li>
                        <li class="col-4 list-group-item align-items-center h4"><a href="#">Seguiti</a> <span class="badge bg-primary rounded-pill">14</span></li>
                    </ul>
                </div>
            </div>
        </section>
    `;
    return section;
}

function showProfile(user_data) {
    main.innerHTML = generateProfile(user_data);
}


const user = "test"; // deve essere preso dalla search bar
const main = document.querySelector("main");
axios.get("api-profile.php?username=" + user).then(response => {
    if (response.data["found"]) {
        console.log("User found");
        showProfile(response.data);
    } else {
        console.log("User not found");
        showError(response.data["errormsg"]);
    }
});