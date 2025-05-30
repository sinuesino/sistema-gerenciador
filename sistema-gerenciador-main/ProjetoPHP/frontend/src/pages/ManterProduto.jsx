import { useEffect, useState } from "react";
import { getProdutos, createProduto, deleteProduto } from "../services/api";

function ProdutoPage() {
  const [produtos, setProdutos] = useState([]);

  const carregarProdutos = () => {
    getProdutos().then((res) => {
      setProdutos(res.data.data);
    });
  };

  useEffect(() => {
    carregarProdutos();
  }, []);

  const adicionarProduto = () => {
    const novo = {
      nome_prod: "Produto Teste",
      cat_prod: 1,
      valor_prod: 99.99,
      estoque_prod: 10,
      cod_prod: 12345,
      situacao_prod: 1,
    };
    createProduto(novo).then(() => {
      alert("Produto criado!");
      carregarProdutos();
    });
  };

  const excluirProduto = (id) => {
    deleteProduto(id).then(() => {
      alert("Produto excluído!");
      carregarProdutos();
    });
  };

  return (
    <div>
      <h2>Lista de Produtos</h2>
      <button onClick={adicionarProduto}>Adicionar Produto</button>
      <ul>
        {produtos.map((prod) => (
          <li key={prod.id_prod}>
            {prod.nome_prod} - R$ {prod.valor_prod}
            <button onClick={() => excluirProduto(prod.id_prod)}>Excluir</button>
          </li>
        ))}
      </ul>
    </div>
  );
}

export default ProdutoPage;
