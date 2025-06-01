import { useState } from "react";
import ProdutoList from "./ProdutoList";
import ProdutoForm from "./ProdutoForm";

export default function ProdutoPage() {
  const [produtoEdit, setProdutoEdit] = useState(null);
  const [reload, setReload] = useState(false); // para forçar reload da lista

  return (
    <div>
      <h1>Gerenciar Produtos</h1>

      <ProdutoForm
        produto={produtoEdit}
        onSuccess={() => {
          setProdutoEdit(null);      // limpa o formulário após salvar
          setReload((old) => !old);  // força atualização da lista
        }}
        onCancel={() => setProdutoEdit(null)} // opção para cancelar edição
      />

      <ProdutoList
        key={reload}                // força re-renderização para atualizar lista
        onEdit={(prod) => setProdutoEdit(prod)}
      />
    </div>
  );
}
