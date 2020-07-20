function like(id) {
    // console.log('rrr');
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            
            var like = document.getElementById('nbreLikesPost'+id);
            like.innerHTML = xhttp.responseText;
            var icon = document.getElementById('myIcon'+id);
            var classList = icon.classList.value;   
            

            if(classList.includes("fa-heart-o")) {
                icon.classList.remove("fa-heart-o");
                icon.classList.add("fa-heart");
                icon.style.color = "red";
            } else {
                icon.classList.remove("fa-heart");
                icon.classList.add("fa-heart-o");
                icon.style.color = "";
            }
            
       }
    };
    xhttp.open("GET", "http://localhost:8000/like/"+id, true);
    xhttp.send();
}