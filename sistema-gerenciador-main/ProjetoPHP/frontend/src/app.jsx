import React from 'react'
import DeleteButton from './components/DeleteButton'

const App = () => {
  return (
    <div>
      <h1>Gerenciador de Produtos</h1>
      <DeleteButton produtoId={1} />
    </div>
  )
}

export default App
