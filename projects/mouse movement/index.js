let hero;
let text;
window.onload = function () {
  hero = document.querySelector(".hero");
  text = hero.querySelector("h1");

  hero.addEventListener("mousemove", shadow);
};
function shadow(e) {
  const { offsetWidth: width, offsetHeight: height } = hero;
  // let x=e.offsetX;
  // let y=e.offsetY;
  let { offsetX: x, offsetY: y } = e;
  if (this !== e.target) {
    x = x + e.target.offsetLeft;
    y = y + e.target.offsetTop;
  }

  const walk = 500;
  const xWalk = (x / width) * walk - walk / 2;
  const yWalk = (y / height) * walk - walk / 2;
  text.style.textShadow = `
  ${xWalk}px ${yWalk}px 1px rgba(255,0,255,0.7),
  ${xWalk * -1}px ${yWalk}px 2px rgba(0,255,255,0.7),
  ${yWalk}px ${xWalk}px 3px rgba(0,0,255,0.7),
  ${yWalk * -1}px ${xWalk}px 4px rgba(0,255,0,0.7)
  `;
}
