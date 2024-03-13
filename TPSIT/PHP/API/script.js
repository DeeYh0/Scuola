fetch('users.php')
    .then(function(response){
        return response.json();
})
    .then(function(data){
        console.log(data)
        document.querySelector("body").innerHTML = JSON.stringify(data);
});