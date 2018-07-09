<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="static/style.css">
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <!-- Materialize JS -->
    <script src="static/materialize/js/materialize.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    <script src="static/js.js"></script>
    <title></title>
</head>
<body>
  <div id="nonFooter">
    <div id="header">
        <nav>
            <div class="nav-wrapper black">
                <?php  
                    session_start();
                    if ($_SESSION['login'] == "admin" and $_SESSION["senha"] == "admin"){
                      echo "<a href='/admin.php' class='brand-logo'>SIA</a>";
                    }else{
                      echo "<a href='/home.php' class='brand-logo'>SIA</a>";
                    }
                ?> 
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <?php  
                        if ($_SESSION['login'] == "admin" and $_SESSION["senha"] = "admin") {
                            echo '<li><a href="/gerenciar_alunos.php">Gerenciar Alunos</a></li>';
                            echo '<li><a href="/gerenciar_disciplinas.php">Gerenciar Disciplinas</a></li>';
                            echo '<li><a href="/gerenciar_cursos.php">Gerenciar Cursos</a></li>';
                            echo '<li><a href="/logout.php">Logout</a></li>';
                        }else{
                            echo '<li><a href="/login.php">Fazer Login</a></li>';
                        }
                    ?>
                </ul>
            </div>
        </nav>
    </div>   