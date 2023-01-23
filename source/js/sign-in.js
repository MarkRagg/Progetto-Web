function generateSuccesfullSignin(loginerror = null) {
  let form = `
  <section>
    <h1>Sign-in completed!</h1>
  </section>`;
  return form;
}

function generateError(loginerror = null) {
  let form = `
  <label class="text-danger">Nickname already existed! Retry.</label>`;
  return form;
}

function visualizeSuccess() {
  section = generateSuccesfullSignin();
  main.innerHTML = section;
}

function visualizeError() {
  error = generateError();
  main.innerHTML += error;
}

const main = document.querySelector("main");
console.log("ciao");
axios.get('Sign-in.php').then(response => {
    console.log(response);
    console.log(response.data["sign-in-result"]);
    if (response.data["sign-in-result"]) {
        // User Sign-in succesfully
        console.log("ciao");
        visualizeSuccess();
    } else {
        // Utente NON loggato
        visualizeError();
    }
});