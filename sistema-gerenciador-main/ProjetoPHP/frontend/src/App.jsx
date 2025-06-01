import { useState } from "react";
import CategoriaPage from "./components/CategoriaPage";
import ProdutoPage from "./components/ProdutoPage";

export default function App() {
  const [pagina, setPagina] = useState("categoria"); // controla página atual

  return (
    <div>
      <nav>
        <button onClick={() => setPagina("categoria")}>Categorias</button>
        <button onClick={() => setPagina("produto")}>Produtos</button>
      </nav>

      <main style={{ marginTop: "20px" }}>
        {pagina === "categoria" && <CategoriaPage />}
        {pagina === "produto" && <ProdutoPage />}
      </main>
    </div>
  );
}
