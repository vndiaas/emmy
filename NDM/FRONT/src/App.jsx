// import { useState } from 'react'
// import reactLogo from './assets/react.svg'
// import viteLogo from '/vite.svg'
import './App.css'
import { Gerenciar } from './components/gerenciar'
import { Menu } from './components/menu'
import { Login } from './components/login'
import { Cronograma } from './components/cronograma'

function App() {
  return (
    <>
      <Login />
      <Menu />
      <Gerenciar/>
    </>
  )
}

export default App
