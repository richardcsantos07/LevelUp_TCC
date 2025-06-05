<?php
session_start();

// Verificar se o usuário está logado como professor
if (!isset($_SESSION['id']) || !isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'professor') {
    header('location: login.html');
    exit;
}

// Dados do Professor logado
$professor_id = $_SESSION['id'];
$professor_nome = isset($_SESSION['nome']) ? $_SESSION['nome'] : 'Professor';
$id_inst = isset($_SESSION['id_inst']) ? $_SESSION['id_inst'] : '';

// Debug - pode ser removido depois
error_log("Professor logado - ID: $professor_id, Nome: $professor_nome, Inst: $id_inst");
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Educacional</title>
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/MenuProfessor.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <!-- Adicione este botão logo após a abertura da div.container -->
        
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
                        <a href="#" class="active">
                            <i class="fas fa-home"></i>
                            <span>Home</span>
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
                <p>&copy; 2025 Levelup</p>
            </div>
        </div>

       

        <!-- Conteúdo principal -->
        <div class="main-content">
            <!-- Cabeçalho -->
            
                <div class="top-bar">
                <div class="greeting">
                    <h2 id="greeting-name">Olá, <?php echo explode(' ', $professor_nome)[0]; ?>!</h2>
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
    <div class="user-profile profile" id="user-profile">
        <div class="user-avatar" id="user-avatar"><?php echo strtoupper($professor_nome[0]); ?></div>
        <div class="user-name" id="user-name"><?php echo explode(' ', $professor_nome)[0]; ?></div>
    </div>
                </div>
            </div>
            

            <!-- Conteúdo da página -->
            <div class="page-content">
               

                <!-- Dropdown de atividades -->
                <div class="section-container">
                    <div class="section-header" id="atividades-dropdown">
                        <div class="section-title">
                            <i class="fas fa-clipboard-list"></i>
                            <h2>Atividades</h2>
                        </div>
                        <div class="section-toggle">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="section-content" id="atividades-content">
                        <div class="cards-container">
                            <div class="activity-card">
                                <div class="card-header">
                                    <div class="card-icon math">
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
                            <div class="activity-card">
                                <div class="card-header">
                                    <div class="card-icon portuguese">
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
                            <div class="activity-card">
                                <div class="card-header">
                                    <div class="card-icon science">
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

                <!-- Seção de Jogos -->
                <div class="section-container">
                    <div class="section-header" id="jogos-dropdown">
                        <div class="section-title">
                            <i class="fas fa-gamepad"></i>
                            <h2>Jogos Disponíveis</h2>
                        </div>
                        <div class="section-toggle">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="section-content" id="jogos-content">
                        <div class="cards-container">
                            <div class="game-card">
                                <div class="game-image math-game">
                                    <i class="fas fa-gamepad"></i>
                                </div>
                                <div class="game-info">
                                    <h3>Matemática Divertida</h3>
                                    <div class="game-stats">
                                        <div class="difficulty easy">
                                            <i class="fas fa-star"></i>
                                            <span>Fácil</span>
                                        </div>
                                        <div class="played-times">
                                            <i class="fas fa-play-circle"></i>
                                            <span>12 jogadas</span>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn-play">Jogar agora</button>
                            </div>
                            <div class="game-card">
                                <div class="game-image logic-game">
                                    <i class="fas fa-puzzle-piece"></i>
                                </div>
                                <div class="game-info">
                                    <h3>Desafio de Lógica</h3>
                                    <div class="game-stats">
                                        <div class="difficulty medium">
                                            <i class="fas fa-star"></i>
                                            <span>Médio</span>
                                        </div>
                                        <div class="played-times">
                                            <i class="fas fa-play-circle"></i>
                                            <span>8 jogadas</span>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn-play">Jogar agora</button>
                            </div>
                            <div class="game-card">
                                <div class="game-image science-game">
                                    <i class="fas fa-brain"></i>
                                </div>
                                <div class="game-info">
                                    <h3>Quiz de Ciências</h3>
                                    <div class="game-stats">
                                        <div class="difficulty hard">
                                            <i class="fas fa-star"></i>
                                            <span>Difícil</span>
                                        </div>
                                        <div class="played-times">
                                            <i class="fas fa-play-circle"></i>
                                            <span>5 jogadas</span>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn-play">Jogar agora</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Seção de Progresso -->
                <div class="section-container">
                    <div class="section-header" id="progresso-dropdown">
                        <div class="section-title">
                            <i class="fas fa-chart-line"></i>
                            <h2>Progresso</h2>
                        </div>
                        <div class="section-toggle">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="section-content" id="progresso-content">
                        <div class="progress-container">
                            <div class="progress-card">
                                <div class="progress-header">
                                    <div class="progress-icon math">
                                        <i class="fas fa-calculator"></i>
                                    </div>
                                    <h3>Matemática</h3>
                                </div>
                                <div class="progress-bar-container">
                                    <div class="progress-bar">
                                        <div class="progress-fill" style="width: 75%"></div>
                                    </div>
                                    <div class="progress-stats">
                                        <span class="progress-percentage">75%</span>
                                        <span class="progress-status">Completo</span>
                                    </div>
                                </div>
                                <div class="progress-details">
                                    <div class="detail-item">
                                        <span class="detail-label">Atividades Concluídas:</span>
                                        <span class="detail-value">15/20</span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Média:</span>
                                        <span class="detail-value">8.5</span>
                                    </div>
                                </div>
                            </div>
                            <div class="progress-card">
                                <div class="progress-header">
                                    <div class="progress-icon portuguese">
                                        <i class="fas fa-book"></i>
                                    </div>
                                    <h3>Português</h3>
                                </div>
                                <div class="progress-bar-container">
                                    <div class="progress-bar">
                                        <div class="progress-fill" style="width: 45%"></div>
                                    </div>
                                    <div class="progress-stats">
                                        <span class="progress-percentage">45%</span>
                                        <span class="progress-status">Completo</span>
                                    </div>
                                </div>
                                <div class="progress-details">
                                    <div class="detail-item">
                                        <span class="detail-label">Atividades Concluídas:</span>
                                        <span class="detail-value">9/20</span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Média:</span>
                                        <span class="detail-value">7.8</span>
                                    </div>
                                </div>
                            </div>
                            <div class="progress-card">
                                <div class="progress-header">
                                    <div class="progress-icon science">
                                        <i class="fas fa-flask"></i>
                                    </div>
                                    <h3>Ciências</h3>
                                </div>
                                <div class="progress-bar-container">
                                    <div class="progress-bar">
                                        <div class="progress-fill" style="width: 60%"></div>
                                    </div>
                                    <div class="progress-stats">
                                        <span class="progress-percentage">60%</span>
                                        <span class="progress-status">Completo</span>
                                    </div>
                                </div>
                                <div class="progress-details">
                                    <div class="detail-item">
                                        <span class="detail-label">Atividades Concluídas:</span>
                                        <span class="detail-value">12/20</span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Média:</span>
                                        <span class="detail-value">8.2</span>
                                    </div>
                                </div>
                            </div>
                        </div>
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
            <div class="profile-avatar-large" id="modal-avatar"><?php echo strtoupper($professor_nome[0]); ?></div>
            <div class="modal-title" id="modal-name"><?php echo $professor_nome; ?></div>
            <div class="modal-subtitle">Perfil do Professor</div>
            </div>
            
            <div class="modal-body">
                <div class="loading-spinner" id="loading-spinner">
                    <div class="spinner"></div>
                    <p>Carregando dados do perfil...</p>
                </div>
                
                

                    <div class="info-group">
                        <div class="info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">E-mail</div>
                            <div class="info-value" id="professor-email">-</div>
                        </div>
                    </div>

                    <div class="info-group">
                        <div class="info-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Telefone</div>
                            <div class="info-value" id="professor-phone">-</div>
                        </div>
                    </div>

                    <div class="info-group">
                        <div class="info-icon">
                            <i class="fas fa-birthday-cake"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Data de Nascimento</div>
                            <div class="info-value" id="professor-birth">-</div>
                        </div>
                    </div>

                    <div class="info-group">
                        <div class="info-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Matéria</div>
                            <div class="info-value" id="professor-materia">-</div>
                        </div>
                    </div>

                    <div class="info-group">
                        <div class="info-icon">
                            <i class="fas fa-id-card"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">CPF</div>
                            <div class="info-value" id="professor-cpf">-</div>
                        </div>
                    </div>

                   
                </div>
            </div>
        </div>
    </div>

    <script src="../js/MenuProfessor.js"></script>
</body>

</html>