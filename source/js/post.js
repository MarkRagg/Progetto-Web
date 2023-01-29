//${post_data[i]["user_image"]}

function generatePost(post_data){
    let section = 
    `
    <section>
    `
    for (let i = 0; i < post_data.length; i++){
        section += `

    <div class="container mt-5 mb-5">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="d-flex justify-content-between p-2 px-3">
                        <div class="d-flex flex-row align-items-center"> <img id="ciao" src="https://www.w3schools.com/html/workplace.jpg" width="50" class="rounded-circle">
                            <div class="d-flex flex-column ml-2"> <a class="nav-link" href="profile.php?username=${post_data[i]["author"]}">${post_data[i]["author"]}</a> 
                                <small class="text-primary">LINK AL CORSO/ESAME OPPURE NIENTE</small> 
                            </div>
                            
                        </div>
                        <div class="d-flex flex-row mt-1 ellipsis"> <small class="mr-2">${post_data[i]["data"]}</small> <i class="fa fa-ellipsis-h"></i> </div>
                    </div>
                    <hr/>
                    <div class="px-4">
                        <p class="text-justify">${post_data[i]["string"]}</p>
                    </div>
                        <hr>
                        <div class="d-flex align-items-center">
                            <ul class="">
                                <li class=" list-group-item align-items-center h5">
                                    
                                    <button id="bottone" class="btn btn-outline-danger ">Like
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="numeroLike" >
                                    ${post_data[i]["num_like"]}</span>
                                    
                                    </button>
                                </li>
                            </ul>
                        </div>
                </div>
            </div>
        </div>
    </div>

        `
    }
    section += `</section>`;
    const variabile = document.createElement("section");
    variabile.innerHTML = section;
    return variabile;
}

function showPost(post_data){
    main.appendChild(generatePost(post_data));
}

function updateButton(response){
    const btn = document.querySelectorAll('#bottone');
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
                btn[i].id = "button";
                nlikes[i].innerHTML = parseInt(nlikes[i].innerHTML) - 1;
                btn[i].innerHTML = "Like" + `<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="numeroLike" >`+nlikes[i].innerHTML+`</span>`;
                formData.append('post_id', response[i]["post_id"]);
                formData.append('type', -1);
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
