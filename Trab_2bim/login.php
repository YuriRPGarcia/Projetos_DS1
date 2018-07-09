<?php 
include("header.php");

echo '
<blockquote><h4>Faça seu Login</h4></blockquote>
<div class="row">
    <form class="col s12" action="login.php" method="post">
        <div class="row">
            <div class="input-field col s12">
              <input id="login" type="text" name="login">
              <label for="login">Insira Seu Login</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
              <input id="senha" type="password" name="senha">
              <label for="senha">Insira Sua Senha</label>
            </div>
        </div>
        <button class="btn waves-effect waves-light" name = "loga" type="submit">Fazer Login</button>
    </form>
</div>
';
include("persistencia.php");
if (isset($_POST['loga'])) {
  login();      
}

function login(){
  if ($_POST['login'] == "admin" and $_POST['senha'] == "admin") {
    $_SESSION['login'] = $_POST['login'];
    $_SESSION['senha'] = $_POST['senha'];
    header('Location: admin.php');
  }else{
    $alunoDAO = new AlunoDAO();
    $aluno = $alunoDAO->obter($_POST['login'], $_POST['senha']);
    if($aluno != null){
      $trimlogin = trim($_POST['login']);
      $trimsenha = trim($_POST['senha']);
      if(!empty($trimlogin) && !empty($trimsenha)){      
        $_SESSION['login'] = $_POST['login'];
        $_SESSION['senha'] = $_POST['senha'];
      }     
    }
  }
}

include("footer.php");
?>