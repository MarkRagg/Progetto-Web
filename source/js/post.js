//${post_data[i]["user_image"]}

function generatePost(post_data) {
  let section = `<div class="container mt-2 mb-5">
    <div class="row">
      <div class="col-12 col-lg-3">
        <div class="left-column">
          <div class="card card-left1 mb-4">
            <img src="" alt="" class="card-img-top img-fluid">
            <div class="card-body text-center ">
              <img src="" alt="img" width="120" height="120" class="rounded-circle mt-n5">
              <h5 id="nome_utente" class="card-title">  </h5>
              <p class="card-text text-justify mb-2">DESCRIZIONE TIPO INSTAGRAM.</p>
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
                  <input type="text" class="quickpost form-control mx-3" placeholder="Post veloce">
                  <div class="input-group-append">
                    <button type="submit" class="bttnpost btn btn-primary" disabled>Posta</button>
                  </div>
                </div>
            </div>`;
  //if(post_data.length != 0){
  for (let i = 0; i < post_data.length && i < 10; i++) {
    section += `
    
            <div class="card-body">
              <div class="d-flex justify-content-between p-2 px-3">
                <div class="d-flex flex-row align-items-center"> <img id="imgProfile${i}"
                    src="https://www.w3schools.com/html/workplace.jpg" width="50" class="rounded-circle" alt="">
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
                <button id="bottoneLikePost${i}" class="bottone btn btn-outline-danger position-relative me-5 ms-5 btn-sm">Like
                  <span class="numeroLike position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    id="numeroLikePost${i}">
                    ${post_data[i]["num_like"]}
                  </span>
                </button>
                <a href="../php/post-comment.php?post_id=${post_data[i]["post_id"]}" class="comlink" >Commenta</a>
              </div>
            </div>
            <hr/>
        `
  }
//}

  section += `</div>
    </div>
  </div>
</div>
</div> `;

  const variabile = document.createElement("section");
  variabile.innerHTML = section;
  return variabile;
}

function showPost(post_data) {
  main.appendChild(generatePost(post_data));
}

function updateButton(response) {
  const btn = document.querySelectorAll('.bottone');
  const nlikes = document.querySelectorAll('.numeroLike');

  //console.log(btn);

  const formData = new FormData();

  for (let i = 0; i < btn.length; i++) {
    showAlreadyLiked(response, i, btn, nlikes);
    btn[i].addEventListener('click', function onClick() {
      if (btn[i].classList.contains("btnlkd")) {
        removeLike(btn, i, nlikes);
        formData.append('post_id', response[i]["post_id"]);
        formData.append('type', -1);
        //console.log(formData);
        axios.post('../php/api-like.php', formData).then(response => {
          console.log(response);
        });
        formData.delete('post_id');
        formData.delete('type');
      } else {
        addLike(btn, i, nlikes);
        formData.append('post_id', response[i]["post_id"]);
        formData.append('type', 1);
        for (const value of formData.values()) {
          //console.log(value);
        }
        axios.post('../php/api-like.php', formData).then(response => {
          console.log(response);
        });

        formData.delete('post_id');
        formData.delete('user');
        formData.delete('type');
      }
    });
  }
}

function addLike(btn, i, nlikes) {
  btn[i].classList.replace("btn-outline-danger", 'btn-danger');
  btn[i].classList.replace("bottone", "btnlkd");
  nlikes[i].innerHTML = parseInt(nlikes[i].innerHTML) + 1;
  btn[i].innerHTML = "Liked" + `<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="numeroLike${i}" >` + nlikes[i].innerHTML + `</span>`;
}

function removeLike(btn, i, nlikes) {
  btn[i].classList.replace('btn-danger', "btn-outline-danger");
  btn[i].classList.replace("btnlkd", "bottone");
  nlikes[i].innerHTML = parseInt(nlikes[i].innerHTML) - 1;
  btn[i].innerHTML = "Like" + `<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="numeroLike${i}" >` + nlikes[i].innerHTML + `</span>`;
}

function showAlreadyLiked(response, i, btn, nlikes) {
  if (response[i]["user_has_liked"] == true) {
    btn[i].classList.replace("btn-outline-danger", "btn-danger");
    btn[i].classList.replace("bottone", "btnlkd");
    btn[i].innerHTML = "Liked" + `<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="numeroLike${i}" >` + nlikes[i].innerHTML + `</span>`;
  }
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
  });
  

}

const main = document.querySelector("main");
axios.get("api-showpost.php").then(response => {
  console.log(response.data);
  showPost(response.data);
  updateButton(response.data);
  sendPost();


  //getLoggedUserInfo()
  //console.log(getLoggedUserInfo());
  
  document.querySelector(".quickpost").addEventListener('keyup', function() {
    if (document.querySelector(".quickpost").value.length > 0){
      document.querySelector(".bttnpost").disabled = false;
    }
    else{
      document.querySelector(".bttnpost").disabled = true;
    }
  });
  
});

