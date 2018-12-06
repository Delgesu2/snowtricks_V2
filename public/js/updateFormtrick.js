/* Show loaded images in HTML */
function showFiles() {

    var files = document.getElementById("update_trick_photo").files;
    document.getElementById("loadedFiles").innerHTML = "";

    for (var i=0; i<files.length; i++) {
        //alert("Photo choisie: " + files.name);
        var content=document.createTextNode(files[i].name);
        var side=document.getElementById("loadedFiles");

        side.appendChild(content);
    }

}


/* Load more videos */
// + and - icons
let plusIcon = document.getElementById("btnNewVideo");
// let minusIcon = document.getElementById("btnDelVideo");
let index = document.querySelector('#collection').getAttribute('data-index');


// Add new video form field
plusIcon.addEventListener('click', function (e) {
    e.preventDefault();

   // console.log(document.querySelector('#collection').getAttribute('data-prototype'));

    //get data-prototype
    let prototype = document.querySelector('#collection').getAttribute('data-prototype');

    // change name
    let newForm = prototype.replace(/__name__/g, index);

    // Display the form
    document.querySelector('#collection > div:last-child').insertAdjacentHTML('afterend', newForm);

    document.querySelector('#collection > div:last-child .btnDelVideo').addEventListener('click', function (e) {
        e.preventDefault();
        console.log(this.dataset);

        let target = this.dataset.target;

        document.getElementById(target).remove();
    } )

    index++;

    document.querySelector('#collection').setAttribute('data-index', index);

});

// Remove video field
let minusIcons = document.getElementsByClassName("btnDelVideo");

for (var i = 0; i<minusIcons.length; i++) {

    minusIcons[i].addEventListener('click', function (e) {
        e.preventDefault();
        console.log(this.dataset);

        let target = this.dataset.target;

        document.getElementById(target).remove();
    } )

}