function generatePost(post_data) {
  let section = `
    <div class="row">
      <div class="col-12 col-lg-3">
        <div class="left-column">
          <div class="card card-left1 mb-4">
            <div class="card-body text-center ">
              <img src="" alt="immagine profilo" width="120" height="120" class="rounded-circle mt-n5" id="profile_picture">
              <p id="nome_utente" class="card-title">  </p>
              <p class="card-text text-justify mb-2" id="descrizione"></p>
            </div>
          </div>
          <div class="card shadow-sm card-left2 mb-4">
            <div class="card-body">
              <h5 class="mb-3 card-title">Tue informazioni: <small><a href="../php/settings.php" class="ml-1">CAMBIA</a></small></h5>
              <p class="card-text">  Studi a: <a href="#"
                  class="text-decoration-none" id="universita"></a></p>
              <p class="card-text">  Che cosa studi? <a href="#"
                  class="text-decoration-none" id="corso"></a></p>
              <p class="card-text" id="residenza">Residenza: </p>
            </div>
          </div>
        </div>
      </div>


      <div class="col-12 col-lg-6">
        <div class="middle-column">
          <div class="card border-primary">
            <div class="card-header">
                <div class="input-group">
                <label for="quickpost" class="visually-hidden">Post veloce:</label> 
                  <input type="text" id="quickpost" class="quickpost form-control mx-3" placeholder="Post veloce">
                  <div class="input-group-append">
                    <button type="submit" class="bttnpost btn btn-primary" disabled>Posta</button>
                  </div>
                </div>
            </div>
            <div class="card-body" id="adddiv">`;
  for (let i = 0; i < post_data.length && i < 10; i++) {
    section += `
              <div class="container">
              <div class="d-flex justify-content-between p-2 px-3">
                <div class="d-flex flex-row align-items-center"> <img id="imgProfile${i}"
                    src="../img/${post_data[i]["user_image"]}" width="50" class="rounded-circle" alt="immagine profilo autore post">
                  <div class="d-flex flex-column ml-2"> <a class="nav-link" href="profile.php?username=${post_data[i]["author"]}">@${post_data[i]["author"]}</a>
                    <small class="text-primary"> ${post_data[i]["nome_corso"]}</small>
                  </div>

                </div>
                <div class="d-flex flex-row mt-1 ellipsis"> <small class="mr-2">${post_data[i]["data"]}</small> <em
                    class="fa fa-ellipsis-h"></em> </div>
              </div>
              <div class="px-4 mt-3 mb-3">`;
    if (post_data[i]["immagine"] != null) {
      section += `<img src="../img/${post_data[i]["immagine"]}" alt="immagine del post" class="img-fluid">`;
    }
    section += `
                
                <p class="text-justify">${post_data[i]["string"]}.</p>
              </div>
              <div class="mt-4">


                <button class="bottone bottoneL btn btn-outline-danger position-relative me-2 ms-2 mb-2"><em class="bi bi-hand-thumbs-up"></em>
                  <span class="numeroLike position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    ${post_data[i]["num_like"]}
                  </span>
                </button>

                <button class="btn btn-outline-danger position-relative me-2 ms-2 mb-2" onclick="location.href='../php/post-comment.php?post_id=${post_data[i]["post_id"]}';"><em class="bi bi-chat-left-text-fill"></em>
                  <span class="numeroCommento position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    ${post_data[i]["num_comments"]}
                  </span>
                </button>

                <button class="btnFire btnFireL btn btn-outline-danger position-relative me-2 ms-2 mb-2"><em class="bi bi-fire"></em>
                  <span class="numeroFire position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    ${post_data[i]["num_fire"]}
                  </span>
                </button>

                <button class="btnSmile btnSmileL btn btn-outline-danger position-relative me-2 ms-2 mb-2"><em class="bi bi-emoji-smile-upside-down"></em>
                  <span class="numeroSmile position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    ${post_data[i]["num_smile"]}
                  </span>
                </button>

                <button class="btnCuore btnCuoreL btn btn-outline-danger position-relative me-2 ms-2 mb-2"><em class="bi bi-heart-fill"></em>
                  <span class="numeroCuore position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    ${post_data[i]["num_cuore"]}
                  </span>
                </button>

                <button  class="btnBacio btnBacioL btn btn-outline-danger position-relative me-2 ms-2 mb-2"><em class="bi bi-emoji-kiss"></em>
                  <span class="numeroBacio position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    ${post_data[i]["num_baci"]}
                  </span>
                </button>


              </div>
            <hr/>
            </div>
            `;
  }
  section += `
  </div>
  </div>
    </div>

`;

  const variabile = document.createElement("div");
  variabile.classList.add("container", "mt-2", "mb-5");
  variabile.innerHTML = section;
  return variabile;
}

