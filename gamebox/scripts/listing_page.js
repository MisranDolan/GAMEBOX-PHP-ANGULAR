
/*JS file for the page of a specific listing, which handles the creation of an image carousel for viewing, along with an error message if an item is sold out */
$('.carousel').carousel({
    interval: 3000,
    keyboard: true,
    pause: 'hover',
    wrap: true
});

$('#slider4').on('slide.bs.carousel', function () { });

$('#slider4').on('slid.bs.carousel', function () { });


function error_click() {
    var msg = document.getElementById("error");
    console.log(msg);
    msg.innerHTML = "Sold out!";

}