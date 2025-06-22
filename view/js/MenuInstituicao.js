document.addEventListener("DOMContentLoaded", () => {
  console.log("Menu Instituição carregado")

  // Initialize all components
  initializeMenuToggle()
  initializeNavigation()
  initializeSubmenus()
  initializeQuickActions()
  initializeModals()
  initializeFormHandlers()
  initializeSearch()

  // Load initial data if needed
  loadDashboardData()
})

// ==================== MENU TOGGLE ====================
function initializeMenuToggle() {
  const menuToggleBtn = document.getElementById("menuToggleBtn")
  const container = document.querySelector(".container")

  if (!menuToggleBtn || !container) return

  let isCollapsed = false

  menuToggleBtn.addEventListener("click", () => {
    isCollapsed = !isCollapsed

    if (isCollapsed) {
      container.classList.add("sidebar-collapsed")
    } else {
      container.classList.remove("sidebar-collapsed")
    }

    // Store state in localStorage
    localStorage.setItem("sidebarCollapsed", isCollapsed)
  })

  // Restore state from localStorage
  const savedState = localStorage.getItem("sidebarCollapsed")
  if (savedState === "true") {
    container.classList.add("sidebar-collapsed")
    isCollapsed = true
  }

  // Auto-collapse on mobile
  if (window.innerWidth <= 768) {
    container.classList.add("sidebar-collapsed")
  }
}

// ==================== NAVIGATION ====================
function initializeNavigation() {
  const menuItems = document.querySelectorAll(".menu-item[data-section]")
  const pageTitle = document.getElementById("pageTitle")

  menuItems.forEach((item) => {
    item.addEventListener("click", function (e) {
      e.preventDefault()

      const sectionId = this.getAttribute("data-section")
      if (!sectionId) return

      // Update active menu item
      menuItems.forEach((menuItem) => {
        menuItem.classList.remove("active")
      })
      this.classList.add("active")

      // Show corresponding section
      showSection(sectionId)

      // Update page title
      updatePageTitle(sectionId)
    })
  })
}

function showSection(sectionId) {
  // Hide all sections
  const sections = document.querySelectorAll(".content-section")
  sections.forEach((section) => {
    section.classList.remove("active")
  })

  // Show target section
  const targetSection = document.getElementById(sectionId)
  if (targetSection) {
    targetSection.classList.add("active")

    // Load section-specific data
    loadSectionData(sectionId)
  }
}

function updatePageTitle(sectionId) {
  const pageTitle = document.getElementById("pageTitle")
  if (!pageTitle) return

  const titles = {
    dashboard: "Dashboard",
    "cadastrar-aluno": "Cadastrar Aluno",
    "listar-alunos": "Alunos Cadastrados",
    "cadastrar-professor": "Cadastrar Professor",
    "listar-professores": "Professores Cadastrados",
    "cadastrar-turma": "Criar Turma",
    "listar-turmas": "Gerenciar Turmas",
    comunicados: "Comunicados",
    configuracoes: "Configurações",
  }

  pageTitle.textContent = titles[sectionId] || "LevelUP Admin"
}

// ==================== SUBMENUS ====================
function initializeSubmenus() {
  const submenuToggles = document.querySelectorAll(".menu-item.has-submenu")

  submenuToggles.forEach((toggle) => {
    toggle.addEventListener("click", function (e) {
      e.preventDefault()

      const submenuId = this.getAttribute("data-toggle")
      const submenu = document.getElementById(submenuId)

      if (submenu) {
        const isOpen = submenu.classList.contains("open")

        // Close all other submenus
        document.querySelectorAll(".submenu.open").forEach((openSubmenu) => {
          if (openSubmenu !== submenu) {
            openSubmenu.classList.remove("open")
            openSubmenu.previousElementSibling.classList.remove("open")
          }
        })

        // Toggle current submenu
        if (isOpen) {
          submenu.classList.remove("open")
          this.classList.remove("open")
        } else {
          submenu.classList.add("open")
          this.classList.add("open")
        }
      }
    })
  })
}

// ==================== QUICK ACTIONS ====================
function initializeQuickActions() {
  const actionBtns = document.querySelectorAll(".action-btn[data-section]")

  actionBtns.forEach((btn) => {
    btn.addEventListener("click", function () {
      const sectionId = this.getAttribute("data-section")
      if (sectionId) {
        // Find and click the corresponding menu item
        const menuItem = document.querySelector(`.menu-item[data-section="${sectionId}"]`)
        if (menuItem) {
          menuItem.click()
        }
      }
    })
  })
}

