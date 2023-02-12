getParameter = (key) => {

  address = window.location.search

  parameterList = new URLSearchParams(address)

  return parameterList.get(key)
}

const idjs = getParameter('post_id');

const bottonePosta = document.querySelector(".bttnpost");

document.querySelector(".commento").addEventListener('keyup', function () {
  if (document.querySelector(".commento").value.length > 0) {
    document.querySelector(".bttnpost").disabled = false;
  }
  else {
    document.querySelector(".bttnpost").disabled = true;
  }
});

bottonePosta.addEventListener('click', function onClick() {
  const comment = document.querySelector(".commento").value;
  console.log(comment);
  if (comment.length > 0) {
    const formData = new FormData();
    formData.append('comment', comment);
    formData.append('post_id', idjs);

    axios.post('../php/api-add-comment.php', formData).then(response => {
      console.log(response.data);
      location.reload();
    });
  }
});

const elimina = document.querySelectorAll(".elimina");
if(elimina.length > 0){
  for (let i = 0; i < elimina.length; i++) {
    elimina[i].addEventListener('click', function onClick() {
      const id = elimina[i].getAttribute("id");
      const formData = new FormData();
      formData.append('comment_id', id);
      formData.append('post_id', idjs);
      axios.post('../php/api-delete-comment.php', formData).then(response => {
        console.log(response.data);
        if(response.data["status"]=="success"){
          location.reload();
        }
      });
    });
  }
}

const formData = new FormData();
formData.append('post_id', idjs);

axios.post('../php/api-reactions-on-comment-post.php', formData).then(response => {
  if(response.data[0]["error"] == false){
    console.log(response.data);
    const btnLike = "bottoneL";
    const numeroLike = "numeroLike"
    updateButton(response.data, btnLike, numeroLike, 1, -1, "btnlkd");
    const btnFire = "btnFireL";
    const numeroFire = "numeroFire"
    updateButton(response.data, btnFire, numeroFire, 2, -2, "btnFireLkd");
    const btnSmile = "btnSmileL"
    const numeroSmile = "numeroSmile"
    updateButton(response.data, btnSmile, numeroSmile, 3, -3, "btnSmileLkd");
    const btnCuore = "btnCuoreL"
    const numeroCuore = "numeroCuore"
    updateButton(response.data, btnCuore, numeroCuore, 4, -4, "btnCuoreLkd");
    const btnBacio = "btnBacioL"
    const numeroBacio = "numeroBacio"
    updateButton(response.data, btnBacio, numeroBacio, 5, -5, "btnBacioLkd");
  } else {
    console.log(response.data);
  }
});