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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Instucional</title>
    <link rel="stylesheet" href="css/MenuInstituicao.css">
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
                            <button type="submit" name="btn-cad-aluno" id="btn-cad-aluno" class="btn-save">Cadastrar
                                Aluno</button>
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
                        $param = "%$data%"; // Corrigido: era "%data%"
                        $stmt->bindParam(':search', $param);
                        $stmt->execute();
                        $resultAluno = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } else {
                        // Usar o método da classe para obter todos os alunos
                        $resultAluno = $alunoObj->listarTodosAlunos($id_inst); // Precisamos adicionar este método à classe Aluno
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
                            foreach ($resultAluno as $aluno) {
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
                                echo "<a title='Excluir' href='../controller/deleteAluno.php?id={$aluno['ra']}'>❌</a>";
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
                            <?PHP
                            $pdo = $professorObj->getPdo(); // Precisamos adicionar este método à classe Aluno
                            
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
                                $param = "%$data%"; // Corrigido: era "%data%"
                                $stmt->bindParam(':search', $param);
                                $stmt->execute();
                                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            } else {
                                // Usar o método da classe para obter todos os alunos
                                $result = $professorObj->listarTodosProfessores($id_inst); // Precisamos adicionar este método à classe Aluno
                            }


                            ?>

                            <!-- Listar Professores -->
                            <table id="teachersTable" style="margin-top: 20px;">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>E-mail</th>
                                        <th>Senha</th>
                                        <th>Disciplina</th>
                                        <th>Data de Nascimento</th>
                                        <th>Telefone</th>
                                        <th>CPF</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?PHP
                                    foreach ($result as $professor) {
                                        echo "<tr>";
                                        echo "<td>{$professor['nome']}</td>";
                                        echo "<td>{$professor['email']}</td>";
                                        echo "<td>{$professor['senha']}</td>";
                                        echo "<td>{$professor['materia']}</td>";
                                        echo "<td>{$professor['dataNasc']}</td>";
                                        echo "<td>{$professor['telefone']}</td>";
                                        echo "<td>{$professor['cpf']}</td>";

                                        // Ações (editar, excluir, ver detalhes)
                                        echo "<td class='actions'>";
                                        echo "<button title='Editar'>✏️</button>";
                                        echo "<a title='Excluir' href='../controller/deleteProf.php?id={$professor['id']}'>❌</a>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
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
                        <form id="form-professor" method="POST" action="../controller/inserirProf.php">
                            <div class="form-group">
                                <label for="nome-professor">Nome Completo</label>
                                <input type="text" id="nome-professor" name="nome-professor" required>
                            </div>

                            <div class="form-group">
                                <label for="email-professor">E-mail</label>
                                <input type="email" id="email-professor" name="email-professor" required>
                            </div>

                            <div class="form-group">
                                <label for="senha-professor">Senha</label>
                                <input type="password" id="senha-professor" name="senha-professor" required>
                            </div>

                            <div class="form-group">
                                <label for="disciplina">Disciplina</label>
                                <input type="text" id="disciplina" name="disciplina" required>
                            </div>

                            <div class="form-group">
                                <label for="cpf-professor">CPF</label>
                                <input type="text" id="cpf-professor" name="cpf-professor" required>
                            </div>

                            <div class="form-group">
                                <label for="data-nascimento-professor">Data de Nascimento</label>
                                <input type="date" id="data-nascimento-professor" name="data-nascimento-professor"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="telefone-professor">Telefone</label>
                                <input type="tel" id="telefone-professor" name="telefone-professor"
                                    placeholder="(00) 00000-0000">
                            </div>

                            <input type="hidden" name="id_inst" id="id_inst" value="<?= $id_inst ?>">

                            <div class="modal-footer">
                                <button type="button" class="btn-cancel">Cancelar</button>
                                <button type="submit" class="btn-save" name="btn-cad-professor"
                                    id="btn-cad-professor">Cadastrar Professor</button>
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

                <div class="table-container">
                    <div class="table-header">
                        <div class="table-title">Comunicados Enviados</div>
                        <div class="table-actions">
                            <button id="btn-novo-comunicado">+ Novo Comunicado</button>
                        </div>
                    </div>
                    <?PHP
                    $pdo = $instObj->getPdo(); // Precisamos adicionar este método à classe Aluno
                    
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
                        $param = "%$data%"; // Corrigido: era "%data%"
                        $stmt->bindParam(':search', $param);
                        $stmt->execute();
                        $resultComunicado = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } else {
                        // Usar o método da classe para obter todos os alunos
                        $resultComunicado = $instObj->conferirCadComunicado($id_inst); // Precisamos adicionar este método à classe Aluno
                    }


                    ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Destinatários</th>
                                <th>Descrição</th>
                                
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?PHP
                                    foreach ($resultComunicado as $comunicado) {
                                        echo "<tr>";
                                        echo "<td>{$comunicado['titulo']}</td>";
                                        echo "<td>{$comunicado['destinatario']}</td>";
                                        echo "<td>{$comunicado['descricao']}</td>";
                                        

                                        // Ações (editar, excluir, ver detalhes)
                                        echo "<td class='actions'>";
                                        echo "<button title='Editar'>✏️</button>";
                                        echo "<a title='Excluir' href='../controller/deleteComunicado.php?id={$comunicado['id']}'>❌</a>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                        </tbody>
                    </table>
                </div>

                <div class="table-container">
                    <div class="table-header">
                        <div class="table-title">Novo Comunicado</div>
                    </div>
                    <form id="form-comunicado" action="../controller/insertInst.php" method="POST">
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

                        <input type="hidden" name="id_inst" id="id_inst" value="<?= $id_inst ?>">

                        <div class="modal-footer">
                            <button type="button" class="btn-cancel" id="btn-cancelar-comunicado">Cancelar</button>
                            <button type="submit" class="btn-save" name="btn-cad-comunicado" id="btn-cad-comunicado">Enviar Comunicado</button>
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
                    <form id="form-turma" action="../controller/inserirTurma.php" method="POST">
                        <div class="form-group">
                            <label for="serie-turma">Serie</label>
                            <input type="text" id="serie-turma" name="serie-turma" required>
                        </div>

                        <div class="form-group">
                            <label for="turma">Turma</label>
                            <input type="text" id="turma" name="turma" required>
                        </div>

                        <div class="form-group">
                            <label for="turno-turma">Turno</label>
                            <input type="text" id="turno-turma" name="turno-turma" required>
                        </div>

                        <input type="hidden" name="id_inst" id="id_inst" value="<?= $id_inst?>">

                        <div class="modal-footer">
                            <button type="button" class="btn-cancel" id="btn-cancelar-turma">Cancelar</button>
                            <button type="submit" class="btn-save" name="btn-cad-turma" id="btn-cad-turma">Criar Turma</button>
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