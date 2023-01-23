function generateForm(loginerror = null) {
  let form = `
  <section>
    <button type="button" onclick="location.href='../php/Login.php';">Log in</button><button type="button" disabled>Sign in</button>
    <form action="../php/Sign-in.php" method="POST">
    <ul>
      <li><label for="nickname">Nickname</label><input type="text" id="nickname" name="nickname"/></li>
      <li><label for="email">Email</label><input type="email" id ="email" name="email"/></li>
      <li><label for="password">Password</label><input type="password" id="password" name="password"/></li>
      <li><label for="name">Name</label><input type="text" id="name" name="name"/></li>
      <li><label for="surname">Surname</label><input type="text" id="surname" name="surname"/></li>
      <li><label for="date">Date</label><input type="date" id="date" name="date"/></li>
      <li><label for="residence">Residence</label>
        <select id="residence" name="residence">
          <option value="Example">Example</option>
          </select>
        </li>
    </ul>
    <button type="submit">Register</button>
    <p class="text-danger"></p>
    </form>
  </section>
  `;
  return form;
}

function generateSuccesfullSignin(loginerror = null) {
  let form = `
  <section>
    <h1>Sign-in completed!</h1>
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
        VisualizeSigninForm();  
    }
});


function VisualizeSigninForm() {
  // Utente NON loggato
  let form = generateForm();
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
