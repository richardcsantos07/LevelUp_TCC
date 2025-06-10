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

const TOTAL_LEVELS = 10; // Total de fases no jogo
let currentLevel = 0; // Fase atual do jogador

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
    currentLevel = 1; // Começar do nível 1
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

    if (!good) {
        console.log(`Usuário perdeu no nível ${turn}`);
        on = false;
        clearInterval(intervalId);
        flashColor();
        turnCounter.innerHTML = "ERRO";
        return;
    }

    if (turn === playerOrder.length && good && !win) {
        currentLevel = turn; // Sincronizar nível com o contador
        
        // Salvar progresso a cada nível completado
        saveProgress();
        
        turn++;
        
        if (turn > TOTAL_LEVELS) {
            winGame();
        } else {
            showLevelUp();
            resetTurn();
        }
    }
}

function resetTurn() {
    playerOrder = [];
    compTurn = true;
    flash = 0;
    turnCounter.innerHTML = turn;
    intervalId = setInterval(gameTurn, getSpeedForLevel(currentLevel));
}

function winGame() {
    flashColor();
    turnCounter.innerHTML = "WIN!";
    on = false;
    win = true;
    console.log("Usuário ganhou o jogo!");
    // Progresso já foi salvo na função check()
}

function saveProgress() {
    console.log(`Salvando progresso: Nível ${currentLevel}`);
    
    fetch('../../controller/saveGameProgress.php', {
        method: 'POST',
        credentials: 'include',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            game: 'genius',
            level: currentLevel,
            maxLevels: TOTAL_LEVELS
        })
    })
    .then(response => {
        console.log('Response status:', response.status);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.text(); // Primeiro como texto para debug
    })
    .then(text => {
        console.log('Response text:', text);
        try {
            const data = JSON.parse(text);
            console.log('Response data:', data);
            if (data.success) {
                console.log('Progresso salvo com sucesso!');
            } else {
                console.error('Erro ao salvar progresso:', data.message);
            }
        } catch (e) {
            console.error('Erro ao fazer parse do JSON:', e);
            console.error('Response não é JSON válido:', text);
        }
    })
    .catch(error => {
        console.error('Erro na requisição:', error);
    });
}

function getSpeedForLevel(level) {
    // Velocidades em milissegundos - diminui conforme avança
    const speeds = [1000, 900, 800, 700, 600, 500, 450, 400, 350, 300];
    return speeds[Math.min(level - 1, speeds.length - 1)];
}

function showLevelUp() {
    const levelDisplay = document.createElement('div');
    levelDisplay.id = 'level-display';
    levelDisplay.textContent = `Fase ${currentLevel} Completa!`;
    levelDisplay.style.position = 'absolute';
    levelDisplay.style.top = '50%';
    levelDisplay.style.left = '50%';
    levelDisplay.style.transform = 'translate(-50%, -50%)';
    levelDisplay.style.color = 'white';
    levelDisplay.style.fontSize = '24px';
    levelDisplay.style.fontFamily = '"Original Surfer", cursive';
    levelDisplay.style.zIndex = '1000';
    levelDisplay.style.textShadow = '2px 2px 4px rgba(0,0,0,0.8)';
    levelDisplay.style.background = 'rgba(0,0,0,0.7)';
    levelDisplay.style.padding = '10px 20px';
    levelDisplay.style.borderRadius = '10px';
    
    document.getElementById('inner-circle').appendChild(levelDisplay);
    
    setTimeout(() => {
        if (levelDisplay.parentNode) {
            levelDisplay.remove();
        }
    }, 2000);
}