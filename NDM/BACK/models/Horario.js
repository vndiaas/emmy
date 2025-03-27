const db = require('../db/database');

class Horario {
  static getAll(callback) {
    db.all('SELECT * FROM horarios', callback);
  }

  static getById(id, callback) {
    db.get('SELECT * FROM horarios WHERE id = ?', [id], callback);
  }

  static create(horario, callback) {
    const { professor, materia, dia_semana, horario_inicio, horario_termino } = horario;
    db.run(
      'INSERT INTO horarios (professor, materia, dia_semana, horario_inicio, horario_termino) VALUES (?, ?, ?, ?, ?)',
      [professor, materia, dia_semana, horario_inicio, horario_termino],
      function(err) {
        callback(err, { id: this.lastID, ...horario });
      }
    );
  }

  static update(id, horario, callback) {
    const { professor, materia, dia_semana, horario_inicio, horario_termino } = horario;
    db.run(
      'UPDATE horarios SET professor = ?, materia = ?, dia_semana = ?, horario_inicio = ?, horario_termino = ? WHERE id = ?',
      [professor, materia, dia_semana, horario_inicio, horario_termino, id],
      callback
    );
  }

  static delete(id, callback) {
    db.run('DELETE FROM horarios WHERE id = ?', [id], callback);
  }
}

module.exports = Horario;