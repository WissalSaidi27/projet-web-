<?php
include "../Model/Product.php";
include "../Controller/ProductController.php";
$product = null;
$error = "";
// create an instance of the controller
$productController = new ProductController();

//utiliser la fonction isset() pour vérifier si les clés name, price et category existe avant d'y accéder
if (
    isset($_POST["name"])  && isset($_POST["price"]) && isset($_POST["category"])
) {
    //utiliser la fonction empty() pour vérifier si les clés name, price et category posséde des valeurs
    if (
        !empty($_POST["name"])  && !empty($_POST["price"]) && !empty($_POST["category"])
    ) {
        // créer un objet à partir des nouvelles valeurs passées pour mettre à jour le produit choisi
        $product = new Product(
            null,
            $_POST['name'],
            $_POST['price'],
            $_POST['category'],
        );
        // appelle de la fonction updateProduct
        $productController->updateProduct($product, $_POST['id']);
        // une fois l'update est faite une redirection vers la page liste des produits sera faite
        header('Location:productList.php');
    } else
        // message en cas de manque d'information
        $error = "Missing information";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    // $_POST['id'] récupérer à partir du form relative au bouton update dans la page productList
    if (isset($_POST['id'])) {
        //récupération du produit à mettre à jour par son ID
        $product = $productController->getProductById($_POST['id']);
    ?>
        <!-- remplir le vormulaire par les données du produits à mettre à jour -->
        <form id="product" action="" method="POST">
            <label for="id">ID product:</label>
            <!-- remplir chaque input par la valeur adéquate dans l'attribut value  -->
            <input class="form-control form-control-user" type="text" id="id" name="id" readonly value="<?php echo $_POST['id'] ?>"><br>

            <label for="id">Product Name </label>
            <!-- remplir chaque input par la valeur adéquate dans l'attribut value  -->

            <input class="form-control form-control-user" type="text" id="name" name="name" value="<?php echo $product['name'] ?>"><br>
            <label for="title">Price</label>
            <input class="form-control form-control-user" type="text" id="price" name="price" value="<?php echo $product['price'] ?>"><br>
            <label for="title">Category</label>
            <input class="form-control form-control-user" type="text" id="category" name="category" value="<?php echo $product['category'] ?>"><br>
            <input type="submit" value="save">
        </form>
    <?php
    }
    ?>



</body>

</html>