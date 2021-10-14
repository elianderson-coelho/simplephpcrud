<?php
    $pdo = new PDO('mysql:host=localhost;dbname=estudophp', 'root','root');

    var_dump($pdo);
    print_r($pdo);
    //INSERT  
   if(isset($_POST['nome'])){
        $sql = $pdo->prepare("INSERT INTO clientes VALUES (null,?,?)");
        $sql->execute(array($_POST['nome'], $_POST['email']));
        echo "Inserted succesfuly!";
    } 
    //DELETE
    if(isset($_GET['delete'])){
        $id = (int)$_GET['delete'];
        $pdo->exec("DELETE FROM clientes WHERE id=$id");
        echo "deleted succesfuly!";
    }
?>

<form method='post'>
    <input type="text" name="nome">
    <input type="text" name="email">
    <input type="submit" value="Enviar">
</form>

<?php
    $sql = $pdo->prepare("SELECT * FROM clientes");
    $sql->execute();

    $fetchClientes = $sql->fetchAll();

    echo '<h1>Clients already registered </h1>';
    foreach ($fetchClientes as $key => $value){
        echo '<a href="?delete='.$value['id'].'"> DELETE </a>'.$value['nome']. ' | '.$value['email'];
        echo '<hr>';
    }
?>