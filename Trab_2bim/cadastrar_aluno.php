<?php 
include("header.php");
include('persistencia.php');
?>

<blockquote><h4>Cadastre um Aluno</h4></blockquote>

<div class="row">
    <form class="col s12" action="cadastrar_aluno.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="input-field col s12">
              <input id="matricula" type="text" name="matricula" required>
              <label for="matricula">Insira a Matrícula</label>
            </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <select name="curso">
            <option value="" disabled selected>Escolha o Curso</option>
            <?php 
              $cursoDAO = new CursoDAO();
              $cursos = $cursoDAO->listar();
              foreach($cursos as $curso) {
                echo '<option value="'.$curso->id.'">'.$curso->nome.'</option>';
              }
            ?>
            </select>
            <label>Escolha o Curso</label>
          </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
              <input id="nome" type="text" name="nome" required>
              <label for="nome">Insira o Nome</label>
            </div>
            <div class="input-field col s6">
              <input id="telefone" type="text" name="telefone" required>
              <label for="telefone">Insira o Telefone</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
              <input id="endereco" type="text" name="endereco" required>
              <label for="endereco">Insira o Endereço</label>
            </div>
            <div class="input-field col s6">
              <input id="municipio" type="text" name="municipio" required>
              <label for="municipio">Insira o Município</label>
            </div>
        </div>
        <button class="btn waves-effect waves-light" name = "cadastrar_aluno" type="submit">Cadastrar</button>
        </form>
    </div>

<?php
if (isset($_POST['cadastrar_aluno'])) {
  cadastrar_aluno();  
}

function cadastrar_aluno(){
  $matricula = trim($_POST['matricula']);
  $nome = trim($_POST['nome']);
  $telefone = trim($_POST['telefone']);
  $endereco = trim($_POST['endereco']);
  $municipio = trim($_POST['municipio']);
  $idCurso = $_POST['curso'];
          
  $aluno = new Aluno($matricula, $nome, $telefone, $endereco, $municipio, $idCurso);
  $alunoDAO = new AlunoDAO();
  $alunoDAO->adicionar($aluno);
  header('Location: gerenciar_alunos.php');
}

include("footer.php");

?>