// ==================== MODALS ====================
function initializeModals() {
  // Close modals when clicking outside
  document.addEventListener("click", (e) => {
    if (e.target.classList.contains("modal-backdrop")) {
      closeAllModals()
    }
  })

  // Close modals with ESC key
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
      closeAllModals()
    }
  })

  // Initialize edit buttons
  initializeEditButtons()
}

function closeAllModals() {
  const modals = document.querySelectorAll(".modal-backdrop")
  modals.forEach((modal) => {
    modal.classList.remove("show")
    document.body.style.overflow = "auto"
  })
}

function initializeEditButtons() {
  // Student edit buttons
  const editStudentBtns = document.querySelectorAll(".btn-editar-aluno")
  editStudentBtns.forEach((btn) => {
    btn.addEventListener("click", function () {
      const studentId = this.getAttribute("data-id")
      openEditStudentModal(studentId)
    })
  })

  // Teacher edit buttons
  const editTeacherBtns = document.querySelectorAll(".btn-editar-professor")
  editTeacherBtns.forEach((btn) => {
    btn.addEventListener("click", function () {
      const teacherId = this.getAttribute("data-id")
      openEditTeacherModal(teacherId)
    })
  })
}

// ==================== STUDENT FUNCTIONS ====================
function openEditStudentModal(studentId) {
  console.log("Opening edit modal for student:", studentId)

  showLoadingState("Carregando dados do aluno...")

  fetch(`../controller/getAluno.php?id=${studentId}`)
    .then((response) => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`)
      }
      return response.json()
    })
    .then((data) => {
      hideLoadingState()

      if (data.success) {
        populateStudentForm(data.aluno)
        showModal("modal-editar-aluno")
      } else {
        showNotification("Erro ao carregar dados do aluno: " + data.message, "error")
      }
    })
    .catch((error) => {
      hideLoadingState()
      console.error("Error:", error)
      showNotification("Erro ao carregar dados do aluno", "error")
    })
}

function populateStudentForm(student) {
  try {
    document.getElementById("edit-ra-aluno").value = student.id || student.ra || ""
    document.getElementById("edit-nome-aluno").value = student.nome || ""
    document.getElementById("edit-email-aluno").value = student.email || ""
    document.getElementById("edit-telefone-aluno").value = student.telefone || student.tell || ""
    document.getElementById("edit-data-nascimento").value = student.dataNasc || ""
    document.getElementById("edit-responsavel-aluno").value = student.nomeResponsavel || student.nome_responsavel || ""
    document.getElementById("edit-telefone-responsavel").value =
      student.telefoneResponsavel || student.tell_responsavel || ""

    const selectTurma = document.getElementById("edit-turma-aluno")
    if (selectTurma && student.turma) {
      selectTurma.value = student.turma
    }
  } catch (error) {
    console.error("Error populating student form:", error)
    showNotification("Erro ao preencher formulário", "error")
  }
}

function fecharModalEditarAluno() {
  closeModal("modal-editar-aluno")
  document.getElementById("form-editar-aluno").reset()
}

// ==================== TEACHER FUNCTIONS ====================
function openEditTeacherModal(teacherId) {
  console.log("Opening edit modal for teacher:", teacherId)

  showLoadingState("Carregando dados do professor...")

  fetch(`../controller/getProfessor.php?id=${teacherId}`)
    .then((response) => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`)
      }
      return response.json()
    })
    .then((data) => {
      hideLoadingState()

      if (data.success) {
        populateTeacherForm(data.professor)
        showModal("modal-editar-professor")
      } else {
        showNotification("Erro ao carregar dados do professor: " + data.message, "error")
      }
    })
    .catch((error) => {
      hideLoadingState()
      console.error("Error:", error)
      showNotification("Erro ao carregar dados do professor", "error")
    })
}

function populateTeacherForm(teacher) {
  try {
    document.getElementById("edit-id-professor").value = teacher.id || ""
    document.getElementById("edit-nome-professor").value = teacher.nome || ""
    document.getElementById("edit-email-professor").value = teacher.email || ""
    document.getElementById("edit-telefone-professor").value = teacher.telefone || teacher.tell || ""
    document.getElementById("edit-data-nascimento-professor").value = teacher.dataNasc || ""
    document.getElementById("edit-materia-professor").value = teacher.materia || ""
    document.getElementById("edit-cpf-professor").value = teacher.cpf || ""
  } catch (error) {
    console.error("Error populating teacher form:", error)
    showNotification("Erro ao preencher formulário", "error")
  }
}

