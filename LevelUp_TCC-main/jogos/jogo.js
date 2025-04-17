// Variáveis globais
let num1, num2, operator, correctAnswer;
let correctCount = 0;
let wrongCount = 0;
let timer = 15;
let interval;
let difficulty = 'medium';

// Função para ajustar dificuldade
function setDifficulty() {
    difficulty = document.getElementById('difficulty').value;
    resetGame();
}

// Função para gerar números baseados na dificuldade
function generateRandomNumber() {
    if (difficulty === 'easy') return Math.floor(Math.random() * 10) + 1;
    if (difficulty === 'medium') return Math.floor(Math.random() * 20) + 1;
    return Math.floor(Math.random() * 50) + 1; // Difícil
}

// Função para gerar uma nova pergunta
function generateQuestion() {
    num1 = generateRandomNumber();
    num2 = generateRandomNumber();
    operator = Math.random() > 0.5 ? '+' : '-';
    correctAnswer = operator === '+' ? num1 + num2 : num1 - num2;

    document.getElementById('question').textContent = 
        `Quantos são ${num1} ${operator} ${num2}?`;
    document.getElementById('feedback').textContent = '';
    document.getElementById('answer').value = '';
}

// Função para verificar a resposta
function checkAnswer() {
    const userAnswer = parseInt(document.getElementById('answer').value);
    const feedback = document.getElementById('feedback');
    if (userAnswer === correctAnswer) {
        correctCount++;
        feedback.textContent = '🎉 Parabéns! Você acertou!';
        feedback.style.color = 'green';
    } else {
        wrongCount++;
        feedback.textContent = `❌ Que pena! A resposta correta é ${correctAnswer}.`;
        feedback.style.color = 'red';
    }
    updateScoreboard();
    generateQuestion();
}

// Função para atualizar o placar
function updateScoreboard() {
    document.getElementById('correct').textContent = correctCount;
    document.getElementById('wrong').textContent = wrongCount;
}

// Função para iniciar o temporizador
function startTimer() {
    clearInterval(interval);
    timer = 15;
    interval = setInterval(() => {
        timer--;
        document.getElementById('timer').textContent = timer;
        if (timer === 0) {
            wrongCount++;
            updateScoreboard();
            generateQuestion();
            timer = 15;
        }
    }, 1000);
}

// Função para resetar o jogo
function resetGame() {
    correctCount = 0;
    wrongCount = 0;
    updateScoreboard();
    generateQuestion();
    startTimer();
}

// Inicia o jogo ao carregar a página
window.onload = resetGame;
