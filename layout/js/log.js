var form = document.querySelector("form"),
sign_button = document.querySelector("form button"),
box_messages = document.querySelector("form .error-message"),
container = document.querySelector(".warpper-main .log-in");

sign_button.onclick = function(e){
    e.preventDefault();

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "log_backend.php", true)
    xhr.onload = function(){
        if(xhr.readyState == XMLHttpRequest.DONE){
            if(xhr.status == 200){
                let data = xhr.response;
                box_messages.style.display = 'block';
                container.style.height = '430px';
                box_messages.innerHTML = data;
                if(data.includes("Hello")){
                    if(data.includes("Admin")){
                        window.location.href = 'main_admin.php';
                    }
                    if(data.includes("Member")){
                        window.location.href = 'main_member.php';
                    }
                    setTimeout(() => {
                        box_messages.style.display = 'none';
                        container.style.height = '360px';
                    }, 1000);
                }else{
                }
            }
        }
    }
    let form_data = new FormData(form);
    xhr.send(form_data);
}