function fecharModalEditarProfessor() {
  closeModal("modal-editar-professor")
  document.getElementById("form-editar-professor").reset()
}

// ==================== FORM HANDLERS ====================
function initializeFormHandlers() {
  // Student edit form
  const studentEditForm = document.getElementById("form-editar-aluno")
  if (studentEditForm) {
    studentEditForm.addEventListener("submit", handleStudentUpdate)
  }

  // Teacher edit form
  const teacherEditForm = document.getElementById("form-editar-professor")
  if (teacherEditForm) {
    teacherEditForm.addEventListener("submit", handleTeacherUpdate)
  }

  // Configuration form
  const configForm = document.getElementById("form-configuracoes")
  if (configForm) {
    configForm.addEventListener("submit", handleConfigUpdate)
  }

  // Cancel buttons
  const cancelBtns = document.querySelectorAll(".btn-cancel")
  cancelBtns.forEach((btn) => {
    btn.addEventListener("click", function (e) {
      e.preventDefault()
      const form = this.closest("form")
      if (form) {
        form.reset()
      }
      closeAllModals()
    })
  })
}

function handleStudentUpdate(e) {
  e.preventDefault()

  const formData = new FormData(e.target)
  const submitBtn = e.target.querySelector('button[type="submit"]')

  setButtonLoading(submitBtn, true)

  fetch("../controller/updateAluno.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      setButtonLoading(submitBtn, false)

      if (data.success !== false) {
        showNotification("Aluno atualizado com sucesso!", "success")
        fecharModalEditarAluno()
        setTimeout(() => window.location.reload(), 1000)
      } else {
        showNotification("Erro ao atualizar aluno: " + (data.message || "Erro desconhecido"), "error")
      }
    })
    .catch((error) => {
      setButtonLoading(submitBtn, false)
      console.error("Error:", error)
      showNotification("Erro ao atualizar aluno", "error")
    })
}

function handleTeacherUpdate(e) {
  e.preventDefault()

  const formData = new FormData(e.target)
  const submitBtn = e.target.querySelector('button[type="submit"]')

  setButtonLoading(submitBtn, true)

  fetch("../controller/updateProfessor.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      setButtonLoading(submitBtn, false)

      if (data.success !== false) {
        showNotification("Professor atualizado com sucesso!", "success")
        fecharModalEditarProfessor()
        setTimeout(() => window.location.reload(), 1000)
      } else {
        showNotification("Erro ao atualizar professor: " + (data.message || "Erro desconhecido"), "error")
      }
    })
    .catch((error) => {
      setButtonLoading(submitBtn, false)
      console.error("Error:", error)
      showNotification("Erro ao atualizar professor", "error")
    })
}

function handleConfigUpdate(e) {
  e.preventDefault()

  const formData = new FormData(e.target)
  const submitBtn = e.target.querySelector('button[type="submit"]')

  setButtonLoading(submitBtn, true)

  fetch("../controller/updateInst.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      setButtonLoading(submitBtn, false)

      if (data.success) {
        showNotification("Configurações atualizadas com sucesso!", "success")
        loadInstitutionData()
      } else {
        showNotification("Erro ao atualizar configurações: " + data.message, "error")
      }
    })
    .catch((error) => {
      setButtonLoading(submitBtn, false)
      console.error("Error:", error)
      showNotification("Erro ao atualizar configurações", "error")
    })
}

// ==================== SEARCH ====================
function initializeSearch() {
  const searchInputs = document.querySelectorAll(".search-input")

  searchInputs.forEach((input) => {
    input.addEventListener(
      "input",
      debounce(function () {
        const searchTerm = this.value.toLowerCase()
        const table = this.closest(".table-section")?.querySelector("table")

        if (table) {
          filterTable(table, searchTerm)
        }
      }, 300),
    )
  })
}

function filterTable(table, searchTerm) {
  const rows = table.querySelectorAll("tbody tr")

  rows.forEach((row) => {
    const text = row.textContent.toLowerCase()
    const shouldShow = text.includes(searchTerm)
    row.style.display = shouldShow ? "" : "none"
  })
}

// ==================== DATA LOADING ====================
function loadDashboardData() {
  // This would typically load real data from the server
  console.log("Loading dashboard data...")
}

