# VUEBOX v2025.06.01

Entorno de pruebas para aprender Vue.js → https://vuejs.org/

## Descripción del Proyecto

VUEBOX es un entorno de aprendizaje integral diseñado para explorar y practicar el desarrollo con Vue.js. Este proyecto proporciona un entorno estructurado con múltiples ejemplos, plantillas y utilidades para ayudar a los desarrolladores a aprender los conceptos de Vue.js de forma progresiva.

## Estructura del Proyecto

```
vuebox/
├── README.md                 # Documentación del proyecto
├── README.es.md             # Documentación en español
├── package.json             # Dependencias de NPM
├── bower.json              # Dependencias de Bower (obsoleto)
├── index.php               # Panel principal del proyecto
├── css/                    # Hojas de estilo
│   └── starter-template.css
├── images/                 # Recursos del proyecto
│   ├── favicon.ico
│   ├── favicon-16x16.png
│   ├── favicon-32x32.png
│   └── vuejs.png
├── 1/                      # Ejemplo: Editor de Markdown
├── 2/                      # Ejemplo: Lista de usuarios con AJAX
├── zzz/                    # Plantilla base para nuevos ejemplos
├── FEATURE_IDEAS.md        # Ideas para futuras funcionalidades
└── CLAUDE.md              # Documentación técnica detallada
```

## Pila Tecnológica

### Dependencias Principales
- **Vue.js 3.5.16** - Framework progresivo de JavaScript
- **Bootstrap 5.3.6** - Framework CSS para diseño responsivo
- **Axios 1.9.0** - Cliente HTTP para peticiones a APIs
- **Vue Resource 1.5.3** - Plugin cliente HTTP para Vue.js
- **Vuex 4.1.0** - Patrón de gestión de estado para Vue.js

### Herramientas de Desarrollo
- **NPM** - Gestor de paquetes
- **Yarn** - Gestor de paquetes (recomendado)
- **PNPM** - Gestor de paquetes rápido y eficiente en espacio
- **Bun** - Runtime y gestor de paquetes extremadamente rápido
- **Bower** - Gestor de paquetes (obsoleto, soporte heredado)

## Instalación

### Requisitos Previos
- Node.js y npm/yarn/pnpm/bun
- Servidor web (Apache/Nginx) o servidor de desarrollo local
- Git para control de versiones

### Pasos de Instalación

1. **Clonar el Repositorio**
```bash
sudo -u www-data git clone https://github.com/davidjimenez75/vuebox.git
```

2. **Elegir tu Gestor de Paquetes**

#### OPCIÓN 1 - INSTALACIÓN CON NPM
```bash
sudo -u www-data npm install
```

#### OPCIÓN 2 - INSTALACIÓN CON YARN (Recomendado)
```bash
sudo -u www-data yarn add axios bootstrap vue vuex vue-resource
sudo -u www-data yarn install
```

#### OPCIÓN 3 - INSTALACIÓN CON PNPM
```bash
sudo -u www-data pnpm install
```

#### OPCIÓN 4 - INSTALACIÓN CON BUN
```bash
sudo -u www-data bun install
```

3. **Iniciar el Servidor de Desarrollo**
```bash
# Si usas un servidor local
php -S localhost:8000

# O colócalo en el directorio del servidor web (ej: /var/www/html/)
```

## Características Principales

### 1. Panel Interactivo (index.php)
- **Listado Dinámico de Directorios**: Escanea y muestra automáticamente todos los directorios de ejemplos
- **Sistema de Estados con Códigos de Color**: Indicadores visuales para diferentes tipos de ejemplos
  - Rojo (danger) - Ejemplos críticos o avanzados
  - Naranja (warning) - Ejemplos intermedios
  - Azul (info/primary) - Ejemplos informativos
  - Verde (success) - Ejemplos básicos o completados
- **Funcionalidad de Búsqueda**: Filtrado en tiempo real de ejemplos
- **Diseño Responsivo**: Interfaz responsiva potenciada por Bootstrap

### 2. Proyectos de Ejemplo Actuales

