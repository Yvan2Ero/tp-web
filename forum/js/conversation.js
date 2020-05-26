
function readMessage()
{
    var xhr = new XMLHttpRequest();
    xhr.open('POST','conversationHandler.php');

    var data = new FormData();
    var sub = document.getElementById("subject");
    data.append('subject',sub.value);
    xhr.onload = function()
    {
        const response = JSON.parse(this.responseText);
        var html = "";
        for(var i=0; i<response.length; i++)
        {
            html += '\
                <div class="post">\
                    <strong>'+response[i].pseudo_autor+':</strong>\
                    <p>'+response[i].contenu_post+'</p>\
                    <em>'+(response[i].date_post).substring(0,16)+'</em>\
                </div>\
            ';
        }
        var posts = document.getElementById("posts");
        posts.innerHTML = html
        posts.scrollTop = posts.scrollHeight;
    }

    xhr.send(data);
}

function postMessage(e)
{
    e.preventDefault();
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "conversationHandler.php?task=write");
    xhr.onload = function (){
        var rps = JSON.parse(this.responseText);
        var erreur = null;
        if(rps.erreur){
            erreur = rps.erreur;
        }
        if(erreur!=null)
        {
            //CREATION DU TEXTE D'ERREUR
            var p = document.createElement('p');
            p.id = "error_alert";
            p.title = "message_error";
            p.style ="text-align: center; color: red";
            console.log(document.querySelector("#errors").hasChildNodes());
            if(!document.querySelector("#errors").hasChildNodes())
            {
                document.querySelector("#errors").appendChild(p);
            var content_errors = document.createTextNode(erreur);
            p.appendChild(content_errors);
            //CREATION DU BOUTTON DE FERMETURE

            var btn = document.createElement('button');
            btn.id = "close_alert";
            btn.type = "button";
            p.appendChild(btn);
            var croix = document.createTextNode("Fermer");
            btn.appendChild(croix);
            btn.addEventListener("click", function(e){
                var target = e.target.parentNode;
                target.parentNode.removeChild(target);
            });
            }
            
        }
        document.getElementById("i_n").value="";
        document.getElementById("i_n").focus();
        readMessage();
    }

    var data = new FormData();
    var subject = document.getElementById("subject").value;
    var content = document.getElementById("i_n").value;
    var btn     = document.getElementById('btn').value;
    console.log(content);
    data.append("subject", subject);
    data.append("input_message", content);
    data.append("btn", btn);

    xhr.send(data);

}
document.getElementById("form-post").addEventListener("submit", postMessage);

readMessage();

const i = window.setInterval(readMessage, 3000);