function loadSectionData(sectionId) {
  switch (sectionId) {
    case "configuracoes":
      loadInstitutionData()
      break
    default:
      break
  }
}

function loadInstitutionData() {
  fetch("../controller/getInst.php")
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        populateInstitutionForm(data.instituicao)
      }
    })
    .catch((error) => {
      console.error("Error loading institution data:", error)
    })
}

function populateInstitutionForm(institution) {
  const fields = ["nome-instituicao", "email-contato", "telefone-contato", "cep", "estado", "bairro", "rua", "num"]

  fields.forEach((fieldId) => {
    const field = document.getElementById(fieldId)
    if (field && institution[fieldId.replace("-", "")]) {
      field.value = institution[fieldId.replace("-", "")]
    }
  })
}

// ==================== UTILITY FUNCTIONS ====================
function showModal(modalId) {
  const modal = document.getElementById(modalId)
  if (modal) {
    modal.classList.add("show")
    document.body.style.overflow = "hidden"
  }
}

function closeModal(modalId) {
  const modal = document.getElementById(modalId)
  if (modal) {
    modal.classList.remove("show")
    document.body.style.overflow = "auto"
  }
}

function showLoadingState(message = "Carregando...") {
  // Create or update loading overlay
  let overlay = document.getElementById("loading-overlay")
  if (!overlay) {
    overlay = document.createElement("div")
    overlay.id = "loading-overlay"
    overlay.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            backdrop-filter: blur(4px);
        `

    const content = document.createElement("div")
    content.style.cssText = `
            background: white;
            padding: 2rem;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        `

    content.innerHTML = `
            <div style="width: 40px; height: 40px; border: 3px solid #f3f3f3; border-top: 3px solid #340069; border-radius: 50%; animation: spin 1s linear infinite; margin: 0 auto 1rem;"></div>
            <p style="color: #64748b; font-weight: 500;">${message}</p>
        `

    overlay.appendChild(content)
    document.body.appendChild(overlay)
  }
}

function hideLoadingState() {
  const overlay = document.getElementById("loading-overlay")
  if (overlay) {
    overlay.remove()
  }
}

function setButtonLoading(button, isLoading) {
  if (!button) return

  if (isLoading) {
    button.disabled = true
    button.dataset.originalText = button.textContent
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processando...'
  } else {
    button.disabled = false
    button.textContent = button.dataset.originalText || "Salvar"
  }
}

function showNotification(message, type = "info") {
  // Remove existing notifications
  const existingNotifications = document.querySelectorAll(".notification")
  existingNotifications.forEach((notification) => notification.remove())

  const notification = document.createElement("div")
  notification.className = "notification"

  const colors = {
    success: "#10b981",
    error: "#ef4444",
    warning: "#f59e0b",
    info: "#3b82f6",
  }

  const icons = {
    success: "fas fa-check-circle",
    error: "fas fa-exclamation-circle",
    warning: "fas fa-exclamation-triangle",
    info: "fas fa-info-circle",
  }

  notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: white;
        color: ${colors[type]};
        padding: 1rem 1.5rem;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        border-left: 4px solid ${colors[type]};
        z-index: 10000;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        max-width: 400px;
        animation: slideIn 0.3s ease;
    `

  notification.innerHTML = `
        <i class="${icons[type]}"></i>
        <span style="color: #1e293b; font-weight: 500;">${message}</span>
        <button onclick="this.parentElement.remove()" style="
            background: none;
            border: none;
            color: #64748b;
            cursor: pointer;
            padding: 0;
            margin-left: auto;
            font-size: 1.2rem;
        ">&times;</button>
    `

  document.body.appendChild(notification)

  // Auto remove after 5 seconds
  setTimeout(() => {
    if (notification.parentElement) {
      notification.remove()
    }
  }, 5000)
}

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

// ==================== GLOBAL FUNCTIONS (for onclick handlers) ====================
window.fecharModalEditarAluno = fecharModalEditarAluno
window.fecharModalEditarProfessor = fecharModalEditarProfessor

// ==================== RESPONSIVE HANDLING ====================
window.addEventListener("resize", () => {
  const container = document.querySelector(".container")
  if (window.innerWidth <= 768) {
    container.classList.add("sidebar-collapsed")
  } else {
    const savedState = localStorage.getItem("sidebarCollapsed")
    if (savedState !== "true") {
      container.classList.remove("sidebar-collapsed")
    }
  }
})

// Add CSS for animations
const style = document.createElement("style")
style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
`
document.head.appendChild(style)
