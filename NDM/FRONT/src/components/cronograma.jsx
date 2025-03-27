import React, { useEffect } from 'react'
import { useState } from 'react';

export const Cronograma = () => {
    const [cronograma, setCronograma] = useState([]);

    const atualizarCronograma = () => {
        const fetchCronograma = async () => {
            const response = await fetch('http://localhost:3000/api/horarios',);
            const data = await response.json();
            setCronograma([...data]);
            console.log(cronograma);
        }
        fetchCronograma();
    }

    return (                    
        <div>
            <h2 className="mt-4">Cronograma</h2>
            <input type="button" value="Atualizar" onClick={atualizarCronograma} />
            <table className="table table-dark table-striped mt-3">
                <thead>
                    <tr>
                        <th>Professor</th>
                        <th>Matéria</th>
                        <th>Dia</th>
                        <th>Horário</th>

                    </tr>
                </thead>
                <tbody>
                    {cronograma.map(horario => (
                        <tr key={horario.id}>
                            <td>{horario.professor}</td>
                            <td>{horario.materia}</td>
                            <td>{horario.dia_semana}</td>
                            <td>{horario.horario_inicio} - {horario.horario_termino}</td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    )
}
