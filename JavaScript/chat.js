const form = document.querySelector(".typing-area"),
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".chat-box");

form.onsubmit = (e)=>{
    e.preventDefault(); //preventing form from submitting
}

sendBtn.onclick = ()=>{
        //Ajax scripting
        let xhr = new XMLHttpRequest(); //creating XML object
        xhr.open("POST", "php/insert-chat.php", true);
        xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    inputField.value = ""; //this leaves the message blank once the message is sent
                    scrollToBottom();
                }
            }
        }
        //sending form data through ajax to php
        let formData = new FormData(form); //creating new formData Object
        xhr.send(formData);//sending the formdata to php
}

chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}
chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}

setInterval(()=>{
    //Ajax script
    let xhr = new XMLHttpRequest(); //Creating XML Object
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                chatBox.innerHTML = data;
                if(!chatBox.classList.contains("active")){
                    scrollToBottom();
                }
            }     
        }
    }

    let formData = new FormData(form); //creating new formData Object
    xhr.send(formData);//sending the formdata to php
}, 500); //ths function would run frequently after 500ms

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
}