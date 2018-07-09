<?php 
include("header.php");

?>

<blockquote><h4>Cadastre uma Disciplina</h4></blockquote>

<div class="row">
    <form class="col s12" action="cadastrar_disciplina.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="input-field col s12">
              <input id="nome" type="text" name="nome" required>
              <label for="nome">Insira o Nome da Disciplina</label>
            </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <textarea id="creditos" name="creditos" class="materialize-textarea"></textarea>
              <label for="creditos">Insiro os Créditos da Disciplina</label>
          </div>
        </div>
        <button class="btn waves-effect waves-light" name = "cadastrar_disciplina" type="submit">Cadastrar</button>
        </form>
    </div>

<?php
include('persistencia.php');
if (isset($_POST['cadastrar_disciplina'])) {
  cadastrar_disciplina();  
}

function cadastrar_disciplina(){
  $nome = trim($_POST['nome']);
  $creditos = trim($_POST['creditos']);
          
  $disciplina = new Disciplina(0, $nome, $creditos);
  $disciplinaDAO = new DisciplinaDAO();
  $disciplinaDAO->adicionar($disciplina);
  header('Location: gerenciar_disciplinas.php');
  
}

include("footer.php");

?>