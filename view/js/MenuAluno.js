/**
 * LevelUp Student Interface JavaScript
 * Provides interactive functionality for the student dashboard
 */

document.addEventListener("DOMContentLoaded", () => {
  // Variables
  const sidebarLinks = document.querySelectorAll(".sidebar a")
  const gameCards = document.querySelectorAll(".game-card")
  const searchInput = document.querySelector(".search-input")
  const searchBtn = document.querySelector(".search-btn")
  const moreActions = document.querySelector(".more-actions")
  const notifications = document.querySelector(".notifications")
  const userProfile = document.querySelector(".user-profile")
  const profileModal = document.getElementById("profile-modal")
  const closeModal = document.getElementById("close-modal")
  const loadingSpinner = document.getElementById("loading-spinner")
  const profileInfo = document.getElementById("profile-info")

  // Inicializar o controle do menu colapsável
  initializeMenuToggle()
  initializeTasksMenu()

  // Carregar progresso após um pequeno delay para garantir que os elementos estejam prontos
  setTimeout(() => {
    loadGameProgress()
    animateProgressBars()
    // Opcional: iniciar polling para atualizações automáticas
    // startProgressPolling();
  }, 1000)

  // Log do ID do aluno para debug
  console.log("ID do aluno logado:", window.STUDENT_DATA?.id)

  // Set active link in sidebar
  function setActiveLink() {
    const currentPage = window.location.pathname.split("/").pop()

    sidebarLinks.forEach((link) => {
      const href = link.getAttribute("href")
      if (href === currentPage || (currentPage === "" && href === "Home.html")) {
        link.classList.add("active")
      } else {
        link.classList.remove("active")
      }
    })
  }

  setActiveLink()

  // Add click event for sidebar links
  sidebarLinks.forEach((link) => {
    link.addEventListener("click", function (e) {
      if (this.getAttribute("href") === "#") {
        e.preventDefault()
        sidebarLinks.forEach((l) => l.classList.remove("active"))
        this.classList.add("active")
        const linkText = this.textContent.trim()
        console.log(`Navegando para: ${linkText}`)
      }
    })
  })

  // Game card interactions with enhanced animations
  gameCards.forEach((card) => {
    card.addEventListener("click", function () {
      const gameTitle = this.querySelector(".game-title").textContent
      const gameDifficulty = this.querySelector(".game-difficulty").textContent

      console.log(`Jogo selecionado: ${gameTitle} (${gameDifficulty})`)

      // Enhanced game selection with modal
      showGameModal(gameTitle, gameDifficulty)
    })

    card.addEventListener("mouseenter", function () {
      this.style.transform = "translateY(-8px) scale(1.02)"
    })

    card.addEventListener("mouseleave", function () {
      this.style.transform = "translateY(0) scale(1)"
    })
  })

  // Enhanced game selection modal
  function showGameModal(title, difficulty) {
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
            animation: fadeIn 0.3s ease;
        `

    const content = document.createElement("div")
    content.style.cssText = `
            background: white;
            padding: 2rem;
            border-radius: 16px;
            text-align: center;
            max-width: 400px;
            margin: 1rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        `

    const gameIcon =
      title === "Genius" ? "🧠" : title.includes("Matemática") ? "🔢" : title.includes("Lógica") ? "🧩" : "🧪"

    content.innerHTML = `
            <div style="font-size: 4rem; margin-bottom: 1rem;">${gameIcon}</div>
            <h3 style="margin-bottom: 1rem; color: #1e293b; font-size: 1.5rem;">${title}</h3>
            <p style="color: #64748b; margin-bottom: 1rem;">Dificuldade: ${difficulty}</p>
            <p style="color: #64748b; margin-bottom: 2rem;">Pronto para começar a jogar?</p>
            <div style="display: flex; gap: 1rem; justify-content: center;">
                <button onclick="this.closest('.game-modal').remove()" style="
                    background: #e2e8f0;
                    color: #64748b;
                    border: none;
                    padding: 0.75rem 1.5rem;
                    border-radius: 8px;
                    cursor: pointer;
                    font-weight: 600;
                    transition: all 0.3s ease;
                ">Cancelar</button>
                <button onclick="startGame('${title}'); this.closest('.game-modal').remove();" style="
                    background: linear-gradient(135deg, #340069, #8a4fd3);
                    color: white;
                    border: none;
                    padding: 0.75rem 1.5rem;
                    border-radius: 8px;
                    cursor: pointer;
                    font-weight: 600;
                    transition: all 0.3s ease;
                ">Jogar Agora</button>
            </div>
        `

    modal.className = "game-modal"
    modal.appendChild(content)
    document.body.appendChild(modal)

    // Close on outside click
    modal.addEventListener("click", (e) => {
      if (e.target === modal) {
        modal.remove()
      }
    })
  }

  // Start game function
  window.startGame = (gameTitle) => {
    if (gameTitle === "Genius") {
      // Redirect to actual Genius game
      window.location.href = "../../games/Genius_2.0/index.html"
    } else {
      // Show coming soon for other games
      showComingSoon(gameTitle)
    }
  }

  // Coming soon modal
  function showComingSoon(gameTitle) {
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
            <div style="font-size: 3rem; margin-bottom: 1rem;">🚀</div>
            <h3 style="margin-bottom: 1rem; color: #1e293b;">${gameTitle}</h3>
            <p style="color: #64748b; margin-bottom: 1.5rem;">Este jogo estará disponível em breve!</p>
            <button onclick="this.closest('.modal').remove()" style="
                background: linear-gradient(135deg, #340069, #8a4fd3);
                color: white;
                border: none;
                padding: 0.75rem 1.5rem;
                border-radius: 8px;
                cursor: pointer;
                font-weight: 600;
            ">Entendi</button>
        `

    modal.className = "modal"
    modal.appendChild(content)
    document.body.appendChild(modal)

    modal.addEventListener("click", (e) => {
      if (e.target === modal) {
        modal.remove()
      }
    })
  }

  // Search functionality
  function performSearch() {
    const searchTerm = searchInput.value.trim()
    if (searchTerm !== "") {
      console.log(`Pesquisando por: ${searchTerm}`)
      // Enhanced search with visual feedback
      searchBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>'

      setTimeout(() => {
        searchBtn.innerHTML = '<i class="fas fa-search"></i>'
        showSearchResults(searchTerm)
      }, 1000)
    }
  }

  function showSearchResults(term) {
    alert(`Resultados para: "${term}"\n\nEsta funcionalidade será implementada em breve!`)
  }

  if (searchBtn) {
    searchBtn.addEventListener("click", performSearch)
  }

  if (searchInput) {
    searchInput.addEventListener("keypress", (e) => {
      if (e.key === "Enter") {
        performSearch()
      }
    })
  }

  // Enhanced notifications interaction
  if (notifications) {
    notifications.addEventListener("click", () => {
      showNotificationsModal()
    })
  }

  function showNotificationsModal() {
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
            padding: 0;
            border-radius: 16px;
            max-width: 500px;
            margin: 1rem;
            overflow: hidden;
        `

    content.innerHTML = `
            <div style="background: #340069; color: white; padding: 1.5rem; text-align: center;">
                <h3 style="margin: 0; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                    <i class="fas fa-bell"></i> Notificações
                </h3>
            </div>
            <div style="padding: 1.5rem;">
                <div style="display: flex; align-items: center; gap: 1rem; padding: 1rem; background: #f8fafc; border-radius: 8px; margin-bottom: 1rem;">
                    <div style="width: 40px; height: 40px; background: #22c55e; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white;">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <div>
                        <strong>Parabéns!</strong><br>
                        <small style="color: #64748b;">Você completou o nível 5 do Genius!</small>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 1rem; padding: 1rem; background: #f8fafc; border-radius: 8px; margin-bottom: 1rem;">
                    <div style="width: 40px; height: 40px; background: #3b82f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white;">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div>
                        <strong>Nova atividade</strong><br>
                        <small style="color: #64748b;">Exercícios de matemática disponíveis</small>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 1rem; padding: 1rem; background: #f8fafc; border-radius: 8px; margin-bottom: 1.5rem;">
                    <div style="width: 40px; height: 40px; background: #f59e0b; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white;">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div>
                        <strong>Lembrete</strong><br>
                        <small style="color: #64748b;">Prazo da redação: 10/05/2025</small>
                    </div>
                </div>
                <button onclick="this.closest('.modal').remove()" style="
                    background: linear-gradient(135deg, #340069, #8a4fd3);
                    color: white;
                    border: none;
                    padding: 0.75rem 1.5rem;
                    border-radius: 8px;
                    cursor: pointer;
                    font-weight: 600;
                    width: 100%;
                ">Fechar</button>
            </div>
        `

    modal.className = "modal"
    modal.appendChild(content)
    document.body.appendChild(modal)

    modal.addEventListener("click", (e) => {
      if (e.target === modal) {
        modal.remove()
      }
    })
  }

  // Profile Modal Functions
  function openProfileModal() {
    if (profileModal) {
      profileModal.classList.add("show")
      document.body.style.overflow = "hidden"
      loadStudentProfile()
    }
  }

  function closeProfileModal() {
    if (profileModal) {
      profileModal.classList.remove("show")
      document.body.style.overflow = "auto"
    }
  }

  function loadStudentProfile() {
    // Show loading spinner
    if (loadingSpinner) {
      loadingSpinner.style.display = "block"
    }
    if (profileInfo) {
      profileInfo.style.display = "none"
    }

    // Get student ID from global variable passed by PHP
    const studentId = getStudentId()

    if (studentId) {
      // Make AJAX request to get student data
      fetch(`../../controller/getAluno.php?id=${studentId}`)
        .then((response) => {
          if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`)
          }
          return response.json()
        })
        .then((data) => {
          if (data.success) {
            populateProfileData(data.aluno)
          } else {
            showError("Erro ao carregar dados do perfil: " + data.message)
          }
        })
        .catch((error) => {
          console.error("Erro:", error)
          showError("Erro de conexão ao carregar dados do perfil")
        })
        .finally(() => {
          if (loadingSpinner) {
            loadingSpinner.style.display = "none"
          }
          if (profileInfo) {
            profileInfo.style.display = "grid"
          }
        })
    } else {
      showError("ID do aluno não encontrado")
      if (loadingSpinner) {
        loadingSpinner.style.display = "none"
      }
      if (profileInfo) {
        profileInfo.style.display = "grid"
      }
    }
  }

  function populateProfileData(aluno) {
    // Update modal header
    const firstLetter = aluno.nome.charAt(0).toUpperCase()
    const modalAvatar = document.getElementById("modal-avatar")
    const modalName = document.getElementById("modal-name")

    if (modalAvatar) modalAvatar.textContent = firstLetter
    if (modalName) modalName.textContent = aluno.nome

    // Update top bar user info (se não estiver já definido pelo PHP)
    const userAvatar = document.getElementById("user-avatar")
    const userName = document.getElementById("user-name")
    const greetingName = document.getElementById("greeting-name")

    if (userAvatar && !userAvatar.textContent) {
      userAvatar.textContent = firstLetter
    }
    if (userName && !userName.textContent) {
      userName.textContent = aluno.nome.split(" ")[0]
    }
    if (greetingName && greetingName.textContent.includes("Olá, !")) {
      greetingName.textContent = `Olá, ${aluno.nome.split(" ")[0]}!`
    }

    // Update profile info fields
    const fields = [
      { id: "student-id", value: aluno.ra || aluno.id },
      { id: "student-email", value: aluno.email },
      { id: "student-phone", value: aluno.telefone || aluno.tell },
      { id: "student-birth", value: formatDate(aluno.dataNasc) },
      { id: "student-class", value: aluno.turma },
      { id: "responsible-name", value: aluno.nomeResponsavel || aluno.nome_responsavel },
      { id: "responsible-phone", value: aluno.telefoneResponsavel || aluno.tell_responsavel },
    ]

    fields.forEach((field) => {
      const element = document.getElementById(field.id)
      if (element) {
        element.textContent = field.value || "-"
      }
    })
  }

  function showError(message) {
    if (profileInfo) {
      profileInfo.innerHTML = `
                <div style="text-align: center; padding: 20px; color: #d9534f;">
                    <i class="fas fa-exclamation-triangle" style="font-size: 48px; margin-bottom: 15px;"></i>
                    <p>${message}</p>
                    <button id="retry-btn" style="margin-top: 15px; padding: 8px 16px; background: var(--primary-color); color: white; border: none; border-radius: 5px; cursor: pointer;">
                        Tentar novamente
                    </button>
                </div>
            `

      const retryBtn = document.getElementById("retry-btn")
      if (retryBtn) {
        retryBtn.addEventListener("click", () => {
          loadStudentProfile()
        })
      }
    }
  }

  function formatDate(dateString) {
    if (!dateString) return "-"
    try {
      const date = new Date(dateString)
      return date.toLocaleDateString("pt-BR")
    } catch (error) {
      return "-"
    }
  }

  function getStudentId() {
    // Get student ID from global variable passed by PHP
    if (window.STUDENT_DATA && window.STUDENT_DATA.id) {
      return window.STUDENT_DATA.id
    }

    // Fallback: Try to get from URL parameters
    const urlParams = new URLSearchParams(window.location.search)
    const studentId = urlParams.get("id")

    return studentId || null
  }

  // Event listeners for modal
  if (userProfile) {
    userProfile.addEventListener("click", openProfileModal)
  }
  if (closeModal) {
    closeModal.addEventListener("click", closeProfileModal)
  }

  // Close modal when clicking outside
  if (profileModal) {
    profileModal.addEventListener("click", (e) => {
      if (e.target === profileModal) {
        closeProfileModal()
      }
    })
  }

  // Close modal with ESC key
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && profileModal && profileModal.classList.contains("show")) {
      closeProfileModal()
    }
  })

  // Progress bar animation
  function animateProgressBars() {
    const progressBars = document.querySelectorAll(".progress")
    progressBars.forEach((bar, index) => {
      const width = bar.style.width
      bar.style.width = "0"
      setTimeout(
        () => {
          bar.style.transition = "width 1s ease"
          bar.style.width = width
        },
        300 + index * 100,
      )
    })
  }

  // Menu Toggle Functions
  function initializeMenuToggle() {
    const container = document.querySelector(".container")
    const menuToggleBtn = document.getElementById("menuToggleBtn")

    if (!container || !menuToggleBtn) return

    let isMenuCollapsed = false

    function toggleMenu() {
      isMenuCollapsed = !isMenuCollapsed

      if (isMenuCollapsed) {
        container.classList.add("sidebar-collapsed")
        if (window.innerWidth <= 768) {
          container.classList.add("sidebar-open")
        }
      } else {
        container.classList.remove("sidebar-collapsed")
        if (window.innerWidth <= 768) {
          container.classList.remove("sidebar-open")
        }
      }
    }

    menuToggleBtn.addEventListener("click", toggleMenu)

    // Ajuste inicial para telas pequenas
    if (window.innerWidth <= 768) {
      toggleMenu() // Fecha o menu em mobile
    }
  }

  function initializeTasksMenu() {
    const tasksLink = document.querySelector('.sidebar a[href="#"]')
    const activitiesOverlay = document.getElementById("activities-overlay")
    const closeActivities = document.getElementById("close-activities")

    if (!tasksLink || !activitiesOverlay) return

    // Evento para abrir as atividades
    tasksLink.addEventListener("click", (e) => {
      e.preventDefault()
      activitiesOverlay.style.display = "flex"
      document.body.style.overflow = "hidden"
    })

    // Evento para fechar as atividades
    if (closeActivities) {
      closeActivities.addEventListener("click", () => {
        activitiesOverlay.style.display = "none"
        document.body.style.overflow = "auto"
      })
    }

    // Fechar ao clicar fora do conteúdo
    activitiesOverlay.addEventListener("click", (e) => {
      if (e.target === activitiesOverlay) {
        activitiesOverlay.style.display = "none"
        document.body.style.overflow = "auto"
      }
    })

    // Fechar com ESC
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape" && activitiesOverlay.style.display === "flex") {
        activitiesOverlay.style.display = "none"
        document.body.style.overflow = "auto"
      }
    })
  }

  // Game Progress Functions
  function loadGameProgress() {
    console.log("Carregando progresso do jogo...")

    // Usar o ID do aluno da sessão
    const studentId = window.STUDENT_DATA?.id

    if (!studentId) {
      console.error("ID do aluno não encontrado")
      return
    }

    console.log("Student ID:", studentId)

    // Fazer requisição para buscar o progresso
    fetch(`../../controller/getGameProgress.php?studentId=${studentId}&game=genius`)
      .then((response) => {
        console.log("Response status:", response.status)
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`)
        }
        return response.text() // Primeiro como texto para debug
      })
      .then((text) => {
        console.log("Response text:", text)
        try {
          const data = JSON.parse(text)
          console.log("Response data:", data)

          if (data.success && data.progress) {
            updateGeniusProgress(data.progress.level, data.progress.maxLevels)
          } else {
            console.error("Erro ao carregar progresso:", data.message)
            // Mesmo com erro, atualizar com valores padrão
            updateGeniusProgress(0, 10)
          }
        } catch (e) {
          console.error("Erro ao fazer parse do JSON:", e)
          console.error("Response não é JSON válido:", text)
          updateGeniusProgress(0, 10)
        }
      })
      .catch((error) => {
        console.error("Erro ao carregar progresso do jogo:", error)
        // Em caso de erro, mostrar progresso zerado
        updateGeniusProgress(0, 10)
      })
  }

  // Função para atualizar a exibição do progresso do Genius
  function updateGeniusProgress(currentLevel, maxLevels) {
    console.log(`Atualizando progresso: ${currentLevel}/${maxLevels}`)

    const progressElement = document.getElementById("genius-progress")

    if (progressElement && maxLevels > 0) {
      const percentage = Math.round((currentLevel / maxLevels) * 100)
      const progressBar = progressElement.querySelector(".progress")
      const progressPercentage = progressElement.querySelector(".progress-percentage")
      const progressText = progressElement.querySelector(".progress-text")

      if (progressBar) {
        progressBar.style.width = `${percentage}%`
        console.log(`Progress bar width set to: ${percentage}%`)
      }

      if (progressPercentage) {
        progressPercentage.textContent = `${percentage}%`
      }

      if (progressText) {
        const infoText = currentLevel > 0 ? `Completo (Nível ${currentLevel}/${maxLevels})` : "Completo"
        progressText.textContent = infoText
        console.log(`Progress info updated: ${infoText}`)
      }

      // Adicionar classe de destaque se o jogo estiver completo
      if (percentage === 100) {
        progressElement.classList.add("completed-game")
      } else {
        progressElement.classList.remove("completed-game")
      }
    } else {
      console.error("Elemento genius-progress não encontrado ou maxLevels inválido")
    }
  }

  // Função para atualizar o progresso periodicamente (opcional)
  function startProgressPolling() {
    // Atualizar a cada 30 segundos
    setInterval(loadGameProgress, 30000)
  }

  // Log do ID do aluno para debug
  console.log("ID do aluno logado:", getStudentId())

  // Initialize profile data on page load if needed
  setTimeout(() => {
    const studentId = getStudentId()
    if (studentId && window.STUDENT_DATA) {
      console.log("Dados do aluno disponíveis:", window.STUDENT_DATA)
    }
  }, 500)
})
