//a function that generates a form for a post with the field to write the post and the button to send it
function generatePostForm() {
    let form = `
    <section>
        <form action="../php/insertpost.php" method="POST">
            <label for="post">Post</label>
            <input type="text" name="post" id="post">
            <input type="submit">
        </form>
    </section>`;
    return form;
}

function showForm(){
    main.innerHTML = generatePostForm();
}

const main = document.querySelector("main");
axios.get('insertpost.php').then(response => {
    showForm();
    
});