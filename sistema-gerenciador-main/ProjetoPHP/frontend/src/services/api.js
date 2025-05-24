export const excluirProduto = async (id_prod) => {
  const resposta = await fetch('http://localhost/backend/delete-produto.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: new URLSearchParams({ id_prod }),
  })

  const texto = await resposta.text()
  return texto
}
