var form = document.querySelector("form"),
sign_button = document.querySelector("form button"),
box_messages = document.querySelector("form .error-message");

sign_button.onclick = function(e){
    e.preventDefault();

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "edite_game_backend.php", true)
    xhr.onload = function(){
        if(xhr.readyState == XMLHttpRequest.DONE){
            if(xhr.status == 200){
                let data = xhr.response;
                box_messages.style.display = 'block';
                box_messages.innerHTML = data;
                if(data == 'Success'){
                    setTimeout(() => {
                        box_messages.style.display = 'none';
                    }, 3000);
                }else{
                }
            }
        }
    }
    let form_data = new FormData(form);
    xhr.send(form_data);
}