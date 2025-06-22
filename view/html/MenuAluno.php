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
        <div class="sidebar">
            <div class="menu-toggle-btn" id="menuToggleBtn">
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div class="logo">
                 <img src="../img/logo2.jpg" alt="">

            </div>
            <div class="menu-container">
                <ul class="nav-menu">
                    <li>
                        <a href="Home.html" class="active" data-tooltip="Jogos">
                            <i class="fas fa-gamepad"></i>
                            <span>Jogos</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-tooltip="Tarefas">
                            <i class="fas fa-tasks"></i>
                            <span>Tarefas</span>
                        </a>
                    </li>
                    <li>
                        <a href="configuracoes.html" data-tooltip="Configurações">
                            <i class="fas fa-cog"></i>
                            <span>Configurações</span>
                        </a>
                    </li>
                    <li class="logout">
                        <a href="../../controller/logout.php" data-tooltip="Sair">
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
                    <div class="search-bar">
                        <input type="text" placeholder="Pesquisar..." class="search-input">
                        <button class="search-btn"><i class="fas fa-search"></i></button>
                    </div>
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
                        <button class="more-options-btn">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                        <div class="dropdown-content">
                            <a href="#">Ver todos</a>
                            <a href="#">Ordenar por</a>
                            <a href="#">Filtrar</a>
                        </div>
                    </div>
                </div>

                <div class="games-container">
                    <div class="games-grid">
                        <div class="game-card math-game">
                            <div class="game-icon">
                                <i class="fas fa-calculator"></i>
                            </div>
                            <div class="game-content">
                                <div class="game-title">Matemática Divertida</div>
                                <div class="game-description">Resolva problemas matemáticos</div>
                                <div class="game-difficulty easy">Fácil</div>
                            </div>
                        </div>
                        
                        <div class="game-card logic-game">
                            <div class="game-icon">
                                <i class="fas fa-puzzle-piece"></i>
                            </div>
                            <div class="game-content">
                                <div class="game-title">Desafio de Lógica</div>
                                <div class="game-description">Teste seu raciocínio lógico</div>
                                <div class="game-difficulty medium">Médio</div>
                            </div>
                        </div>
                        
                        <div class="game-card science-game">
                            <div class="game-icon">
                                <i class="fas fa-flask"></i>
                            </div>
                            <div class="game-content">
                                <div class="game-title">Quiz de Ciências</div>
                                <div class="game-description">Explore o mundo da ciência</div>
                                <div class="game-difficulty hard">Difícil</div>
                            </div>
                        </div>

                        <div class="game-card genius-game">
                            <div class="game-icon">
                                <i class="fas fa-brain"></i>
                            </div>
                            <div class="game-content">
                                <div class="game-title">Genius</div>
                                <div class="game-description">Jogo de memória e sequência</div>
                                <div class="game-difficulty medium">Médio</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section-header">
                    <h3>Progresso</h3>
                </div>
                <div class="progress-container">
                    <div class="progress-card math-progress">
                        <div class="progress-header">
                            <div class="progress-icon">
                                <i class="fas fa-calculator"></i>
                            </div>
                            <div class="progress-info">
                                <div class="progress-title">Matemática</div>
                                <div class="progress-percentage">75%</div>
                            </div>
                        </div>
                        <div class="progress-bar">
                            <div class="progress" style="width: 75%"></div>
                        </div>
                        <div class="progress-text">Completo</div>
                    </div>
                    
                    <div class="progress-card portuguese-progress">
                        <div class="progress-header">
                            <div class="progress-icon">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="progress-info">
                                <div class="progress-title">Português</div>
                                <div class="progress-percentage">45%</div>
                            </div>
                        </div>
                        <div class="progress-bar">
                            <div class="progress" style="width: 45%"></div>
                        </div>
                        <div class="progress-text">Completo</div>
                    </div>
                    
                    <div class="progress-card science-progress">
                        <div class="progress-header">
                            <div class="progress-icon">
                                <i class="fas fa-flask"></i>
                            </div>
                            <div class="progress-info">
                                <div class="progress-title">Ciências</div>
                                <div class="progress-percentage">60%</div>
                            </div>
                        </div>
                        <div class="progress-bar">
                            <div class="progress" style="width: 60%"></div>
                        </div>
                        <div class="progress-text">Completo</div>
                    </div>
                    
                    <div class="progress-card genius-progress" id="genius-progress">
                        <div class="progress-header">
                            <div class="progress-icon">
                                <i class="fas fa-brain"></i>
                            </div>
                            <div class="progress-info">
                                <div class="progress-title">Genius</div>
                                <div class="progress-percentage">0%</div>
                            </div>
                        </div>
                        <div class="progress-bar">
                            <div class="progress" style="width: 0%"></div>
                        </div>
                        <div class="progress-text">Completo</div>
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

    <!-- Activities Overlay -->
    <div class="activities-overlay" id="activities-overlay" style="display: none;">
        <div class="section-container">
            <div class="section-header">
                <div class="section-title">
                    <i class="fas fa-clipboard-list"></i>
                    <h2>Atividades</h2>
                </div>
                <button class="modal-close" id="close-activities">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="section-content">
                <div class="cards-container">
                    <!-- Card 1 -->
                    <div class="activity-card math-activity">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-calculator"></i>
                            </div>
                            <div class="card-deadline">
                                <span>Prazo: 12/05/2025</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h3>Exercícios de Álgebra</h3>
                            <p>Resolução de equações do 2º grau</p>
                        </div>
                        <div class="card-footer">
                            <div class="status pending">
                                <span>Pendente</span>
                            </div>
                            <button class="btn-action">Iniciar</button>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="activity-card portuguese-activity">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="card-deadline">
                                <span>Prazo: 10/05/2025</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h3>Redação Argumentativa</h3>
                            <p>Tema: Meio ambiente e sustentabilidade</p>
                        </div>
                        <div class="card-footer">
                            <div class="status in-progress">
                                <span>Em progresso</span>
                            </div>
                            <button class="btn-action">Continuar</button>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="activity-card science-activity">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-flask"></i>
                            </div>
                            <div class="card-deadline">
                                <span>Prazo: 08/05/2025</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h3>Relatório de Experimento</h3>
                            <p>Reações químicas em laboratório</p>
                        </div>
                        <div class="card-footer">
                            <div class="status completed">
                                <span>Concluído</span>
                            </div>
                            <button class="btn-action">Ver nota</button>
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
            ra: '<?php echo $aluno_id; ?>',
            nome: '<?php echo addslashes($aluno_nome); ?>',
            id_inst: '<?php echo $id_inst; ?>'
        };
    </script>

    <script src="../js/MenuAluno.js"></script>
</body>

</html>
