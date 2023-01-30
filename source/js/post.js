//${post_data[i]["user_image"]}

function generatePost(post_data){
    let section = `<div class="container mt-5 mb-5">
    <div class="row">
      <div class="col-12 col-lg-3">
        <div class="left-column">
          <div class="card card-left1 mb-4">
            <img src="" alt="" class="card-img-top img-fluid">
            <div class="card-body text-center ">
              <img src="" alt="img" width="120" height="120" class="rounded-circle mt-n5">
              <h5 class="card-title">NOME UTENTE</h5>
              <p class="card-text text-justify mb-2">DESCRIZIONE TIPO INSTAGRAM.</p>

            </div>
          </div>
          <div class="card shadow-sm card-left2 mb-4">
            <div class="card-body">
              <h5 class="mb-3 card-title">TUE INFO <small><a href="#" class="ml-1">CAMBIA</a></small></h5>
              <p class="card-text"> <em class="fas fa-calendar-week mr-2"></em> STUDIA A <a href="#"
                  class="text-decoration-none">UNIVERSITA</a></p>
              <p class="card-text"> <em class="fas fa-user-friends mr-2"></em> COSA STUDIA? <a href="#"
                  class="text-decoration-none">CORSO</a></p>
              <p class="card-text"> <em class="fas fa-user-friends mr-2"></em> RESIDENZA <a href="#"
                  class="text-decoration-none">CITTA</a></p>
            </div>
          </div>
        </div>
      </div>


      <div class="col-12 col-lg-6">
        <div class="middle-column">
          <div class="card">
            <div class="card-header bg-transparent">
              <h3>Homepage</h3>
            </div>`;
    for (let i = 0; i < post_data.length; i++){
        section += `
    
            <div class="card-body">
              <div class="d-flex justify-content-between p-2 px-3">
                <div class="d-flex flex-row align-items-center"> <img id="ciao"
                    src="https://www.w3schools.com/html/workplace.jpg" width="50" class="rounded-circle" alt="">
                  <div class="d-flex flex-column ml-2"> <a class="nav-link" href="profile.php?username=${post_data[i]["author"]}">${post_data[i]["author"]}</a>
                    <small class="text-primary">LINK AL CORSO/ESAME OPPURE NIENTE</small>
                  </div>

                </div>
                <div class="d-flex flex-row mt-1 ellipsis"> <small class="mr-2">${post_data[i]["data"]}</small> <em
                    class="fa fa-ellipsis-h"></em> </div>
              </div>
              <div class="px-4">
                <p class="text-justify">${post_data[i]["string"]}.</p>
              </div>
              <div class="d-flex align-items-center mt-5">
                <button id="bottoneLike" class="btn btn-outline-danger position-relative me-5 ms-5">Like
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    id="numeroLike">
                    ${post_data[i]["num_like"]}
                  </span>
                </button>
                <button id="bottoneCommenti" class="btn btn-outline-danger position-relative">Commenti
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    id="numeroCommenti">
                    Ncommenti
                  </span>
                </button>
              </div>
            </div>
            <hr>
          
        `
    }

    section += `</div>
    </div>
  </div>
</div>
</div> `;

    const variabile = document.createElement("section");
    variabile.innerHTML = section;
    return variabile;
}

function showPost(post_data){
    main.appendChild(generatePost(post_data));
}

function updateButton(response){
    const btn = document.querySelectorAll('#bottoneLike');
    const nlikes = document.querySelectorAll('#numeroLike');

    const formData = new FormData();

    for(let i = 0; i < btn.length; i++){
        if(response[i]["user_has_liked"]==true){
            btn[i].classList.replace("btn-outline-danger","btn-danger");
            btn[i].id = "button liked";
            btn[i].innerHTML = "Liked" + `<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="numeroLike" >`+nlikes[i].innerHTML+`</span>`;
        }
        btn[i].addEventListener('click', function onClick() {
            if(btn[i].id == "button liked"){
                btn[i].classList.replace('btn-danger', "btn-outline-danger");
                btn[i].id = "bottoneLike";
                nlikes[i].innerHTML = parseInt(nlikes[i].innerHTML) - 1;
                btn[i].innerHTML = "Like" + `<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="numeroLike" >`+nlikes[i].innerHTML+`</span>`;
                formData.append('post_id', response[i]["post_id"]);
                formData.append('type', -1);
                console.log(formData);
                axios.post('../php/like.php', formData).then(response => {
                    console.log(response);
                });
                formData.delete('post_id');
                formData.delete('type');
            } else {
                btn[i].classList.replace("btn-outline-danger",'btn-danger' );
                btn[i].id = "button liked";

                formData.append('post_id', response[i]["post_id"]);
                formData.append('type', 1);

                for (const value of formData.values()) {
                    console.log(value);
                }

                axios.post('../php/like.php', formData).then(response => {
                    console.log(response);
                });
                nlikes[i].innerHTML = parseInt(nlikes[i].innerHTML) + 1;
                btn[i].innerHTML = "Liked" + `<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="numeroLike" >`+nlikes[i].innerHTML+`</span>`;
                
                formData.delete('post_id');
                formData.delete('user');
                formData.delete('type');
            }
        });
    }   
}

const main = document.querySelector("main");
axios.get("api-showpost.php").then(response => {
    console.log(response.data);
    showPost(response.data);

    updateButton(response.data);
    
});
