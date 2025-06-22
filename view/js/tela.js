// Lista de jogos com dados completos
const games = [
  {
    id: 1,
    title: "Genius",
    description: "Teste sua memória com sequências coloridas e sons",
    subject: "logica",
    difficulty: "medium",
    image: "../img/genius.jpg",
    featured: true,
    link: "../../games/Genius_2.0/index.html",
    tags: ["Memória", "Sequência", "Concentração"],
  },
  {
    id: 2,
    title: "Adivinha a Palavra",
    description: "Descubra palavras ocultas e expanda seu vocabulário",
    subject: "portugues",
    difficulty: "easy",
    image: "../img/guesstheword.png",
    featured: true,
    tags: ["Vocabulário", "Ortografia", "Raciocínio"],
  },
  {
    id: 3,
    title: "Desafio Matemático",
    description: "Resolva problemas e torne-se um mestre dos números",
    subject: "matematica",
    difficulty: "hard",
    image: "../img/matematica.png",
    featured: true,
    tags: ["Cálculo", "Lógica", "Números"],
  },
  {
    id: 4,
    title: "Tabuada Divertida",
    description: "Aprenda multiplicação de forma interativa",
    subject: "matematica",
    difficulty: "easy",
    image: "../img/matematica (1).png",
    featured: true,
    tags: ["Multiplicação", "Tabuada", "Básico"],
  },
  {
    id: 5,
    title: "Caça-Palavras Científico",
    description: "Encontre termos científicos escondidos",
    subject: "ciencias",
    difficulty: "medium",
    image: "../img/download.jpeg",
    featured: true,
    tags: ["Vocabulário", "Ciência", "Pesquisa"],
  },
  {
    id: 6,
    title: "Quiz de Geografia",
    description: "Teste seus conhecimentos sobre países e capitais",
    subject: "geografia",
    difficulty: "medium",
    image: "../img/geografia.png",
    featured: true,
    tags: ["Países", "Capitais", "Mundo"],
  },
  {
    id: 7,
    title: "Laboratório Virtual",
    description: "Experimente reações químicas em segurança",
    subject: "ciencias",
    difficulty: "hard",
    image: "../img/tubos-de-ensaio.png",
    featured: true,
    tags: ["Química", "Experimentos", "Laboratório"],
  },
  {
    id: 8,
    title: "Linha do Tempo",
    description: "Organize eventos históricos cronologicamente",
    subject: "historia",
    difficulty: "medium",
    image: "../img/evolucao.png",
    tags: ["História", "Cronologia", "Eventos"],
  },
  {
    id: 9,
    title: "Quebra-Cabeça Lógico",
    description: "Resolva puzzles desafiadores de raciocínio",
    subject: "logica",
    difficulty: "hard",
    image: "../img/puzzle.png",
    tags: ["Puzzle", "Raciocínio", "Estratégia"],
  },
  {
    id: 10,
    title: "Conjugação Verbal",
    description: "Pratique conjugações de verbos portugueses",
    subject: "portugues",
    difficulty: "medium",
    image: "../img/conjugacaoverbal.jpeg",
    tags: ["Verbos", "Gramática", "Conjugação"],
  },
  {
    id: 11,
    title: "Sistema Solar",
    description: "Explore planetas e suas características",
    subject: "ciencias",
    difficulty: "easy",
    image: "../img/solarsytem.png",
    tags: ["Planetas", "Astronomia", "Espaço"],
  },
  {
    id: 12,
    title: "Frações Divertidas",
    description: "Aprenda frações com pizzas e bolos",
    subject: "matematica",
    difficulty: "medium",
    image: "../img/grafico-de-pizza.png",
    tags: ["Frações", "Divisão", "Visual"],
  },
]

// Variables
let currentSlide = 0
let filteredGames = [...games]
const isLoading = false

