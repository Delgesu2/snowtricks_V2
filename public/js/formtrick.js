/* Show loaded images in HTML */
 function showFiles() {

    var files = document.getElementById("create_trick_photo").files;
                document.getElementById("loadedFiles").innerHTML = "";

    for (var i=0; i<files.length; i++) {
        //alert("Photo choisie: " + files.name);
        var content=document.createTextNode(files[i].name);
        var side=document.getElementById("loadedFiles");

        side.appendChild(content);
        }

}
