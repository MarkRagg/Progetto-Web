function addImageInput() {
    const imageInput = document.createElement("div");
    imageInput.id = "imgDiv";
    imageInput.innerHTML = `
        <label for="imgpost">Aggiungi immagine</label><input type="file" name="imgpost" id="imgpost" class="form-control"/>
    `;
    const lastFormCheck = document.querySelector("div.form-check.mb-2");
    lastFormCheck.parentElement.insertBefore(imageInput, lastFormCheck.nextElementSibling);
}

function removeImageInput() {
    document.getElementById("imgDiv")?.remove();
}

function toggleDelete() {
    if (!deleteToggled) {
        // remove all other forms
        document.getElementById("formContent")?.remove();
        deleteToggled = true;
    } else {
        // add all forms
        const formContent = document.createElement("div");
        formContent.id = "formContent";
        formContent.innerHTML = `
            <div class="form-check">
                <input class="form-check-input" value="sameImage" type="radio" name="image" id="sameImage" checked>
                <label class="form-check-label" for="sameImage">
                    Lascia immagine invariata.
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" value="deleteImage" type="radio" name="image" id="deleteImage">
                <label class="form-check-label" for="deleteImage">
                    Elimina immagine.
                </label>
            </div>
            <div class="form-check mb-2">
                <input class="form-check-input" value="changeImage" type="radio" name="image" id="changeImage">
                <label class="form-check-label" for="changeImage">
                    Cambia o aggiungi immagine.
                </label>
            </div>
            <textarea class="form-control" id="post" name="post" rows="4">${postContent}</textarea>
        `;
        const firstHr = document.getElementById("formContentDivider");
        console.log(firstHr);
        firstHr.parentElement.insertBefore(formContent, firstHr.nextElementSibling);
        deleteToggled = false;
    }
}

const changeImage = document.getElementById("changeImage");
const otherRadios = new Set([document.getElementById("sameImage"), document.getElementById("deleteImage")]);
const deleteButton = document.getElementById("deletePost");
const postContent = document.querySelector("textarea").innerText;
let deleteToggled = false;
changeImage.addEventListener("click", function() {
    addImageInput();
});
otherRadios.forEach(x => {
    x.addEventListener("click", function() {
        removeImageInput();
    });
});
deleteButton.addEventListener("click", function(event) {
    toggleDelete();
});
