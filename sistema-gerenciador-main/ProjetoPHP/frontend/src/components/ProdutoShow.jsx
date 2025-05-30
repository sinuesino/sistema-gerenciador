import { useEffect, useState } from "react";

const backendUrl = "http://localhost/sistema-gerenciador-main/ProjetoPHP/backend/public";

export default function ProdutoShow({ id, onClose }) {
  const [produto, setProduto] = useState(null);
  const [loading, setLoading] = useState(false);

  useEffect(() => {
    const fetchProduto = async () => {
      setLoading(true);
      try {
        const res = await fetch(`${backendUrl}/produto/show/${id}`);
        const json = await res.json();
        if (json.status === "success") {
          setProduto(json.data);
        } else {
          alert(json.message);
          onClose();
        }
      } catch {
        alert("Erro ao carregar produto");
        onClose();
      }
      setLoading(false);
    };
    fetchProduto();
  }, [id]);

  if (loading) return <p>Carregando produto...</p>;
  if (!produto) return null;

  return (
    <div style={{ border: "1px solid #aaa", padding: 10, marginTop: 10 }}>
      <p><strong>Nome:</strong> {produto.nome_prod}</p>
      <p><strong>Categoria:</strong> {produto.cat_prod}</p>
      <p><strong>Valor:</strong> R$ {produto.valor_prod}</p>
      <p><strong>Estoque:</strong> {produto.estoque_prod}</p>
      <p><strong>Código:</strong> {produto.cod_prod}</p>
      <p><strong>Situação:</strong> {produto.situacao_prod}</p>
      <button onClick={onClose}>Fechar</button>
    </div>
  );
}
