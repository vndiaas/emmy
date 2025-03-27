import React from 'react'

export const Menu = () => {
  return (
    <>
    {/* <!-- Menu Lateral --> */}
    <div className="sidebar">
        <h4 className="text-center">Menu</h4>
        <a href="index.html">🏠 Página Inicial</a>
        <a href="listagem_horarios.html">📅 Cronograma</a>
        <a href="gerenciamento_horarios.html">➕ Adicionar/Gerenciar Horários</a>
        
        {/* <!-- "Sair" movido para o final --> */}
        <div >
            <a href="login.html">🚪 Sair</a>
        </div>
    </div>

    {/* <!-- Conteúdo Principal --> */}
    <div className="container">
        <h1 className="text-center">Bem-vindo ao Sistema</h1>
        <img src="logo.png" alt="Logo da Marca" className="logo"/>
    </div> 
    {/* <!-- Fechando corretamente a div --> */}
    </>
  )
}
