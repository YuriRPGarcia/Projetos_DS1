<?php 
	include("modelo.php");
	include("database.php");

	class AlunoDAO{
		function __construct(){}
		function adicionar(Aluno $aluno){
			$db = new Database("localhost","root","postgres");
			$db->selectDB("trab_2bim");
			$sql = "INSERT INTO Aluno (matricula, nome, telefone, endereco, municipio, idCurso) VALUES ('".$aluno->matricula."', '".$aluno->nome."', '".$aluno->telefone."', '".$aluno->endereco."', '".$aluno->municipio."', '".$aluno->idCurso."')";
			$db->query($sql);
			$db->con_close();
		}

		function alunoporCurso($idCurso){
			$db = new Database("localhost","root","postgres");
			$db->selectDB("trab_2bim");
			$sql = "SELECT aluno.matricula, aluno.nome, aluno.telefone, aluno.endereco, aluno.municipio, min(nota) as nota FROM aluno INNER JOIN historico ON aluno.matricula = historico.matriculaAluno INNER JOIN disciplina ON historico.idDisciplina = disciplina.id WHERE aluno.idCurso = '".$idCurso."' GROUP BY aluno.matricula ORDER BY aluno.nome";
			$resultado = $db->query($sql);
			$vetAlunos = array();
			while($linha = $db->fetch($resultado)) {
	        	$aluno = new Aluno($linha['matricula'], $linha['nome'], $linha['telefone'], $linha['endereco'], $linha['municipio'], $linha['nota']);
				array_push($vetAlunos, $aluno);
			}
			$db->con_close();
			return $vetAlunos;
		}

		function alunoBusca($busca){
			$db = new Database("localhost","root","postgres");
			$db->selectDB("trab_2bim");
			$sql = "SELECT aluno.matricula, disciplina.id, historico.nota, historico.frequencia FROM Aluno INNER JOIN historico ON aluno.matricula = historico.matriculaAluno INNER JOIN disciplina ON historico.idDisciplina = disciplina.id WHERE aluno.municipio LIKE '".$busca."' OR aluno.nome LIKE '".$busca."' OR aluno.matricula = '".$busca."' ORDER BY aluno.matricula";
			$resultado = $db->query($sql);
			$vetHistorico = array();
			while($linha = $db->fetch($resultado)) {
	        	$historico = new Historico($linha['nota'], $linha['frequencia'], $linha['matricula'], $linha['id']);
				array_push($vetHistorico, $historico);
			}
			$db->con_close();
			return $vetHistorico;
		}

		function alunoporDisciplina($idDisciplina){
			$db = new Database("localhost","root","postgres");
			$db->selectDB("trab_2bim");
			
			$sql = "SELECT aluno.matricula, aluno.nome, aluno.telefone, aluno.endereco, aluno.municipio, historico.frequencia AS frequencia FROM aluno INNER JOIN historico ON aluno.matricula = historico.matriculaAluno INNER JOIN disciplina ON historico.idDisciplina = disciplina.id INNER JOIN cursodisciplina on disciplina.id = cursodisciplina.idDisciplina INNER JOIN curso ON cursodisciplina.idCurso = curso.id  WHERE disciplina.id = '".$idDisciplina."' AND curso.id = aluno.idCurso GROUP BY aluno.matricula ORDER BY aluno.nome";
			$resultado = $db->query($sql);
			$vetAlunos = array();
			while($linha = $db->fetch($resultado)) {
	        	$aluno = new Aluno($linha['matricula'], $linha['nome'], $linha['telefone'], $linha['endereco'], $linha['municipio'], $linha['frequencia']);
				array_push($vetAlunos, $aluno);
			}
			$db->con_close();
			return $vetAlunos;
		}		

		function listar(){
			$db = new Database("localhost","root","postgres");
			$db->selectDB("trab_2bim");
			$sql = "SELECT * FROM Aluno";
			$resultado = $db->query($sql);
			$vetAlunos = array();
			while($linha = $db->fetch($resultado)) {
	        	$aluno = new Aluno($linha['matricula'], $linha['nome'], $linha['telefone'], $linha['endereco'], $linha['municipio'], $linha['idCurso']);
				array_push($vetAlunos, $aluno);
			}
			$db->con_close();
			return $vetAlunos;
		}

		function editar(Aluno $aluno){
			$db = new Database("localhost","root","postgres");
			$db->selectDB("trab_2bim"); 
			$sql = "UPDATE Aluno SET nome = '".$aluno->nome."', telefone = '".$aluno->telefone."', endereco = '".$aluno->endereco."', municipio = '".$aluno->municipio."' WHERE matricula = '".$aluno->matricula."'";
			$resultado = $db->query($sql);
			$db->con_close();
		}

		function excluir($matricula){
			$db = new Database("localhost","root","postgres");
			$db->selectDB("trab_2bim");
			$sql = "DELETE FROM historico WHERE matriculaAluno = '".$matricula."';";
			$db->query($sql);
			$sql = "DELETE FROM aluno WHERE matricula = '".$matricula."';";
			$db->query($sql);
			$db->con_close();
		}
		function obter($matricula){
			$db = new Database("localhost","root","postgres");
			$db->selectDB("Trab_2bim"); 
			$sql = "SELECT * FROM Aluno WHERE matricula = '".$matricula."'";
			$resultado = $db->query($sql);
			$linha = $db->fetch($resultado);
	        $aluno = new Aluno($linha['matricula'], $linha['nome'], $linha['telefone'], $linha['endereco'], $linha['municipio'], $linha['idCurso']);
			$db->con_close();
			return $aluno;
		}
	}

	class DisciplinaDAO{
		function __construct(){}
		function adicionar(Disciplina $disciplina){
			$db = new Database("localhost","root","postgres");
			$db->selectDB("trab_2bim");
			$sql = "INSERT INTO Disciplina (nome, creditos) VALUES ('".$disciplina->nome."', '".$disciplina->creditos."')";
			$db->query($sql);
			$db->con_close();
		}

		function listar(){
			$db = new Database("localhost","root","postgres");
			$db->selectDB("trab_2bim");
			$sql = "SELECT * FROM Disciplina";
			$resultado = $db->query($sql);
			$vetDisciplinas = array();
			while($linha = $db->fetch($resultado)) {
	        	$disciplina = new Disciplina($linha['id'], $linha['nome'], $linha['creditos']);
				array_push($vetDisciplinas, $disciplina);
			}
			$db->con_close();
			return $vetDisciplinas;
		}

		function maisAlunos(){
			$db = new Database("localhost","root","postgres");
			$db->selectDB("Trab_2bim"); 
			$sql = "SELECT disciplina.*, COUNT(historico.matriculaAluno) as quant FROM disciplina INNER JOIN historico ON disciplina.id = historico.idDisciplina INNER JOIN aluno on historico.matriculaAluno = aluno.matricula GROUP BY disciplina.id";
			$resultado = $db->query($sql);
			$vetDisciplinas = array();
			while($linha = $db->fetch($resultado)) {
	        	$disciplina = new Historico($linha['id'], $linha['nome'], $linha['creditos'], $linha['quant']);
				array_push($vetDisciplinas, $disciplina);
			}
			$db->con_close();
			return $vetDisciplinas;
		}	

		function editar(Disciplina $disciplina){
			$db = new Database("localhost","root","postgres");
			$db->selectDB("trab_2bim"); 
			$sql = "UPDATE Disciplina SET nome = '".$disciplina->nome."', creditos = '".$disciplina->creditos."' WHERE id = '".$disciplina->id."'";
			$resultado = $db->query($sql);
			$db->con_close();
		}

		function excluir($id){
			$db = new Database("localhost","root","postgres");
			$db->selectDB("trab_2bim");
			$sql = "DELETE FROM CursoDisciplina WHERE idDisciplina = '".$id."';"; 
			$db->query($sql);
			$sql = "DELETE FROM historico WHERE idDisciplina = '".$id."';";
			$db->query($sql);
			$sql = "DELETE FROM disciplina WHERE id= '".$id."';";
			$db->query($sql);
			$db->con_close();

		}

		function obter($id){
			$db = new Database("localhost","root","postgres");
			$db->selectDB("Trab_2bim"); 
			$sql = "SELECT * FROM Disciplina WHERE id = '".$id."'";
			$resultado = $db->query($sql);
			$linha = $db->fetch($resultado);
			$disciplina = new Disciplina($linha['id'], $linha['nome'], $linha['creditos']);
			$db->con_close();
			return $disciplina;
		}

	}

	class CursoDAO{
		function __construct(){}
		function adicionar(Curso $curso){
			$db = new Database("localhost","root","postgres");
			$db->selectDB("trab_2bim");
			$sql = "INSERT INTO Curso (nome, turno) VALUES ('".$curso->nome."', '".$curso->turno."')";
			$db->query($sql);
			$db->con_close();
		}

		function listar(){
			$db = new Database("localhost","root","postgres");
			$db->selectDB("trab_2bim");
			$sql = "SELECT * FROM Curso";
			$resultado = $db->query($sql);
			$vetCursos = array();
			while($linha = $db->fetch($resultado)) {
	        	$curso = new Curso($linha['id'], $linha['nome'], $linha['turno']);
				array_push($vetCursos, $curso);
			}
			$db->con_close();
			return $vetCursos;
		}

		function editar(Curso $curso){
			$db = new Database("localhost","root","postgres");
			$db->selectDB("trab_2bim"); 
			$sql = "UPDATE Curso SET nome = '".$curso->nome."', creditos = '".$curso->turno."' WHERE id = '".$curso->id."'";
			$db->query($sql);
			$db->con_close();
		}

		function excluir($id){
			$db = new Database("localhost","root","postgres");
			$db->selectDB("trab_2bim");
			$sql = "DELETE FROM CursoDisciplina WHERE idCurso = '".$id."';"; 
			$db->query($sql);
			$sql = "DELETE FROM curso WHERE id= '".$id."';";
			$db->query($sql);
			$db->con_close();
		}

		function obter($id){
			$db = new Database("localhost","root","postgres");
			$db->selectDB("Trab_2bim"); 
			$sql = "SELECT FROM Curso WHERE id = '".$id."'";
			$resultado = $db->query($sql);
			$linha = $db->query($sql);
			$curso = new Curso($linha['id'], $linha['nome'], $linha['turno']);
			$db->con_close();
			return $curso;
		}
	}

	class CursoDisciplinaDAO{
		function __construct(){}
		function adicionar(CursoDisciplina $curso_disciplina){
			$db = new Database("localhost","root","postgres");
			$db->selectDB("trab_2bim");
			$sql = "INSERT INTO CursoDisciplina (idCurso, idDisciplina) VALUES ('".$curso_disciplina->idCurso."', '".$curso_disciplina->idDisciplina."')";
			$db->query($sql);
			$db->con_close();
		}

		function listarDisciplinas($idCurso){
			$db = new Database("localhost","root","postgres");
			$db->selectDB("trab_2bim");
			$sql = "SELECT disciplina.id, disciplina.nome, disciplina.creditos FROM disciplina, curso, cursodisciplina WHERE disciplina.id = cursodisciplina.idDisciplina AND curso.id = cursodisciplina.idCurso AND curso.id ='".$idCurso."'";
			$resultado = $db->query($sql);
			$vetDisciplinas = array();
			while($linha = $db->fetch($resultado)) {
	        	$disciplina = new Disciplina($linha['id'], $linha['nome'], $linha['creditos']);
				array_push($vetDisciplinas, $disciplina);
			}
			$db->con_close();
			return $vetDisciplinas;
		}
	}

	class HistoricoDAO{
		function __construct(){}
		function adicionar(Historico $historico){
			$db = new Database("localhost","root","postgres");
			$db->selectDB("trab_2bim");
			$sql = "INSERT INTO Historico (nota, frequencia, matriculaAluno, idDisciplina) VALUES ('".$historico->nota."', '".$historico->frequencia."', '".$historico->matriculaAluno."', '".$historico->idDisciplina."')";
			$db->query($sql);
			$db->con_close();
		}
	}	
	

?>