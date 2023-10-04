function pull(){
    const randomNumber = Math.floor(Math.random() * 5) + 1;
    const starContainer = document.getElementById('star-container')
    let html = ''
    for (let index = 1; index <= randomNumber; index++) {
        html += '<img src="assets/star.png" alt="star" class="img-star">'
    }
    starContainer.innerHTML = html
    const result = document.getElementById('result')
    result.innerHTML = `<h1>Congratulations on getting a ${randomNumber}-star weapon</h1>`
}