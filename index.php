<?php
    $pdo = new PDO('mysql:host=localhost;dbname=estudophp', 'root','root');
    
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
    NAME <input type="text" name="nome">
    EMAIL <input type="text" name="email">
    <input type="submit" value="Submit">
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