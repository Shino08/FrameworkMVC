# 🌐 Guía de Integración AJAX y API

Esta guía explica cómo realizar peticiones asíncronas (AJAX) utilizando la arquitectura de este framework MVC.

---

## 1. Configuración de Rutas para AJAX
Para que una petición AJAX funcione, primero debemos dar de alta la ruta en `Routes/web.php`. Es recomendable usar el nombre del método HTTP correspondiente (`GET` para obtener datos, `POST` para enviar/guardar).

```php
use App\Controllers\ApiController;

// Ruta para obtener datos (JSON)
Route::get('/api/usuarios', [ApiController::class, 'getUsuarios']);

// Ruta para recibir datos capturados por un formulario vía AJAX
Route::post('/api/guardar', [ApiController::class, 'saveData']);
```

---

## 2. Lógica en el Controlador (Respuesta JSON)
El controlador debe procesar la solicitud y devolver una respuesta en formato JSON utilizando el método helper `$this->json()`.

**Ejemplo: `App/Controllers/ApiController.php`**
```php
<?php
namespace App\Controllers;
use Lib\Controller;

class ApiController extends Controller {

    public function getUsuarios() {
        $usuarios = [
            ['id' => 1, 'nombre' => 'Ana'],
            ['id' => 2, 'nombre' => 'Pedro']
        ];

        // Retorna JSON con código 200 (éxito)
        $this->json($usuarios);
    }

    public function saveData() {
        // En peticiones POST de AJAX, los datos pueden venir en $_POST 
        // o en el cuerpo de la petición (php://input)
        $nombre = $_POST['nombre'] ?? 'Sin nombre';

        $respuesta = [
            'status' => 'success',
            'mensaje' => 'Recibido correctamente: ' . $nombre
        ];

        $this->json($respuesta, 201); // 201 = Creado
    }
}
```

---

## 3. Implementación en el Cliente (JavaScript)
Se recomienda usar la API `fetch` de JavaScript moderno para interactuar con las rutas del servidor.

### A. Petición GET con Fetch
```javascript
async function cargarUsuarios() {
    try {
        const response = await fetch('/api/usuarios');
        const data = await response.json();
        
        console.log("Usuarios cargados:", data);
        
        // Ejemplo: Dibujar en el HTML
        data.forEach(user => {
            document.body.innerHTML += `<p>${user.nombre}</p>`;
        });
    } catch (error) {
        console.error("Error en la petición:", error);
    }
}
```

### B. Petición POST con envío de formulario
```javascript
const enviarFormulario = async (datos) => {
    // Formar el cuerpo del POST
    const formData = new FormData();
    formData.append('nombre', datos.nombre);

    const response = await fetch('/api/guardar', {
        method: 'POST',
        body: formData
    });

    const resultado = await response.json();
    alert(resultado.mensaje);
};
```

---

## 4. Puntos Clave para la Integración
1.  **Cabeceras**: El método `$this->json()` del framework automáticamente envía la cabecera `Content-Type: application/json`.
2.  **URLs Relativas**: Asegúrate de que la URL en el `fetch` coincida exactamente con la ruta definida en `web.php` (ej: `/api/usuarios`).
3.  **Manejo de Errores**: Siempre devuelve un código de estado coherente (`404` si no se encuentra el recurso, `400` si faltan datos, `500` si hay un error de servidor).
4.  **Método POST**: Si envías datos como JSON desde el cliente (en lugar de FormData), en PHP deberás leerlos así:
    ```php
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    ```

Esta arquitectura permite separar totalmente la lógica de datos (API) de la lógica de visualización (Vistas), facilitando el mantenimiento y permitiendo que el frontend sea dinámico sin recargar la página.