// DOM Elements
const carouselTrack = document.getElementById("carouselTrack")
const indicators = document.querySelectorAll(".indicator")
const prevBtn = document.getElementById("prevBtn")
const nextBtn = document.getElementById("nextBtn")
const gamesGrid = document.getElementById("games-grid")
const searchInput = document.getElementById("search")
const searchBtn = document.getElementById("search-btn")
const difficultyFilter = document.getElementById("difficultyFilter")
const subjectFilter = document.getElementById("subjectFilter")
const loadingContainer = document.getElementById("loadingContainer")
const menuToggleBtn = document.getElementById("menuToggleBtn")

// Initialize
document.addEventListener("DOMContentLoaded", () => {
  initializeCarousel()
  loadGames()
  initializeFilters()
  initializeSearch()
  initializeMenuToggle()
  initializeSubjects()

  // Auto-play carousel
  setInterval(nextSlide, 5000)
})

// Carousel Functions
function initializeCarousel() {
  // Set up carousel controls
  if (prevBtn) prevBtn.addEventListener("click", prevSlide)
  if (nextBtn) nextBtn.addEventListener("click", nextSlide)

  // Set up indicators
  indicators.forEach((indicator, index) => {
    indicator.addEventListener("click", () => goToSlide(index))
  })

  // Touch/swipe support
  let startX = 0
  let endX = 0

  if (carouselTrack) {
    carouselTrack.addEventListener("touchstart", (e) => {
      startX = e.touches[0].clientX
    })

    carouselTrack.addEventListener("touchend", (e) => {
      endX = e.changedTouches[0].clientX
      handleSwipe()
    })
  }

  function handleSwipe() {
    const swipeThreshold = 50
    const diff = startX - endX

    if (Math.abs(diff) > swipeThreshold) {
      if (diff > 0) {
        nextSlide()
      } else {
        prevSlide()
      }
    }
  }
}

function goToSlide(slideIndex) {
  currentSlide = slideIndex
  updateCarousel()
}

function nextSlide() {
  currentSlide = (currentSlide + 1) % 3
  updateCarousel()
}

function prevSlide() {
  currentSlide = currentSlide === 0 ? 2 : currentSlide - 1
  updateCarousel()
}

function updateCarousel() {
  if (carouselTrack) {
    carouselTrack.style.transform = `translateX(-${currentSlide * 100}%)`
  }

  // Update indicators
  indicators.forEach((indicator, index) => {
    indicator.classList.toggle("active", index === currentSlide)
  })
}

// Games Functions
function loadGames(showLoading = true) {
  if (showLoading) {
    showLoadingAnimation()
  }

  setTimeout(() => {
    renderGames(filteredGames)
    hideLoadingAnimation()
  }, 800)
}

function renderGames(gamesToRender) {
  if (!gamesGrid) return

  gamesGrid.innerHTML = ""

  if (gamesToRender.length === 0) {
    gamesGrid.innerHTML = `
            <div style="
                grid-column: 1 / -1;
                text-align: center;
                padding: 3rem;
                color: #64748b;
            ">
                <div style="font-size: 4rem; margin-bottom: 1rem;">🔍</div>
                <h3 style="margin-bottom: 0.5rem;">Nenhum jogo encontrado</h3>
                <p>Tente ajustar os filtros ou pesquisar por outro termo</p>
            </div>
        `
    return
  }

  gamesToRender.forEach((game, index) => {
    const gameCard = createGameCard(game)
    gameCard.style.animationDelay = `${index * 0.1}s`
    gamesGrid.appendChild(gameCard)
  })
}

function createGameCard(game) {
  const card = document.createElement("div")
  card.className = "game-card"
  card.setAttribute("data-subject", game.subject)
  card.setAttribute("data-difficulty", game.difficulty)

  const difficultyText = {
    easy: "Fácil",
    medium: "Médio",
    hard: "Difícil",
  }

  card.innerHTML = `
        <div class="game-card-image">
            <img src="${game.image}" alt="${game.title}" loading="lazy">
            <div class="game-card-overlay">
                <div class="card-play-button">
                    <i class="fas fa-play"></i>
                </div>
            </div>
        </div>
        <div class="game-card-content">
            <h3 class="game-card-title">${game.title}</h3>
            <p class="game-card-description">${game.description}</p>
            <div class="game-card-footer">
                <span class="game-card-subject subject-${game.subject}">
                    ${getSubjectName(game.subject)}
                </span>
                <span class="game-card-difficulty">
                    ${difficultyText[game.difficulty]}
                </span>
            </div>
        </div>
    `

  // Add click event
  card.addEventListener("click", () => {
    playGame(game)
  })

  return card
}

