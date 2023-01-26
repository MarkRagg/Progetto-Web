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
                    <div class="p-2">
                        <p class="text-justify">${post_data[i]["string"]}</p>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-row muted-color">
                            <button id="bottone">Like</button>
                            </div>
                        </div>
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

    //const map = new Map();

    //console.log(btn);
    const formData = new FormData();

    for(let i = 0; i < btn.length; i++){
        btn[i].addEventListener('click', function onClick() {
            btn[i].style.backgroundColor = 'salmon';
            btn[i].style.color = 'white';
            btn[i].innerHTML = 'Liked';



            formData.append('post_id', response[i]["post_id"]);
            formData.append('author', response[i]["user_id"]);

            for (const value of formData.values()) {
                console.log(value);
            }
        });

        //const list = [response[i]["post_id"], response[i][""]];

        //map.set(btn[i], list);
    }   
    //console.log(map); 
}



const main = document.querySelector("main");
axios.get("api-showpost.php").then(response => {
    showPost(response.data);

    updateButton(response.data);
    
});

/*cosa devo fare?

clicco sul bottone del like
l actionlistener fa qualcosa
dentro quel qualcosa metto dentro il formdata il post_id e l author
poi devo mandare il formdata a php
php piglia le robe:
prende il postid e l'utente che ha messo il like
e lo mette dentro la tabella dei like
(poi devo aggiornare il numero di like)
ovviamente devo ritornare qualcosa
ma non so cosa

dove metto il axiso.post?
cosa ritorno da php?




se lo riclicco devo togliere il like ma ci penso dopo

*/
