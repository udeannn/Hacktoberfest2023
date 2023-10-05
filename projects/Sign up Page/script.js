const ticker = document.querySelector('.ticker');
const passwordInput = document.getElementById("password");
const instructions = document.querySelector(".instructions");
const submitButton = document.getElementById("submit-button");

passwordInput.addEventListener("input", () => {
  const password = passwordInput.value;

  const hasLength = password.length >= 8;
  const hasNumber = /\d/.test(password);
  const hasUppercase = /[A-Z]/.test(password);
  const hasSpecialSymbol = /[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/.test(password);

  if (hasLength && hasNumber && hasUppercase && hasSpecialSymbol) {
    instructions.style.display = "none";
    submitButton.removeAttribute("disabled");
  } else {
    instructions.style.display = "block";
    submitButton.setAttribute("disabled", "true");
  }
});
function startCountdown() {
  var countdownHours = document.getElementById("countdown-hours");
  var countdownMinutes = document.getElementById("countdown-minutes");
  var countdownSeconds = document.getElementById("countdown-seconds");
  var timeLeft = 3600; // 1 hour in seconds

  function updateCountdown() {
    var hours = Math.floor(timeLeft / 3600);
    var minutes = Math.floor((timeLeft % 3600) / 60);
    var seconds = timeLeft % 60;

    countdownHours.textContent = (hours < 10 ? "0" : "") + hours;
    countdownMinutes.textContent = (minutes < 10 ? "0" : "") + minutes;
    countdownSeconds.textContent = (seconds < 10 ? "0" : "") + seconds;

    timeLeft--;
  }

  updateCountdown();
  let interval = setInterval(updateCountdown, 1000); // Update every second
}



const textElement = document.getElementById("text-animation");
const sentences = [
  "Fly with ease Book with Breeze",
  "Cheapest Flights",
  "24x7 Customer Service"
];
let sentenceIndex = 0;
let letterIndex = 0;

function animateText() {
  if (sentenceIndex < sentences.length) {
    if (letterIndex < sentences[sentenceIndex].length) {
      textElement.textContent += sentences[sentenceIndex][letterIndex];
      letterIndex++;
      setTimeout(animateText, 100); // Adjust the animation speed here
    } else {
      setTimeout(eraseText, 1000);
    }
  } else {
    sentenceIndex = 0;
    setTimeout(animateText, 1000); // Delay before typing the next sentence
  }
}

function eraseText() {
  if (letterIndex > 0) {
    textElement.textContent = textElement.textContent.slice(0, -1);
    letterIndex--;
    setTimeout(eraseText, 50); // Adjust the erase speed as needed
  } else {
    sentenceIndex++;
    setTimeout(animateText, 500); // Delay before typing the next sentence
  }
}



// Start the text animation when the page loads
animateText();
// Start the countdown when the page loads
startCountdown();
