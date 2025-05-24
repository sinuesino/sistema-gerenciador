import React, { useState } from 'react'
import { excluirProduto } from '../services/api'

const DeleteButton = ({ produtoId }) => {
  const [mensagem, setMensagem] = useState('')

  const handleClick = async () => {
    try {
      const resposta = await excluirProduto(produtoId)
      setMensagem(resposta)
    } catch (erro) {
      setMensagem('Erro ao excluir produto.')
    }
  }

  return (
    <div>
      <button onClick={handleClick}>Excluir Produto</button>
      {mensagem && <p>{mensagem}</p>}
    </div>
  )
}

export default DeleteButton
