const tl = gsap.timeline();
tl.from(".logo, .menu-items li, .lang", {
  duration: 1,
  delay: 0.5,
  opacity: 0,
  y: 50,
  stagger: {
    amount: 0.4,
  },
});
tl.from(
  ".left-container h1",
  {
    y: 100,
    skewY: 5,
    duration: 1,
    stagger: {
      amount: 0.4,
    },
  },
  "-=1"
);
tl.from(
  ".left-container-2-1 p",
  {
    x: 100,
    duration: 1,
    opacity: 0,
  },
  "-=.5"
);
tl.from(".right-container", {
  x: 500,
  opacity: 0,
  duration: 1,
});
tl.from(".left-container-2-2 p", {
  y: 50,
  duration: 0.5,
  stagger: {
    amount: 0.4,
  },
});
