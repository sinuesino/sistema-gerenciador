import { useEffect, useState } from "react";
import { getCategorias, deleteCategoria } from "../services/CategoriaAPI";

export default function CategoriaList({ onEdit }) {
  const [categorias, setCategorias] = useState([]);
  const [loading, setLoading] = useState(false);

  const fetchCategorias = async () => {
    setLoading(true);
    const json = await getCategorias();
    if (json.status === "success") {
      setCategorias(json.data);
    } else {
      alert(json.message);
    }
    setLoading(false);
  };

  const handleDelete = async (id) => {
    if (!window.confirm("Quer realmente excluir essa categoria?")) return;
    const json = await deleteCategoria(id);
    alert(json.message);
    fetchCategorias();
  };

  useEffect(() => {
    fetchCategorias();
  }, []);

  if (loading) return <p>Carregando categorias...</p>;

  return (
    <ul>
      {categorias.map((cat) => (
        <li key={cat.id_cat}>
          {cat.nome_cat}{" "}
          <button onClick={() => onEdit(cat)}>Editar</button>{" "}
          <button onClick={() => handleDelete(cat.id_cat)}>Excluir</button>
        </li>
      ))}
    </ul>
  );
}
