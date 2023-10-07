var nav_button = document.getElementById("nav_button");
var sidebar = document.getElementById("side_content");

nav_button.onclick = function(){
    sidebar.classList.toggle("sideon");
}

var item = document.getElementsByClassName("item_card");
var buyoption = document.getElementsByClassName("buy");

item.onclick = function(){
    item.classList.toggle("card-on");
    buyoption.classList.toggle("buy-on");
}

const search_button = document.getElementById("search_button");
const searchbar = document.getElementById("search");

search_button.onclick = function(){
    if(searchbar.style.display != "flex")
    {
        searchbar.style.display = "flex";
    }
    else{
        searchbar.style.display = "none";
    }
}

const explore = document.getElementById('Explore_button');
const scroll_section = document.querySelector('.ShopCard');

explore.addEventListener('click',() => {
    scroll_section.scrollIntoView({behavior:"smooth"});
});