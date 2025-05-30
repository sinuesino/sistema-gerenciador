const backendUrl = "http://localhost/sistema-gerenciador-main/ProjetoPHP/backend/public";

export async function getCategorias() {
  const res = await fetch(`${backendUrl}/categoria/index`);
  return res.json();
}

export async function getCategoria(id) {
  const res = await fetch(`${backendUrl}/categoria/show/${id}`);
  return res.json();
}

export async function createCategoria(data) {
  const res = await fetch(`${backendUrl}/categoria/store`, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(data),
  });
  return res.json();
}

export async function updateCategoria(id, data) {
  // Supondo que exista rota update (você pode criar no backend)
  const res = await fetch(`${backendUrl}/categoria/update/${id}`, {
    method: "PUT", // ou POST dependendo do backend
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(data),
  });
  return res.json();
}

export async function deleteCategoria(id) {
  const res = await fetch(`${backendUrl}/categoria/destroy/${id}`, {
    method: "DELETE",
  });
  return res.json();
}
