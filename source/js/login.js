function generateForm(loginerror = null) {
  let form = `
  <div class="container text-center p-5">
    <h1 class="text-primary">Login</h1>
  </div>
  <section>
    <div class="d-flex justify-content-center align-middle">
      <div class="flex-column border">
        <div class="p-5">
          <div class="pb-2 text-center">
            <button type="button" class="btn btn-primary mx-2" data-toggle="button" aria-pressed="true" disabled>Log in</button><a class="btn btn-primary mx-2" data-toggle="button" aria-pressed="false" href='../php/index.php'>Sign in</a>
          </div>
          <form action="../php/Login.php" method="POST">
          <ul class="list-unstyled">
            <li class="pl-1"><label for="email">Email</label></li>
            <li class="pb-1"><input type="email" id ="email" name="email"/></li>
            <li class="ptl-1"><label for="password">Password</label></li>
            <li><input type="password" id="password" name="password"/></li>
          </ul>
          <hr/>
          <div class="d-flex justify-content-end">
            <button type="submit" data-toggle="button" class="btn btn-outline-primary">Accedi</button>
          </div>
          <p class="text-danger m-0" id="error-text"></p>
          </form>
       </div> 
      </div>
    </div>
  </section>
  `;
  return form;
}

const main = document.querySelector("main");
axios.get('api-login.php').then(response => {
    if (!response.data["login-result"]) {
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
        window.location.href = "../php/showhomepage.php";
      } else {
        document.getElementById("error-text").innerText = response.data["login-error"];
      }
  });
}
