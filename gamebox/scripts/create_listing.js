/*JS file that defines the create listing logic, which includes multiple different kinds of JS warnings if listing qualifications are not met*/
var submitButton = document.getElementById("submit_listing")
submitButton.addEventListener('click', checkListingForm);

var description_length = document.getElementById("length_description")
var description_input_box = document.getElementById("description");


description_input_box.addEventListener('input', function () {
    description_length.textContent = description_input_box.value.length
});

var form = document.getElementById("listing-form");
function handleForm(event) { event.preventDefault(); }
form.addEventListener('submit', handleForm);

function isInt(str) {
    var val = parseInt(str);
    return (val > 0);
}

var checkMoneyExpression = function (str) {
    var pattern = new RegExp("^[0-9]+(\.[0-9]{1,2})?$");
    var match_test = pattern.test(str);
    return match_test;
}


var s = true;
function checkListingForm() {
    const title = document.getElementById("title");
    const title_warning = document.getElementById("title_warning");
    if (title.value.length < 8) {
        title.style.borderColor = "red"
        title_warning.style.display = "block"
        title.focus()
        s = false;
    } else {
        title.style.borderColor = "#ced4da"
        title_warning.style.display = "none"
    }

    const game = document.getElementById("game");
    const game_warning = document.getElementById("game_warning");

    if (game.value.length < 1) {
        game.style.borderColor = "red"

        game.focus()
        game_warning.style.display = "block"
        s = false;

    } else {
        game.style.borderColor = "#ced4da"

        game_warning.style.display = "none"
    }

    const location = document.getElementById("location");
    const location_warning = document.getElementById("location_warning");

    if (location.value.length < 1) {
        location.style.borderColor = "red"
        location.focus()
        location_warning.style.display = "block"
        s = false;

    } else {
        location.style.borderColor = "#ced4da"
        location_warning.style.display = "none"
    }

    const price = document.getElementById("price");
    const price_warning = document.getElementById("price_warning");

    if ((checkMoneyExpression(price.value)) == false) {
        price.style.borderColor = "red"
        price_warning.style.display = "block"
        price.focus()
        s = false;

    } else {
        price.style.borderColor = "#ced4da"
        price_warning.style.display = "none"
    }

    const description = document.getElementById("description");
    const description_warning = document.getElementById("description_warning");

    if (description.value.length > 1000) {
        description_warning.style.display = "block"
        description.focus()
        s = false;
    } else {
        description_warning.style.display = "none"
    }
    console.log(s)
    if (s == false) {
        return false;
    } else {
        document.getElementById("listing-form").submit();
    };
}