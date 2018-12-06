/* Load more videos */

    //+ AND - ICONES
    let plusIcon = document.getElementById("btnNewVideo");
    let minusIcon = document.getElementById("btnDelVideo");

    let buttons = document.getElementById("buttons");
    let index = document.querySelector('#collection').getAttribute('data-index');

    // ADD NEW VIDEO FORM FIELDS
plusIcon.addEventListener('click', function (e) {
    e.preventDefault();

    console.log(document.querySelector('#collection').getAttribute('data-prototype'));

        //get data-prototype
        let prototype = document.querySelector('#collection').getAttribute('data-prototype');
        let newForm = prototype.replace(/__name__/g, index);



        //let videoForm = document.querySelector('#url-field');

        document.querySelector('#collection').setAttribute('data-index', index);

       // Display the form
        buttons.insertAdjacentHTML('afterend', newForm);

        index++;
    });



    // Remove video field
minusIcon.addEventListener('click', function (e) {
    e.prevent
    // get the div that holds the collection
    var collectionHolder = document.getElementById('collection');
    // field followed by buttons
    //var newLinkLi = document.getElementById('url-field').insertAdjacentHTML('afterend', buttons);

    // add a 'delete' link to all of the existing form elements    N'IMPORTE QUOI !
   // var elements = collectionHolder.querySelectorAll("li");

    //Array.prototype.forEach.call(elements, function () {

        //minusIcon.addEventListener("click", function (e) {

            //e.preventDefault();
            // remove the field

    var
            newLinkLi.parentNode.removeChild(newLinkLi);
        //});
   // });
}
