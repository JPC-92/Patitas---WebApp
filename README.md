# 🐾 Patitas WebApp

Aplicación web integral para la gestión de usuarios, mascotas y citas, desarrollada con enfoque práctico y orientada a mantener un código limpio y estructurado. 

El proyecto implementa un sistema de control de acceso por roles (Administrador y Cliente) y gestiona de manera eficiente las relaciones en la base de datos entre los dueños, sus mascotas y el calendario de citas.

## 🚀 Funcionalidades Principales

* **Sistema de Roles:** Acceso diferenciado para administradores y clientes.
* **Gestión de Citas:** Programación de citas asociadas a mascotas específicas con control de duplicidades (única fecha y hora).
* **Gestión de Mascotas:** Registro de animales vinculados a sus respectivos dueños.
* **Diseño Limpio:** Separación total de la lógica y la presentación, utilizando hojas de estilo CSS dedicadas (sin estilos en línea) para un mantenimiento óptimo.

## 🛠️ Tecnologías Utilizadas

* **Frontend:** HTML5, CSS3, JavaScript.
* **Backend:** PHP.
* **Base de Datos:** MySQL.
* **Arquitectura:** Patrón MVC (Modelo-Vista-Controlador).

## 📂 Arquitectura del Proyecto

El código está estructurado bajo el patrón MVC con un único punto de entrada (`index.php`), garantizando la separación de responsabilidades:

```text
├── app/
│   ├── controladores/  # Lógica de control y gestión de peticiones
│   ├── modelos/        # Gestión de datos y consultas a la base de datos SQL
│   └── vistas/         # Interfaz de usuario (HTML estructurado)
├── config/             # Archivos de configuración del sistema (plantillas)
├── database/           # Scripts y esquemas de la base de datos SQL
├── public/             # Archivos estáticos accesibles (CSS, JS, imágenes)
└── index.php           # Enrutador y punto de entrada principal