function getSubjectName(subject) {
  const subjects = {
    matematica: "Matemática",
    portugues: "Português",
    ciencias: "Ciências",
    geografia: "Geografia",
    historia: "História",
    logica: "Lógica",
  }
  return subjects[subject] || subject
}

function playGame(game) {
  if (game.link) {
    // Show loading modal before redirect
    showGameLoadingModal(game)
    setTimeout(() => {
      window.location.href = game.link
    }, 1500)
  } else {
    showComingSoonModal(game)
  }
}

function showGameLoadingModal(game) {
  const modal = document.createElement("div")
  modal.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        animation: fadeIn 0.3s ease;
    `

  const content = document.createElement("div")
  content.style.cssText = `
        background: white;
        padding: 3rem;
        border-radius: 16px;
        text-align: center;
        max-width: 400px;
        margin: 1rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    `

  content.innerHTML = `
        <div class="loading-spinner" style="margin-bottom: 2rem;">
            <div class="spinner-ring"></div>
            <div class="spinner-ring"></div>
            <div class="spinner-ring"></div>
        </div>
        <h3 style="margin-bottom: 1rem; color: #1e293b; font-size: 1.5rem;">
            Carregando ${game.title}
        </h3>
        <p style="color: #64748b;">Preparando uma experiência incrível...</p>
    `

  modal.appendChild(content)
  document.body.appendChild(modal)

  // Remove after redirect
  setTimeout(() => {
    modal.remove()
  }, 2000)
}

function showComingSoonModal(game) {
  const modal = document.createElement("div")
  modal.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
    `

  const content = document.createElement("div")
  content.style.cssText = `
        background: white;
        padding: 2rem;
        border-radius: 16px;
        text-align: center;
        max-width: 400px;
        margin: 1rem;
    `

  content.innerHTML = `
        <div style="font-size: 4rem; margin-bottom: 1rem;">🚀</div>
        <h3 style="margin-bottom: 1rem; color: #1e293b; font-size: 1.5rem;">
            ${game.title}
        </h3>
        <p style="color: #64748b; margin-bottom: 1.5rem;">
            Este jogo estará disponível em breve!<br>
            Fique ligado para mais novidades.
        </p>
        <button onclick="this.closest('.modal').remove()" style="
            background: linear-gradient(135deg, #340069, #8a4fd3);
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 1rem;
        ">Entendi</button>
    `

  modal.className = "modal"
  modal.appendChild(content)
  document.body.appendChild(modal)

  // Close on outside click
  modal.addEventListener("click", (e) => {
    if (e.target === modal) {
      modal.remove()
    }
  })
}

// Filter Functions
function initializeFilters() {
  if (difficultyFilter) {
    difficultyFilter.addEventListener("change", applyFilters)
  }
  if (subjectFilter) {
    subjectFilter.addEventListener("change", applyFilters)
  }
}

function applyFilters() {
  const difficulty = difficultyFilter?.value || ""
  const subject = subjectFilter?.value || ""
  const searchTerm = searchInput?.value.toLowerCase() || ""

  filteredGames = games.filter((game) => {
    const matchesDifficulty = !difficulty || game.difficulty === difficulty
    const matchesSubject = !subject || game.subject === subject
    const matchesSearch =
      !searchTerm ||
      game.title.toLowerCase().includes(searchTerm) ||
      game.description.toLowerCase().includes(searchTerm) ||
      game.tags.some((tag) => tag.toLowerCase().includes(searchTerm))

    return matchesDifficulty && matchesSubject && matchesSearch
  })

  loadGames()
}

