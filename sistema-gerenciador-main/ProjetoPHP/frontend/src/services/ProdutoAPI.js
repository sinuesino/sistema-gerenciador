const baseUrl = "http://localhost/seu-backend/produto";

export async function getProdutos() {
  const res = await fetch(baseUrl);
  return await res.json();
}

export async function createProduto(data) {
  const res = await fetch(baseUrl, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(data),
  });
  return await res.json();
}

export async function updateProduto(id, data) {
  const res = await fetch(`${baseUrl}/${id}`, {
    method: "PUT",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(data),
  });
  return await res.json();
}

export async function deleteProduto(id) {
  const res = await fetch(`${baseUrl}/${id}`, { method: "DELETE" });
  return await res.json();
}
