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

const changeImage = document.getElementById("changeImage");
const otherRadios = new Set([document.getElementById("sameImage"), document.getElementById("deleteImage")]);
changeImage.addEventListener("click", function() {
    addImageInput();
});
otherRadios.forEach(x => {
    x.addEventListener("click", function() {
        removeImageInput();
    });
});
