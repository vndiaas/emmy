<?php
require_once "conexao.php";

// Criar tabela de professores
$sql_professores = "CREATE TABLE IF NOT EXISTS professor (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    disciplina VARCHAR(255) NOT NULL
)";
$conn->exec($sql_professores);

// Criar tabela de horários
$sql_horarios = "CREATE TABLE IF NOT EXISTS horario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    professor_id INT NOT NULL,
    horario_inicio TIME NOT NULL,
    horario_fim TIME NOT NULL,
    FOREIGN KEY (professor_id) REFERENCES professor(id) ON DELETE CASCADE
)";
$conn->exec($sql_horarios);

echo "Banco de dados atualizado com sucesso!";
?>