// Search Functions
function initializeSearch() {
  if (searchInput) {
    searchInput.addEventListener("input", debounce(applyFilters, 300))
    searchInput.addEventListener("keypress", (e) => {
      if (e.key === "Enter") {
        applyFilters()
      }
    })
  }

  if (searchBtn) {
    searchBtn.addEventListener("click", applyFilters)
  }
}

// Menu Toggle Functions
function initializeMenuToggle() {
  if (!menuToggleBtn) return

  const sidebar = document.querySelector(".sidebar")
  const mainContent = document.querySelector(".main-content")
  let isCollapsed = false

  menuToggleBtn.addEventListener("click", () => {
    isCollapsed = !isCollapsed

    if (isCollapsed) {
      document.body.classList.add("sidebar-collapsed")
    } else {
      document.body.classList.remove("sidebar-collapsed")
    }
  })

  // Auto-collapse on mobile
  if (window.innerWidth <= 768) {
    document.body.classList.add("sidebar-collapsed")
  }
}

// Subject Functions
function initializeSubjects() {
  const subjectItems = document.querySelectorAll(".subject-item")

  subjectItems.forEach((item) => {
    item.addEventListener("click", () => {
      // Remove active class from all subjects
      subjectItems.forEach((s) => s.classList.remove("active"))

      // Add active class to clicked subject
      item.classList.add("active")

      // Filter games by subject
      const subject = item.getAttribute("data-subject")
      if (subjectFilter) {
        subjectFilter.value = subject
        applyFilters()
      }

      // Scroll to games section
      document.querySelector(".games-section")?.scrollIntoView({
        behavior: "smooth",
      })
    })
  })
}

// Utility Functions
function debounce(func, wait) {
  let timeout
  return function executedFunction(...args) {
    const later = () => {
      clearTimeout(timeout)
      func(...args)
    }
    clearTimeout(timeout)
    timeout = setTimeout(later, wait)
  }
}

function showLoadingAnimation() {
  if (loadingContainer) {
    loadingContainer.style.display = "flex"
  }
  if (gamesGrid) {
    gamesGrid.style.opacity = "0.5"
  }
}

function hideLoadingAnimation() {
  if (loadingContainer) {
    loadingContainer.style.display = "none"
  }
  if (gamesGrid) {
    gamesGrid.style.opacity = "1"
  }
}

// Navigation Functions
document.querySelectorAll(".nav-item").forEach((item) => {
  item.addEventListener("click", function () {
    // Remove active class from all nav items
    document.querySelectorAll(".nav-item").forEach((nav) => {
      nav.classList.remove("active")
    })

    // Add active class to clicked item
    this.classList.add("active")

    // Handle navigation
    const text = this.textContent.trim()
    console.log(`Navegando para: ${text}`)

    if (text === "Favoritos") {
      showFavorites()
    } else if (text === "Recentes") {
      showRecent()
    } else {
      // Reset to all games
      filteredGames = [...games]
      loadGames()
    }
  })
})

function showFavorites() {
  // Simulate favorites (in real app, this would come from user data)
  const favoriteIds = [1, 3, 5, 8]
  filteredGames = games.filter((game) => favoriteIds.includes(game.id))
  loadGames()
}

function showRecent() {
  // Simulate recent games (in real app, this would come from user data)
  const recentIds = [1, 2, 4, 6, 7]
  filteredGames = games.filter((game) => recentIds.includes(game.id))
  loadGames()
}

// Keyboard shortcuts
document.addEventListener("keydown", (e) => {
  if (e.key === "ArrowLeft" && e.ctrlKey) {
    e.preventDefault()
    prevSlide()
  } else if (e.key === "ArrowRight" && e.ctrlKey) {
    e.preventDefault()
    nextSlide()
  } else if (e.key === "/" && e.ctrlKey) {
    e.preventDefault()
    searchInput?.focus()
  }
})

// Smooth scrolling for internal links
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    e.preventDefault()
    const target = document.querySelector(this.getAttribute("href"))
    if (target) {
      target.scrollIntoView({
        behavior: "smooth",
        block: "start",
      })
    }
  })
})
