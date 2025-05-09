<?PHP
session_start();
$id_inst = $_SESSION['id'];

require '../model/Turma.class.php';
$turmaObj = new Turma();

require '../model/Aluno.class.php';
$alunoObj = new Aluno();

require '../model/Professor.class.php';
$professorObj = new Professor();





?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Instucional</title>
    <link rel="stylesheet" href="css/MenuInstituicao.css">
    <link rel="stylesheet" href="css/calendar.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>

<body>


    <!-- 'container' onde está localizado a sidebar-menu -->
    <div class="container">
        <div class="sidebar">

            <!-- Informações do usuário logado -->
            <div class="user-info">
                <div class="user-avatar">AC</div>
                <div class="user-details">
                    <div class="user-name">Admin</div>
                    <div class="user-role">Administrador</div>
                </div>
            </div>

            <!-- Menu lateral -->
            <div class="menu">
                <div class="menu-section">Principal</div>
                <a href="#dashboard" class="menu-item active" data-section="dashboard">
                    <span class="menu-icon">📊</span>
                    Dashboard
                </a>

                <div class="menu-section">Gerenciamento</div>
                <div class="menu-item has-submenu" data-toggle="alunos-submenu">
                    <span class="menu-icon">👨‍🎓</span>
                    Alunos
                </div>

                <!-- Itens e Sub-itens do menu -->
                <div class="submenu" id="alunos-submenu">
                    <a href="#cadastrar-aluno" class="menu-item" data-section="cadastrar-aluno">
                        Cadastrar Aluno
                    </a>
                    <a href="#listar-alunos" class="menu-item" data-section="listar-alunos">
                        Listar Alunos
                    </a>
                </div>

                <div class="menu-item has-submenu" data-toggle="professores-submenu">
                    <span class="menu-icon">👨‍🏫</span>
                    Professores
                </div>
                <div class="submenu" id="professores-submenu">
                    <a href="#cadastrar-professor" class="menu-item" data-section="cadastrar-professor">
                        Cadastrar Professor
                    </a>
                    <a href="#listar-professores" class="menu-item" data-section="listar-professores">
                        Listar Professores
                    </a>
                </div>

                <div class="menu-item has-submenu" data-toggle="turmas-submenu">
                    <span class="menu-icon">🏛️</span>
                    Turmas
                </div>
                <div class="submenu" id="turmas-submenu">
                    <a href="#cadastrar-turma" class="menu-item" data-section="cadastrar-turma">
                        Criar Turma
                    </a>
                    <a href="#listar-turmas" class="menu-item" data-section="listar-turmas">
                        Gerenciar Turmas
                    </a>
                </div>

                <div class="menu-section">Comunicação</div>
                <a href="#comunicados" class="menu-item" data-section="comunicados">
                    <span class="menu-icon">📢</span>
                    Comunicados
                </a>

                <div class="menu-section">Sistema</div>
                <a href="#configuracoes" class="menu-item" data-section="configuracoes">
                    <span class="menu-icon">⚙️</span>
                    Configurações
                </a>
                <a href="#sair" class="menu-item">
                    <span class="menu-icon">🚪</span>
                    Sair
                </a>
            </div>
        </div>



        <!-- 'main-content' conteudo principal, ou seja os formularios dos itens e subitens -->
        <div class="main-content">

            <!-- Dashboard -->
            <div class="content-section active" id="dashboard">
                <div class="header">
                    <h1 class="page-title">Dashboard</h1>
                    <div class="search-bar">
                        <input type="text" placeholder="Pesquisar...">
                        <span class="search-icon">🔍</span>
                    </div>
                </div>

                <div class="cards-container">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <div class="card-title">Total de Alunos</div>
                                <div class="card-value">248</div>
                            </div>
                            <div class="card-icon">👨‍🎓</div>
                        </div>
                        <div class="card-footer">
                            <span class="trend-up">↑ 12%</span>
                            <span>desde o último semestre</span>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <div>
                                <div class="card-title">Total de Professores</div>
                                <div class="card-value">32</div>
                            </div>
                            <div class="card-icon">👨‍🏫</div>
                        </div>
                        <div class="card-footer">
                            <span class="trend-up">↑ 5%</span>
                            <span>desde o último semestre</span>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <div>
                                <div class="card-title">Turmas Ativas</div>
                                <div class="card-value">18</div>
                            </div>
                            <div class="card-icon">🏛️</div>
                        </div>
                        <div class="card-footer">
                            <span class="trend-up">↑ 2</span>
                            <span>novas turmas este semestre</span>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <div>
                                <div class="card-title">Comunicados</div>
                                <div class="card-value">5</div>
                            </div>
                            <div class="card-icon">📢</div>
                        </div>
                        <div class="card-footer">
                            <span>não lidos</span>
                        </div>
                    </div>
                </div>

                <div class="table-container">
                    <div class="table-header">
                        <div class="table-title">Últimas Atividades</div>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Atividade</th>
                                <th>Responsável</th>
                                <th>Data</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Cadastro de novo aluno</td>
                                <td>Carlos Silva</td>
                                <td>05/05/2025</td>
                                <td><span class="status status-active">Concluído</span></td>
                            </tr>
                            <tr>
                                <td>Criação de nova turma</td>
                                <td>Maria Oliveira</td>
                                <td>04/05/2025</td>
                                <td><span class="status status-active">Concluído</span></td>
                            </tr>
                            <tr>
                                <td>Envio de comunicado geral</td>
                                <td>João Santos</td>
                                <td>03/05/2025</td>
                                <td><span class="status status-active">Enviado</span></td>
                            </tr>
                            <tr>
                                <td>Atualização de dados cadastrais</td>
                                <td>Ana Souza</td>
                                <td>02/05/2025</td>
                                <td><span class="status status-pending">Em andamento</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Fim do Dashboard -->

            <!-- Cadastrar Aluno -->
            <div class="content-section" id="cadastrar-aluno">
                <div class="header">
                    <h1 class="page-title">Cadastrar Novo Aluno</h1>
                </div>

                <div class="table-container">
                    <form id="form-aluno" action="../controller/inserirAluno.php" method="POST">
                        <div class="form-group">
                            <label for="ra-aluno">RA</label>
                            <input type="text" id="ra-aluno" name="ra-aluno" required>
                        </div>

                        <div class="form-group">
                            <label for="nome-aluno">Nome Completo</label>
                            <input type="text" id="nome-aluno" name="nome-aluno" required>
                        </div>

                        <div class="form-group">
                            <label for="data-nascimento">Data de Nascimento</label>
                            <input type="date" id="data-nascimento" name="data-nascimento" required>
                        </div>

                        <div class="form-group">
                            <label for="email-aluno">E-mail</label>
                            <input type="email" id="email-aluno" name="email-aluno" required>
                        </div>

                        <div class="form-group">
                            <label for="senha-aluno">Senha</label>
                            <input type="text" id="senha-aluno" name="senha-aluno" required>
                        </div>

                        <div class="form-group">
                            <label for="telefone-aluno">Telefone</label>
                            <input type="tel" id="telefone-aluno" name="telefone-aluno" placeholder="(00) 00000-0000">
                        </div>

                        <div class="form-group">
                            <label for="turma-aluno">Turma</label>
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
                            <label for="responsavel-aluno">Nome do Responsável</label>
                            <input type="text" id="responsavel-aluno" name="responsavel-aluno">
                        </div>

                        <div class="form-group">
                            <label for="telefone-responsavel">Telefone do Responsável</label>
                            <input type="tel" id="telefone-responsavel" name="telefone-responsavel"
                                placeholder="(00) 00000-0000">
                        </div>

                        <input type="hidden" id="id_inst" name="id_inst" value="<?= $id_inst ?>">

                        <div class="modal-footer">
                            <button type="button" class="btn-cancel" id="btn-cancelar-aluno">Cancelar</button>
                            <button type="submit" name="btn-cad-aluno"
                            id="btn-cad-aluno" class="btn-save">Cadastrar Aluno</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Fim do Cadastrar Aluno -->

            <!-- Listar Alunos -->
            <div class="content-section" id="listar-alunos">
                <div class="header">
                    <h1 class="page-title">Alunos Cadastrados</h1>
                    <div class="search-bar">
                        <input type="text" placeholder="Buscar aluno...">
                        <span class="search-icon">🔍</span>
                    </div>
                </div>

                <div class="table-container">
                    <div class="table-header">
                        <div class="table-title">Lista de Alunos</div>
                        <div class="table-actions">
                            <button id="btn-novo-aluno">+ Novo Aluno</button>
                        </div>
                    </div>
                    <?PHP
                    $pdo = $alunoObj->getPdo(); // Precisamos adicionar este método à classe Aluno
    
                    if(!empty($_GET['search'])) {
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
                        $param = "%$data%"; // Corrigido: era "%data%"
                        $stmt->bindParam(':search', $param);
                        $stmt->execute();
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } else {
                        // Usar o método da classe para obter todos os alunos
                        $result = $alunoObj->listarTodosAlunos($id_inst); // Precisamos adicionar este método à classe Aluno
                    }
                                                                            
                         
                    ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Senha</th>
                                <th>Turma</th>
                                <th>Telefone</th>
                                <th>Data de Nascimento</th>
                                <th>Nome do Responsável</th>
                                <th>Telefone do Responsável</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?PHP
                            foreach ($result as $aluno) {
                                echo "<tr>";
                                echo "<td>{$aluno['nome']}</td>";
                                echo "<td>{$aluno['email']}</td>";
                                echo "<td>{$aluno['senha']}</td>";
                                echo "<td>{$aluno['turma']}</td>";
                                echo "<td>{$aluno['tell']}</td>";
                                echo "<td>{$aluno['dataNasc']}</td>";
                                echo "<td>{$aluno['nome_responsavel']}</td>";
                                echo "<td>{$aluno['tell_responsavel']}</td>";
                                // Ações (editar, excluir, ver detalhes)
                                echo "<td class='actions'>";
                                echo "<button title='Editar'>✏️</button>";
                                echo "<button title='Excluir'>❌</button>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Fim do Listar Alunos -->

            <!-- Professores Section -->
            <!-- Content Area -->
            <div class="content" id="content">




                <div class="content-section" id="listar-professores">







                    <!-- Tab Content -->
                    <div class="tab-content active" id="professores-lista">
                        <div class="table-container">
                            <div class="table-header">
                                <h3 class="table-title">Professores Cadastrados</h3>
                                <div class="search-container">
                                    <input type="text" class="search-input" id="searchProfessores"
                                        placeholder="Buscar professor...">
                                    <button class="btn btn-primary">Buscar</button>
                                </div>
                            </div>

                            <!-- Table view (hidden by default) -->
                            <table id="teachersTable" style="margin-top: 20px;">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Disciplina</th>
                                        <th>Status</th>
                                        <th>Turmas</th>
                                        <th>Alunos</th>
                                        <th>Tempo de Casa</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="profile-card">
                                                <div class="profile-img">MR</div>
                                                <div class="profile-info">
                                                    <div class="profile-name">Marcos Ribeiro</div>
                                                    <div class="profile-subtitle">ID: 1001</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Matemática</td>
                                        <td><span class="badge badge-success">Ativo</span></td>
                                        <td>4</td>
                                        <td>120</td>
                                        <td>8 anos</td>
                                        <td>
                                            <div class="actions">
                                                <div class="action-btn bg-primary">👁️</div>
                                                <div class="action-btn bg-success">✏️</div>
                                                <div class="action-btn bg-danger">❌</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="profile-card">
                                                <div class="profile-img">CS</div>
                                                <div class="profile-info">
                                                    <div class="profile-name">Carla Silva</div>
                                                    <div class="profile-subtitle">ID: 1002</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Português</td>
                                        <td><span class="badge badge-success">Ativo</span></td>
                                        <td>3</td>
                                        <td>85</td>
                                        <td>5 anos</td>
                                        <td>
                                            <div class="actions">
                                                <div class="action-btn bg-primary">👁️</div>
                                                <div class="action-btn bg-success">✏️</div>
                                                <div class="action-btn bg-danger">❌</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="profile-card">
                                                <div class="profile-img">JA</div>
                                                <div class="profile-info">
                                                    <div class="profile-name">João Almeida</div>
                                                    <div class="profile-subtitle">ID: 1003</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>História</td>
                                        <td><span class="badge badge-success">Ativo</span></td>
                                        <td>2</td>
                                        <td>60</td>
                                        <td>3 anos</td>
                                        <td>
                                            <div class="actions">
                                                <div class="action-btn bg-primary">👁️</div>
                                                <div class="action-btn bg-success">✏️</div>
                                                <div class="action-btn bg-danger">❌</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="profile-card">
                                                <div class="profile-img">RL</div>
                                                <div class="profile-info">
                                                    <div class="profile-name">Roberta Lima</div>
                                                    <div class="profile-subtitle">ID: 1004</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Ciências</td>
                                        <td><span class="badge badge-warning">Licença</span></td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>6 anos</td>
                                        <td>
                                            <div class="actions">
                                                <div class="action-btn bg-primary">👁️</div>
                                                <div class="action-btn bg-success">✏️</div>
                                                <div class="action-btn bg-danger">❌</div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>





                </div>


                <!-- Cadastrar Professor -->
                <div class="content-section" id="cadastrar-professor">
                    <div class="header">
                        <h1 class="page-title">Cadastrar Novo Professor</h1>
                    </div>

                    <div class="table-container">
                        <form id="form-professor">
                            <div class="form-group">
                                <label for="nome-professor">Nome Completo</label>
                                <input type="text" id="nome-professor" name="nome-professor" required>
                            </div>

                            <div class="form-group">
                                <label for="email-professor">E-mail</label>
                                <input type="email" id="email-professor" name="email-professor" required>
                            </div>

                            <div class="form-group">
                                <label for="disciplina">Disciplina</label>
                                <input type="text" id="disciplina" name="disciplina" required>
                            </div>

                            <div class="form-group">
                                <label for="telefone-professor">Telefone</label>
                                <input type="tel" id="telefone-professor" name="telefone-professor"
                                    placeholder="(00) 00000-0000">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn-cancel">Cancelar</button>
                                <button type="submit" class="btn-save">Cadastrar Professor</button>
                            </div>
                        </form>
                    </div>
                </div>




            </div>

            <!-- Fim do Cadastrar Professor -->

           <!-- Comunicados -->
<div class="content-section" id="comunicados">
    <div class="header">
        <h1 class="page-title">Comunicados</h1>
        <div class="search-bar">
            <input type="text" placeholder="Buscar comunicado...">
            <span class="search-icon">🔍</span>
        </div>
    </div>
    
    <div class="calendar" id="calendar-container">
        <?php
        // Configurações de localização para português
        setlocale(LC_TIME, 'pt_BR.utf8', 'pt_BR', 'Portuguese_Brazil.1252');
        
        // Parâmetros do mês e ano
        $month = isset($_GET['month']) ? (int)$_GET['month'] : date('m');
        $year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');
        $month = max(1, min(12, $month));
        
        // Cálculo de dias do mês e início da semana
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $firstDayOfWeek = date('w', strtotime("$year-$month-01"));
        
        // Cálculo dos meses anterior e próximo
        $prevMonth = $month - 1;
        $prevYear = $year;
        if ($prevMonth < 1) {
            $prevMonth = 12;
            $prevYear--;
        }
        
        $nextMonth = $month + 1;
        $nextYear = $year;
        if ($nextMonth > 12) {
            $nextMonth = 1;
            $nextYear++;
        }
        
        // Verifica se é uma requisição AJAX
        $isAjax = isset($_GET['ajax']);
        
        // Renderiza o conteúdo do calendário
        ?>
        
        <div class="calendar-content">
            <div class="calendar-header">
                <div class="month-navigation">
                    <button class="nav-btn" onclick="loadCalendar(<?= $prevMonth ?>, <?= $prevYear ?>)">&#8249;</button>
                    <h2><?= ucfirst(strftime('%B', strtotime("$year-$month-01"))) . " $year" ?></h2>
                    <button class="nav-btn" onclick="loadCalendar(<?= $nextMonth ?>, <?= $nextYear ?>)">&#8250;</button>
                </div>
            </div>
            <div class="weekdays">
                <div>Dom</div><div>Seg</div><div>Ter</div><div>Qua</div><div>Qui</div><div>Sex</div><div>Sáb</div>
            </div>
            <div class="days-grid">
                <?php
                for ($i = 0; $i < $firstDayOfWeek; $i++) {
                    echo "<div class='day other-month'></div>";
                }
                for ($day = 1; $day <= $daysInMonth; $day++) {
                    $isToday = ($day == date('j') && $month == date('n') && $year == date('Y'));
                    $class = 'day' . ($isToday ? ' current-day' : '');
                    echo "<div class='$class'>$day</div>";
                }
                ?>
            </div>
            <div class="calendar-actions">
                <button class="btn">Adicionar Evento</button>
                <button class="btn">Ver Eventos</button>
            </div>
        </div>
        
        <?php
        // Se não for AJAX, inclui o script JavaScript
        if (!$isAjax):
        ?>
        <script>
            function loadCalendar(month, year) {
                fetch(`?month=${month}&year=${year}&ajax=1`)
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('calendar-container').innerHTML = html;
                        attachDayClick(); // Reatribui eventos aos dias
                    });
            }
            
            // Função para destacar dia clicado
            function attachDayClick() {
                document.querySelectorAll('.calendar-content .day').forEach(day => {
                    day.addEventListener('click', function() {
                        document.querySelectorAll('.calendar-content .day').forEach(d => 
                            d.classList.remove('selected'));
                        this.classList.add('selected');
                    });
                });
            }
            
            // Ao carregar a página, anexa eventos de clique nos dias
            window.addEventListener('DOMContentLoaded', attachDayClick);
        </script>
        <?php endif; ?>
    </div>
