<?php 

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'api_db';



// Set DSN (DATA SOURCE NAME)
$dsn = 'mysql:host=' . $host . ';dbname=' .$dbname;

// Create a PDO instance
$pdo = new PDO($dsn, $user, $password);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

$stmt = $pdo->query('SELECT * FROM products');


while($row = $stmt->fetch()){
    echo $row->name . '<br>';
}

// FETCH MULTIPLE POSTS

// User input
$price = 300;

// Positional Params
$sql = 'SELECT * FROM products WHERE price < ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$price]);
$posts = $stmt->fetchAll();

foreach($posts as $post){
    echo $post->price . '<br>';
}


// INSERT ITEM 

$id = 61;
$name = 'Rolex Watch2';
$description = 'Luxury watch.';
$price = '25000';
$category_id = 1;
$created = '2016-01-11 15:46:02';
$modified = '2016-01-11 14:46:02';

$sql = "INSERT INTO  products(id, name, description, price, category_id, created, modified) VALUES(:id, :name, :description , :price, :category_id, :created , :modified)";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id, 'name' => $name,  'description' => $description, 'price' => $price, 'category_id' => $category_id, 'created' => $created, 'modified' =>$modified]);
echo "product with id ${id} added";


// GET A SINGLE ITEM
$id = 61;
$sql = 'SELECT * FROM products WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$post = $stmt->fetch();

echo '<br>This is a single product fetched <br>';
echo $post->name . ' ' . $post->id . '<br>';





// UPDATE ITEM
$id = 61;
$name = 'U-Rolex Watch2';

$sql = "UPDATE products SET name = :name WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id, 'name' => $name]);
echo "<br>product no ${id} updated";


// DELETE DATA
$id = 61;
$sql = 'DELETE FROM products WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
echo "<br>Product deleted with id ${id}";

// SEARCH DATA
$search = '%samsung%';
$sql = 'SELECT * FROM products WHERE name LIKE ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$search]);
$products = $stmt->fetchAll();

echo '<br><h1>Search result:</h1>';

foreach($products as $product){
    echo '<br>'. $product->name ;
}


echo '<br><h1>Multiple items:</h1>';



// GET MULTIPLE ITEMS
$id = 61;
$price = 300;
$sql = 'SELECT * FROM products WHERE id < :id && price < :price';
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id, 'price' => $price]);
$products = $stmt->fetchAll();

foreach($products as $product){
    echo '<br>' . $product->name;
}


