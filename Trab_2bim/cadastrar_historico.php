<?php 
include("header.php");
include('persistencia.php');
$alunoDAO = new AlunoDAO();
$aluno = $alunoDAO->obter($_POST['aluno']);
$curso_disciplinaDAO = new CursoDisciplinaDAO();
$disciplinas = $curso_disciplinaDAO->listarDisciplinas($aluno->idCurso);
?>

<blockquote><h4>Inserir Histórico do Aluno</h4></blockquote>

<div class="row">
    <form class="col s12" action="cadastrar_historico.php" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="input-field col s12">
            <select name="disciplina">
            <option value="" disabled selected>Escolha a Disciplina</option>
            <?php 
              foreach($disciplinas as $disciplina) {
                echo '<option value="'.$disciplina->id.'">'.$disciplina->nome.'</option>';
              }
            ?>
            </select>
            <label>Escolha a Disciplina</label>
          </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
              <input id="nota" type="number" name="nota" required>
              <label for="nota">Insira a Nota do Aluno</label>
            </div>
            <div class="input-field col s6">
              <input id="frequencia" type="number" name="frequencia" required>
              <label for="frequencia">Insira a Frequencia do Aluno</label>
            </div>
          </div>
        </div>
        <input type="hidden" name="aluno" value="<?php echo $aluno->matricula; ?>">    
        <button class="btn waves-effect waves-light" name = "cadastrar_historico" type="submit">Cadastrar</button>
    </form>
</div>

<?php
if (isset($_POST['cadastrar_historico'])) {
  cadastrar_historico();  
}

function cadastrar_historico(){
  $matriculaAluno = trim($_POST['aluno']);
  $idDisciplina = trim($_POST['disciplina']);
  $nota = trim($_POST['nota']);
  $frequencia = trim($_POST['frequencia']);
          
  $historico = new Historico($nota, $frequencia, $matriculaAluno, $idDisciplina);
  $historicoDAO = new HistoricoDAO();
  $historicoDAO->adicionar($historico);
  header('Location: gerenciar_alunos.php');

}

include("footer.php");

?>