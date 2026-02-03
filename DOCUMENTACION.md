# 🚀 Guía de Uso: Framework MVC Personalizado

Este framework es una estructura ligera diseñada para seguir el patrón de diseño **Modelo-Vista-Controlador (MVC)**. A continuación, se detalla cómo expandir el proyecto agregando nuevas rutas, controladores, modelos y vistas.

---

## 1. Estructura de Carpetas
-   `App/Controllers/`: Lógica de control (maneja las peticiones).
-   `App/Models/`: Lógica de datos (interacción con la DB).
-   `App/Views/`: Plantillas HTML (lo que ve el usuario).
-   `Lib/`: Núcleo del framework (Router, Controller base, Model base).
-   `Routes/`: Definición de rutas (`web.php`).
-   `public/`: Punto de entrada único (`index.php`) y recursos estáticos (CSS, JS).

---

## 2. Cómo agregar una Nueva Ruta
Las rutas se definen en `Routes/web.php`. Tienes dos formas de hacerlo:

### A. Ruta con Función Anónima (Ideal para pruebas rápidas)
```php
Route::get('/saludo', function() {
    echo "¡Hola Mundo!";
});
```

### B. Ruta vinculada a un Controlador (Recomendado)
```php
use App\Controllers\UsuarioController;

// Formato: Route::metodo('/url', [NombreClase::class, 'nombreMetodo']);
Route::get('/perfil', [UsuarioController::class, 'mostrarPerfil']);

// Ruta con parámetros dinámicos (los parámetros se pasan al método del controlador)
Route::get('/usuario/{id}', [UsuarioController::class, 'verDetalle']);
```

---

## 3. Cómo crear un Controlador
Los controladores deben crearse en `App/Controllers/` y extender de `Lib\Controller`.

**Ejemplo: `App/Controllers/UsuarioController.php`**
```php
<?php
namespace App\Controllers;
use Lib\Controller;
use App\Models\Usuario;

class UsuarioController extends Controller {
    
    public function mostrarPerfil() {
        // Lógica del controlador...
        $datos = ['nombre' => 'Juan Pérez', 'rol' => 'Admin'];
        
        // Renderizar una vista y pasarle datos
        $this->view('usuarios/perfil', $datos);
    }

    public function verDetalle($id) {
        // Instanciar un modelo para buscar datos
        // $model = new Usuario();
        // $usuario = $model->find($id);

        $this->view('usuarios/detalle', ['id' => $id]);
    }
}
```

---

## 4. Cómo crear una Vista
Las vistas son archivos `.php` dentro de `App/Views/`. El método `$this->view()` busca automáticamente dentro de esta carpeta.

**Ejemplo: `App/Views/usuarios/perfil.php`**
```html
<h1>Perfil de Usuario</h1>
<p>Nombre: <?= $nombre ?></p>
<p>Rol: <?= $rol ?></p>
```
*Nota: Los elementos del array pasado desde el controlador se convierten en variables automáticas en la vista.*

---

## 5. Cómo crear y usar Modelos
Los modelos manejan los datos. Deben estar en `App/Models/` y extender de `Lib\Model`.

**Ejemplo: `App/Models/Usuario.php`**
```php
<?php
namespace App\Models;
use Lib\Model;

class Usuario extends Model {
    public function all() {
        // Aquí iría la lógica de base de datos (Ej: PDO)
        return [
            ['id' => 1, 'nombre' => 'Ana'],
            ['id' => 2, 'nombre' => 'Luis']
        ];
    }
}
```

**Interacción en el Controlador:**
```php
public function index() {
    $userModel = new Usuario();
    $lista = $userModel->all();
    $this->view('home', ['usuarios' => $lista]);
}
```

---

## 6. Flujo de Trabajo (Interacción con el Cliente)
1.  **Cliente**: Realiza una petición (ej: solicita `tudominio.com/usuario/5`).
2.  **Servidor (Apache/.htaccess)**: Redirige todo a `public/index.php`.
3.  **Router (`Lib/Route.php`)**: Examina la URL, encuentra que coincide con `/usuario/{id}` y llama al controlador `UsuarioController`.
4.  **Controlador (`App/Controllers`)**: 
    - Recibe el parámetro `5`.
    - Pide datos al **Modelo**.
5.  **Modelo (`App/Models`)**: Consulta la base de datos y devuelve la información al controlador.
6.  **Controlador**: Toma los datos y los envía a la **Vista**.
7.  **Vista (`App/Views`)**: Genera el HTML final.
8.  **Respuesta**: El servidor envía el HTML resultante al navegador del cliente.

---

## 💡 Tips de Oro
1.  **Namespaces**: Asegúrate siempre de que el nombre del archivo coincida con la clase y que el `namespace` sea el correcto para que el `autoload.php` funcione.
2.  **URLs Limpias**: Si el ruteo te da 404 fuera de la página principal, revisa que el archivo `public/.htaccess` esté activo en tu servidor.
3.  **Extender**: Si necesitas que todos tus controladores tengan una lógica común (ej: verificar sesión), agrégala en `Lib/Controller.php`.
