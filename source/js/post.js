function generatePost(post_data) {
  let section = `<div class="container mt-2 mb-5">
    <div class="row">
      <div class="col-12 col-lg-3">
        <div class="left-column">
          <div class="card card-left1 mb-4">
            <div class="card-body text-center ">
              <img src="" alt="img" width="120" height="120" class="rounded-circle mt-n5">
              <h5 id="nome_utente" class="card-title">  </h5>
              <p class="card-text text-justify mb-2" id="descrizione">  .</p>
            </div>
          </div>
          <div class="card shadow-sm card-left2 mb-4">
            <div class="card-body">
              <h5 class="mb-3 card-title">Tue informazioni: <small><a href="#" class="ml-1">CAMBIA</a></small></h5>
              <p class="card-text"> <em class="fas fa-calendar-week mr-2"></em> Studi a: <a href="#"
                  class="text-decoration-none">universita di bolo</a></p>
              <p class="card-text"> <em class="fas fa-user-friends mr-2"></em> Che cosa studi? <a href="#"
                  class="text-decoration-none">Corso</a></p>
              <p class="card-text"> <em class="fas fa-user-friends mr-2"></em> Residenza: <a href="#"
                  class="text-decoration-none">Citta</a></p>
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
    if (post_data[0]["author"] !== null ){
    section += `
              <div>
              <div class="d-flex justify-content-between p-2 px-3">
                <div class="d-flex flex-row align-items-center"> <img id="imgProfile${i}"
                    src="../img/${post_data[i]["user_image"]}" width="50" class="rounded-circle" alt="">
                  <div class="d-flex flex-column ml-2"> <a class="nav-link" href="profile.php?username=${post_data[i]["author"]}">@${post_data[i]["author"]}</a>
                    <small class="text-primary">LINK AL CORSO/ESAME OPPURE NIENTE</small>
                  </div>

                </div>
                <div class="d-flex flex-row mt-1 ellipsis"> <small class="mr-2">${post_data[i]["data"]}</small> <em
                    class="fa fa-ellipsis-h"></em> </div>
              </div>
              <div class="px-4 mt-3 mb-3">`
    if (post_data[i]["immagine"] != null) {
      section += `<img src="../img/${post_data[i]["immagine"]}" alt="" class="img-fluid">`;
    }
    section += `
                
                <p class="text-justify">${post_data[i]["string"]}.</p>
              </div>
              <div class="d-flex align-items-center mt-4">


                <button id="bottoneLikePost${i}" class="bottone bottoneL btn btn-outline-danger position-relative me-2 ms-4 "><em class="bi bi-hand-thumbs-up"></em>
                  <span class="numeroLike position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    id="numeroLikePost${i}">
                    ${post_data[i]["num_like"]}
                  </span>
                </button>

                <button id="bottoneCommentPost${i}" class="btn btn-outline-danger position-relative me-2 ms-2 " onclick="location.href='../php/post-comment.php?post_id=${post_data[i]["post_id"]}';"><em class="bi bi-chat-left-text-fill"></em>
                  <span class="numeroCommento position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    id="numeroCommentiPost${i}">
                    ${post_data[i]["num_comments"]}
                  </span>
                </button>

                <button id="bottoneFirePost${i}" class="btnFire btnFireL btn btn-outline-danger position-relative me-2 ms-2 "><em class="bi bi-fire"></em>
                  <span class="numeroFire position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    id="numeroFirePost${i}">
                    ${post_data[i]["num_fire"]}
                  </span>
                </button>

                <button class="btnSmile btnSmileL btn btn-outline-danger position-relative me-2 ms-2 "><em class="bi bi-emoji-smile-upside-down"></em>
                  <span class="numeroSmile position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    id="numeroSmilePost${i}">
                    ${post_data[i]["num_smile"]}
                  </span>
                </button>

                <button class="btnCuore btnCuoreL btn btn-outline-danger position-relative me-2 ms-2 "><em class="bi bi-heart-fill"></em>
                  <span class="numeroCuore position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    id="numeroCuoriPost${i}">
                    ${post_data[i]["num_cuore"]}
                  </span>
                </button>







                <button  class="btnBacio btn btn-outline-danger position-relative me-2 ms-2 "><em class="bi bi-emoji-kiss"></em>
                  <span class="numeroBacio position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    id="numeroBaciPost${i}">
                    ${post_data[i]["num_baci"]}
                  </span>
                </button>


              </div>
            <hr/>
            </div>
            `
  }
  }
  section += `
  </div>
  </div>
    </div>
  </div>
`;

  const variabile = document.createElement("section");
  variabile.innerHTML = section;
  return variabile;
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
    document.querySelector("#nome_utente").innerHTML = "@" + response.data["userid"];
    document.querySelector("#descrizione").innerHTML = response.data["descrizione"];
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

let num;
let rd;
const main = document.querySelector("main");
axios.get("api-showpost.php").then(response => {
  showPost(response.data);
  num = response.data.length;
  const btnLike = "bottoneL";
  const numeroLike = "numeroLike"
  updateButton(response.data, btnLike, numeroLike, 1, -1, "btnlkd");
  const btnFire = "btnFireL";
  const numeroFire = "numeroFire"
  updateButton(response.data, btnFire, numeroFire, 2, -2, "btnFireLkd");
  const btnSmile = "btnSmileL"
  const numeroSmile = "numeroSmile"
  updateButton(response.data, btnSmile, numeroSmile, 3, -3, "btnSmileLkd");
  const btnCuore = "btnCuoreL"
  const numeroCuore = "numeroCuore"
  updateButton(response.data, btnCuore, numeroCuore, 4, -4, "btnCuoreLkd");
  rd = response.data;
  console.log(rd);
  sendPost();
  getLoggedUserInfo()
  dynamicButtonPost();
});


document.addEventListener(
  'scroll',
  (event) => {
    loadMore();
  },
  { passive: true }
);


let loading = false;

async function loadMore() {
  if (window.scrollY + window.innerHeight >= document.body.scrollHeight && !loading) {
    loading = true;
    const formData = new FormData();
    formData.append('num', num);
    const resp = await axios.post("api-loadPost.php", formData);

    q = resp.data;
    if (q.length == 0) {
      document.removeEventListener('scroll', loadMore);
      let element = document.getElementById('adddiv');
      let newdiv = showEndPost();
      element.append(newdiv);
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
    loading = false;
  }

}

function newPosts(post_data, i) {
  let newdiv = `
              <div class="d-flex justify-content-between p-2 px-3">
                <div class="d-flex flex-row align-items-center"> <img id="imgProfile${i}"
                    src="https://www.w3schools.com/html/workplace.jpg" width="50" class="rounded-circle" alt="">
                  <div class="d-flex flex-column ml-2"> <a class="nav-link" href="profile.php?username=${post_data["author"]}">@${post_data["author"]}</a>
                    <small class="text-primary">LINK AL CORSO/ESAME OPPURE NIENTE</small>
                  </div>

                </div>
                <div class="d-flex flex-row mt-1 ellipsis"> <small class="mr-2">${post_data["data"]}</small> <em
                    class="fa fa-ellipsis-h"></em> </div>
              </div>
              <div class="px-4 mt-3 mb-3">`;
  if (post_data["immagine"] != null) {
    newdiv += `<img src="../img/${post_data["immagine"]}" alt="" class="img-fluid">`;
  }
  newdiv += `
                <p class="text-justify">${post_data["string"]}.</p>
              </div>
              <div class="d-flex align-items-center mt-4">


                <button id="bottoneLikePost${i}" class="bottone bottoneL btn btn-outline-danger position-relative me-2 ms-4 "><em class="bi bi-hand-thumbs-up"></em>
                  <span class="numeroLike position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    id="numeroLikePost${i}">
                    ${post_data["num_like"]}
                  </span>
                </button>

                <button id="bottoneCommentPost${i}" class="btn btn-outline-danger position-relative me-2 ms-2 " onclick="location.href='../php/post-comment.php?post_id=${post_data["post_id"]}';"><em class="bi bi-chat-left-text-fill"></em>
                  <span class="numeroCommento position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    id="numeroCommentiPost${i}">
                    ${post_data["num_comments"]}
                  </span>
                </button>

                <button id="bottoneFirePost${i}" class="btnFire btnFireL btn btn-outline-danger position-relative me-2 ms-2 "><em class="bi bi-fire"></em>
                  <span class="numeroFire position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    id="numeroFirePost${i}">
                    ${post_data["num_fire"]}
                  </span>
                </button>

                <button class="btnSmile btnSmileL btn btn-outline-danger position-relative me-2 ms-2 "><em class="bi bi-emoji-smile-upside-down"></em>
                  <span class="numeroSmile position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    id="numeroSmilePost${i}">
                    ${post_data["num_smile"]}
                  </span>
                </button>

                <button class="btnCuore btnCuoreL btn btn-outline-danger position-relative me-2 ms-2 "><em class="bi bi-heart-fill"></em>
                  <span class="numeroCuore position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    id="numeroCuoriPost${i}">
                    ${post_data["num_cuore"]}
                  </span>
                </button>







                <button  class="btnBacio btn btn-outline-danger position-relative me-2 ms-2 "><em class="bi bi-emoji-kiss"></em>
                  <span class="numeroBacio position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    id="numeroBaciPost${post_data["post_id"]}">
                    ${post_data["num_baci"]}
                  </span>
                </button>


              </div>
            
            <hr/>`
  let div = document.createElement("div");
  div.innerHTML = newdiv;
  return div;
}

function showEndPost(){
  let newdiv = `<div class="d-flex justify-content-between p-2 px-3">
    <p>Non ci sono più post da mostrare</p>
  </div>`
  let div = document.createElement("div");
  div.innerHTML = newdiv;
  return div;
}