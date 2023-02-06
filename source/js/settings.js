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
              <input type="file" name="user_image" id="user_img" />
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
            <button type="submit" data-toggle="button" class="btn btn-outline-primary">Save</button>
          </div>
       </div> 
      </div>
    </div>
  `;
  main.innerHTML = form;
}

const main = document.querySelector("main");
  axios.get("api-get-current-settings.php").then(response => {
    if(response.data["logged"]) {
      showPage(response.data);
    } else {
      console.log(response.data["errormsg"]);
    }
  });