/*JS file for the page that displays all listings, this includes functionality to sort by price and submission date*/
const selectElement = document.querySelector('.sort_option');
const listings = Array.from(document.getElementsByClassName('listing'));


// Parse for number
function getPrice(element) {
    return Number(element
        .querySelector('.price')
        .textContent
        .replace(/[^\d.]+/g, ''));
}

function getDate(element) {
    return new Date(element.querySelector('.date').textContent)

}


selectElement.addEventListener('change', (event) => {
    listing_section = document.querySelector('.listings');
    listing_section.innerHTML = '';
    if (event.target.value == "highest") {
        listings.sort((a, b) => getPrice(b) - getPrice(a));
    }
    else if (event.target.value == "lowest") {
        listings.sort((a, b) => getPrice(a) - getPrice(b));
    }
    else if (event.target.value == "oldest") {
        listings.sort((a, b) => getDate(a) - getDate(b));
    }
    else if (event.target.value == "newest") {
        listings.sort((a, b) => getDate(b) - getDate(a));
    }
    listings.forEach(element => listing_section.appendChild(element));

});

