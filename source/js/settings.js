function showPage(response) {
  const form = `
    <div class="d-flex justify-content-center align-middle">
      <div class="flex-column border">
        <div class="p-5">
          <div class="row p-2">
            <div class="col-6">
              <label for="bio">Bio</label>
            </div>
            <div class="col-6">
              <textarea id="bio" name="bio" rows="5" cols="30">${response["bio"]}</textarea>
            </div>
          <div class="w-100 p-2"></div>
            <div class="col-6">
              <label for="user_image">Profile image</label>
            </div>
            <div class="col-6">
              <input type="file" name="user_image" id="user_image" />
            </div>
          <div class="w-100 p-2"></div>
            <div class="col-6">
              <label for="course">Course</label>
            </div>
            <div class="col-6">
              <select id="course" name="course" class="d-flex justify-content-end">
                <option value="Example">Example</option>
              </select>
            </div>
          </div>
          <hr/>
          <div class="d-flex justify-content-end">
            <button type="submit" data-toggle="button" class="btn btn-outline-primary" id="apply_changes">Save</button>
          </div>
       </div> 
      </div>
    </div>
  `;
  main.innerHTML = form;
}

function saveChanges(bio, img, course, user_id) {
  var formData = new FormData();
  formData.append("bio", bio);
  formData.append("img", img); 
  formData.append("course", course);

  axios.post('api-save-settings.php', formData).then(response => {
    if(response.data["success"]) {
      window.location.href = "../php/profile.php?username=" + user_id;
    } else {
      //TODO
    }
  });
}

function updateButton(user_id) {
  document.querySelector("#apply_changes").addEventListener('click', function (event) {
    event.preventDefault();
    const bio = document.querySelector("#bio").value;
    const img = document.querySelector("#user_image") != null ? document.querySelector("#user_image").files[0] : null;
    const course = document.querySelector("#course").value;
    saveChanges(bio, img, course, user_id);
  });
}

const main = document.querySelector("main");
axios.get("api-get-current-settings.php").then(response => {
  if(response.data["logged"]) {
    console.log(response.data);
    showPage(response.data);
    updateButton(response.data["user_id"]);
  } else {
    console.log(response.data["errormsg"]);
  }
});