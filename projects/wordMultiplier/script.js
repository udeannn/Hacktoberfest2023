let inputText = document.querySelector('#inputText > input[name="inputText"]');
let inputNumber = document.querySelector('#inputNumber > input[name="inputNumber"]');
let output = document.querySelector('#output > textarea');
let submitButton = document.querySelector('#submit');
let resetButton  = document.querySelector('#reset');
let copyButton  = document.querySelector('#copy');

submitButton.addEventListener('click', () => {
    let word = inputText.value;
    let multiplier = parseInt(inputNumber.value);
    let result = Array(multiplier).fill(word).join(' ');
    output.value = result;
});

copyButton.addEventListener('click', () => {
    navigator.clipboard.writeText(output.value)
    .then(() => {
        alert('Text copied to clipboard');
    })
        .catch(err => {
        alert('Error in copying text: ', err);
    });
});

resetButton.addEventListener('click', () => {
    inputText.value = '';
    inputNumber.value = '';
    output.value  = '';
});