</div>

    
                    <!-- Fim CALENDARIO -->        



                        <!--Casdastro de comunicados-->
                <div class="table-container">
                    <div class="table-header">
                        <div class="table-title">Novo Comunicado</div>
                    </div>
                    <form id="form-comunicado">
                        <div class="form-group">
                            <label for="titulo-comunicado">Título</label>
                            <input type="text" id="titulo-comunicado" name="titulo-comunicado" required>
                        </div>

                        <div class="form-group">
                            <label for="destinatarios">Destinatários</label>
                            <select id="destinatarios" name="destinatarios" multiple required>
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
                            <label for="conteudo-comunicado">Conteúdo</label>
                            <textarea id="conteudo-comunicado" name="conteudo-comunicado" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="anexo">Anexo</label>
                            <input type="file" id="anexo" name="anexo">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn-cancel" id="btn-cancelar-comunicado">Cancelar</button>
                            <button type="submit" class="btn-save">Enviar Comunicado</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Fim do Comunicados -->

            <!-- Cadastrar Turma -->
            <div class="content-section" id="cadastrar-turma">
                <div class="header">
                    <h1 class="page-title">Criar Nova Turma</h1>
                </div>


                <div class="table-container">
                    <form id="form-turma">
                        <div class="form-group">
                            <label for="nome-turma">Nome da Turma</label>
                            <input type="text" id="nome-turma" name="nome-turma" required>
                        </div>

                        <div class="form-group">
                            <label for="ano-letivo">Ano Letivo</label>
                            <select id="ano-letivo" name="ano-letivo" required>
                                <option value="">Selecione o ano letivo</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="periodo">Período</label>
                            <select id="periodo" name="periodo" required>
                                <option value="">Selecione o período</option>
                                <option value="manha">Manhã</option>
                                <option value="tarde">Tarde</option>
                                <option value="noite">Noite</option>
                                <option value="integral">Integral</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="professor-responsavel">Professor Responsável</label>
                            <select id="professor-responsavel" name="professor-responsavel">
                                <option value="">Selecione o professor</option>
                                <option value="1">Roberto Almeida</option>
                                <option value="2">Mariana Costa</option>
                                <option value="3">Fernando Santos</option>
                                <option value="4">Patrícia Lima</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="capacidade">Capacidade de Alunos</label>
                            <input type="number" id="capacidade" name="capacidade" min="1" max="100" value="30"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="sala">Sala</label>
                            <input type="text" id="sala" name="sala">
                        </div>

                        <div class="form-group">
                            <label for="descricao-turma">Descrição</label>
                            <textarea id="descricao-turma" name="descricao-turma"></textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn-cancel" id="btn-cancelar-turma">Cancelar</button>
                            <button type="submit" class="btn-save">Criar Turma</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Fim do Cadastrar Turma -->

            <!-- Listar Turmas -->
            <div class="content-section" id="listar-turmas">
                <div class="header">
                    <h1 class="page-title">Gerenciamento de Turmas</h1>
                    <div class="search-bar">
                        <input type="text" placeholder="Buscar turma...">
                        <span class="search-icon">🔍</span>
                    </div>
                </div>

                <div class="table-container">
                    <div class="table-header">
                        <div class="table-title">Lista de Turmas</div>
                        <div class="table-actions">
                            <button id="btn-nova-turma">+ Nova Turma</button>
                        </div>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Período</th>
                                <th>Professor Responsável</th>
                                <th>Alunos</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1º Ano A</td>
                                <td>Manhã</td>
                                <td>Roberto Almeida</td>
                                <td>25/30</td>
                                <td><span class="status status-active">Ativa</span></td>
                                <td class="actions">
                                    <button title="Editar">✏️</button>
                                    <button title="Gerenciar Alunos">👨‍👩‍👧‍👦</button>
                                    <button title="Ver detalhes">👁️</button>
                                </td>
                            </tr>
                            <tr>
                                <td>1º Ano B</td>
                                <td>Tarde</td>
                                <td>Mariana Costa</td>
                                <td>28/30</td>
                                <td><span class="status status-active">Ativa</span></td>
                                <td class="actions">
                                    <button title="Editar">✏️</button>
                                    <button title="Gerenciar Alunos">👨‍👩‍👧‍👦</button>
                                    <button title="Ver detalhes">👁️</button>
                                </td>
                            </tr>
                            <tr>
                                <td>2º Ano A</td>
                                <td>Manhã</td>
                                <td>Fernando Santos</td>
                                <td>22/30</td>
                                <td><span class="status status-active">Ativa</span></td>
                                <td class="actions">
                                    <button title="Editar">✏️</button>
                                    <button title="Gerenciar Alunos">👨‍👩‍👧‍👦</button>
                                    <button title="Ver detalhes">👁️</button>
                                </td>
                            </tr>
                            <tr>
                                <td>2º Ano B</td>
                                <td>Tarde</td>
                                <td>Patrícia Lima</td>
                                <td>0/30</td>
                                <td><span class="status status-pending">Pendente</span></td>
                                <td class="actions">
                                    <button title="Editar">✏️</button>
                                    <button title="Gerenciar Alunos">👨‍👩‍👧‍👦</button>
                                    <button title="Ver detalhes">👁️</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Fim do Listar Turmas -->

            <!-- Configurações -->
            <div class="content-section" id="configuracoes">
                <div class="header">
                    <h1 class="page-title">Configurações do Sistema</h1>
                </div>

                <div class="table-container">
                    <div class="table-header">
                        <div class="table-title">Configurações Gerais</div>
                    </div>
                    <form id="form-configuracoes">
                        <div class="form-group">
                            <label for="nome-instituicao">Nome da Instituição</label>
                            <input type="text" id="nome-instituicao" name="nome-instituicao" value="EduGestão">
                        </div>

                        <div class="form-group">
                            <label for="email-contato">E-mail de Contato</label>
                            <input type="email" id="email-contato" name="email-contato"
                                value="contato@edugestao.com.br">
                        </div>

                        <div class="form-group">
                            <label for="telefone-contato">Telefone de Contato</label>
                            <input type="tel" id="telefone-contato" name="telefone-contato" value="(11) 5555-5555">
                        </div>

                        <div class="form-group">
                            <label for="endereco">Endereço</label>
                            <textarea id="endereco" name="endereco">Av. Paulista, 1000 - São Paulo/SP</textarea>
                        </div>

                        <div class="form-group">
                            <label for="ano-letivo-atual">Ano Letivo Atual</label>
                            <select id="ano-letivo-atual" name="ano-letivo-atual">
                                <option value="2025" selected>2025</option>
                                <option value="2026">2026</option>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn-save">Salvar Configurações</button>
                        </div>
                    </form>
                </div>

                <div class="table-container">
                    <div class="table-header">
                        <div class="table-title">Usuários do Sistema</div>
                        <div class="table-actions">
                            <button id="btn-novo-usuario">+ Novo Usuário</button>
                        </div>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Perfil</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Administrador</td>
                                <td>admin@edugestao.com.br</td>
                                <td>Administrador</td>
                                <td><span class="status status-active">Ativo</span></td>
                                <td class="actions">
                                    <button title="Editar">✏️</button>
                                    <button title="Redefinir senha">🔑</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Coordenador</td>
                                <td>coordenador@edugestao.com.br</td>
                                <td>Coordenador</td>
                                <td><span class="status status-active">Ativo</span></td>
                                <td class="actions">
                                    <button title="Editar">✏️</button>
                                    <button title="Redefinir senha">🔑</button>
                                    <button title="Desativar">❌</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Secretaria</td>
                                <td>secretaria@edugestao.com.br</td>
                                <td>Secretaria</td>
                                <td><span class="status status-active">Ativo</span></td>
                                <td class="actions">
                                    <button title="Editar">✏️</button>
                                    <button title="Redefinir senha">🔑</button>
                                    <button title="Desativar">❌</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Fim do Configurações -->

            <!--Fechamento da div.container e da div.main-content -->
        </div>
    </div>




    <script src="js/MenuInstituicao.js"></script>

</body>

</html>