function newPosts(post_data, i) {
  let newdiv = `
              <div class="d-flex justify-content-between p-2 px-3">
                <div class="d-flex flex-row align-items-center"> <img id="imgProfile${i}"
                    src="../img/${post_data["user_image"]}" width="50" class="rounded-circle" alt="immagine profilo autore post">
                  <div class="d-flex flex-column ml-2"> <a class="nav-link" href="profile.php?username=${post_data["author"]}">@${post_data["author"]}</a>
                    <small class="text-primary">${post_data["nome_corso"]}</small>
                  </div>

                </div>
                <div class="d-flex flex-row mt-1 ellipsis"> <small class="mr-2">${post_data["data"]}</small> <em
                    class="fa fa-ellipsis-h"></em> </div>
              </div>
              <div class="px-4 mt-3 mb-3">`;
  if (post_data["immagine"] != null) {
    newdiv += `<img src="../img/${post_data["immagine"]}" alt="immagine del post" class="img-fluid">`;
  }
  newdiv += `
                <p class="text-justify">${post_data["string"]}.</p>
              </div>
              <div class="mt-4">


                <button class="bottone bottoneL btn btn-outline-danger position-relative me-2 ms-2 mb-2"><em class="bi bi-hand-thumbs-up"></em>
                  <span class="numeroLike position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    ${post_data["num_like"]}
                  </span>
                </button>

                <button class="btn btn-outline-danger position-relative me-2 ms-2 mb-2" onclick="location.href='../php/post-comment.php?post_id=${post_data["post_id"]}';"><em class="bi bi-chat-left-text-fill"></em>
                  <span class="numeroCommento position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    ${post_data["num_comments"]}
                  </span>
                </button>

                <button class="btnFire btnFireL btn btn-outline-danger position-relative me-2 ms-2 mb-2"><em class="bi bi-fire"></em>
                  <span class="numeroFire position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    ${post_data["num_fire"]}
                  </span>
                </button>

                <button class="btnSmile btnSmileL btn btn-outline-danger position-relative me-2 ms-2 mb-2"><em class="bi bi-emoji-smile-upside-down"></em>
                  <span class="numeroSmile position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    ${post_data["num_smile"]}
                  </span>
                </button>

                <button class="btnCuore btnCuoreL btn btn-outline-danger position-relative me-2 ms-2 mb-2"><em class="bi bi-heart-fill"></em>
                  <span class="numeroCuore position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    ${post_data["num_cuore"]}
                  </span>
                </button>

                <button  class="btnBacio btnBacioL btn btn-outline-danger position-relative me-2 ms-2 mb-2"><em class="bi bi-emoji-kiss"></em>
                  <span class="numeroBacio position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    ${post_data["num_baci"]}
                  </span>
                </button>


              </div>
            
            <hr/>`
  let div = document.createElement("div");
  div.classList.add("container");
  div.innerHTML = newdiv;
  return div;
}

function showPost(post_data) {
  main.appendChild(generatePost(post_data));
}

function sendPost() {
  const btnpost = document.querySelector(".bttnpost");
  btnpost.addEventListener('click', function onClick() {
    const qpost = document.querySelector(".quickpost").value;
    if (qpost != "") {
      console.log(qpost);
      const formData = new FormData();
      formData.append('post', qpost);
      axios.post('../php/quickpost.php', formData).then(response => {
        if (!response.data["error"]) {
          location.reload();
          console.log(response.data["info"]);
        } else {
          console.log(response.data["info"]);
          document.querySelector(".quickpost").value = "";
          document.querySelector(".quickpost").placeholder = "C'è stato un errore, riprova";
        }
      });
    } else {
      console.log("Post is empty");
    }
  });
}

function getLoggedUserInfo() {
  axios.get('../php/api-getuserinfo.php').then(response => {
    console.log(response.data);
    if (response.data["status"]) {
      document.querySelector("#nome_utente").innerHTML = "@" + response.data["userid"];
      if (response.data["user_info"]["descrizione"] != ' ') {
        document.querySelector("#descrizione").innerHTML = response.data["user_info"]["descrizione"]
      } else {
        document.querySelector("#descrizione").innerHTML = "Nessuna descrizione inserita";
      }

      document.querySelector("#residenza").innerHTML += response.data["user_info"]["uni_residence"];

      if (response.data["uni_info"] != null) {
        document.querySelector("#universita").innerHTML = response.data["uni_info"]["nome"]
        document.querySelector("#universita").href = "uni.php?uni_id=" + response.data["uni_info"]["uni_id"];
      } else {
        document.querySelector("#universita").innerHTML = "Nessuna università selezionata";
        document.querySelector("#universita").href = "uni-list.php";
      }

      if (response.data["course_info"] != null) {
        document.querySelector("#corso").innerHTML = response.data["course_info"]["nome"];
        document.querySelector("#corso").href = "course.php?course_id=" + response.data["course_info"]["corso_id"];
      } else {
        document.querySelector("#corso").innerHTML = "Nessun corso selezionato";
        document.querySelector("#corso").href = "uni-list.php";
      }

      if (response.data["user_info"]["user_image"] != null) {
        document.querySelector("#profile_picture").src = "../img/" + response.data["user_info"]["user_image"];
      }
    } else {
      main.innerHTML = "";
      main.appendChild(showError());
    }
  });
}

