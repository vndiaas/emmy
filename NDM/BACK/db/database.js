const sqlite3 = require('sqlite3').verbose();
const path = require('path');

const dbPath = path.resolve(__dirname, '../database.sqlite');
const db = new sqlite3.Database(dbPath);

// Criar tabela de horários
db.serialize(() => {
  db.run(`
    CREATE TABLE IF NOT EXISTS horarios (
      id INTEGER PRIMARY KEY AUTOINCREMENT,
      professor TEXT NOT NULL,
      materia TEXT NOT NULL,
      dia_semana TEXT NOT NULL,
      horario_inicio TEXT NOT NULL,
      horario_termino TEXT NOT NULL,
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )
  `);
});

module.exports = db;