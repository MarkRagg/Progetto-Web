function generateForm(loginerror = null) {
  let form = `
  <section>
    <button type="button" disabled>Log in</button><button type="button" onclick="location.href='../php/index.php';">Sign in</button>
    <form action="../php/Login.php" method="POST">
    <ul>
      <li><label for="email">Email</label><input type="email" id ="email" name="email"/></li>
      <li><label for="password">Password</label><input type="password" id="password" name="password"/></li>
    </ul>
    <button type="submit">Next</button>
    <p class="text-danger"><p>
    </form>
  </section>
  `;
  return form;
}

function generateSuccesfullLogin(loginerror = null) {
  let form = `
  <section>
    <h1>Login completed!</h1>
  </section>`;
  return form;
}

function visualizeSuccess() {
  section = generateSuccesfullLogin();
  main.innerHTML = section;
}

const main = document.querySelector("main");
axios.get('api-login.php').then(response => {
    console.log("a");
    if (response.data["login-result"]) {
        // User Login succesfully
        visualizeSuccess();
    } else {
        VisualizeLoginForm();  
    }
});


function VisualizeLoginForm() {
  // Utente NON loggato
  let form = generateForm();
  main.innerHTML = form;
  // Gestisco tentativo di login
  document.querySelector("main form").addEventListener("submit", function (event) {
      event.preventDefault();
      const email = document.querySelector("#email").value;
      const password = document.querySelector("#password").value;
      login(email, password);
  });
}

function login(email, password) {
  const formData = new FormData();

  formData.append('email', email);
  formData.append('password', password);

  axios.post('api-login.php', formData).then(response => {
      if (response.data["login-result"]) {
        visualizeSuccess();
      } else {
        document.querySelector("form p").innerText = response.data["login-error"];
      }
  });
}
