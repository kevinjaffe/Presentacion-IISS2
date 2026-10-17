-- Tabla de contactos (equivalente a la del proyecto on-premises).
-- En PostgreSQL el autoincremento es GENERATED ALWAYS AS IDENTITY.
create table public.contactos (
  id bigint generated always as identity primary key,
  nombre varchar(100) not null,
  correo varchar(100) not null,
  creado_en timestamptz default now()
);

-- Row Level Security: sin esto, la API REST publica no permite nada.
alter table public.contactos enable row level security;

-- El rol anon (visitantes sin login) puede insertar y leer.
-- La anon key es publica, pero RLS limita lo que se puede hacer.
create policy "anon can insert contactos"
  on public.contactos
  for insert
  to anon
  with check (true);

create policy "anon can select contactos"
  on public.contactos
  for select
  to anon
  using (true);
