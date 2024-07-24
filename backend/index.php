<?php // Conexión a la base de datos
$host = "localhost";
$dbname = "entrega";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host; dbname=$dbname", $username, $password);
    echo "Conexión exitosa";
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}
// Conexión a la base de datos?>


<?php // Ejecución del procedure

function seleccionarUsuarios($pdo) {
    try {
        // prepare
        $laQuery = $pdo -> prepare("CALL seleccionarUsuarios()"); // Absorbe la query
        $laQuery->execute(); // Ejecuta la query
        $Resultado = $laQuery->fetchAll(PDO::FETCH_ASSOC); // Ejecuta fetch a la query y la guarda en Resultado
        return $Resultado;
    } catch(PDOException $e) { // catch error
        return array('error' => 'Error al obtener usuarios: ' . $e->getMessage()); // getMessage
    }

}

// Configurar el resultado en formato json
header('Content-Type: application/json');

// Hacer echo en formato json a la funcion previa que llama directamente una stored procedure a la conexión definida en $pdo
echo json_encode(seleccionarUsuarios($pdo));

// Ejecución del procedure?>

