# Proyecto 3: Editor WYSIWYG para TODO.md

Este proyecto es un editor avanzado de tareas TODO con funcionalidad WYSIWYG (Lo Que Ves Es Lo Que Obtienes) para archivos Markdown.

## Características

* Editor WYSIWYG visual para editar tareas de forma intuitiva
* Modo de edición de código Markdown tradicional
* Vista previa en tiempo real del contenido
* Soporte para tareas con comentarios multi-línea y subtareas
* Separadores automáticos entre tareas (80 guiones por defecto)
* Guardado y carga de archivos TODO.md
* Interfaz responsive y moderna con Bootstrap
* Funcionalidad de agregar tareas mediante formulario modal

## Tecnologías Utilizadas

* HTML5
* CSS3 con Bootstrap 5
* JavaScript ES6+
* Vue.js 3 (vía CDN)
* Marked.js (para análisis de Markdown)
* Font Awesome (iconos)
* CodeMirror (editor de código)

## Estructura de Archivos

```
3/
├── index.html          # Página principal de la aplicación
├── index.js           # Lógica de la aplicación Vue.js
├── style.css          # Estilos personalizados
├── TODO.md           # Archivo de tareas por defecto
├── README.md         # Documentación en inglés
└── README.es.md      # Este archivo (documentación en español)
```

## Cómo Utilizar

1. Abrir `index.html` en un navegador web moderno
2. La aplicación cargará automáticamente el archivo `TODO.md`
3. Usar el modo WYSIWYG para edición visual o cambiar al modo código
4. Agregar nuevas tareas con el botón "Nueva Tarea"
5. Guardar los cambios usando el botón "Guardar"

## Funcionalidades del Editor

### Modo WYSIWYG
- Edición visual directa del contenido
- Barra de herramientas con opciones de formato
- Botón para agregar nuevas tareas estructuradas
- Inserción automática de separadores

### Modo Código
- Editor de texto plano para Markdown
- Resaltado de sintaxis
- Edición directa del código fuente

### Vista Previa
- Renderizado en tiempo real del Markdown
- Estilos personalizados para mejor legibilidad
- Soporte completo para checkboxes de tareas

## Formato de Tareas

Cada tarea sigue esta estructura:

```markdown
--------------------------------------------------------------------------------

## Título de la Tarea

### Descripción
Descripción detallada de la tarea.

### Comentarios
Comentarios adicionales que pueden ser
de múltiples líneas.

### Subtareas
- [ ] Primera subtarea
- [ ] Segunda subtarea
- [ ] Tercera subtarea
```

## Requisitos del Sistema

- Navegador web moderno con soporte para ES6+
- Conexión a internet para cargar las librerías CDN
- JavaScript habilitado

## Personalización

El archivo `style.css` contiene todos los estilos personalizables:
- Colores del tema
- Tamaños de fuente
- Espaciado y diseño
- Efectos de animación

## Limitaciones Conocidas

- La funcionalidad de guardado descarga el archivo localmente
- Requiere conexión a internet para las librerías CDN
- La conversión HTML a Markdown es básica y puede requerir ajustes manuales

## Instalación y Uso

No requiere instalación adicional. Simplemente:

1. Descargar todos los archivos en una carpeta
2. Abrir `index.html` en tu navegador preferido
3. ¡Comenzar a editar tus tareas!

## Contribución

Este proyecto forma parte de una colección de ejemplos Vue.js. Para contribuir:

1. Revisar el código existente
2. Mantener el estilo de documentación consistente
3. Probar en múltiples navegadores
4. Actualizar la documentación según sea necesario
