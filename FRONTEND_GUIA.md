# 🎨 Guía de Desarrollo Frontend

Esta guía explica cómo estructurar el Frontend (HTML, CSS, JS) en este framework para mantener una arquitectura limpia y separada.

---

## 1. Organización de Archivos
Todos los recursos estáticos **deben** residir en la carpeta `public/`. Esto garantiza que sean accesibles desde el navegador.

-   `/public/Css/`: Archivos de estilos (`.css`).
-   `/public/Js/`: Lógica del lado del cliente (`.js`).
-   `/public/Img/`: Imágenes, iconos y recursos gráficos.
-   `/App/Views/`: Estructura HTML (archivos `.php`).

---

## 2. Vincular Recursos en las Vistas
Debido a que el ruteo es dinámico, **nunca** uses rutas relativas como `href="css/style.css"`. Usa siempre rutas absolutas desde la raíz `/` para evitar errores cuando cambies de ruta (ej: `/usuario/perfil`).

**Ejemplo de Estructura de Vista (`App/Views/layout.php`):**
```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Mi Proyecto' ?></title>
    
    <!-- CSS: Siempre desde la raíz -->
    <link rel="stylesheet" href="/Css/main.css">
    <link rel="stylesheet" href="/Css/componentes.css">
</head>
<body>

    <nav>...</nav>

    <main>
        <!-- Contenido dinámico -->
        <h1><?= $welcome_message ?></h1>
    </main>

    <!-- JS: Al final del body -->
    <script src="/Js/main.js"></script>
    <script src="/Js/validaciones.js"></script>
</body>
</html>
```

---

## 3. Interacción Frontend - Controlador
El frontend se comunica con los controladores de dos maneras principales:

### A. Navegación Tradicional (Sincronía)
Se realiza mediante enlaces `<a>` o envíos de formulario estándar. El controlador responderá renderizando una nueva vista completa.

```html
<!-- El controlador 'ProductoController' recibirá la petición -->
<a href="/productos/ver/25">Ver Producto</a>
```

### B. Interacción Dinámica (AJAX)
Se realiza mediante JavaScript (`fetch`). El controlador responderá con JSON y el JS actualizará el DOM sin recargar.

```javascript
// En /public/Js/carrito.js
async function agregarAlCarrito(id) {
    const response = await fetch(`/api/carrito/agregar/${id}`, { method: 'POST' });
    const res = await response.json();
    
    if(res.status === 'ok') {
        document.getElementById('contador').innerText = res.total_items;
    }
}
```

---

## 4. Mejores Prácticas (CSS y JS)

### Separación de JS
No escribas JavaScript dentro de las etiquetas `<script>` en las vistas. Crea archivos individuales en `public/Js/` y lánzalos según la necesidad.
-   **Mal**: `<button onclick="alert('Hola')">`
-   **Bien**: `button.addEventListener('click', ...)` en un archivo `.js` externo.

### Estructura de CSS
Divide tu CSS para que sea mantenible:
-   `main.css`: Estilos globales (fuentes, reset, colores).
-   `layout.css`: Estilos de cabecera, pie de página y estructura.
-   `vistas/`: (Opcional) Puedes crear subcarpetas para estilos específicos de una sección.

---

## 5. El método `view()` y el Frontend
Recuerda que cada dato enviado desde el Controlador:
```php
$this->view('home', ['color' => 'red', 'usuario' => 'Admin']);
```
Se convierte en una variable global en el archivo de la vista:
```html
<!-- En App/Views/home.php -->
<div style="color: <?= $color ?>">
    Bienvenido, <?= $usuario ?>
</div>
```

---

## 💡 Recomendación para el flujo de trabajo
1.  El **Maquetador** crea el HTML/CSS en `App/Views` y `public/Css`.
2.  El **Programador Frontend** agrega la interactividad en `public/Js` usando `fetch` para hablar con los controladores.
3.  El **Programador Backend** asegura que los controladores envíen las variables necesarias a las vistas o las respuestas JSON correctas.
