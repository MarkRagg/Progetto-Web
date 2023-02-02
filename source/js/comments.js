getParameter = (key) => {
  
  address = window.location.search

  parameterList = new URLSearchParams(address)

  return parameterList.get(key)
}

console.log("ciao");

const x = document.querySelector("#bottoneLikePost");
console.log(x);

const bottonePosta = document.querySelector(".bttnpost");

bottonePosta.addEventListener('click', function onClick() {
  const post = document.querySelector(".commento").value;
  console.log(post);
  /*
  const formData = new FormData();
  formData.append('post', post);
  axios.post('api-quickpost.php', formData).then(response => {
    if (!response.data["error"]) {
      location.reload();
      console.log(response.data["info"]);
    } else {
      console.log(response.data["info"]);
    }
  });
  */
});


/*
const formData = new FormData();
const id = getParameter('post_id');
formData.append('post_id', id);

axios.post('api-post-comment.php', formData).then(response => {
  console.log(response.data);
  console.log(id);

});



axios.get('api-post-comment.php').then(response => {
  console.log(response.data);
});

*/

