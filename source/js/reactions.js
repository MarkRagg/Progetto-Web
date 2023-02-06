function updateButton(response, idbtn, idnum, numeroin, numeroout, contains) {
    const btn = document.querySelectorAll("." + idbtn);
    const nlikes = document.querySelectorAll("." + idnum);
    const formData = new FormData();

    for (let i = 0; i < btn.length; i++) {
        if (numeroin == 1) {
            showAlreadyLiked(response, i, btn, nlikes);
        } else if (numeroin == 2) {
            showAlreadyFire(response, i, btn, nlikes);
        } else if (numeroin == 3) {
            showAlreadySmile(response, i, btn, nlikes);
        } else if (numeroin == 4) {
            showAlreadyCuore(response, i, btn, nlikes);
        } else if (numeroin == 5) {
            showAlreadyBacio(response, i, btn, nlikes);
        }
        if (!btn[i].classList.contains("added")) {
            btn[i].classList.add("added");
            btn[i].addEventListener('click', function onClick() {
                if (btn[i].classList.contains(contains)) {
                    if (numeroout == -1) {
                        changeReaction(btn, i, nlikes, "btnlkd", "bottone", -1);
                    } else if (numeroout == -2) {
                        changeReaction(btn, i, nlikes, "btnFireLkd", "btnFire", -1);
                    } else if (numeroout == -3) {
                        changeReaction(btn, i, nlikes, "btnSmileLkd", "btnSmile", -1);
                    } else if (numeroout == -4) {
                        changeReaction(btn, i, nlikes, "btnCuoreLkd", "btnCuore", -1);
                    } else if(numeroout == -5) {
                        changeReaction(btn, i, nlikes, "btnBacioLkd", "btnBacio", -1);
                    }

                    removeReaction(formData, response, i, numeroout);
                } else {
                    if (numeroin == 1) {
                        changeReaction(btn, i, nlikes, "bottone", "btnlkd", 1);
                    } else if (numeroin == 2) {
                        changeReaction(btn, i, nlikes, "btnFire", "btnFireLkd", 1);
                    } else if (numeroin == 3) {
                        changeReaction(btn, i, nlikes, "btnSmile", "btnSmileLkd", 1);
                    } else if (numeroin == 4) {
                        changeReaction(btn, i, nlikes, "btnCuore", "btnCuoreLkd", 1);
                    } else if (numeroin == 5) {
                        changeReaction(btn, i, nlikes, "btnBacio", "btnBacioLkd", 1);
                    }

                    addReaction(formData, response, i, numeroin);
                }
            });
        }
    }
}

function addReaction(formData, response, i, numeroin) {
    formData.append('post_id', response[i]["post_id"]);
    formData.append('type', numeroin);
    axios.post('../php/api-like.php', formData).then(response => {
        console.log(response);
    });

    formData.delete('post_id');
    formData.delete('user');
    formData.delete('type');
}

function removeReaction(formData, response, i, numeroout) {
    formData.append('post_id', response[i]["post_id"]);
    formData.append('type', numeroout);
    axios.post('../php/api-like.php', formData).then(response => {
        console.log(response);
    });
    formData.delete('post_id');
    formData.delete('type');
}

function changeReaction(btn, i, nlikes, replaceThis, replaceWithThis, number) {
    console.log(btn[i]);
    if (number > 0) {
        btn[i].classList.replace("btn-outline-danger", "btn-danger");
    } else {
        btn[i].classList.replace("btn-danger", "btn-outline-danger");
    }
    btn[i].classList.replace(replaceThis, replaceWithThis);
    nlikes[i].innerHTML = parseInt(nlikes[i].innerHTML) + number;
}

function showAlreadyLiked(response, i, btn) {
    if (response[i]["user_has_like"] == true) {
        btn[i].classList.replace("btn-outline-danger", "btn-danger");
        btn[i].classList.replace("bottone", "btnlkd");
    }
}

function showAlreadyFire(response, i, btn) {
    if (response[i]["user_has_fire"] == true) {
        btn[i].classList.replace("btn-outline-danger", "btn-danger");
        btn[i].classList.replace("btnFire", "btnFireLkd");
    }
}

function showAlreadySmile(response, i, btn) {
    if (response[i]["user_has_smile"] == true) {
        btn[i].classList.replace("btn-outline-danger", "btn-danger");
        btn[i].classList.replace("btnSmile", "btnSmileLkd");
    }
}

function showAlreadyCuore(response, i, btn) {
    if (response[i]["user_has_cuore"] == true) {
        btn[i].classList.replace("btn-outline-danger", "btn-danger");
        btn[i].classList.replace("btnCuore", "btnCuoreLkd");
    }
}

function showAlreadyBacio(response, i, btn) {
    if (response[i]["user_has_baci"] == true) {
        btn[i].classList.replace("btn-outline-danger", "btn-danger");
        btn[i].classList.replace("btnBacio", "btnBacioLkd");
    }
}

