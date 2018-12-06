/* Show loaded image in HTML */
function showFile() {

    let file = document.getElementById("user_registration_photo").files[0];
    let side = document.getElementById("loadedFile");

    if(file) {

        alert("Photo choisie: " + file.name);
        let content = document.createTextNode(file.name);
        document.getElementById("loadedFile").innerHTML = "";
        side.appendChild(content);
    }
}

function showFileUpdating() {

    let file = document.getElementById("update_user_photo").files[0];
    let side = document.getElementById("loadedFile");

    if(file) {

        alert("Photo choisie: " + file.name);
        let content = document.createTextNode(file.name);
        document.getElementById("loadedFile").innerHTML = "";
        side.appendChild(content);
    }
}
