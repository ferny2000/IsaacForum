# Foro Web "The Binding of Isaac"

Este repositorio contiene el código fuente del foro web dedicado al juego **The Binding of Isaac**. El proyecto tiene como objetivo facilitar a la comunidad información clara y organizada sobre personajes, objetos y otros elementos del juego.

---

## Flujo de trabajo y control de versiones

Para gestionar el código se utiliza un flujo simple con dos ramas principales:

- **main:** Rama estable que contiene la versión lista para producción o entrega. Solo se integran cambios probados y funcionales.
- **res_main:** Rama de desarrollo y respaldo donde se implementan nuevas funcionalidades, correcciones y pruebas. Cuando el código está listo y probado, se fusiona con `main`.

---

## Estructura de ramas

- `main` — Versión estable y segura del proyecto.
- `res_main` — Rama para desarrollo activo y respaldo temporal.

---

## Uso recomendado

1. Realiza todos los cambios, nuevas funcionalidades y pruebas en la rama `res_main`.
2. Cuando el código esté probado y listo, crea un Pull Request para fusionar `res_main` en `main`.
3. Mantén `main` siempre funcional y estable para despliegues o entregas.

---

## Evidencias

En el historial de commits se puede observar la implementación gradual de funcionalidades en `res_main` y su posterior integración a `main` mediante merges. Esto garantiza un desarrollo ordenado y seguro.

---


