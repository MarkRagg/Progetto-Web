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
                        <div class="d-flex flex-row align-items-center"> <img src="https://www.w3schools.com/html/workplace.jpg" width="50" class="rounded-circle">
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
                            <div class="d-flex flex-row icons d-flex align-items-center"> <i class="fa fa-heart"></i> <i class="fa fa-smile-o ml-2"></i> </div>
                            <div class="d-flex flex-row muted-color"> <span>comments</span> <span class="ml-2">Share</span> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        `
    }
    section += `</section>`;
return section;
}

function showPost(post_data){
    main.innerHTML = generatePost(post_data);
}

const main = document.querySelector("main");
axios.get("api-showpost.php").then(response => {
    showPost(response.data);
    console.log(response.data);
});