<?php

 namespace  model\ManagerClass;


 use model\InterfaceClass\ActionInterface;
 use model\MappingClass\ActionMapping;
 use model\InterfaceClass\ManagerInterface;
 use model\TraitsClass\TestTrait;
 use PDO;
 use Exception;

class ActionManager implements ManagerInterface,ActionInterface {

    protected PDO $connect;

    public function __construct(PDO $connection){
        $this->connect = $connection;
    }

    /**
     * request for one by id
     * @param int $id
     * @return \model\MappingClass\ActionMapping|void
     */
    public  function getOneById(int $id){
        $prepare = $this->connect->prepare("SELECT * FROM action WHERE `idAction` = :id");
        $prepare->bindValue(":id", $id, PDO::PARAM_INT);
        try {
            $prepare->execute();
            $result = $prepare->fetch();
            return new ActionMapping($result);
        } catch (Exception $e) {
            echo "Erreur de requête : " . $e->getMessage();
            exit;
        }

    }

    /**
     * request for get all
     * @return array of all action
     */
    public function getAll(): array{
        $prepare = $this->connect->prepare("SELECT * FROM action");
        try {
            $prepare->execute();
            $result = $prepare->fetchAll();
            $all = [];
            foreach ($result as $row) {
                $all[] = new ActionMapping($row);
            }
            return $all;
        } catch (Exception $e) {
            echo "Erreur de requête : " . $e->getMessage();
            exit;
        }
    }

    /**
     * request for insert of db
     * @param \model\MappingClass\ActionMapping $datas
     * @return bool
     */
    public function insertAction(ActionMapping  $datas): bool{
        $prepare = $this->connect->prepare("INSERT INTO `action` (`actionTitre`, `actionDescription`, `actionText`,`actionImages`,`actionDate`) VALUES (:actionTitre, :actionDescription, :actionText , :actionImage , :actionDate");
        $prepare->bindValue(":actionTitre", $datas->getActionTitre(), PDO::PARAM_STR);
        $prepare->bindValue(":actionDescription", $datas->getActionDescription(), PDO::PARAM_STR);
        $prepare->bindValue(":actionText", $datas->getActionText(), PDO::PARAM_STR);
        $prepare->bindValue(":actionImage",$datas->getActionImage(),PDO::PARAM_STR);
        $prepare->bindValue(":actionDate", $datas->getActionDate(),PDO::PARAM_STR);

        try {
            $prepare->execute();
            return true;
        } catch (Exception $e) {
            echo "Erreur de requête : " . $e->getMessage();
            exit;
        }
    }

    /**
     * request for update of db
     * @param \model\MappingClass\ActionMapping $datas
     * @return bool
     */
  public function  updateAction(ActionMapping $datas):bool
  {
      $prepare = $this->connect->prepare("UPDATE action SET actionTitle=?,actioniDescription=?,actionText=?,actionImg=?,actionDate=? WHERE idAction = :idAction");
      $prepare->bindValue(1, htmlspecialchars(strip_tags(trim($datas->getActionTitre()), ENT_QUOTES)), PDO::PARAM_STR);
      $prepare->bindValue(2, htmlspecialchars(strip_tags(trim($datas->getActionDescription()), ENT_QUOTES)), PDO::PARAM_STR);
      $prepare->bindValue(3, htmlspecialchars(strip_tags(trim($datas->getActionText()), ENT_QUOTES)), PDO::PARAM_STR);
      $prepare->bindValue(4, htmlspecialchars(strip_tags(trim($datas->getActionImg()), ENT_QUOTES)), PDO::PARAM_STR);
      $prepare->bindValue(5, htmlspecialchars(strip_tags(trim($datas->getActionDate()), ENT_QUOTES)), PDO::PARAM_STR);

      try {
          $prepare->execute();
          return true;
      } catch (Exception $e) {
          echo "Erreur de requête : " . $e->getMessage();
          exit;
      }
  }

    /**
     * request delete of db
     * @param \model\MappingClass\ActionMapping $id
     * @return bool
     */
    public function deleteAction(ActionMapping $id):bool
    {
          $prepare= $this->connect->prepare("DELETE FROM action WHERE idAction =  :idAction");
          $prepare->bindValue(":id", $id, PDO::PARAM_INT);
          header("Location:./");

           try {
            $prepare->execute();
            return true;
        } catch (Exception $e) {
            echo "Erreur de requête : " . $e->getMessage();
            exit;
        }

  }




}