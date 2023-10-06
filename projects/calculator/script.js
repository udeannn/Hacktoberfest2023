// Define a function to perform calculations
function calculate(event) {
    event.preventDefault(); // Prevent the default form submission behavior

    // Get the values and operation selected by the user
    let n1 = parseFloat(document.getElementById('num1').value);
    let n2 = parseFloat(document.getElementById('num2').value);
    let operation = document.getElementById('operacao').value;

    // Check if the selected operation is valid
    if (operation == '' || operation == 'NA') {
        alert("Choose an operation");
        return;
    }

    let result; // Initialize a variable to store the result

    // Perform the calculation based on the selected operation
    if (operation == '+') {
        result = n1 + n2;
    }
    if (operation == '-') {
        result = n1 - n2;
    }
    if (operation == '*') {
        result = n1 * n2;
    }
    if (operation == '/') {
        result = n1 / n2;
    }

    // Display the result section
    document.getElementById('resultado').style.display = 'block';
    document.getElementById('result').style.display = 'block';

    // Update the result value on the page
    document.getElementById('result').innerHTML = result;
}

// Hide the result section initially
document.getElementById('resultado').style.display = 'none';
document.getElementById('result').style.display = 'none';

// Add an event listener to the form for calculation
document.getElementById('formCalc').addEventListener('submit', calculate);
