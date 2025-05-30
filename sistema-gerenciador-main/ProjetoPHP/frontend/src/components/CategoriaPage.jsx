import { useState } from "react";
import CategoriaList from "./CategoriasList";
import CategoriaForm from "./CategoriaForm";

export default function CategoriaPage() {
  const [categoriaEdit, setCategoriaEdit] = useState(null);
  const [reload, setReload] = useState(false); // para forçar reload da lista

  return (
    <div>
      <h1>Gerenciar Categorias</h1>

      <CategoriaForm
        categoria={categoriaEdit}
        onSuccess={() => {
          setCategoriaEdit(null);
          setReload((old) => !old); // força recarregar lista
        }}
      />

      <CategoriaList
        key={reload} // re-renderiza lista para atualizar
        onEdit={(cat) => setCategoriaEdit(cat)}
      />
    </div>
  );
}
