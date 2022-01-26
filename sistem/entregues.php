<?php

// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();

// Verifica se não há a variável da sessão que identifica o usuário
if (!isset($_SESSION['UsuarioID'])) {
    // Destrói a sessão por segurança
    session_destroy();
    // Redireciona o visitante de volta pro login
    header("Location: ../index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <title>Página Inicial</title>
</head>

<body>
    <header>
        <div class="container">
            <nav class="navbar navbar-expand-lg ftco_navbar ftco-navbar-dark" id="ftco-navbar">
                <div class="container">
                    <a class="navbar-brand" href="index.html">Digital</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                        aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="fa fa-bars"></span>
                        Menu
                    </button>
                    <div class="collapse navbar-collapse" id="ftco-nav">
                        <ul class="navbar-nav ml-auto mr-md-3">
                            <li class="nav-item active">
                                <a href="index.php" class="nav-link">Pendentes</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Entregues</a>
                            </li>
                            <li class="nav-item">
                                <a href="../users/index.php" class="nav-link">Usuario</a>
                            </li>
                            <li class="nav-item">
                                <a href="../logout.php" class="nav-link">Logout</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Configurações gerais</a>
                            </li>
                        </ul>
                    </div>
                </div>

            </nav>
            <!-- END nav -->
        </div>
    </header>
    <div class="container">
        <p>Conectado como <?php echo $_SESSION['UsuarioNome']; ?> </p>

        <!-- <div class="jumbotron">
            <p>Conectado como <?php echo $_SESSION['UsuarioNome']; ?> </p>

            <div class="row">
                <h2>SAA - Controle de Maquinas</h2>
            </div>

        </div> -->
        </br>
        <div class="row">
            <p>
                <a href="create.php" class="btn btn-success">Adicionar</a>
            </p>
            <br>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <!-- <th scope="col">Nome</th> -->
                        <th scope="col">Local</th>
                        <th scope="col">Setor</th>
                        <th scope="col">Entrada</th>
                        <th scope="col">Status</th>
                        <th scope="col">Chapa</th>
                        <th scope="col">Chamado</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'banco.php';
                    $pdo = Banco::conectar();
                    $sql = 'SELECT * FROM maquina ORDER BY id DESC';

                    foreach ($pdo->query($sql) as $row) {
                        if ($row['status'] == 'Entregue') {
                            echo '<tr>';
                            echo '<th scope="row">' . $row['id'] . '</th>';
                            echo '<td>' . $row['local'] . '</td>';
                            echo '<td>' . $row['setor'] . '</td>';
                            echo '<td>' . $row['entrada'] . '</td>';
                            echo '<td>' . $row['status'] . '</td>';
                            echo '<td>' . $row['chapa'] . '</td>';
                            echo '<td>' . $row['chamado'] . '</td>';
                            echo '<td width=100>';
                            echo '<a class="btn btn-primary" href="read.php?id=' . $row['id'] . '">Info</a>';
                            echo ' ';
                            echo '</td>';
                            echo '</tr>';
                        }
                    }
                    Banco::desconectar();
                    ?>
                </tbody>
            </table>
        </div>
        <hr>

    </div>

    <footer>
        <div class="container">
            <span class="badge badge-secondary">v 1.0.0 &copy; 2021 - Marcos A. R. T. dos Santos</span>


        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="../assets/js/bootstrap.min.js"></script>
</body>

</html>