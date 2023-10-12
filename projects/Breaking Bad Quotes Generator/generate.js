const generateButton = document.querySelector('.generate-quotes');

generateButton.addEventListener('click', async function(){
    const [{quote,author}] = await getQuote();
    putAnimation();
    setTimeout(()=>{
        refreshQuote(quote,author);
    },1000)
});

function getQuote(){
    return fetch('https://api.breakingbadquotes.xyz/v1/quotes')
    .then(quote => quote.json())
    .then(quote => quote);
}

function refreshQuote(quote,author){
    const quoteplace = document.querySelector('.quotes');
    const character = document.querySelector('.character');
    quoteplace.innerHTML = quote;
    character.innerHTML = author;
}


function putAnimation(){
    const quoteplace = document.querySelector('.quotes');
        quoteplace.classList.add('clicked')
        setTimeout(()=>{
            quoteplace.classList.remove('clicked')
        },1000)
    
}