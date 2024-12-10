<?php
include '../Controller/ProductController.php';
$ProductC = new ProductController();

// récupérer l'id passé dans l'URL en utilisant la methode par défaut $_GET["id"]
$ProductC->deleteProduct($_GET["id"]);
//une fois la suppression est faite une redirection vers la liste des produits ce fait
header('Location:productList.php');

?>