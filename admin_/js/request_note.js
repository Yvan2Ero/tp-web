var classe = document.getElementById("actual_classe").value;
var cours = document.getElementById("actual_cours").value;

function r(){
if(classe != null && cours != null && classe != "" && cours != ""){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./search.php");
    xhr.onreadystatechange = function(){

        console.log(this);
    }

    var data = new FormData();
    data.append("classe", classe);
    data.append("cours", cours);

    xhr.send(data);
}
}