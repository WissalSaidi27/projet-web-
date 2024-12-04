<?php
require_once '../../controllers/contratControlleur.php';

if(isset($_GET['id'])) {
    $controller = new ContratController();
    $contrat = $controller->getContratById($_GET['id']);
    
    header('Content-Type: application/json');
    echo json_encode($contrat);
}
?>





