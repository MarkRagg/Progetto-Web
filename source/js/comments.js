getParameter = (key) => {
  
  address = window.location.search

  parameterList = new URLSearchParams(address)

  return parameterList.get(key)
}

const idjs = getParameter('post_id');

const bottonePosta = document.querySelector(".bttnpost");

document.querySelector(".commento").addEventListener('keyup', function() {
  if (document.querySelector(".commento").value.length > 0){
    document.querySelector(".bttnpost").disabled = false;
  }
  else{
    document.querySelector(".bttnpost").disabled = true;
  }
});

bottonePosta.addEventListener('click', function onClick() {
  const comment = document.querySelector(".commento").value;
  console.log(comment);
  if(comment.length > 0) {
    const formData = new FormData();
    formData.append('comment', comment);
    formData.append('post_id', idjs);
    
    axios.post('../php/api-add-comment.php', formData).then(response => {
      console.log(response.data);
      location.reload();
    });
  }
});
