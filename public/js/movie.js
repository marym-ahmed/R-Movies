let details = document.querySelectorAll('.details');
let card = document.querySelectorAll('.card');
let movieName =document.querySelectorAll('.movieName')
console.log(movieName);
for (let i = 0; i < details.length; i++) {
    console.log(details[i].offsetHeight);
    details[i].style.bottom = `-${details[i].offsetHeight - movieName[i].offsetHeight}px`;
}
for (let i = 0; i < card.length; i++) {
    card[i].addEventListener('mouseover', function () {
        details[i].style.bottom = `0px`;
    })

}
for (let i = 0; i < details.length; i++) {
    card[i].addEventListener('mouseout', function () {
        details[i].style.bottom = `-${details[i].offsetHeight - movieName[i].offsetHeight}px`;
    })
}
