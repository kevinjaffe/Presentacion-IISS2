// Configura estos dos valores con los de tu proyecto Supabase.
// Los encuentras en: Settings > API del dashboard de Supabase.
const SUPABASE_URL = "https://cbetagvyjbxqeptwhthq.supabase.co";
const SUPABASE_ANON_KEY = "sb_publishable_SHI9IwCZeETs55FSzVIOeg_V3zcqFRP";

const form = document.getElementById("form");
const msgOk = document.getElementById("msg-ok");
const msgError = document.getElementById("msg-error");

form.addEventListener("submit", async (e) => {
  e.preventDefault();
  msgOk.hidden = true;
  msgError.hidden = true;

  const nombre = document.getElementById("nombre").value.trim();
  const correo = document.getElementById("correo").value.trim();

  try {
    const res = await fetch(`${SUPABASE_URL}/rest/v1/contactos`, {
      method: "POST",
      headers: {
        apikey: SUPABASE_ANON_KEY,
        Authorization: `Bearer ${SUPABASE_ANON_KEY}`,
        "Content-Type": "application/json",
        Prefer: "return=representation",
      },
      body: JSON.stringify({ nombre, correo }),
    });

    if (!res.ok) throw new Error(`HTTP ${res.status}`);

    const [row] = await res.json();
    msgOk.textContent = `Registro guardado correctamente. ID: ${row.id}`;
    msgOk.hidden = false;
    form.reset();
  } catch (err) {
    console.error(err);
    msgError.hidden = false;
  }
});
