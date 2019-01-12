let showMedias = document.getElementById('show-medias'),
    hiddenClass = "is-hidden-mobile",
     text = "Cacher médias",
    columns = document.getElementById('hide-columns');

showMedias.addEventListener('click', function () {

    columns.classList.toggle(hiddenClass);

        if (showMedias.innerHTML === "Voir médias") {
            showMedias.innerHTML = text;
        } else {
            showMedias.innerHTML = "Voir médias";
        }
});
