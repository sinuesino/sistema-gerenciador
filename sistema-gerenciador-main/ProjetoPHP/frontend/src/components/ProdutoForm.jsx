import { useState, useEffect } from "react";
import { createProduto, updateProduto } from "../services/ProdutoAPI";

export default function ProdutoForm({ produtoSelecionado, onSaved, onCancel }) {
  const [produto, setProduto] = useState({
    nome_prod: "",
    cat_prod: 1,
    valor_prod: 0,
    estoque_prod: 0,
    cod_prod: 0,
    situacao_prod: 1,
  });

  useEffect(() => {
    if (produtoSelecionado) {
      setProduto(produtoSelecionado);
    }
  }, [produtoSelecionado]);

  const handleChange = (e) => {
    const { name, value } = e.target;
    setProduto((prev) => ({ ...prev, [name]: value }));
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    const json = produto.id_prod
      ? await updateProduto(produto.id_prod, produto)
      : await createProduto(produto);

    alert(json.message);
    if (json.status === "success") onSaved();
  };

  return (
    <form onSubmit={handleSubmit}>
      <h2>{produto.id_prod ? "Editar" : "Cadastrar"} Produto</h2>

      <input
        name="nome_prod"
        placeholder="Nome"
        value={produto.nome_prod}
        onChange={handleChange}
      />

      <input
        name="valor_prod"
        type="number"
        placeholder="Valor"
        value={produto.valor_prod}
        onChange={handleChange}
      />

      <input
        name="estoque_prod"
        type="number"
        placeholder="Estoque"
        value={produto.estoque_prod}
        onChange={handleChange}
      />

      <input
        name="cod_prod"
        type="number"
        placeholder="Código"
        value={produto.cod_prod}
        onChange={handleChange}
      />

      <select
        name="situacao_prod"
        value={produto.situacao_prod}
        onChange={handleChange}
      >
        <option value={1}>Ativo</option>
        <option value={0}>Inativo</option>
      </select>

      <button type="submit">Salvar</button>
      <button type="button" onClick={onCancel}>Cancelar</button>
    </form>
  );
}
