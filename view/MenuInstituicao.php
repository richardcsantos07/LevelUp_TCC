<?PHP
session_start();
$id_inst = $_SESSION['id'];

require '../model/Turma.class.php';
$turmaObj = new Turma();

require '../model/Aluno.class.php';
$alunoObj = new Aluno();

require '../model/Professor.class.php';
$professorObj = new Professor();

require '../model/Instituicao.class.php';
$instObj = new Instituicao();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LevelUP - Painel Institucional</title>
    <link rel="stylesheet" href="css/MenuInstituicao.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="menu-toggle-btn" id="menuToggleBtn">
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>

            <!-- Logo -->
            <div class="logo">
                <img src="img/logo2.jpg" alt="">
            </div>

            

            <!-- Menu -->
            <div class="menu">
                <div class="menu-section">
                    <i class="fas fa-chart-line"></i>
                    <span>Visão Geral</span>
                </div>
                <a href="#dashboard" class="menu-item active" data-section="dashboard">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>

                <div class="menu-section">
                    <i class="fas fa-users-cog"></i>
                    <span>Gerenciamento</span>
                </div>
                
                <div class="menu-item has-submenu" data-toggle="alunos-submenu">
                    <i class="fas fa-user-graduate"></i>
                    <span>Alunos</span>
                    
                </div>
                <div class="submenu" id="alunos-submenu">
                    <a href="#cadastrar-aluno" class="menu-item" data-section="cadastrar-aluno">
                        <i class="fas fa-plus-circle"></i>
                        <span>Cadastrar Aluno</span>
                    </a>
                    <a href="#listar-alunos" class="menu-item" data-section="listar-alunos">
                        <i class="fas fa-list"></i>
                        <span>Listar Alunos</span>
                    </a>
                </div>

                <div class="menu-item has-submenu" data-toggle="professores-submenu">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span>Professores</span>
                   
                </div>
                <div class="submenu" id="professores-submenu">
                    <a href="#cadastrar-professor" class="menu-item" data-section="cadastrar-professor">
                        <i class="fas fa-plus-circle"></i>
                        <span>Cadastrar Professor</span>
                    </a>
                    <a href="#listar-professores" class="menu-item" data-section="listar-professores">
                        <i class="fas fa-list"></i>
                        <span>Listar Professores</span>
                    </a>
                </div>

                <div class="menu-item has-submenu" data-toggle="turmas-submenu">
                    <i class="fas fa-school"></i>
                    <span>Turmas</span>
                    
                </div>
                <div class="submenu" id="turmas-submenu">
                    <a href="#cadastrar-turma" class="menu-item" data-section="cadastrar-turma">
                        <i class="fas fa-plus-circle"></i>
                        <span>Criar Turma</span>
                    </a>
                    <a href="#listar-turmas" class="menu-item" data-section="listar-turmas">
                        <i class="fas fa-list"></i>
                        <span>Gerenciar Turmas</span>
                    </a>
                </div>

                <div class="menu-section">
                    <i class="fas fa-bullhorn"></i>
                    <span>Comunicação</span>
                </div>
                <a href="#comunicados" class="menu-item" data-section="comunicados">
                    <i class="fas fa-megaphone"></i>
                    <span>Comunicados</span>
                </a>

                <div class="menu-section">
                    <i class="fas fa-cogs"></i>
                    <span>Sistema</span>
                </div>
                <a href="#configuracoes" class="menu-item" data-section="configuracoes">
                    <i class="fas fa-sliders-h"></i>
                    <span>Configurações</span>
                </a>
                <a href="../controller/logout.php" class="menu-item logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Sair</span>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <div class="top-bar">
                <div class="page-info">
                    <h1 class="page-title" id="pageTitle">Dashboard</h1>
                    <p class="page-subtitle">Gerencie sua instituição educacional</p>
                </div>
                <div class="header-actions">
                    <div class="search-container">
                        <div class="search-bar">
                            <input type="text" placeholder="Pesquisar...">
                            <button class="search-btn">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="notifications">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </div>
                </div>
            </div>

            <!-- Dashboard -->
            <div class="content-section active" id="dashboard">
                <div class="stats-grid">
                    <div class="stat-card students">
                        <div class="stat-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-number">248</div>
                            <div class="stat-label">Total de Alunos</div>
                            <div class="stat-trend">
                                <i class="fas fa-arrow-up"></i>
                                <span>+12% este semestre</span>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card teachers">
                        <div class="stat-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-number">32</div>
                            <div class="stat-label">Professores</div>
                            <div class="stat-trend">
                                <i class="fas fa-arrow-up"></i>
                                <span>+5% este semestre</span>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card classes">
                        <div class="stat-icon">
                            <i class="fas fa-school"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-number">18</div>
                            <div class="stat-label">Turmas Ativas</div>
                            <div class="stat-trend">
                                <i class="fas fa-plus"></i>
                                <span>2 novas turmas</span>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card announcements">
                        <div class="stat-icon">
                            <i class="fas fa-megaphone"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-number">5</div>
                            <div class="stat-label">Comunicados</div>
                            <div class="stat-trend">
                                <span>não lidos</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dashboard-content">
                    <div class="recent-activities">
                        <div class="section-header">
                            <h3>Atividades Recentes</h3>
                            <button class="btn-secondary">Ver todas</button>
                        </div>
                        <div class="activities-list">
                            <div class="activity-item">
                                <div class="activity-icon success">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">Novo aluno cadastrado</div>
                                    <div class="activity-subtitle">Carlos Silva - 3º Ano A</div>
                                    <div class="activity-time">Há 2 horas</div>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon info">
                                    <i class="fas fa-school"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">Nova turma criada</div>
                                    <div class="activity-subtitle">1º Ano C - Manhã</div>
                                    <div class="activity-time">Ontem</div>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon warning">
                                    <i class="fas fa-megaphone"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">Comunicado enviado</div>
                                    <div class="activity-subtitle">Reunião de pais - Todas as turmas</div>
                                    <div class="activity-time">2 dias atrás</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="quick-actions">
                        <div class="section-header">
                            <h3>Ações Rápidas</h3>
                        </div>
                        <div class="actions-grid">
                            <button class="action-btn" data-section="cadastrar-aluno">
                                <i class="fas fa-user-plus"></i>
                                <span>Novo Aluno</span>
                            </button>
                            <button class="action-btn" data-section="cadastrar-professor">
                                <i class="fas fa-chalkboard-teacher"></i>
                                <span>Novo Professor</span>
                            </button>
                            <button class="action-btn" data-section="cadastrar-turma">
                                <i class="fas fa-plus-circle"></i>
                                <span>Nova Turma</span>
                            </button>
                            <button class="action-btn" data-section="comunicados">
                                <i class="fas fa-megaphone"></i>
                                <span>Comunicado</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cadastrar Aluno -->
            <div class="content-section" id="cadastrar-aluno">
                <div class="form-container">
                    <div class="form-header">
                        <div class="form-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="form-title">
                            <h2>Cadastrar Novo Aluno</h2>
                            <p>Adicione um novo estudante ao sistema</p>
                        </div>
                    </div>

                    <form id="form-aluno" action="../controller/inserirAluno.php" method="post" class="compact-form">
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="ra-aluno">
                                    <i class="fas fa-id-card"></i>
                                    RA
                                </label>
                                <input type="text" id="ra-aluno" name="ra-aluno" required>
                            </div>

                            <div class="form-group">
                                <label for="nome-aluno">
                                    <i class="fas fa-user"></i>
                                    Nome Completo
                                </label>
                                <input type="text" id="nome-aluno" name="nome-aluno" required>
                            </div>

                            <div class="form-group">
                                <label for="data-nascimento">
                                    <i class="fas fa-calendar"></i>
                                    Data de Nascimento
                                </label>
                                <input type="date" id="data-nascimento" name="data-nascimento" required>
                            </div>

                            <div class="form-group">
                                <label for="email-aluno">
                                    <i class="fas fa-envelope"></i>
                                    E-mail
                                </label>
                                <input type="email" id="email-aluno" name="email-aluno" required>
                            </div>

                            <div class="form-group">
                                <label for="senha-aluno">
                                    <i class="fas fa-lock"></i>
                                    Senha
                                </label>
                                <input type="text" id="senha-aluno" name="senha-aluno" required>
                            </div>

                            <div class="form-group">
                                <label for="telefone-aluno">
                                    <i class="fas fa-phone"></i>
                                    Telefone
                                </label>
                                <input type="tel" id="telefone-aluno" name="telefone-aluno" placeholder="(00) 00000-0000">
                            </div>

                            <div class="form-group">
                                <label for="turma-aluno">
                                    <i class="fas fa-school"></i>
                                    Turma
                                </label>
                                <select id="turma-aluno" name="turma-aluno">
                                    <option value="">Selecione uma turma</option>
                                    <?php
                                    $turmas = $turmaObj->listarTurmas($id_inst);
                                    if ($turmas !== null && is_array($turmas)) {
                                        foreach ($turmas as $turma) {
                                            echo "<option value='{$turma['turma']}'>{$turma['turma']}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="responsavel-aluno">
                                    <i class="fas fa-user-friends"></i>
                                    Nome do Responsável
                                </label>
                                <input type="text" id="responsavel-aluno" name="responsavel-aluno">
                            </div>

                            <div class="form-group">
                                <label for="telefone-responsavel">
                                    <i class="fas fa-phone-alt"></i>
                                    Telefone do Responsável
                                </label>
                                <input type="tel" id="telefone-responsavel" name="telefone-responsavel" placeholder="(00) 00000-0000">
                            </div>
                        </div>

                        <input type="hidden" id="id_inst" name="id_inst" value="<?= $id_inst ?>">

                        <div class="form-actions">
                            <button type="button" class="btn-cancel" id="btn-cancelar-aluno">
                                <i class="fas fa-times"></i>
                                Cancelar
                            </button>
                            <button type="submit" name="btn-cad-aluno" id="btn-cad-aluno" class="btn-primary">
                                <i class="fas fa-save"></i>
                                Cadastrar Aluno
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Listar Alunos -->
            <div class="content-section" id="listar-alunos">
                <div class="table-section">
                    <div class="section-header">
                        <div class="section-title">
                            <h2>
                                <i class="fas fa-user-graduate"></i>
                                Alunos Cadastrados
                            </h2>
                            <p>Gerencie todos os estudantes da instituição</p>
                        </div>
                        <div class="section-actions">
                            <div class="search-container">
                                <input type="text" placeholder="Buscar aluno..." class="search-input">
                                <button class="search-btn">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <button class="btn-primary" id="btn-novo-aluno">
                                <i class="fas fa-plus"></i>
                                Novo Aluno
                            </button>
                        </div>
                    </div>

                    <?PHP
                    $pdo = $alunoObj->getPdo();
                    
                    if (!empty($_GET['search'])) {
                        $data = $_GET['search'];
                        $sql = "SELECT * FROM aluno WHERE 
                        ra LIKE :search
                        OR nome     LIKE :search
                        OR email    LIKE :search
                        OR turma    LIKE :search
                        OR serie    LIKE :search
                        OR dataNasc LIKE :search
                        ORDER BY ra DESC";

                        $stmt = $pdo->prepare($sql);
                        $param = "%$data%";
                        $stmt->bindParam(':search', $param);
                        $stmt->execute();
                        $resultAluno = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } else {
                        $resultAluno = $alunoObj->listarTodosAlunos($id_inst);
                    }
                    ?>

                    <div class="table-container">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Turma</th>
                                    <th>Telefone</th>
                                    <th>Responsável</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?PHP
                                foreach ($resultAluno as $aluno) {
                                    echo "<tr data-id='{$aluno['ra']}'>";
                                    echo "<td>";
                                    echo "<div class='user-cell'>";
                                    echo "<div class='user-avatar-small'>" . strtoupper($aluno['nome'][0]) . "</div>";
                                    echo "<div class='user-info-small'>";
                                    echo "<div class='user-name-small'>{$aluno['nome']}</div>";
                                    echo "<div class='user-id-small'>RA: {$aluno['ra']}</div>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</td>";
                                    echo "<td>{$aluno['email']}</td>";
                                    echo "<td><span class='badge badge-info'>{$aluno['turma']}</span></td>";
                                    echo "<td>{$aluno['tell']}</td>";
                                    echo "<td>{$aluno['nome_responsavel']}</td>";
                                    echo "<td class='actions'>";
                                    echo "<button class='btn-icon btn-edit btn-editar-aluno' title='Editar' data-id='{$aluno['ra']}'>";
                                    echo "<i class='fas fa-edit'></i>";
                                    echo "</button>";
                                    echo "<a class='btn-icon btn-delete' title='Excluir' href='../controller/deleteAluno.php?id={$aluno['ra']}'>";
                                    echo "<i class='fas fa-trash'></i>";
                                    echo "</a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal de Edição de Aluno -->
            <div class="modal-backdrop" id="modal-editar-aluno">
                <div class="modal">
                    <div class="modal-header">
                        <div class="modal-title">
                            <i class="fas fa-user-edit"></i>
                            Editar Aluno
                        </div>
                        <button class="modal-close" type="button" onclick="fecharModalEditarAluno()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-editar-aluno" action="../controller/updateAluno.php" method="POST">
                            <input type="hidden" id="edit-ra-aluno" name="ra-aluno">
                            <input type="hidden" name="id_inst" value="<?= $id_inst ?>">

                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="edit-nome-aluno">
                                        <i class="fas fa-user"></i>
                                        Nome Completo
                                    </label>
                                    <input type="text" id="edit-nome-aluno" name="nome-aluno" required>
                                </div>

                                <div class="form-group">
                                    <label for="edit-data-nascimento">
                                        <i class="fas fa-calendar"></i>
                                        Data de Nascimento
                                    </label>
                                    <input type="date" id="edit-data-nascimento" name="data-nascimento" required>
                                </div>

                                <div class="form-group">
                                    <label for="edit-email-aluno">
                                        <i class="fas fa-envelope"></i>
                                        E-mail
                                    </label>
                                    <input type="email" id="edit-email-aluno" name="email-aluno" required>
                                </div>

                                <div class="form-group">
                                    <label for="edit-telefone-aluno">
                                        <i class="fas fa-phone"></i>
                                        Telefone
                                    </label>
                                    <input type="tel" id="edit-telefone-aluno" name="telefone-aluno" placeholder="(00) 00000-0000">
                                </div>

                                <div class="form-group">
                                    <label for="edit-turma-aluno">
                                        <i class="fas fa-school"></i>
                                        Turma
                                    </label>
                                    <select id="edit-turma-aluno" name="turma-aluno">
                                        <option value="">Selecione uma turma</option>
                                        <?php
                                        $turmas = $turmaObj->listarTurmas($id_inst);
                                        if ($turmas !== null && is_array($turmas)) {
                                            foreach ($turmas as $turma) {
                                                echo "<option value='{$turma['turma']}'>{$turma['turma']}</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="edit-responsavel-aluno">
                                        <i class="fas fa-user-friends"></i>
                                        Nome do Responsável
                                    </label>
                                    <input type="text" id="edit-responsavel-aluno" name="responsavel-aluno">
                                </div>

                                <div class="form-group">
                                    <label for="edit-telefone-responsavel">
                                        <i class="fas fa-phone-alt"></i>
                                        Telefone do Responsável
                                    </label>
                                    <input type="tel" id="edit-telefone-responsavel" name="telefone-responsavel" placeholder="(00) 00000-0000">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn-cancel" onclick="fecharModalEditarAluno()">
                                    <i class="fas fa-times"></i>
                                    Cancelar
                                </button>
                                <button type="submit" name="btn-update-aluno" class="btn-primary">
                                    <i class="fas fa-save"></i>
                                    Atualizar Aluno
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Cadastrar Professor -->
            <div class="content-section" id="cadastrar-professor">
                <div class="form-container">
                    <div class="form-header">
                        <div class="form-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div class="form-title">
                            <h2>Cadastrar Novo Professor</h2>
                            <p>Adicione um novo educador ao sistema</p>
                        </div>
                    </div>

                    <form id="form-professor" method="POST" action="../controller/inserirProf.php" class="compact-form">
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="nome-professor">
                                    <i class="fas fa-user"></i>
                                    Nome Completo
                                </label>
                                <input type="text" id="nome-professor" name="nome-professor" required>
                            </div>

                            <div class="form-group">
                                <label for="email-professor">
                                    <i class="fas fa-envelope"></i>
                                    E-mail
                                </label>
                                <input type="email" id="email-professor" name="email-professor" required>
                            </div>

                            <div class="form-group">
                                <label for="senha-professor">
                                    <i class="fas fa-lock"></i>
                                    Senha
                                </label>
                                <input type="password" id="senha-professor" name="senha-professor" required>
                            </div>

                            <div class="form-group">
                                <label for="disciplina">
                                    <i class="fas fa-book"></i>
                                    Disciplina
                                </label>
                                <input type="text" id="disciplina" name="disciplina" required>
                            </div>

                            <div class="form-group">
                                <label for="cpf-professor">
                                    <i class="fas fa-id-card"></i>
                                    CPF
                                </label>
                                <input type="text" id="cpf-professor" name="cpf-professor" required>
                            </div>

                            <div class="form-group">
                                <label for="data-nascimento-professor">
                                    <i class="fas fa-calendar"></i>
                                    Data de Nascimento
                                </label>
                                <input type="date" id="data-nascimento-professor" name="data-nascimento-professor" required>
                            </div>

                            <div class="form-group">
                                <label for="telefone-professor">
                                    <i class="fas fa-phone"></i>
                                    Telefone
                                </label>
                                <input type="tel" id="telefone-professor" name="telefone-professor" placeholder="(00) 00000-0000">
                            </div>
                        </div>

                        <input type="hidden" name="id_inst" id="id_inst" value="<?= $id_inst ?>">

                        <div class="form-actions">
                            <button type="button" class="btn-cancel">
                                <i class="fas fa-times"></i>
                                Cancelar
                            </button>
                            <button type="submit" class="btn-primary" name="btn-cad-professor" id="btn-cad-professor">
                                <i class="fas fa-save"></i>
                                Cadastrar Professor
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Listar Professores -->
            <div class="content-section" id="listar-professores">
                <div class="table-section">
                    <div class="section-header">
                        <div class="section-title">
                            <h2>
                                <i class="fas fa-chalkboard-teacher"></i>
                                Professores Cadastrados
                            </h2>
                            <p>Gerencie todos os educadores da instituição</p>
                        </div>
                        <div class="section-actions">
                            <div class="search-container">
                                <input type="text" placeholder="Buscar professor..." class="search-input" id="searchProfessores">
                                <button class="search-btn">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <button class="btn-primary">
                                <i class="fas fa-plus"></i>
                                Novo Professor
                            </button>
                        </div>
                    </div>

                    <?PHP
                    $pdo = $professorObj->getPdo();
                    
                    if (!empty($_GET['search'])) {
                        $data = $_GET['search'];
                        $sql = "SELECT * FROM professor WHERE 
                        id LIKE :search
                        OR nome     LIKE :search
                        OR email    LIKE :search
                        OR senha    LIKE :search
                        OR materia    LIKE :search
                        OR dataNasc LIKE :search
                        ORDER BY id DESC";

                        $stmt = $pdo->prepare($sql);
                        $param = "%$data%";
                        $stmt->bindParam(':search', $param);
                        $stmt->execute();
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } else {
                        $result = $professorObj->listarTodosProfessores($id_inst);
                    }
                    ?>

                    <div class="table-container">
                        <table class="data-table" id="teachersTable">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Disciplina</th>
                                    <th>Telefone</th>
                                    <th>CPF</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?PHP
                                foreach ($result as $professor) {
                                    echo "<tr data-id='{$professor['id']}'>";
                                    echo "<td>";
                                    echo "<div class='user-cell'>";
                                    echo "<div class='user-avatar-small'>" . strtoupper($professor['nome'][0]) . "</div>";
                                    echo "<div class='user-info-small'>";
                                    echo "<div class='user-name-small'>{$professor['nome']}</div>";
                                    echo "<div class='user-id-small'>ID: {$professor['id']}</div>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</td>";
                                    echo "<td>{$professor['email']}</td>";
                                    echo "<td><span class='badge badge-success'>{$professor['materia']}</span></td>";
                                    echo "<td>{$professor['telefone']}</td>";
                                    echo "<td>{$professor['cpf']}</td>";
                                    echo "<td class='actions'>";
                                    echo "<button class='btn-icon btn-edit btn-editar-professor' title='Editar' data-id='{$professor['id']}'>";
                                    echo "<i class='fas fa-edit'></i>";
                                    echo "</button>";
                                    echo "<a class='btn-icon btn-delete' title='Excluir' href='../controller/deleteProf.php?id={$professor['id']}'>";
                                    echo "<i class='fas fa-trash'></i>";
                                    echo "</a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal de Edição de Professor -->
            <div class="modal-backdrop" id="modal-editar-professor">
                <div class="modal">
                    <div class="modal-header">
                        <div class="modal-title">
                            <i class="fas fa-user-edit"></i>
                            Editar Professor
                        </div>
                        <button class="modal-close" type="button" onclick="fecharModalEditarProfessor()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-editar-professor" action="../controller/updateProfessor.php" method="POST">
                            <input type="hidden" id="edit-id-professor" name="id-professor">
                            <input type="hidden" name="id_inst" value="<?= $id_inst ?>">

                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="edit-nome-professor">
                                        <i class="fas fa-user"></i>
                                        Nome Completo
                                    </label>
                                    <input type="text" id="edit-nome-professor" name="nome-professor" required>
                                </div>

                                <div class="form-group">
                                    <label for="edit-data-nascimento-professor">
                                        <i class="fas fa-calendar"></i>
                                        Data de Nascimento
                                    </label>
                                    <input type="date" id="edit-data-nascimento-professor" name="data-nascimento" required>
                                </div>

                                <div class="form-group">
                                    <label for="edit-email-professor">
                                        <i class="fas fa-envelope"></i>
                                        E-mail
                                    </label>
                                    <input type="email" id="edit-email-professor" name="email-professor" required>
                                </div>

                                <div class="form-group">
                                    <label for="edit-telefone-professor">
                                        <i class="fas fa-phone"></i>
                                        Telefone
                                    </label>
                                    <input type="tel" id="edit-telefone-professor" name="telefone-professor" placeholder="(00) 00000-0000">
                                </div>

                                <div class="form-group">
                                    <label for="edit-materia-professor">
                                        <i class="fas fa-book"></i>
                                        Matéria
                                    </label>
                                    <input type="text" id="edit-materia-professor" name="materia-professor">
                                </div>

                                <div class="form-group">
                                    <label for="edit-cpf-professor">
                                        <i class="fas fa-id-card"></i>
                                        CPF
                                    </label>
                                    <input type="text" id="edit-cpf-professor" name="cpf-professor" placeholder="000.000.000-00">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn-cancel" onclick="fecharModalEditarProfessor()">
                                    <i class="fas fa-times"></i>
                                    Cancelar
                                </button>
                                <button type="submit" name="btn-update-professor" class="btn-primary">
                                    <i class="fas fa-save"></i>
                                    Atualizar Professor
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Cadastrar Turma -->
            <div class="content-section" id="cadastrar-turma">
                <div class="form-container">
                    <div class="form-header">
                        <div class="form-icon">
                            <i class="fas fa-school"></i>
                        </div>
                        <div class="form-title">
                            <h2>Criar Nova Turma</h2>
                            <p>Organize uma nova turma para os estudantes</p>
                        </div>
                    </div>

                    <form id="form-turma" action="../controller/inserirTurma.php" method="POST" class="compact-form">
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="serie-turma">
                                    <i class="fas fa-layer-group"></i>
                                    Série
                                </label>
                                <input type="text" id="serie-turma" name="serie-turma" required>
                            </div>

                            <div class="form-group">
                                <label for="turma">
                                    <i class="fas fa-school"></i>
                                    Turma
                                </label>
                                <input type="text" id="turma" name="turma" required>
                            </div>

                            <div class="form-group">
                                <label for="turno-turma">
                                    <i class="fas fa-clock"></i>
                                    Turno
                                </label>
                                <select id="turno-turma" name="turno-turma" required>
                                    <option value="">Selecione o turno</option>
                                    <option value="Manhã">Manhã</option>
                                    <option value="Tarde">Tarde</option>
                                    <option value="Noite">Noite</option>
                                </select>
                            </div>
                        </div>

                        <input type="hidden" name="id_inst" id="id_inst" value="<?= $id_inst ?>">

                        <div class="form-actions">
                            <button type="button" class="btn-cancel" id="btn-cancelar-turma">
                                <i class="fas fa-times"></i>
                                Cancelar
                            </button>
                            <button type="submit" class="btn-primary" name="btn-cad-turma" id="btn-cad-turma">
                                <i class="fas fa-save"></i>
                                Criar Turma
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Listar Turmas -->
            <div class="content-section" id="listar-turmas">
                <div class="table-section">
                    <div class="section-header">
                        <div class="section-title">
                            <h2>
                                <i class="fas fa-school"></i>
                                Gerenciamento de Turmas
                            </h2>
                            <p>Visualize e gerencie todas as turmas da instituição</p>
                        </div>
                        <div class="section-actions">
                            <div class="search-container">
                                <input type="text" placeholder="Buscar turma..." class="search-input">
                                <button class="search-btn">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <button class="btn-primary" id="btn-nova-turma">
                                <i class="fas fa-plus"></i>
                                Nova Turma
                            </button>
                        </div>
                    </div>

                    <?PHP
                    $pdo = $turmaObj->getPdo();
                    
                    if (!empty($_GET['search'])) {
                        $data = $_GET['search'];
                        $sql = "SELECT * FROM turma WHERE 
                            id LIKE :search
                            OR turma LIKE :search
                            ORDER BY id DESC";

                        $stmt = $pdo->prepare($sql);
                        $param = "%$data%";
                        $stmt->bindParam(':search', $param);
                        $stmt->execute();
                        $resultTurma = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } else {
                        $resultTurma = $turmaObj->listarTurmas($id_inst);
                    }
                    ?>

                    <div class="table-container">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Turma</th>
                                    <th>Alunos</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?PHP
                                foreach ($resultTurma as $turma) {
                                    echo "<tr data-id='{$turma['id']}'>";
                                    echo "<td>";
                                    echo "<div class='turma-cell'>";
                                    echo "<div class='turma-icon'>";
                                    echo "<i class='fas fa-school'></i>";
                                    echo "</div>";
                                    echo "<div class='turma-info'>";
                                    echo "<div class='turma-name'>{$turma['turma']}</div>";
                                    echo "<div class='turma-id'>ID: {$turma['id']}</div>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</td>";
                                    
                                    echo "<td><span class='student-count'>0 alunos</span></td>";
                                    echo "<td class='actions'>";
                                    echo "</button>";
                                    echo "<a class='btn-icon btn-delete' title='Excluir' href='../controller/deleteTurma.php?id={$turma['id']}'>";
                                    echo "<i class='fas fa-trash'></i>";
                                    echo "</a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Comunicados -->
            <div class="content-section" id="comunicados">
                <div class="comunicados-container">
                    <div class="section-header">
                        <div class="section-title">
                            <h2>
                                <i class="fas fa-megaphone"></i>
                                Comunicados
                            </h2>
                            <p>Gerencie comunicações com a comunidade escolar</p>
                        </div>
                    </div>

                    <div class="comunicados-grid">
                        <!-- Lista de Comunicados -->
                        <div class="comunicados-list">
                            <div class="list-header">
                                <h3>Comunicados Enviados</h3>
                                <div class="search-container">
                                    <input type="text" placeholder="Buscar comunicado..." class="search-input">
                                    <button class="search-btn">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>

                            <?PHP
                            $pdo = $instObj->getPdo();
                            
                            if (!empty($_GET['search'])) {
                                $data = $_GET['search'];
                                $sql = "SELECT * FROM comunicado WHERE 
                                ra LIKE :search
                                OR nome     LIKE :search
                                OR email    LIKE :search
                                OR turma    LIKE :search
                                OR serie    LIKE :search
                                OR dataNasc LIKE :search
                                ORDER BY ra DESC";

                                $stmt = $pdo->prepare($sql);
                                $param = "%$data%";
                                $stmt->bindParam(':search', $param);
                                $stmt->execute();
                                $resultComunicado = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            } else {
                                $resultComunicado = $instObj->conferirCadComunicado($id_inst);
                            }
                            ?>

                            <div class="comunicados-items">
                                <?PHP
                                foreach ($resultComunicado as $comunicado) {
                                    echo "<div class='comunicado-item'>";
                                    echo "<div class='comunicado-header'>";
                                    echo "<div class='comunicado-icon'>";
                                    echo "<i class='fas fa-bullhorn'></i>";
                                    echo "</div>";
                                    echo "<div class='comunicado-info'>";
                                    echo "<div class='comunicado-title'>{$comunicado['titulo']}</div>";
                                    echo "<div class='comunicado-meta'>";
                                    echo "<span class='comunicado-date'>{$comunicado['data_comunicado']}</span>";
                                    echo "<span class='comunicado-target'>{$comunicado['destinatario']}</span>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "<div class='comunicado-actions'>";
                                    echo "<a class='btn-icon btn-delete' title='Excluir' href='../controller/deleteComunicado.php?id={$comunicado['id']}'>";
                                    echo "<i class='fas fa-trash'></i>";
                                    echo "</a>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "<div class='comunicado-content'>";
                                    echo "<p>" . substr($comunicado['descricao'], 0, 100) . "...</p>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                                ?>
                            </div>
                        </div>

                        <!-- Novo Comunicado -->
                        <div class="novo-comunicado">
                            <div class="form-header">
                                <div class="form-icon">
                                    <i class="fas fa-megaphone"></i>
                                </div>
                                <div class="form-title">
                                    <h3>Novo Comunicado</h3>
                                    <p>Envie informações importantes</p>
                                </div>
                            </div>

                            <form id="form-comunicado" action="../controller/insertInst.php" method="POST" class="compact-form">
                                <div class="form-group">
                                    <label for="titulo-comunicado">
                                        <i class="fas fa-heading"></i>
                                        Título
                                    </label>
                                    <input type="text" id="titulo-comunicado" name="titulo-comunicado" required>
                                </div>

                                <div class="form-group">
                                    <label for="destinatarios">
                                        <i class="fas fa-users"></i>
                                        Destinatários
                                    </label>
                                    <select id="destinatarios" name="destinatarios" required>
                                        <option value="">Selecione os destinatários</option>
                                        <option value="todos">Todos</option>
                                        <option value="alunos">Todos os Alunos</option>
                                        <option value="professores">Todos os Professores</option>
                                        <option value="1a">1º Ano A - Manhã</option>
                                        <option value="1b">1º Ano B - Tarde</option>
                                        <option value="2a">2º Ano A - Manhã</option>
                                        <option value="2b">2º Ano B - Tarde</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="conteudo-comunicado">
                                        <i class="fas fa-align-left"></i>
                                        Conteúdo
                                    </label>
                                    <textarea id="conteudo-comunicado" name="conteudo-comunicado" required rows="4"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="data-comunicado">
                                        <i class="fas fa-calendar"></i>
                                        Data
                                    </label>
                                    <input type="date" id="data-comunicado" name="data-comunicado" required>
                                </div>

                                <input type="hidden" name="id_inst" id="id_inst" value="<?= $id_inst ?>">

                                <div class="form-actions">
                                    <button type="button" class="btn-cancel" id="btn-cancelar-comunicado">
                                        <i class="fas fa-times"></i>
                                        Cancelar
                                    </button>
                                    <button type="submit" class="btn-primary" name="btn-cad-comunicado" id="btn-cad-comunicado">
                                        <i class="fas fa-paper-plane"></i>
                                        Enviar Comunicado
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Configurações -->
            <div class="content-section" id="configuracoes">
                <div class="configuracoes-container">
                    <div class="section-header">
                        <div class="section-title">
                            <h2>
                                <i class="fas fa-sliders-h"></i>
                                Configurações do Sistema
                            </h2>
                            <p>Gerencie as configurações da sua instituição</p>
                        </div>
                    </div>

                    <div class="config-grid">
                        <!-- Dados da Instituição -->
                        <div class="config-section">
                            <div class="config-header">
                                <div class="config-icon">
                                    <i class="fas fa-building"></i>
                                </div>
                                <div class="config-title">
                                    <h3>Dados da Instituição</h3>
                                    <p>Informações básicas da escola</p>
                                </div>
                            </div>

                            <form id="form-configuracoes" class="compact-form">
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label for="nome-instituicao">
                                            <i class="fas fa-school"></i>
                                            Nome da Instituição
                                        </label>
                                        <input type="text" id="nome-instituicao" name="nome-instituicao" value="">
                                    </div>

                                    <div class="form-group">
                                        <label for="email-contato">
                                            <i class="fas fa-envelope"></i>
                                            E-mail de Contato
                                        </label>
                                        <input type="email" id="email-contato" name="email-contato" value="">
                                    </div>

                                    <div class="form-group">
                                        <label for="telefone-contato">
                                            <i class="fas fa-phone"></i>
                                            Telefone de Contato
                                        </label>
                                        <input type="tel" id="telefone-contato" name="telefone-contato" value="">
                                    </div>

                                    <div class="form-group">
                                        <label for="cep">
                                            <i class="fas fa-map-pin"></i>
                                            CEP
                                        </label>
                                        <input type="text" id="cep" name="cep" value="">
                                    </div>

                                    <div class="form-group">
                                        <label for="estado">
                                            <i class="fas fa-map"></i>
                                            Estado
                                        </label>
                                        <input type="text" id="estado" name="estado" value="">
                                    </div>

                                    <div class="form-group">
                                        <label for="bairro">
                                            <i class="fas fa-map-marker-alt"></i>
                                            Bairro
                                        </label>
                                        <input type="text" id="bairro" name="bairro" value="">
                                    </div>

                                    <div class="form-group">
                                        <label for="rua">
                                            <i class="fas fa-road"></i>
                                            Rua
                                        </label>
                                        <input type="text" id="rua" name="rua" value="">
                                    </div>

                                    <div class="form-group">
                                        <label for="num">
                                            <i class="fas fa-hashtag"></i>
                                            Número
                                        </label>
                                        <input type="text" id="num" name="num" value="">
                                    </div>

                                    <div class="form-group">
                                        <label for="senha-instituicao">
                                            <i class="fas fa-lock"></i>
                                            Nova Senha (opcional)
                                        </label>
                                        <input type="password" id="senha-instituicao" name="senha-instituicao" value="">
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn-primary">
                                        <i class="fas fa-save"></i>
                                        Salvar Configurações
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Usuários do Sistema -->
                        <div class="config-section">
                            <div class="config-header">
                                <div class="config-icon">
                                    <i class="fas fa-users-cog"></i>
                                </div>
                                <div class="config-title">
                                    <h3>Usuários do Sistema</h3>
                                    <p>Gerencie acessos administrativos</p>
                                </div>
                            </div>

                            <div class="users-list">
                                <div class="user-item">
                                    <div class="user-avatar">
                                        <i class="fas fa-user-shield"></i>
                                    </div>
                                    <div class="user-info">
                                        <div class="user-name">Administrador</div>
                                        <div class="user-email">admin@levelup.com</div>
                                        <div class="user-role">Administrador</div>
                                    </div>
                                    <div class="user-status">
                                        <span class="badge badge-success">Ativo</span>
                                    </div>
                                    <div class="user-actions">
                                        <button class="btn-icon btn-edit" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn-icon btn-key" title="Redefinir senha">
                                            <i class="fas fa-key"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/MenuInstituicao.js"></script>
</body>

</html>