function dynamicButtonPost() {
  document.querySelector(".quickpost").addEventListener('keyup', function () {
    if (document.querySelector(".quickpost").value.length > 0) {
      document.querySelector(".bttnpost").disabled = false;
    }
    else {
      document.querySelector(".bttnpost").disabled = true;
    }
  });
}

document.addEventListener(
  'scroll',
  (event) => {
    loadMore();
  },
  { passive: true }
);

let num;
let rd;
let end = false;
const main = document.querySelector("main");
axios.get("api-showpost.php").then(response => {
  if (response.data["success"]) {
    num = response.data["posts"].length;
    showPost(response.data["posts"]);
    if (num == 0) {
      let element = document.getElementById('adddiv');
      let newdiv = showEndPost();
      element.append(newdiv);
      end = true;
    } else if (num < 10) {
      //showPost(response.data["posts"]);
      let element = document.getElementById('adddiv');
      let newdiv = showEndPost();
      element.append(newdiv);
      end = true;
      enableButtons(response);
    } else {
      //showPost(response.data["posts"]);
      enableButtons(response);
    }
    rd = response.data["posts"];
    console.log(response.data);
    sendPost();
    getLoggedUserInfo()
    dynamicButtonPost();
  } else {
    main.appendChild(showError());
  }

});

let loading = false;

function enableButtons(response) {
  const btnLike = "bottoneL";
  const numeroLike = "numeroLike";
  updateButton(response.data["posts"], btnLike, numeroLike, 1, -1, "btnlkd");
  const btnFire = "btnFireL";
  const numeroFire = "numeroFire";
  updateButton(response.data["posts"], btnFire, numeroFire, 2, -2, "btnFireLkd");
  const btnSmile = "btnSmileL";
  const numeroSmile = "numeroSmile";
  updateButton(response.data["posts"], btnSmile, numeroSmile, 3, -3, "btnSmileLkd");
  const btnCuore = "btnCuoreL";
  const numeroCuore = "numeroCuore";
  updateButton(response.data["posts"], btnCuore, numeroCuore, 4, -4, "btnCuoreLkd");
  const btnBacio = "btnBacioL";
  const numeroBacio = "numeroBacio";
  updateButton(response.data["posts"], btnBacio, numeroBacio, 5, -5, "btnBacioLkd");
}

async function loadMore() {
  if (window.scrollY + window.innerHeight >= document.body.scrollHeight && !loading) {
    loading = true;
    const formData = new FormData();
    formData.append('num', num);
    const resp = await axios.post("api-loadPost.php", formData);
    console.log(resp.data);

    if (!resp.data["errors"]) {
      q = resp.data["posts"];
      if (q.length == 0) {
        document.removeEventListener('scroll', loadMore);
        if (end == false) {
          let element = document.getElementById('adddiv');
          let newdiv = showEndPost();
          element.append(newdiv);
        }
        return;
      }

      rd = rd.concat(q);

      for (let i = 0; i < q.length; i++) {
        let newdiv = newPosts(q[i], i + num);
        let element = document.getElementById('adddiv');
        element.append(newdiv);
      }

      num = num + q.length;
      const btnLike = "bottoneL";
      const numeroLike = "numeroLike"
      updateButton(rd, btnLike, numeroLike, 1, -1, "btnlkd");

      const btnFire = "btnFireL";
      const numeroFire = "numeroFire"
      updateButton(rd, btnFire, numeroFire, 2, -2, "btnFireLkd");

      const btnSmile = "btnSmileL"
      const numeroSmile = "numeroSmile"
      updateButton(rd, btnSmile, numeroSmile, 3, -3, "btnSmileLkd");

      const btnCuore = "btnCuoreL"
      const numeroCuore = "numeroCuore"
      updateButton(rd, btnCuore, numeroCuore, 4, -4, "btnCuoreLkd");

      const btnBacio = "btnBacioL"
      const numeroBacio = "numeroBacio"
      updateButton(rd, btnBacio, numeroBacio, 5, -5, "btnBacioLkd");
      loading = false;
    } else {
      main.innerHTML = "";
      main.appendChild(showError());
    }
  }

}

function showEndPost() {
  let newdiv = `<div class="d-flex justify-content-between p-2 px-3">
    <p>Non ci sono più post da mostrare</p>
  </div>`
  let div = document.createElement("div");
  div.innerHTML = newdiv;
  return div;
}

function showError(){
  let newdiv = `<div class="d-flex justify-content-between p-2 px-3 bg-light">
    <p class="fs-3">An error has occurred; please retry or log in. </p>
  </div>`
  let div = document.createElement("div");
  div.innerHTML = newdiv;
  return div;
}