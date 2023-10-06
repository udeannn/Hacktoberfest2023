let copy = document.querySelector(".copy");
let coba = document.querySelector(".coba");
let article = document.querySelector(".whois");

let names = `Kita Ikuyo`;

const whois = (name) => {
  return `Who is <span class="red">${name}</span>? For the blind, she is vision. For the hungry, she is the chef. For the thirsty, she is water. If <span class="red">${name}</span> thinks, I agree. If <span class="red">${name}</span> speaks, I’m listening. If <span class="red">${name}</span> has a million fans, I am one of them. If <span class="red">${name}</span> has ten fans, I am one of them. If <span class="red">${name}</span> has only one fan, that is me. If <span class="red">${name}</span> has no fans, I no longer exist. If the whole world is against <span class="red">${name}</span> , I am against the whole world. I will love <span class="red">${name}</span> until my very last breath.`;
};

article.innerHTML = whois(names);

coba.addEventListener("input", (e) => {
  names = e.target.value;
  article.innerHTML = whois(names);
});

copy.addEventListener("click", function () {
  navigator.clipboard
    .writeText(article.innerText)
    .then(() => {
      alert("Copy text success.");
    })
    .catch((err) => {
      alert(`Copy text failed: , ${err}`);
    });
});
