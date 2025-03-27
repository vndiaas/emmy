import React, { useState, useEffect } from 'react';
// import './FormHorario.css'; // Estilos opcionais

export const Gerenciar = ({ horarioParaEditar, onSuccess }) => {
    const [formData, setFormData] = useState({
        professor: '',
        materia: '',
        dia_semana: 'Segunda-feira',
        horario_inicio: '',
        horario_termino: ''
    });

    const [erro, setErro] = useState('');
    const [sucesso, setSucesso] = useState('');
    const [carregando, setCarregando] = useState(false);

    // Preenche o formulário se estiver editando
    useEffect(() => {
        if (horarioParaEditar) {
            setFormData({
                professor: horarioParaEditar.professor,
                materia: horarioParaEditar.materia,
                dia_semana: horarioParaEditar.dia_semana,
                horario_inicio: horarioParaEditar.horario_inicio,
                horario_termino: horarioParaEditar.horario_termino
            });
        }
    }, [horarioParaEditar]);

    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData(prev => ({
            ...prev,
            [name]: value
        }));
    };

    const validarFormulario = () => {
        if (!formData.professor || !formData.materia || !formData.dia_semana ||
            !formData.horario_inicio || !formData.horario_termino) {
            setErro('Todos os campos são obrigatórios');
            return false;
        }

        if (formData.horario_termino <= formData.horario_inicio) {
            setErro('O horário de término deve ser após o horário de início');
            return false;
        }

        setErro('');
        return true;
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setCarregando(true);

        if (!validarFormulario()) {
            setCarregando(false);
            return;
        }

        try {
            const url = horarioParaEditar
                ? `http://localhost:3000/api/horarios/${horarioParaEditar.id}`
                : 'http://localhost:3000/api/horarios';

            const method = horarioParaEditar ? 'PUT' : 'POST';

            const response = await fetch(url, {
                method,
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(formData),
            });

            if (!response.ok) {
                throw new Error('Erro ao salvar horário');
            }

            const resultado = await response.json();
            setSucesso(horarioParaEditar ? 'Horário atualizado com sucesso!' : 'Horário cadastrado com sucesso!');
            setFormData({
                professor: '',
                materia: '',
                dia_semana: 'Segunda-feira',
                horario_inicio: '',
                horario_termino: ''
            });

            if (onSuccess) onSuccess(resultado);

        } catch (error) {
            console.error('Erro:', error);
            setErro(error.message || 'Ocorreu um erro ao processar sua solicitação');
        } finally {
            setCarregando(false);
            setTimeout(() => {
                setSucesso('');
                setErro('');
            }, 5000);
        }
    };

    return (
        <>
            <form id="formHorario" onSubmit={handleSubmit} className="form-container">
                {erro && <div className="alert alert-danger">{erro}</div>}
                {sucesso && <div className="alert alert-success">{sucesso}</div>}

                <div className="mb-3">
                    <label className="form-label">Professor</label>
                    <input
                        type="text"
                        className="form-control"
                        name="professor"
                        value={formData.professor}
                        onChange={handleChange}
                        required
                    />
                </div>

                <div className="mb-3">
                    <label className="form-label">Matéria</label>
                    <input
                        type="text"
                        className="form-control"
                        name="materia"
                        value={formData.materia}
                        onChange={handleChange}
                        required
                    />
                </div>

                <div className="mb-3">
                    <label className="form-label">Dia da Semana</label>
                    <select
                        className="form-control"
                        name="dia_semana"
                        value={formData.dia_semana}
                        onChange={handleChange}
                        required
                    >
                        <option value="Segunda-feira">Segunda-feira</option>
                        <option value="Terça-feira">Terça-feira</option>
                        <option value="Quarta-feira">Quarta-feira</option>
                        <option value="Quinta-feira">Quinta-feira</option>
                        <option value="Sexta-feira">Sexta-feira</option>
                    </select>
                </div>

                <div className="mb-3">
                    <label className="form-label">Horário de Início</label>
                    <input
                        type="time"
                        className="form-control"
                        name="horario_inicio"
                        value={formData.horario_inicio}
                        onChange={handleChange}
                        required
                    />
                </div>

                <div className="mb-3">
                    <label className="form-label">Horário de Término</label>
                    <input
                        type="time"
                        className="form-control"
                        name="horario_termino"
                        value={formData.horario_termino}
                        onChange={handleChange}
                        required
                    />
                </div>

                <button
                    type="submit"
                    className="btn btn-gold w-100"
                    disabled={carregando}
                >
                    {carregando ? (
                        <>
                            <span className="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            {horarioParaEditar ? ' Atualizando...' : ' Cadastrando...'}
                        </>
                    ) : (
                        horarioParaEditar ? 'Atualizar Horário' : 'Adicionar Horário'
                    )}
                </button>
            </form>
        </>
    );
};

