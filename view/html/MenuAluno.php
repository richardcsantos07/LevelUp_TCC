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
                <img src="../img/logo2.jpg" alt="">
            </div>
            <div class="menu-container">
                <ul class="nav-menu">
                    <li>
                        <a href="Home.html" class="active">
                            <i class="fas fa-gamepad"></i>
                            <span>Jogos</span>
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <i class="fas fa-tasks"></i>
                            <span>Tarefas</span>
                        </a>
                    </li>
                    <li>
                        <a href="configuracoes.html">
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
                    <div class="progress-card" id="genius-progress">
                        <div class="progress-title">Genius</div>
                        <div class="progress-bar">
                            <div class="progress" style="width: 0%"></div>
                        </div>
                        <div class="progress-info">0% Completo</div>
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

    <div class="activities-overlay" id="activities-overlay" style="display: none;">
        <div class="section-container"
            style="background: white; border-radius: 8px; box-shadow: 0 8px 16px rgba(0,0,0,0.14); width: 90%; max-width: 800px; max-height: 90vh; overflow-y: auto;">
            <div class="section-header"
                style="display: flex; justify-content: space-between; align-items: center; padding: 20px; background: #340069; color: white; position: sticky; top: 0; z-index: 10;">
                <div class="section-title" style="display: flex; align-items: center; gap: 12px;">
                    <i class="fas fa-clipboard-list" style="font-size: 20px;"></i>
                    <h2 style="font-size: 18px; font-weight: 600;">Atividades</h2>
                </div>
                <button class="modal-close" id="close-activities"
                    style="background: none; border: none; color: white; font-size: 20px; cursor: pointer;">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="section-content" style="padding: 20px;">
                <div class="cards-container"
                    style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px;">
                    <!-- Card 1 -->
                    <div class="activity-card"
                        style="background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); border: 1px solid #e0e0e0; transition: all 0.3s ease;">
                        <div class="card-header"
                            style="display: flex; justify-content: space-between; align-items: center; padding: 15px; background: #f5f5f5;">
                            <div class="card-icon math"
                                style="width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 18px; background: #2196f3;">
                                <i class="fas fa-calculator"></i>
                            </div>
                            <div class="card-deadline" style="font-size: 12px; color: #666;">
                                <span>Prazo: 12/05/2025</span>
                            </div>
                        </div>
                        <div class="card-body" style="padding: 15px;">
                            <h3 style="font-size: 16px; margin-bottom: 8px;">Exercícios de Álgebra</h3>
                            <p style="color: #666; font-size: 14px;">Resolução de equações do 2º grau</p>
                        </div>
                        <div class="card-footer"
                            style="display: flex; justify-content: space-between; align-items: center; padding: 15px; border-top: 1px solid #e0e0e0;">
                            <div class="status pending"
                                style="font-size: 12px; font-weight: 600; padding: 4px 8px; border-radius: 12px; background: #fff3e0; color: #e65100;">
                                <span>Pendente</span>
                            </div>
                            <button class="btn-action"
                                style="background: #340069; color: white; border: none; padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: 600; cursor: pointer; transition: all 0.3s ease;">
                                Iniciar
                            </button>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="activity-card"
                        style="background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); border: 1px solid #e0e0e0; transition: all 0.3s ease;">
                        <div class="card-header"
                            style="display: flex; justify-content: space-between; align-items: center; padding: 15px; background: #f5f5f5;">
                            <div class="card-icon portuguese"
                                style="width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 18px; background: #ff5722;">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="card-deadline" style="font-size: 12px; color: #666;">
                                <span>Prazo: 10/05/2025</span>
                            </div>
                        </div>
                        <div class="card-body" style="padding: 15px;">
                            <h3 style="font-size: 16px; margin-bottom: 8px;">Redação Argumentativa</h3>
                            <p style="color: #666; font-size: 14px;">Tema: Meio ambiente e sustentabilidade</p>
                        </div>
                        <div class="card-footer"
                            style="display: flex; justify-content: space-between; align-items: center; padding: 15px; border-top: 1px solid #e0e0e0;">
                            <div class="status in-progress"
                                style="font-size: 12px; font-weight: 600; padding: 4px 8px; border-radius: 12px; background: #e3f2fd; color: #0d47a1;">
                                <span>Em progresso</span>
                            </div>
                            <button class="btn-action"
                                style="background: #340069; color: white; border: none; padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: 600; cursor: pointer; transition: all 0.3s ease;">
                                Continuar
                            </button>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="activity-card"
                        style="background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); border: 1px solid #e0e0e0; transition: all 0.3s ease;">
                        <div class="card-header"
                            style="display: flex; justify-content: space-between; align-items: center; padding: 15px; background: #f5f5f5;">
                            <div class="card-icon science"
                                style="width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 18px; background: #4caf50;">
                                <i class="fas fa-flask"></i>
                            </div>
                            <div class="card-deadline" style="font-size: 12px; color: #666;">
                                <span>Prazo: 08/05/2025</span>
                            </div>
                        </div>
                        <div class="card-body" style="padding: 15px;">
                            <h3 style="font-size: 16px; margin-bottom: 8px;">Relatório de Experimento</h3>
                            <p style="color: #666; font-size: 14px;">Reações químicas em laboratório</p>
                        </div>
                        <div class="card-footer"
                            style="display: flex; justify-content: space-between; align-items: center; padding: 15px; border-top: 1px solid #e0e0e0;">
                            <div class="status completed"
                                style="font-size: 12px; font-weight: 600; padding: 4px 8px; border-radius: 12px; background: #e8f5e9; color: #1b5e20;">
                                <span>Concluído</span>
                            </div>
                            <button class="btn-action"
                                style="background: #340069; color: white; border: none; padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: 600; cursor: pointer; transition: all 0.3s ease;">
                                Ver nota
                            </button>
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