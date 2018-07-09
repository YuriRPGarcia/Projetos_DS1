<?php
  class Aluno{
    public function __construct($matricula = "", $nome = "", $telefone = "", $endereco = "", $municipio = "", $idCurso = 0){
      $this->matricula = $matricula;
      $this->nome = $nome;
      $this->telefone = $telefone;
      $this->endereco = $endereco;
      $this->municipio = $municipio;
      $this->idCurso = $idCurso;
    }
  }
  
  class Disciplina{
    public function __construct($id = 0, $nome = "", $creditos = ""){
      $this->id = $id;
      $this->nome = $nome;
      $this->creditos = $creditos;
    }
  }

  class Curso{
    public function __construct($id = 0, $nome = "", $turno = ""){
      $this->id = $id;
      $this->nome = $nome;
      $this->turno = $turno;
    }
  }

  class CursoDisciplina{
    public function __construct($idDisciplina = 0, $idCurso = 0){
      $this->idDisciplina = $idDisciplina;
      $this->idCurso = $idCurso;
    }
  }

  class Historico{
    public function __construct($nota = "", $frequencia = "", $matriculaAluno = "", $idDisciplina = 0){
      $this->nota = $nota;
      $this->frequencia = $frequencia;
      $this->matriculaAluno = $matriculaAluno;
      $this->idDisciplina = $idDisciplina;
    }
  }
?>