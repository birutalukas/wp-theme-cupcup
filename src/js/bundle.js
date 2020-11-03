jQuery(document).ready(function(){
    jQuery(".hero-slider").owlCarousel({
        loop: true,
        autoplay: true,
        autoplayHoverPause: true,
        items: 1
    });
    jQuery(".partners-slider").owlCarousel({
        loop: true,
        autoplay: true,
        autoplayHoverPause: true,
        responsive:{
            0:{
                items:3
            },
            360:{
                items:4
            },
            768:{
                items:6
            }
        }
    });
});

//Mobile Nav
document.querySelector('.mobile-nav .menu-item-has-children > a').addEventListener('click', function(e) {
    e.preventDefault();
    document.querySelector('.mobile-nav .menu-item-has-children .sub-menu').classList.toggle('open');
});
document.querySelector('input[type=checkbox]').addEventListener('click', function() {
    document.querySelector('body').classList.toggle('no-scroll');
});


// Cities for Coffee Map
let coffeeList = document.querySelectorAll('.city__list');

for (let i = 1; i <= coffeeList.length; i++) {
    let btnCity = document.querySelector('#city-' + i);
    btnCity.addEventListener('click', function() {
        document.querySelector('#city-list-' + i).classList.toggle('open');
    });
};