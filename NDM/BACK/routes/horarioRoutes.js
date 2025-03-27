const express = require('express');
const router = express.Router();
const horarioController = require('../controllers/horarioController');

// Rotas CRUD
router.get('/', horarioController.getAllHorarios);
router.get('/:id', horarioController.getHorarioById);
router.post('/', horarioController.createHorario);
router.put('/:id', horarioController.updateHorario);
router.delete('/:id', horarioController.deleteHorario);

module.exports = router;