#### Proyecto 1: Editor de Markdown
**Ubicación**: `/1/`
**Estado**: Éxito (Verde)
**Descripción**: Ejemplo de Editor de Markdown

Un editor de markdown en tiempo real que demuestra:
- **Enlace de Datos Bidireccional**: Vista previa en vivo del contenido markdown
- **Propiedades Computadas**: Compilación de markdown en tiempo real
- **Manejo de Eventos**: Actualizaciones de entrada con debounce
- **Integración de Librerías Externas**: Usa marked.js y lodash

**Conceptos Clave de Vue.js Demostrados:**
```javascript
// Propiedades computadas para transformación reactiva de datos
computed: {
  compiledMarkdown() {
    return marked.parse(this.input)
  }
}

// Métodos con debounce para optimización del rendimiento
methods: {
  update: _.debounce(function (e) {
    this.input = e.target.value
  }, 300)
}
```

#### Proyecto 2: Lista de Usuarios con AJAX
**Ubicación**: `/2/`
**Estado**: Éxito (Verde)
**Descripción**: Lista usuarios mediante ajax usando una API remota - GENERADOR DE USUARIOS ALEATORIOS [randomuser.me](http://randomuser.me/)

Demuestra:
- **Peticiones HTTP**: Obtención de datos de APIs externas
- **Renderizado de Listas**: Visualización de datos dinámicos
- **Operaciones Asíncronas**: Manejo de respuestas de API
- **Integración de API Externa**: Trabajo con la API de randomuser.me

#### Estructura de Plantilla (zzz)
**Ubicación**: `/zzz/`
**Estado**: Primario (Azul)
**Descripción**: Carpeta de plantilla reutilizable, simplemente haz una copia y renómbrala.

Proporciona un punto de partida estandarizado para nuevos ejemplos:
- Integración con Bootstrap
- Configuración de Vue.js
- Secciones comentadas para diferentes librerías (Vue Resource, Vuex, Axios)
- Estilo y navegación consistentes

### 3. Sistema de Organización

#### Indicadores de Estado
Los ejemplos pueden categorizarse usando archivos especiales:
- `index.danger.txt` - Fondo rojo (avanzado/crítico)
- `index.warning.txt` - Fondo naranja (intermedio)
- `index.info.txt` - Fondo azul claro (informativo)
- `index.primary.txt` - Fondo azul (ejemplos primarios)
- `index.success.txt` - Fondo verde (básico/completado)

#### Documentación
- `index.txt` - Contiene descripción y notas para cada ejemplo
- Soporta contenido HTML para formato enriquecido
- Se muestra automáticamente en el panel principal

## Flujo de Trabajo de Desarrollo

### Crear Nuevos Ejemplos

1. **Copiar Plantilla**
```bash
cp -r zzz/ tu-nuevo-ejemplo/
```

2. **Personalizar Contenido**
- Editar `index.html` para la estructura
- Modificar `index.js` para la lógica de Vue.js
- Actualizar `style.css` para estilos personalizados

3. **Añadir Documentación**
- Crear `index.txt` con la descripción del ejemplo
- Añadir archivo indicador de estado si es necesario

4. **Probar Integración**
- Verificar que el ejemplo aparece en el panel principal
- Probar funcionalidad y responsividad

### Mejores Prácticas

1. **Estructura Consistente**: Seguir el patrón de plantilla para todos los ejemplos
2. **Complejidad Progresiva**: Comenzar con conceptos básicos, avanzar gradualmente
3. **Documentación**: Incluir siempre descripciones claras y comentarios
4. **Diseño Responsivo**: Asegurar que los ejemplos funcionen en todos los tamaños de dispositivo
5. **Rendimiento**: Usar técnicas de debouncing y optimización cuando sea apropiado

## Valor Educativo

### Ruta de Aprendizaje
1. **Conceptos Básicos de Vue.js** (Sintaxis de plantillas, enlace de datos)
2. **Comunicación entre Componentes** (Props, eventos)
3. **Gestión de Estado** (Integración con Vuex)
4. **Peticiones HTTP** (Axios, Vue Resource)
5. **Patrones Avanzados** (Mixins, directivas personalizadas)

### Conceptos Clave de Vue.js Cubiertos
- **Enlace de Datos Reactivo**
- **Propiedades Computadas**
- **Métodos y Manejo de Eventos**
- **Ciclo de Vida de Componentes**
- **Sintaxis de Plantillas**
- **Renderizado Condicional**
- **Renderizado de Listas**
- **Enlace de Entradas de Formulario**
- **Integración de Cliente HTTP**
- **Comunicación con API Externa**

## Preguntas Frecuentes

### ¿Cómo instalar Yarn en Debian/Ubuntu?

**YARN - VERSIÓN ESTABLE:**

https://yarnpkg.com/en/docs/install#debian-stable

```bash
apt install curl
curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | sudo apt-key add -
echo "deb https://dl.yarnpkg.com/debian/ stable main" | sudo tee /etc/apt/sources.list.d/yarn.list
sudo apt update && sudo apt install yarn
yarn -v
```

**YARN - CANDIDATO DE LANZAMIENTO:**

https://yarnpkg.com/en/docs/install#debian-rc

```bash
apt install curl
curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | sudo apt-key add -
echo "deb https://dl.yarnpkg.com/debian/ rc main" | sudo tee /etc/apt/sources.list.d/yarn.list
sudo apt update && sudo apt install yarn
yarn -v
```

### ¿Añadir color a las carpetas?

Copia uno de los archivos index.*.txt de la carpeta raíz dentro de la subcarpeta.

- index.danger.txt (rojo)
- index.warning.txt (naranja)
- index.info.txt (azul claro)
- index.primary.txt (azul)
- index.success.txt (verde)

### ¿Añadir una pequeña descripción a las carpetas?

Crea un archivo index.txt con tus comentarios.

### ¿Puedo añadir enlaces a URLs externas en los comentarios?

Sí, simplemente usa un href html en el index.txt

```html
<a href="https://ejemplo.com" target="_blank">Enlace externo</a>
```

## Compatibilidad de Navegadores

- Navegadores modernos que soporten ES6+
- Puntos de ruptura responsivos de Bootstrap 5
- Requisitos de compatibilidad de Vue.js 3.x

## Contribuir

### Añadir Nuevos Ejemplos
1. Seguir la estructura de plantilla
2. Incluir documentación completa
3. Probar en diferentes navegadores
4. Asegurar diseño responsivo
5. Añadir indicadores de estado apropiados

### Estándares de Código
- Usar indentación consistente (2 espacios)
- Incluir comentarios significativos
- Seguir la guía de estilo de Vue.js
- Mantener el sistema de rejilla de Bootstrap

## Ideas para Futuras Funcionalidades

Consulta el archivo [FEATURE_IDEAS.md](./FEATURE_IDEAS.md) para ver las ideas propuestas para mejorar VUEBOX, incluyendo:

1. **Integración de IDE Online** - Embebido de editores como CodeSandbox o StackBlitz
2. **Categorización y Filtrado de Ejemplos** - Sistema de categorías para mejor navegación
3. **Autenticación de Usuario y Seguimiento de Progreso** - Sistema de progreso personalizado

## Licencia

Licencia MIT - Consulta el repositorio del proyecto para los detalles completos de la licencia.

## Recursos Adicionales

- [Documentación Oficial de Vue.js](https://vuejs.org/guide/)
- [Documentación de Vuex](https://vuex.vuejs.org/en/)
- [Documentación de Bootstrap 5](https://getbootstrap.com/docs/5.3/getting-started/introduction/)
- [Ejemplos de Vue.js](https://vuejs.org/examples/)
- [API del Generador de Usuarios Aleatorios](http://randomuser.me/)

## Autor

**David Jiménez** - [davidjimenez75@gmail.com](mailto:davidjimenez75@gmail.com)

---

*Esta documentación fue actualizada el 2025.06.01 para reflejar la estructura actual del proyecto, opciones de instalación y ejemplos disponibles.*