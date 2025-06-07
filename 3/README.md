# Proyecto 3: Editor WYSIWYG para TODO.md

Este proyecto es un editor avanzado de tareas TODO con funcionalidad WYSIWYG (What You See Is What You Get) para archivos Markdown.

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
* Vue.js 3 (via CDN)
* Marked.js (para parsing de Markdown)
* Font Awesome (iconos)
* CodeMirror (editor de código)

## Estructura de Archivos

```
3/
├── index.html          # Página principal de la aplicación
├── index.js           # Lógica de la aplicación Vue.js
├── style.css          # Estilos personalizados
├── TODO.md           # Archivo de tareas por defecto
├── README.md         # Este archivo (documentación en inglés)
└── README.es.md      # Documentación en español
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
