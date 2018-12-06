/* responsiveness
var modal = document.querySelector('.modal');
modal.addEventListener('click', function(event) {
    event.stopPropagation();
    modal.classList.toggle('is-active');
});
*/

/* Show more tricks landing page script */

// cache vars

var parent = document.querySelector('#container'),
 items  = parent.querySelectorAll('#row'),
 loadMoreBtn =  document.querySelector('#load-more-tricks'),
 maxItems = 1,
 hiddenClass = "visually-hidden";


 [].forEach.call(items, function(item, idx){
    if (idx > maxItems - 1) {
        item.classList.add(hiddenClass);
    }
});

 loadMoreBtn.addEventListener('click', function(){

    [].forEach.call(document.querySelectorAll('.' + hiddenClass), function(item, idx){
        console.log(item);
        if (idx <= maxItems - 1) {
            item.classList.remove(hiddenClass);
        }

        if ( document.querySelectorAll('.' + hiddenClass).length === 0) {
            loadMoreBtn.style.display = 'none';
        }

    });

});