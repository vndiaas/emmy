import React, { useState } from 'react';
import axios from 'axios';

export const Login = () => {
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [error, setError] = useState('');

    const handleSubmit = async (event) => {
        event.preventDefault(); // Evita o comportamento padrão do formulário

        try {
            const response = await axios.post('http://seu-backend.com/api/login', {
                email,
                password,
            });

            // Aqui você pode lidar com a resposta do backend
            console.log(response.data);
            // Por exemplo, redirecionar o usuário ou armazenar o token de autenticação

        } catch (err) {
            setError('Erro ao fazer login. Verifique suas credenciais.');
            console.error(err);
        }
    };

    return (
        <div className="container d-flex justify-content-center align-items-center vh-100">
            <div className="card p-4 w-50">
                <h3 className="text-center highlight-gold">Login</h3>
                <form onSubmit={handleSubmit}>
                    <div className="mb-3">
                        <label htmlFor="email" className="form-label highlight-gold">Email</label>
                        <input
                            type="email"
                            className="form-control"
                            id="email"
                            placeholder="Digite seu email"
                            value={email}
                            onChange={(e) => setEmail(e.target.value)}
                        />
                    </div>
                    <div className="mb-3">
                        <label htmlFor="password" className="form-label highlight-gold">Senha</label>
                        <input
                            type="password"
                            className="form-control"
                            id="password"
                            placeholder="Digite sua senha"
                            value={password}
                            onChange={(e) => setPassword(e.target.value)}
                        />
                    </div>
                    {error && <div className="alert alert-danger">{error}</div>}
                    <button type="submit" className="btn btn-gold w-100">Entrar</button>
                </form>
                <p className="mt-3 text-center">Não consegue acessar? <a href="register.html" className="text-decoration-none text-warning">Entre em contato com o administrador</a></p>
            </div>
        </div>
    );
};