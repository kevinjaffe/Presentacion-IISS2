const form = document.getElementById("form");
const msgOk = document.getElementById("msg-ok");
const msgError = document.getElementById("msg-error");

form.addEventListener("submit", async (e) => {
  e.preventDefault();
  msgOk.hidden = true;
  msgError.hidden = true;

  const body = new URLSearchParams({
    nombre: document.getElementById("nombre").value.trim(),
    correo: document.getElementById("correo").value.trim(),
  });

  try {
    const res = await fetch("submit.php", { method: "POST", body });
    const data = await res.json();

    if (!res.ok || !data.ok) throw new Error(data.message || "error");

    msgOk.textContent = `Registro guardado correctamente. ID: ${data.id}`;
    msgOk.hidden = false;
    form.reset();
  } catch (err) {
    console.error(err);
    msgError.hidden = false;
  }
});
