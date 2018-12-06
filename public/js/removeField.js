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

