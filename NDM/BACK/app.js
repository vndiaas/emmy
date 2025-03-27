const express = require('express');
const bodyParser = require('body-parser');
const cors = require('cors');
const horarioRoutes = require('./routes/horarioRoutes');

const app = express();

// Middleware
app.use(cors());
app.use(bodyParser.json());

// Rotas
app.use('/api/horarios', horarioRoutes);

// Rota padrão
app.get('/', (req, res) => {
  res.send('API de Gerenciamento de Horários');
});

// Tratamento de erros
app.use((err, req, res, next) => {
  console.error(err.stack);
  res.status(500).json({ error: 'Erro interno do servidor' });
});

// Iniciar servidor
const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
  console.log(`Servidor rodando na porta ${PORT}`);
});