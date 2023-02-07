function generateOptions(values, selected, category) {
  let options = ``;
  let add_selected = ``;
  values.forEach(element => {
    add_selected = ``;
    if(category == "uni") {
      if(selected == element["uni_id"]) {
        add_selected = `selected='selected'`;
      }
      options += `<option value='${element["uni_id"]}' ` + add_selected + `>${element["nome"]}</option>`;
    } else if (category == "course") {
      if(selected == element["corso_id"]) {
        add_selected = `selected='selected'`;
      }
      options += `<option value='${element["corso_id"]}' ` + add_selected + `>${element["nome"]}</option>`;
    }
  });
  return options;
}

function showPage(response_settings, response_select) {
  uni_options = generateOptions(response_settings["unis"], response_select["uni-selected"],"uni");
  course_options = generateOptions(response_select["courses"], 1, "course");
  let form = `
    <div class="d-flex justify-content-center align-middle">
      <div class="flex-column border">
        <div class="p-5">
          <div class="row p-2">
            <div class="col-6">
              <label for="bio">Bio</label>
            </div>
            <div class="col-6">
              <textarea id="bio" name="bio" rows="5" cols="30">${response_settings["bio"]}</textarea>
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
            <div class="col-3">
              <select id="uni" name="uni" class="d-flex justify-content-end">`
                + uni_options + 
              `</select>
            </div>
            <div class="col-3">
              <select id="course" name="course" class="d-flex justify-content-end">`
                + course_options +
              `</select>
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
  formData.append("course_id", course);

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

function updateSelect(response_settings) {
  var formData = new FormData();
  select = document.querySelector("#uni");
  select.addEventListener('change', function abstractFunction() {
    formData.append("uni-selected", select.value);
    axios.post("api-selector-controller.php", formData).then(response_selector => {
      showPage(response_settings.data, response_selector.data);
      updateButton(response_settings.data["user_id"]);
      updateSelect(response_settings);
    });
  });
}

const main = document.querySelector("main");
axios.get("api-get-current-settings.php").then(response_settings => {
  axios.get("api-selector-controller.php").then(response_selector => {
    if(response_settings.data["logged"]) {
      showPage(response_settings.data, response_selector.data);
      updateButton(response_settings.data["user_id"]);
      updateSelect(response_settings);
    } else {
      console.log(response_settings.data["errormsg"]);
    }
  });
});