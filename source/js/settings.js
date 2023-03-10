function generateOptions(values, selected, category) {
  let options = `<option value='0'></option>`;
  let add_selected = ``;
  if(values == null && category == 'course') {
    return options;
  }
  if(category != 'uni') {
    options = ``;
  }
  values.forEach(element => {
    add_selected = ``;
    switch (category) {
      case 'uni':
        if(selected == element["uni_id"]) {
          add_selected = `selected='selected'`;
        }
        options += `<option value='${element["uni_id"]}' ` + add_selected + `>${element["nome"]}</option>`;
        break;
      case 'course':
        if(selected == element["corso_id"]) {
          add_selected = `selected='selected'`;
        }
        options += `<option value='${element["corso_id"]}' ` + add_selected + `>${element["nome"]}</option>`;
        break;
      case 'residence':
        if(selected == element) {
          add_selected = `selected='selected'`;
        }
        options += `<option value='${element}' ` + add_selected + `>${element}</option>`;
        break;
    }
  });
  return options;
}

function showPage(response_settings, response_select) {
  uni_options = generateOptions(response_select["unis"], response_select["uni-selected"],"uni");
  course_options = generateOptions(response_select["courses"], 1, "course");
  residence_options = generateOptions(response_settings["cities"], response_settings["current-residence"], "residence");
  let form = `
    <div class="container justify-content-center align-middle ">
      <div class="p-lg-5 mb-5 bg-light">
        <div class="row p-2">
          <div class="col-sm-6">
            <label for="bio">Descrizione</label>
          </div>
          <div class="col-sm-6">
            <textarea id="bio" name="bio" rows="5" cols="30">${response_settings["bio"]}</textarea>
          </div>
        <div class="w-100 p-2"></div>
          <div class="col-sm-6">
            <label for="user_image">Immagine profilo</label>
          </div>
          <div class="col-sm-6">
            <input type="file" name="user_image" id="user_image" class="form-control" />
          </div>
        <div class="w-100 p-2"></div>
          <div class="col-sm-6">
            <label for="course">Corso</label>
          </div>
          <div class="col-sm-3">
            <select id="uni" name="uni" class="justify-content-end">`
              + uni_options + 
            `</select>
          </div>
          <div class="col-sm-3">
            <select id="course" name="course" class="justify-content-end">`
              + course_options +
            `</select>
          </div>
          <div class="w-100 p-2"></div>
          <div class="col-sm-6">
            <label for="residence">Residenza</label>
          </div>
          <div class="col-sm-6">
            <select id="residence" name="Residence" class="justify-content-end">`
              + residence_options +
            `</select>
          </div>
          <div class="w-100 p-2"></div>
          <div class="col-sm-6">
            <label for="passw">Password</label>
          </div>
          <div class="col-sm-6">
            <input type="password" id="passw" name="passw" class="justify-content-end" />
          </div>
        </div>
        <hr/>
        <div class="flex d-flex justify-content-between">
          <p class="text-danger" id="errormsg"></p>
          <button type="submit" data-toggle="button" class="btn btn-outline-primary" id="apply_changes">Salva</button>
        </div>
      </div> 
    </div>
  `;
  main.innerHTML = form;
}

function showErrorMsg(errormsg) {
  p = document.querySelector("#errormsg");
  p.innerText = errormsg;
}

function saveChanges(bio, img, course, user_id, residence, password) {
  var formData = new FormData();
  formData.append("bio", bio);
  formData.append("img", img); 
  formData.append("course_id", course);
  formData.append("residence", residence);
  formData.append("password", password);

  select = document.querySelector("#uni");

  axios.post('api-save-settings.php', formData).then(response => {
    if(response.data["success"]) {
      window.location.href = "../php/profile.php?username=" + user_id;
    } else {
      showErrorMsg(response.data["errormsg"]);
    }
  });
}

function updateButton(user_id) {
  document.querySelector("#apply_changes").addEventListener('click', function (event) {
    event.preventDefault();
    const bio = document.querySelector("#bio").value;
    const img = document.querySelector("#user_image") != null ? document.querySelector("#user_image").files[0] : null;
    const course = document.querySelector("#course").value;
    const residence = document.querySelector("#residence").value;
    const password = document.querySelector("#passw").value;

    saveChanges(bio, img, course, user_id, residence, password);
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
      window.location.href = "../php/index.php";
    }
  });
});