function generatePost(post_data){
    let section = `
    <section>
    <h2>Post</h2>
        <div class="container mt-4 mb-5">
            <div class="d-flex justify-content-center row">
                <div class="col-md-8">
                    <div class="feed p-2">
                        <div class="bg-white border mt-2">
                            <div>
                                <div class="d-flex flex-row justify-content-between align-items-center p-2 border-bottom">
                                    <div class="d-flex flex-row align-items-center feed-text px-2"><img src="${post_data["user_image"]}" alt=""/>
                                        <div class="d-flex flex-column flex-wrap ml-2"><a class="nav-link" href="profile.php"> ${post_data["username"]} </a></div>
                                    </div>
                                    <div class="feed-icon px-2"><em class="fa fa-ellipsis-v text-black-50"></em></div>
                                </div>
                            </div>
                            <div class="p-2 px-3"><span>${post_data["contenuto"]}</span></div>
                            <div class="d-flex justify-content-end socials p-2 py-3"><em class="fa fa-thumbs-up">LIKE</em><em class="fa fa-comments-o">COMMENTO</em><em class="fa fa-share">REACTION</em></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
`
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