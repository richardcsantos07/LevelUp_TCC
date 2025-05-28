<?php
session_start();
$id_resp = $_SESSION['id'];

require '../model/Crianca.class.php';
$criancaObj = new Crianca();

require '../model/Responsavel.class.php';
$respObj = new Responsavel();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Menu Responsável</title>
    <link rel="stylesheet" href="css/MenuCrianca.css" />
    <link rel="shortcut icon" href="../view/favicon.ico" type="image/x-icon" />
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <div class="user-info">
                <div class="user-avatar">CR</div>
                <div class="user-details">
                    <div class="user-name">Usuário</div>
                    <div class="user-role">Responsável</div>
                </div>
            </div>

            <div class="menu">
                <div class="menu-section">Principal</div>
                <a href="#dashboard" class="menu-item" data-section="dashboard">
                    <span class="menu-icon">📊</span>
                    Dashboard
                </a>

                <a href="#perfil-responsavel" class="menu-item" data-section="perfil-responsavel">
                    <span class="menu-icon">👤</span>
                    Perfil
                </a>

                <div class="menu-section">Cadastros</div>
                <div class="menu-item has-submenu" data-toggle="criancas-submenu">
                    <span class="menu-icon">👶</span>
                    Crianças
                </div>
                <div class="submenu" id="criancas-submenu">
                    <a href="#cadastrar-crianca" class="menu-item" data-section="cadastrar-crianca">
                        Cadastrar Criança
                    </a>
                    <a href="#listar-criancas" class="menu-item" data-section="listar-criancas">
                        Visualizar Cadastros
                    </a>
                </div>
            </div>
        </div>

        <div class="main-content">
            <!-- Dashboard -->
            <div class="content-section" id="dashboard">
                <div class="header">
                    <h1 class="page-title">Dashboard</h1>
                    <div class="search-bar">
                        <input type="text" placeholder="Pesquisar..." />
                        <span class="search-icon">🔍</span>
                    </div>
                </div>
                <div class="cards-container">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <div class="card-title">Total de Crianças</div>
                                <div class="card-value">
                                    <?php
                                    $result = $criancaObj->conferirCadCri($id_resp);
                                    echo count($result);
                                    ?>
                                </div>
                            </div>
                            <div class="card-icon">👶</div>
                        </div>
                        <div class="card-footer">
                            <span>Dados atualizados</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Perfil Responsável -->
            <div class="content-section" id="perfil-responsavel">
                <div class="header">
                    <h1 class="page-title">Perfil do Responsável</h1>
                </div>
                <div class="table-container">
                    <?php
                    $resp = $respObj->conferirCadastro($id_resp);
                    if ($resp) {
                    ?>
                        <div class="perfil-info">
                            <p><strong>Nome:</strong> <?= htmlspecialchars($resp['nome']) ?></p>
                            <p><strong>E-mail:</strong> <?= htmlspecialchars($resp['email']) ?></p>
                            <p><strong>Telefone:</strong> <?= htmlspecialchars($resp['telefone']) ?></p>
                            <p><strong>CPF:</strong> <?= htmlspecialchars($resp['cpf']) ?></p>
                        </div>

                        <div class="danger-zone">
                            
                            <button type="button" class="btn-delete-account" id="btn-delete-account">
                                Excluir Minha Conta
                            </button>
                        </div>
                    <?php
                    } else {
                        echo "<p>Informações do responsável não encontradas.</p>";
                    }
                    ?>
                </div>
            </div>

            <!-- Cadastrar Criança -->
            <div class="content-section" id="cadastrar-crianca">
                <div class="header">
                    <h1 class="page-title">Cadastrar Nova Criança</h1>
                </div>
                <div class="table-container">
                    <form id="form-crianca" action="../controller/inserirCri.php" method="POST">
                        <div class="form-group">
                            <label for="nome-crianca">Nome Completo</label>
                            <input type="text" id="nome-crianca" name="nome-crianca" required />
                        </div>
                        <div class="form-group">
                            <label for="email-crianca">E-mail</label>
                            <input type="email" id="email-crianca" name="email-crianca" required />
                        </div>
                        <div class="form-group">
                            <label for="senha-crianca">Senha</label>
                            <input type="password" id="senha-crianca" name="senha-crianca" required />
                        </div>
                        <div class="form-group">
                            <label for="data-nascimento">Data de Nascimento</label>
                            <input type="date" id="data-nascimento" name="data-nascimento" required />
                        </div>
                        <div class="form-group">
                            <label for="telefone-crianca">Telefone</label>
                            <input type="tel" id="telefone-crianca" name="telefone-crianca" required />
                        </div>
                        <input type="hidden" id="id_resp" name="id_resp" value="<?= $id_resp ?>" />
                        <div class="modal-footer">
                            <button type="button" class="btn-cancel" id="btn-cancelar-crianca">Cancelar</button>
                            <button type="submit" class="btn-save" id="btn-cad-crianca" name="btn-cad-crianca">
                                Cadastrar Criança
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <?php
            $pdo = $criancaObj->getPdo();
            
            if (!empty($_GET['search'])) {
                $data = $_GET['search'];
                $sql = "SELECT * FROM crianca WHERE 
                        idResponsavel = :id_resp AND (
                        nome LIKE :search
                        OR email LIKE :search
                        OR dataNasc LIKE :search
                        OR telefone LIKE :search)
                        ORDER BY id DESC";

                $stmt = $pdo->prepare($sql);
                $param = "%$data%";
                $stmt->bindParam(':search', $param);
                $stmt->bindParam(':id_resp', $id_resp);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $result = $criancaObj->conferirCadCri($id_resp);
            }
            ?>

            <!-- Listar Crianças -->
            <div class="content-section" id="listar-criancas">
                <div class="header">
                    <h1 class="page-title">Crianças Cadastradas</h1>
                    <div class="search-bar">
                        <input type="text" id="search-criancas" placeholder="Buscar criança..." />
                        <span class="search-icon">🔍</span>
                    </div>
                </div>
                <div class="table-container">
                    <?php if (count($result) > 0): ?>
                        <table id="criancas-table">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Data de Nascimento</th>
                                    <th>Telefone</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($result as $crianca) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($crianca['nome']) . "</td>";
                                    echo "<td>" . htmlspecialchars($crianca['email']) . "</td>";
                                    echo "<td>" . htmlspecialchars(date('d/m/Y', strtotime($crianca['dataNasc']))) . "</td>";
                                    echo "<td>" . htmlspecialchars($crianca['telefone']) . "</td>";
                                    echo "<td class='actions'>";
                                    echo "<button title='Editar' onclick='editarCrianca(" . $crianca['id'] . ")'>✏️</button>";
                                    echo "<a title='Excluir' href='../controller/deleteCri.php?id=" . $crianca['id'] . "' onclick='return confirm(\"Tem certeza que deseja excluir esta criança?\")'>❌</a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="no-data">
                            <p>Nenhuma criança cadastrada ainda.</p>
                            <p>Clique em "Cadastrar Criança" para adicionar a primeira criança.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmação de Exclusão -->
    <div class="modal-overlay" id="modal-delete-account">
        <div class="modal">
            <h3>🚨 Confirmar Exclusão de Conta</h3>
            <p><strong>Atenção:</strong> Esta ação é irreversível!</p>
            <p>Ao excluir sua conta, as seguintes ações serão executadas:</p>
            <ul>
                <li>✗ Sua conta de responsável será permanentemente excluída</li>
                <li>✗ Todas as contas das crianças associadas a você também serão excluídas</li>
                <li>✗ Todos os dados relacionados serão perdidos</li>
            </ul>
            <p><strong>Tem certeza de que deseja continuar?</strong></p>
            
            <div class="modal-buttons">
                <button type="button" class="btn-cancel-delete" id="btn-cancel-delete">
                    Cancelar
                </button>
                <button type="button" class="btn-confirm-delete" id="btn-confirm-delete">
                    Sim, Excluir Conta
                </button>
            </div>
        </div>
    </div>

    <script src="js/MenuCrianca.js"></script>
    
    <script>
        function editarCrianca(id) {
            alert('Funcionalidade de edição em desenvolvimento. ID: ' + id);
            // Aqui você pode implementar a funcionalidade de edição
        }
    </script>
</body>

</html>