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


/* Load more videos */

    // + and - icons
let plusIcon = document.getElementById("btnNewVideo");
let minusIcon = document.getElementById("btnDelVideo");

let buttons = document.getElementById("buttons");
let index = document.querySelector('#collection').getAttribute('data-index');


    // Add new video form field
plusIcon.addEventListener('click', function (e) {
    e.preventDefault();

    console.log(document.querySelector('#collection').getAttribute('data-prototype'));

    //get data-prototype
    let prototype = document.querySelector('#collection').getAttribute('data-prototype');
    let newForm = prototype.replace(/__name__/g, index);

    document.querySelector('#collection').setAttribute('data-index', index);

    // Display the form
    plusIcon.insertAdjacentHTML('afterend', newForm);

    index++;
});


   /** // Remove field
minusIcon.addEventListener('click', function (e) {
    e.preventDefault();
    let newForm = prototype.replace(/__name__/g, index);
    newForm.parentNode.removeChild();

})**/


/**
// Remove video field     Le mieux : un signe - en face de chaque nouveau champ.
minusIcon.addEventListener('click', function (e) {
    e.preventDefault();

    // get the div that holds the collection
    var collectionHolder = document.getElementById('collection');
    // field followed by buttons
    var newLinkLi = document.getElementById('url-field').insertAdjacentHTML('afterend', buttons);

    // add a 'delete' link to all of the existing form elements    N'IMPORTE QUOI !
    // var elements = collectionHolder.querySelectorAll("li");

    Array.prototype.forEach.call(elements, function () {

    // remove the field
    var newLinkLi.removeChild(newLinkLi);
    //});
    });
} )

**/