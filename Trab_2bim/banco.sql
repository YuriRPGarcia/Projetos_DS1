CREATE TABLE Disciplina(
	id SERIAL,
	nome VARCHAR(100),
	creditos TEXT,
	CONSTRAINT DisciplinaPK PRIMARY KEY (id)
);

CREATE TABLE Curso(
	id SERIAL,
	nome VARCHAR(100),
	turno VARCHAR(20),
	CONSTRAINT CursoPK PRIMARY KEY (id)
);

CREATE TABLE CursoDisciplina(
	idDiscplina bigint UNSIGNED,
	idCurso bigint UNSIGNED,
	CONSTRAINT CursoDisciplinaPK PRIMARY KEY (idDiscplina, idCurso),
	CONSTRAINT CursoFK FOREIGN KEY (idCurso) REFERENCES Curso(id),
	CONSTRAINT DisciplinaFK FOREIGN KEY (idDiscplina) REFERENCES Disciplina(id)
);

CREATE TABLE Aluno(
	matricula VARCHAR(20),
	nome VARCHAR(100),
	telefone VARCHAR(20),
	endereco VARCHAR(100),
	municipio VARCHAR(100),
	idCurso bigint UNSIGNED,
	CONSTRAINT AlunoPK PRIMARY KEY (matricula),
	CONSTRAINT Aluno_CursoFK FOREIGN KEY (idCurso) REFERENCES Curso(id)
									ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE Historico(
	matriculaAluno VARCHAR(20),
	idDisciplina bigint UNSIGNED,
	nota DECIMAL(5,2),
	frequencia INTEGER,
	CONSTRAINT HistoricoPK PRIMARY KEY (matriculaAluno, idDisciplina),
	CONSTRAINT Hitorico_AlunoFK FOREIGN KEY (matriculaAluno) REFERENCES Aluno(matricula),
	CONSTRAINT Hitorico_DisciplinaFK FOREIGN KEY (idDisciplina) REFERENCES Disciplina(id)	
);