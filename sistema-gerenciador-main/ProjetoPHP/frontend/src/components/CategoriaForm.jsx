import { useState, useEffect } from "react";
import { createCategoria, updateCategoria } from "../services/CategoriaAPI";

export default function CategoriaForm({ categoria, onSuccess }) {
  const [nome_cat, setNomeCat] = useState("");

  useEffect(() => {
    if (categoria) {
      setNomeCat(categoria.nome_cat || "");
    } else {
      setNomeCat("");
    }
  }, [categoria]);

  const handleSubmit = async (e) => {
    e.preventDefault();

    if (!nome_cat.trim()) {
      alert("Nome da categoria é obrigatório");
      return;
    }

    const data = { nome_cat };

    let json;
    if (categoria && categoria.id_cat) {
      json = await updateCategoria(categoria.id_cat, data);
    } else {
      json = await createCategoria(data);
    }

    alert(json.message);
    if (json.status === "success") {
      onSuccess();
      setNomeCat("");
    }
  };

  return (
    <form onSubmit={handleSubmit}>
      <label>
        Nome da Categoria:
        <input
          type="text"
          value={nome_cat}
          onChange={(e) => setNomeCat(e.target.value)}
          required
        />
      </label>
      <button type="submit">{categoria ? "Atualizar" : "Criar"}</button>
    </form>
  );
}
