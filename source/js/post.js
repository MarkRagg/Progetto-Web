//${post_data[i]["user_image"]}

function generatePost(post_data){
    let section = 
    `
    <section>
    `
    for (let i = 0; i < post_data.length; i++){
        section += `

            <div class="container mt-4 mb-5">
                <div class="d-flex justify-content-center row">
                    <div class="col-md-8">
                        <div class="feed p-2">
                            <div class="bg-white border mt-2">
                                <div>
                                    <div class="d-flex flex-row justify-content-between align-items-center p-2 border-bottom">
                                        <div class="d-flex flex-row align-items-center feed-text px-2"><img src="https://www.w3schools.com/html/workplace.jpg" width="50" height="50" alt=""/>
                                            <div class="d-flex flex-column flex-wrap ml-2"><a class="nav-link" href="profile.php?username=${post_data[i]["author"]}" > ${post_data[i]["author"]} </a></div>
                                        </div>
                                        <div class="feed-icon px-2"><em class="fa fa-ellipsis-v text-black-50"></em></div>
                                    </div>
                                </div>
                                <div class="p-2 px-3"><span>${post_data[i]["string"]}</span></div>
                                <div class="d-flex justify-content-end socials p-2 py-3"><em class="fa fa-thumbs-up">LIKE</em><em class="fa fa-comments-o">COMMENTO</em><em class="fa fa-share">REACTION</em></div>
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