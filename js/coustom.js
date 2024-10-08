$(document).ready(function () {
    $('.single-slide-carousel').owlCarousel({
        items: 3, // Display three slides at a time
        loop: true, // Enable looping
        nav: false, // Show navigation arrows
        dots: false, // Enable dots for navigation
        margin: 20, // Margin between items
        autoplay: true, // Enable auto sliding
        autoplayTimeout: 5000, // Time between slides (5 seconds)
        autoplayHoverPause: true, // Pause on hover
        smartSpeed: 600, // Speed of the transition
        // animateOut: 'fadeOut', // Disable this for troubleshooting
        responsive: {
            0: {
                items: 1 // 1 item on small screens
            },
            768: {
                items: 2 // 2 items on medium screens
            },
            992: {
                items: 3 // 3 items on large screens
            },
            1200: {
                items: 3 // 3 items on extra-large screens
            }
        }
    });
});
