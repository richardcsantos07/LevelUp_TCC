let order = [];
let playerOrder = [];
let flash;
let turn;
let good;
let compTurn;
let intervalId;
let strict = false;
let noise = true;
let on = false;
let win;

const turnCounter = document.querySelector("#turn");
const topLeft = document.querySelector("#topleft");
const topRight = document.querySelector("#topright");
const bottomLeft = document.querySelector("#bottomleft");
const bottomRight = document.querySelector("#bottomright");
const strictButton = document.querySelector("#strict");
const onButton = document.querySelector("#on");
const startButton = document.querySelector("#start");

strictButton.addEventListener("click", () => {
    strict = strictButton.checked;
});

onButton.addEventListener("click", () => {
    on = onButton.checked;
    turnCounter.innerHTML = on ? "-" : "";
    clearColor();
    clearInterval(intervalId);
});

startButton.addEventListener("click", () => {
    if (on || win) {
        play();
    }
});

function play() {
    win = false;
    order = Array.from({ length: 20 }, () => Math.floor(Math.random() * 4) + 1);
    playerOrder = [];
    flash = 0;
    intervalId = 0;
    turn = 1;
    turnCounter.innerHTML = "1";
    good = true;
    compTurn = true;
    intervalId = setInterval(gameTurn, 800);
}

function gameTurn() {
    on = false;
    if (flash === turn) {
        clearInterval(intervalId);
        compTurn = false;
        clearColor();
        on = true;
    }

    if (compTurn) {
        clearColor();
        setTimeout(() => {
            playSoundAndColor(order[flash]);
            flash++;
        }, 200);
    }
}

function playSoundAndColor(position) {
    const sounds = {
        1: "clip1",
        2: "clip2",
        3: "clip3",
        4: "clip4"
    };
    const colors = {
        1: topLeft,
        2: topRight,
        3: bottomLeft,
        4: bottomRight
    };

    if (noise) {
        document.getElementById(sounds[position]).play();
    }
    noise = true;
    colors[position].style.backgroundColor = getActiveColor(position);
}

function getActiveColor(position) {
    return {
        1: "green",
        2: "rgb(204, 20, 20)",
        3: "rgb(255, 187, 17)",
        4: "rgb(39, 39, 224)"
    }[position];
}

function clearColor() {
    topLeft.style.backgroundColor = "darkgreen";
    topRight.style.backgroundColor = "darkred";
    bottomLeft.style.backgroundColor = "rgb(194, 144, 17)";
    bottomRight.style.backgroundColor = "darkblue";
}

function flashColor() {
    topLeft.style.backgroundColor = "lightgreen";
    topRight.style.backgroundColor = "tomato";
    bottomLeft.style.backgroundColor = "yellow";
    bottomRight.style.backgroundColor = "lightskyblue";
}

topLeft.addEventListener("click", () => handlePlayerClick(1));
topRight.addEventListener("click", () => handlePlayerClick(2));
bottomLeft.addEventListener("click", () => handlePlayerClick(3));
bottomRight.addEventListener("click", () => handlePlayerClick(4));

function handlePlayerClick(position) {
    if (on) {
        playerOrder.push(position);
        check();
        playSoundAndColor(position);
        if (!win) {
            setTimeout(clearColor, 300);
        }
    }
}

function check() {
    if (playerOrder[playerOrder.length - 1] !== order[playerOrder.length - 1]) {
        good = false;
    }

    if (playerOrder.length === 20 && good) {
        winGame();
    }

    if (!good) {
        flashColor();
        turnCounter.innerHTML = "ERRO";
        setTimeout(() => {
            turnCounter.innerHTML = turn;
            clearColor();
            if (strict) {
                play();
            } else {
                resetTurn();
            }
        }, 800);
        noise = false;
    } else if (turn === playerOrder.length && good && !win) {
        turn++;
        resetTurn();
    }
}

function resetTurn() {
    playerOrder = [];
    compTurn = true;
    flash = 0;
    turnCounter.innerHTML = turn;
    intervalId = setInterval(gameTurn, 800);
}

function winGame() {
    flashColor();
    turnCounter.innerHTML = "WIN!";
    on = false;
    win = true;
}