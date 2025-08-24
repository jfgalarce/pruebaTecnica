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

1. Ingresa al contenedor correspondiente "codeigniter_app" :
  ```bash
  docker compose exec codeigniter_app bash
  ```

2. Ejecutar todas las pruebas del proyecto:
  ```bash
	docker compose exec codeigniter_app vendor/bin/phpunit tests/unit/TaskModelTest.php
  ```

3. Ejecutar una prueba específica dentro de un archivo 
  ```bash
  docker compose exec codeigniter_app vendor/bin/phpunit --filter test_insert_task tests/unit/TaskModelTest.php
  ```

 ```bash
  docker compose exec codeigniter_app vendor/bin/phpunit --filter test_find_task tests/unit/TaskModelTest.php
  ```

 ```bash
  docker compose exec codeigniter_app vendor/bin/phpunit --filter test_update_task tests/unit/TaskModelTest.php
  ```
