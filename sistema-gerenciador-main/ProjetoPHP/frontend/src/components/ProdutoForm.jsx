import { useState } from "react";

const backendUrl = "http://localhost/sistema-gerenciador-main/ProjetoPHP/backend/public";

export default function ProdutoForm() {
  const [form, setForm] = useState({
    nome_prod: "",
    cat_prod: "",
    valor_prod: "",
    estoque_prod: "",
    cod_prod: "",
    situacao_prod: ""
  });

  const handleChange = (e) => {
    setForm({ ...form, [e.target.name]: e.target.value });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      const res = await fetch(`${backendUrl}/produto/store`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(form),
      });
      const json = await res.json();
      alert(json.message);
      if (json.status === "success") {
        setForm({
          nome_prod: "",
          cat_prod: "",
          valor_prod: "",
          estoque_prod: "",
          cod_prod: "",
          situacao_prod: ""
        });
      }
    } catch {
      alert("Erro ao criar produto");
    }
  };

  return (
    <form onSubmit={handleSubmit} style={{ marginTop: 10 }}>
      <div>
        <label>Nome: </label>
        <input name="nome_prod" value={form.nome_prod} onChange={handleChange} required />
      </div>
      <div>
        <label>Categoria: </label>
        <input name="cat_prod" value={form.cat_prod} onChange={handleChange} required />
      </div>
      <div>
        <label>Valor: </label>
        <input
          name="valor_prod"
          type="number"
          step="0.01"
          value={form.valor_prod}
          onChange={handleChange}
          required
        />
      </div>
      <div>
        <label>Estoque: </label>
        <input
          name="estoque_prod"
          type="number"
          value={form.estoque_prod}
          onChange={handleChange}
          required
        />
      </div>
      <div>
        <label>Código: </label>
        <input name="cod_prod" value={form.cod_prod} onChange={handleChange} required />
      </div>
      <div>
        <label>Situação: </label>
        <input name="situacao_prod" value={form.situacao_prod} onChange={handleChange} required />
      </div>
      <button type="submit" style={{ marginTop: 10 }}>
        Criar Produto
      </button>
    </form>
  );
}
