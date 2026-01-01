<?php
/**
 * Script de prueba para conexión con MySQL mediante PDO.
 *
 * Este archivo:
 *  - Establece conexión con la base de datos.
 *  - Crea una tabla de visitas si no existe.
 *  - Inserta un registro por cada ejecución.
 *  - Muestra el total de visitas almacenadas.
 *
 * @package ProyectoDemo
 */

// -----------------------------------------------------------------------------
// Parámetros de conexión
// -----------------------------------------------------------------------------

/**
 * DSN de conexión a MySQL.
 *
 * @var string
 */
$dsn = "mysql:host=db;dbname=dwes;charset=utf8mb4";

/**
 * Usuario de la base de datos.
 *
 * @var string
 */
$user = "dwes";

/**
 * Contraseña del usuario de la base de datos.
 *
 * @var string
 */
$pass = "dwes";

try {
    /**
     * Conexión PDO a la base de datos.
     *
     * @var PDO $pdo
     */
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    // -------------------------------------------------------------------------
    // Crear tabla si no existe
    // -------------------------------------------------------------------------

    /**
     * Crea la tabla `visitas` en caso de que aún no exista.
     *
     * La tabla contiene:
     * - id: clave primaria autoincremental
     * - ts: marca de tiempo del momento de la inserción
     */
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS visitas (
            id INT AUTO_INCREMENT PRIMARY KEY,
            ts TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");

    // -------------------------------------------------------------------------
    // Insertar un nuevo registro
    // -------------------------------------------------------------------------

    /**
     * Inserta una nueva visita en la tabla.
     *
     * Insertar sin columnas hace que se utilicen valores por defecto.
     */
    $pdo->exec("INSERT INTO visitas () VALUES ()");

    // -------------------------------------------------------------------------
    // Obtener número total de visitas
    // -------------------------------------------------------------------------

    /**
     * Consulta el total de registros almacenados en la tabla `visitas`.
     *
     * @var int $count Número total de visitas.
     */
    $count = $pdo->query("SELECT COUNT(*) FROM visitas")->fetchColumn();

    // -------------------------------------------------------------------------
    // Salida por pantalla
    // -------------------------------------------------------------------------

    echo "<h1>Proyecto funcionando</h1>";
    echo "<p>Conexión a MySQL establecida.</p>";
    echo "<p>Total de visitas registradas: <strong>$count</strong></p>";

} catch (Throwable $e) {
    /**
     * Captura cualquier error relacionado con la conexión o las consultas.
     *
     * @var Throwable $e Excepción capturada.
     */
    echo "<h1>Error al conectar a MySQL</h1>";
    echo "<pre>" . $e->getMessage() . "</pre>";
}
