import { useEffect, useState } from "react";
import { getProdutos, deleteProduto } from "../services/ProdutoAPI";

export default function ProdutoList({ onEdit }) {
  const [produtos, setProdutos] = useState([]);

  const fetchProdutos = async () => {
    const json = await getProdutos();
    if (json.status === "success") {
      setProdutos(json.data);
    } else {
      alert(json.message);
    }
  };

  const handleDelete = async (id) => {
    if (!window.confirm("Tem certeza que deseja excluir?")) return;
    const json = await deleteProduto(id);
    alert(json.message);
    fetchProdutos();
  };

  useEffect(() => {
    fetchProdutos();
  }, []);

  return (
    <ul>
      {produtos.map((prod) => (
        <li key={prod.id_prod}>
          {prod.nome_prod} - R$ {prod.valor_prod}
          <button onClick={() => onEdit(prod)}>Editar</button>
          <button onClick={() => handleDelete(prod.id_prod)}>Excluir</button>
        </li>
      ))}
    </ul>
  );
}
