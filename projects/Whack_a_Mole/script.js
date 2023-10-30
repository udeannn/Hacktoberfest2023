let score = 0;
let misses = 0;

function getRandomHole() {
    const holes = document.querySelectorAll('.hole');
    const randomIndex = Math.floor(Math.random() * holes.length);
    return holes[randomIndex];
}

function startGame() {
    gameInterval = setInterval(() => {
        const mole = getRandomHole();
        mole.textContent = '👾';
        setTimeout(() => {
            mole.textContent = '';
            if (!mole.classList.contains('whacked')) {
                misses++;
                document.getElementById('misses').textContent = misses;
            }
            mole.classList.remove('whacked');

            if (misses === 3) {
                clearInterval(gameInterval);
                document.getElementById('endMessage').innerHTML = `<p>Game Over! Your Score: ${score}</p>`;
            }
        }, 1000);
    }, 1500);
}

function restartGame() {
    clearInterval(gameInterval);
    score = 0;
    misses = 0;
    document.getElementById('score').textContent = score;
    document.getElementById('misses').textContent = misses;
    document.getElementById('endMessage').textContent = '';
    startGame(); // Restart the game
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.hole').forEach(hole => {
        hole.addEventListener('click', () => {
            if (hole.textContent === '👾') {
                score++;
                document.getElementById('score').textContent = score;
                hole.classList.add('whacked');
            }
        });
    });

    const restartBtn = document.getElementById('restartBtn');
    restartBtn.addEventListener('click', restartGame);

    startGame(); // Start the game
});


