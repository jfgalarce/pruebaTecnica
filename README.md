# README

## Clonar y levantar el proyecto usando Docker

1. Clona el repositorio:
  ```bash
  git clone https://github.com/jfgalarce/pruebaTecnica
  cd pruebaTecnica
  ```

2. Levanta los servicios con Docker:
  ```bash
  docker compose up --build
  ```

## Acceso al frontend

- Una vez que los contenedores estén corriendo, accede al frontend desde tu navegador en:
  ```
  http://localhost:8080
  ```

## Ejecutar pruebas unitarias

1. Ingresa al contenedor correspondiente (por ejemplo, `frontend` o `backend`):
  ```bash
  docker compose exec <nombre_del_contenedor> bash
  ```

2. Ejecuta las pruebas unitarias:
  ```bash
  # Para frontend (ejemplo con npm)     
  npm test

  # Para backend (ejemplo con pytest)
  pytest
  ```
