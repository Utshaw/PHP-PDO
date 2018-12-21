<?php 

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'api_db';



// Set DSN (DATA SOURCE NAME)
$dsn = 'mysql:host=' . $host . ';dbname=' .$dbname;

// Create a PDO instance
$pdo = new PDO($dsn, $user, $password);

$stmt = $pdo->query('SELECT * FROM products');


while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    echo $row['name'] . '<br>';
}



