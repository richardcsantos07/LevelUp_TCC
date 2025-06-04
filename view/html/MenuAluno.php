<?php
session_start();

// Verificar se o usuário está logado como aluno
if (!isset($_SESSION['id']) || !isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'aluno') {
    header('location: login.html');
    exit;
}

// Dados do aluno logado
$aluno_id = $_SESSION['id'];
$aluno_nome = isset($_SESSION['nome']) ? $_SESSION['nome'] : 'Aluno';
$id_inst = isset($_SESSION['id_inst']) ? $_SESSION['id_inst'] : '';

// Debug - pode ser removido depois
error_log("Aluno logado - ID: $aluno_id, Nome: $aluno_nome, Inst: $id_inst");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LevelUp - Menu Aluno</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/MenuAluno.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar Navigation -->
       <!-- Menu lateral -->
<div class="sidebar">
    <div class="menu-toggle-btn" id="menuToggleBtn">
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="logo">
        <h2>LevelUp</h2>
    </div>
    <div class="menu-container">
        <ul class="nav-menu">
            <li>
                <a href="#" class="active">
                    <i class="fas fa-gamepad"></i>
                    <span>Jogos</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-book"></i>
                    <span>Matérias</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-tasks"></i>
                    <span>Tarefas</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-cog"></i>
                    <span>Configurações</span>
                </a>
            </li>
            <li class="logout">
                <a href="../../controller/logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Sair da conta</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="sidebar-footer">
        <p>&copy; 2025 LevelUp</p>
    </div>
</div>
        <!-- Main Content Area -->
        <div class="main">
            <!-- Top Bar -->
            <div class="top-bar">
                <div class="greeting">
                    <h2 id="greeting-name">Olá, <?php echo explode(' ', $aluno_nome)[0]; ?>!</h2>
                    
                    <p>Bem-vindo de volta</p>
                </div>
                <div class="search-container">
                    <input type="text" placeholder="Pesquisar..." class="search-input">
                    <button class="search-btn"><i class="fas fa-search"></i></button>
                </div>
                <div class="user-info">
                    <div class="notifications">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </div>
                    <div class="user-profile" id="user-profile">
                        <div class="user-avatar" id="user-avatar"><?php echo strtoupper($aluno_nome[0]); ?></div>
                        <div class="user-name" id="user-name"><?php echo explode(' ', $aluno_nome)[0]; ?></div>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="content">
                <div class="section-header">
                    <h3>Jogos Disponíveis</h3>
                    <div class="more-actions">
                        <span class="dots">•••</span>
                        <div class="dropdown-content">
                            <a href="#">Ver todos</a>
                            <a href="#">Ordernar por</a>
                            <a href="#">Filtrar</a>
                        </div>
                    </div>
                </div>

                <div class="games-container">
                    <div class="games-grid">
                        <div class="game-card">
                            <div class="game-icon"><i class="fas fa-gamepad"></i></div>
                            <div class="game-title">Matemática Divertida</div>
                            <div class="game-difficulty">Fácil</div>
                        </div>
                        <div class="game-card">
                            <div class="game-icon"><i class="fas fa-puzzle-piece"></i></div>
                            <div class="game-title">Desafio de Lógica</div>
                            <div class="game-difficulty">Médio</div>
                        </div>
                        <div class="game-card">
                            <div class="game-icon"><i class="fas fa-brain"></i></div>
                            <div class="game-title">Quiz de Ciências</div>
                            <div class="game-difficulty">Difícil</div>
                        </div>
                    </div>
                </div>

                <div class="section-header">
                    <h3>Progresso</h3>
                </div>
                <div class="progress-container">
                    <div class="progress-card">
                        <div class="progress-title">Matemática</div>
                        <div class="progress-bar">
                            <div class="progress" style="width: 75%"></div>
                        </div>
                        <div class="progress-info">75% Completo</div>
                    </div>
                    <div class="progress-card">
                        <div class="progress-title">Português</div>
                        <div class="progress-bar">
                            <div class="progress" style="width: 45%"></div>
                        </div>
                        <div class="progress-info">45% Completo</div>
                    </div>
                    <div class="progress-card">
                        <div class="progress-title">Ciências</div>
                        <div class="progress-bar">
                            <div class="progress" style="width: 60%"></div>
                        </div>
                        <div class="progress-info">60% Completo</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Modal -->
    <div class="modal-overlay" id="profile-modal">
        <div class="profile-modal">
            <div class="modal-header">
                <button class="modal-close" id="close-modal">
                    <i class="fas fa-times"></i>
                </button>
                <div class="profile-avatar-large" id="modal-avatar"><?php echo strtoupper($aluno_nome[0]); ?></div>
                <div class="modal-title" id="modal-name"><?php echo $aluno_nome; ?></div>
                <div class="modal-subtitle">Perfil do Estudante</div>
            </div>
            
            <div class="modal-body">
                <div class="loading-spinner" id="loading-spinner">
                    <div class="spinner"></div>
                    <p>Carregando dados do perfil...</p>
                </div>
                
                <div class="profile-info" id="profile-info" style="display: none;">
                    <div class="info-group">
                        <div class="info-icon">
                            <i class="fas fa-id-card"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">RA (Registro Acadêmico)</div>
                            <div class="info-value" id="student-id">-</div>
                        </div>
                    </div>

                    <div class="info-group">
                        <div class="info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">E-mail</div>
                            <div class="info-value" id="student-email">-</div>
                        </div>
                    </div>

                    <div class="info-group">
                        <div class="info-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Telefone</div>
                            <div class="info-value" id="student-phone">-</div>
                        </div>
                    </div>

                    <div class="info-group">
                        <div class="info-icon">
                            <i class="fas fa-birthday-cake"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Data de Nascimento</div>
                            <div class="info-value" id="student-birth">-</div>
                        </div>
                    </div>

                    <div class="info-group">
                        <div class="info-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Turma</div>
                            <div class="info-value" id="student-class">-</div>
                        </div>
                    </div>

                    <div class="info-group">
                        <div class="info-icon">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Responsável</div>
                            <div class="info-value" id="responsible-name">-</div>
                        </div>
                    </div>

                    <div class="info-group">
                        <div class="info-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Telefone do Responsável</div>
                            <div class="info-value" id="responsible-phone">-</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para passar dados do PHP para JavaScript -->
    <script>
        // Variáveis globais com dados do aluno logado
        window.STUDENT_DATA = {
            id: '<?php echo $aluno_id; ?>',
            nome: '<?php echo addslashes($aluno_nome); ?>',
            id_inst: '<?php echo $id_inst; ?>'
        };
    </script>
    <script src="../js/MenuAluno.js"></script>
</body>
</html>