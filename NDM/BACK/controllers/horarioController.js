const Horario = require('../models/Horario');

exports.getAllHorarios = (req, res) => {
  Horario.getAll((err, horarios) => {
    if (err) {
      return res.status(500).json({ error: err.message });
    }
    res.json(horarios);
  });
};

exports.getHorarioById = (req, res) => {
  const id = req.params.id;
  Horario.getById(id, (err, horario) => {
    if (err) {
      return res.status(500).json({ error: err.message });
    }
    if (!horario) {
      return res.status(404).json({ error: 'Horário não encontrado' });
    }
    res.json(horario);
  });
};

exports.createHorario = (req, res) => {
  const { professor, materia, dia_semana, horario_inicio, horario_termino } = req.body;
  
  if (!professor || !materia || !dia_semana || !horario_inicio || !horario_termino) {
    return res.status(400).json({ error: 'Todos os campos são obrigatórios' });
  }

  const novoHorario = { professor, materia, dia_semana, horario_inicio, horario_termino };
  
  Horario.create(novoHorario, (err, horario) => {
    if (err) {
      return res.status(500).json({ error: err.message });
    }
    res.status(201).json(horario);
  });
};

exports.updateHorario = (req, res) => {
  const id = req.params.id;
  const { professor, materia, dia_semana, horario_inicio, horario_termino } = req.body;
  
  if (!professor || !materia || !dia_semana || !horario_inicio || !horario_termino) {
    return res.status(400).json({ error: 'Todos os campos são obrigatórios' });
  }

  const horarioAtualizado = { professor, materia, dia_semana, horario_inicio, horario_termino };
  
  Horario.update(id, horarioAtualizado, (err) => {
    if (err) {
      return res.status(500).json({ error: err.message });
    }
    res.json({ id, ...horarioAtualizado });
  });
};

exports.deleteHorario = (req, res) => {
  const id = req.params.id;
  Horario.delete(id, (err) => {
    if (err) {
      return res.status(500).json({ error: err.message });
    }
    res.json({ message: 'Horário deletado com sucesso' });
  });
};