// Lista de perguntas e respostas
const questions = [
    {
        question: "Complete: O céu está muito _______.",
        options: ["azul", "feliz", "rápido"],
        answer: "azul"
    },
    {
        question: "Complete: O cachorro _______ muito alto.",
        options: ["late", "corre", "dorme"],
        answer: "late"
    },
    {
        question: "Complete: Eu gosto de comer _______ no café da manhã.",
        options: ["sapatos", "pão", "papel"],
        answer: "pão"
    },
    {
        question: "Complete: A flor é muito _______.",
        options: ["bonita", "salgada", "triste"],
        answer: "bonita"
    }
];

let currentQuestionIndex = 0;

// Elementos HTML
const questionElement = document.getElementById("question");
const optionsElement = document.getElementById("options");
const feedbackElement = document.getElementById("feedback");
const nextButton = document.getElementById("next-button");

// Exibe a pergunta atual
function showQuestion() {
    const currentQuestion = questions[currentQuestionIndex];
    questionElement.textContent = currentQuestion.question;
    optionsElement.innerHTML = ""; // Limpa as opções anteriores
    feedbackElement.textContent = ""; // Limpa o feedback
    nextButton.style.display = "none"; // Esconde o botão "Próxima"

    // Cria botões para as opções
    currentQuestion.options.forEach(option => {
        const button = document.createElement("button");
        button.textContent = option;
        button.onclick = () => checkAnswer(option);
        optionsElement.appendChild(button);
    });
}

// Verifica se a resposta está correta
function checkAnswer(selectedOption) {
    const currentQuestion = questions[currentQuestionIndex];
    if (selectedOption === currentQuestion.answer) {
        feedbackElement.textContent = "🎉 Parabéns! Você acertou!";
        feedbackElement.style.color = "green";
    } else {
        feedbackElement.textContent = `❌ Que pena! A resposta correta é "${currentQuestion.answer}".`;
        feedbackElement.style.color = "red";
    }
    nextButton.style.display = "block"; // Mostra o botão "Próxima"
}

// Avança para a próxima pergunta
function nextQuestion() {
    currentQuestionIndex++;
    if (currentQuestionIndex < questions.length) {
        showQuestion();
    } else {
        questionElement.textContent = "Fim do jogo! Obrigado por jogar! 🎉";
        optionsElement.innerHTML = "";
        feedbackElement.textContent = "";
        nextButton.style.display = "none";
    }
}

// Inicia o jogo
showQuestion();
