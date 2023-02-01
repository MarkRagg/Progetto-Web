getParameter = (key) => {
  
  address = window.location.search

  parameterList = new URLSearchParams(address)

  return parameterList.get(key)
}


const formData = new FormData();
const id = getParameter('post_id');
formData.append('post_id', id);
/*
axios.post('api-post-comment.php', formData).then(response => {
  console.log(response.data);
  console.log(id);

});
*/


axios.get('api-post-comment.php').then(response => {
  console.log(response.data);
});



