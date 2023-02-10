function generateOptions(cities) {
  options = ``;
  cities.forEach(element => {
    options += `<option value='${element}'>${element}</option>`;
  });

  return options;
}

function generateForm(cities) {
  city_options = generateOptions(cities);
  let form = `
  <div class="container text-center p-5">
    <h1 class="text-primary">Sign-in</h1>
  </div>
  <section>
    <div class="d-flex justify-content-center align-middle">
      <div class="flex-column border">
        <div class="p-5">
          <div class="pb-2 text-center">
            <button class="btn btn-primary mx-2" data-toggle="button" aria-pressed="false" type="button" onclick="location.href='../php/Login.php';">Log in</button><button type="button" class="btn btn-primary mx-2" data-toggle="button" aria-pressed="true" disabled>Sign in</button>
          </div>
            <form action="../php/Sign-in.php" method="POST">
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><label for="nickname"">Nickname</label><input type="text" class="d-flex justify-content-end" id="nickname" name="nickname"/></li>
            <li class="list-group-item"><label for="email">Email</label><input type="email" class="d-flex justify-content-end" id ="email" name="email"/></li>
            <li class="list-group-item"><label for="password">Password</label><input type="password" class="d-flex justify-content-end" id="password" name="password"/></li>
            <li class="list-group-item"><label for="name">Nome</label><input type="text" class="d-flex justify-content-end" id="name" name="name"/></li>
            <li class="list-group-item"><label for="surname">Cognome</label><input type="text" class="d-flex justify-content-end" id="surname" name="surname"/></li>
            <li class="list-group-item"><label for="date">Data nascita</label><input type="date" class="d-flex justify-content-end" id="date" name="date" required/></li>
            <li class="list-group-item"><label for="residence">Residenza</label>
              <select id="residence" class="d-flex justify-content-end" name="residence" required>`
                + city_options +
              `</select>
              </li>
          </ul>
          <hr/>
          <div class="d-flex justify-content-end">
            <button type="submit" data-toggle="button" class="btn btn-outline-primary">Registrati</button>
          </div>
          <p class="text-danger"></p>
          </form>
        </div>
      </div>
    </div>
  </section>
  `;
  return form;
}

function generateSuccesfullSignin(loginerror = null) {
  let form = `
  <section>
  <div class="container text-center p-5">
    <h1 class="text-primary">Sign-in completed!</h1>
  </div>
  <div class="d-flex justify-content-center align-middle">
    <button type="button" class="btn btn-outline-primary" onclick="location.href='../php/Login.php';">Log in</button>
  </div>
  </section>`;
  return form;
}

function visualizeSuccess() {
  section = generateSuccesfullSignin();
  main.innerHTML = section;
}

const main = document.querySelector("main");
axios.get('Sign-in.php').then(response => {
    if (response.data["sign-in-result"]) {
        // User Sign-in succesfully
        visualizeSuccess();
    } else {
        // Utente NON loggato
        VisualizeSigninForm(response.data["cities"]);  
    }
});


function VisualizeSigninForm(cities) {
  // Utente NON loggato
  let form = generateForm(cities);
  main.innerHTML = form;
  // Gestisco tentativo di login
  document.querySelector("main form").addEventListener("submit", function (event) {
      event.preventDefault();
      const nickname = document.querySelector("#nickname").value;
      const email = document.querySelector("#email").value;
      const name = document.querySelector("#name").value;
      const surname = document.querySelector("#surname").value;
      const password = document.querySelector("#password").value;
      const date = document.querySelector("#date").value;
      const residence = document.querySelector("#residence").value;
      signin(nickname, email, name, surname, password, date, residence);
  });
}

function signin(nickname, email, name, surname, password, date, residence) {
  const formData = new FormData();

  formData.append('nickname', nickname);
  formData.append('email', email);
  formData.append('name', name);
  formData.append('surname', surname);
  formData.append('date', date);
  formData.append('password', password);
  formData.append('residence', residence);

  axios.post('Sign-in.php', formData).then(response => {
      if (response.data["sign-in-result"]) {
        visualizeSuccess();
      } else {
        document.querySelector("form > p").innerText = response.data["text-error"];
      }
  });
}
