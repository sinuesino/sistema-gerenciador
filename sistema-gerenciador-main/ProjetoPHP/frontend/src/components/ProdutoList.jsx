import { useEffect, useState } from "react";

const backendUrl = "http://localhost/sistema-gerenciador-main/ProjetoPHP/backend/public";

export default function ProdutoList({ onShow }) {
  const [produtos, setProdutos] = useState([]);
  const [loading, setLoading] = useState(false);

  const fetchProdutos = async () => {
    setLoading(true);
    try {
      const res = await fetch(`${backendUrl}/produto/index`);
      const json = await res.json();
      if (json.status === "success") {
        setProdutos(json.data);
      } else {
        alert(json.message);
      }
    } catch (err) {
      alert("Erro ao buscar produtos");
    }
    setLoading(false);
  };

  const handleDelete = async (id) => {
    if (!confirm("Tem certeza que quer excluir?")) return;
    try {
      const res = await fetch(`${backendUrl}/produto/destroy/${id}`);
      const json = await res.json();
      alert(json.message);
      fetchProdutos();
    } catch {
      alert("Erro ao excluir produto");
    }
  };

  useEffect(() => {
    fetchProdutos();
  }, []);

  if (loading) return <p>Carregando...</p>;

  return (
    <ul>
      {produtos.map((p) => (
        <li key={p.id_produto}>
          <strong>{p.nome_prod}</strong> - {p.cat_prod} - R$ {p.valor_prod} - Estoque: {p.estoque_prod}{" "}
          <button onClick={() => onShow(p.id_produto)}>Ver</button>{" "}
          <button onClick={() => handleDelete(p.id_produto)}>Excluir</button>
        </li>
      ))}
    </ul>
  );
}
