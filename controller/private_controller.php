<?php
use \model\ManagerClass\AdminManager;
use \model\ManagerClass\ActionManager;
use \model\ManagerClass\FormationManager;
use \model\ManagerClass\AgendaManager;


$adminConect = new AdminManager($connection);

$action = new ActionManager($connection);
$actionAll = $action->getAll();
$actionInsert = $action->insertAction($connection);


if (isset($_GET['p'])) {

    switch ($_GET['p']) {
        case "home":

            include_once "../view/private_view/homeAdmin.php";
            break;
        case "action":
            /* Création d'un manager VALIDE avec sa connexion */
            $actionAdmin =new ActionManager($connection);
            /* Instantiation du AccueilMapping.php avec la méthod du manager */
            $act = $actionAdmin-> getOneById(1);
           // $actAll= $act->getAll();
            include_once "../view/private_view/actionAdmin.php";

            break;
        case "modifAction" :
            /* Création d'un manager VALIDE avec sa connexion */
            $modAction =new ActionManager($connection);
            /* Instantiation du AccueilMapping.php avec la méthod du manager */
            $modAct = $modAction-> updateAction($connection);
            include_once "../view/private_view/modifierAction.php";
            break;
        case "formation" :
            /* Création d'un manager VALIDE avec sa connexion */
            $formaAdmin =new FormationManager($connection);
            /* Instantiation du AccueilMapping.php avec la méthod du manager */
            $forma = $formaAdmin-> getOneById(1);
            $formationAll = $formaAdmin-> getAll();
            include_once "../view/private_view/formationAdmin.php";
            break;
        case "modifFormation" :
            /* Création d'un manager VALIDE avec sa connexion */
            $forAction =new FormationManager($connection);
            /* Instantiation du AccueilMapping.php avec la méthod du manager */
            $forAdmin = $forAction -> updateFormation($connection);
            include_once "../view/private_view/modifierFormation.php";
            break;
        case "agenda" :
            /* Création d'un manager VALIDE avec sa connexion */
            $agenda =new AgendaManager($connection);
            /* Instantiation du AccueilMapping.php avec la méthod du manager */
            $agendaAdmin = $agenda-> getOneById(1);
            $agendaAll= $agenda->getAll();// ca marche pas
            include_once "../view/private_view/agendaAdmin.php";
            break;
        case "modifAgenda":
            /* Création d'un manager VALIDE avec sa connexion */
            $modAgenda =new AgendaManager($connection);
            /* Instantiation du AccueilMapping.php avec la méthod du manager */
            $modAge =  $modAgenda->updateAgenda($connection);

            include_once "../view/private_view/modifierAgenda.php";
            break;
        default :
            include_once "../view/private_view/homeAdmin.php";
            break;
    }
}else if (isset($_GET['disconnect'])) {
      $adminConect->disconnect();
        header("Location: ./");
        exit();
}else{
    include_once "../view/private_view/homeAdmin.php";
}


        if(isset($_POST['addAction'])) {
          if (!empty($_POST['articleImage']) && !empty($_POST['title'])) {
            try {
              $lastInsert = $actionInsert;
           } catch (Exception $e) {
             $e = throw new Exception("Un problème est survenu lors de l'ajout 
                 de l'action veuillez réesayer ");
          }
    }

}