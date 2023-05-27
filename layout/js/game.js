var form = document.querySelector(".comment-game form"),
sign_button = document.querySelector(".comment-game form button"),
textarea = document.querySelector(".comment-game form textarea"),
comments = document.querySelector(".game .comments");

sign_button.onclick = function(e){
    e.preventDefault();

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "comments.php", true)
    xhr.onload = function(){
        if(xhr.readyState == XMLHttpRequest.DONE){
            if(xhr.status == 200){
                let data = xhr.response;
                textarea.value = '';
            }
        }
    }
    let form_data = new FormData(form);
    xhr.send(form_data);
}

setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "comments_get.php", true)
    xhr.onload = function(){
        if(xhr.readyState == XMLHttpRequest.DONE){
            if(xhr.status == 200){
                let data = xhr.response;
                comments.innerHTML = data;
            }
        }
    }
    let form_data = new FormData(form);
    xhr.send(form_data);
}, 500);