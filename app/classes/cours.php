<?php
require_once 'database.php';
require_once 'coursTexte.php';
require_once 'coursVideo.php';


abstract class Cours  {
    protected $id;
    protected $titre;
    protected $description;
    protected $id_categorie;
    protected $type;
    protected $enseignant_id;
    protected $status;

    public function __construct($id = null, $titre = null, $description = null, $id_categorie = null, $image_path = null,$enseignant_id=null,$type=null,$status = null) {
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->id_categorie = $id_categorie;
        $this->image_path = $image_path;
        $this->enseignant_id = $enseignant_id;
        $this->type = $type;
        $this->status = $status;
    }

    abstract public function ajouter() ;
    abstract public function afficherCours();
    abstract public function mettreAJour();

        public static function afficherCoursPagination($start)
        {
            $pdo = Database::getInstance()->getConnection();
            $stmt = $pdo->prepare("SELECT * from CoursView where status = 'Accepte' LIMIT 6 OFFSET :offset");
            $stmt->bindValue(':offset',$start,PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $coursList = [];
            foreach ($result as $row) {
                if($row['contenu_type'] == 'video')
                {
                    $coursList[] = new coursVideo($row['id'], $row['titre'], $row['description'], $row['categorie_id'], $row['image_path'] ,$row['video_url'],$row['enseignant_id'] ,$row['contenu_type'],$row['status']);
                } else 
                {
                    $coursList[] = new coursTexte($row['id'], $row['titre'], $row['description'], $row['categorie_id'], $row['image_path'], $row['contenu'],$row['enseignant_id'] ,$row['contenu_type'],$row['status']);

                }
            }
            return $coursList;
        }

     public static function afficherTous(){
  
            $pdo = Database::getInstance()->getConnection();
            $stmt = $pdo->query("SELECT * FROM CoursView where status = 'Accepte' ");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            $coursList = [];
            foreach ($result as $row) {
                if($row['contenu_type'] == 'video')
                {
                    $coursList[] = new coursVideo($row['id'], $row['titre'], $row['description'], $row['categorie_id'], $row['image_path'], $row['video_url'],$row['enseignant_id'] ,$row['contenu_type'],$row['status']);
                } else 
                {
                    $coursList[] = new coursTexte($row['id'], $row['titre'], $row['description'], $row['categorie_id'] ,$row['image_path'], $row['contenu'],$row['enseignant_id'] ,$row['contenu_type'],$row['status']);

                }
            }
            return $coursList;
        
   }
   public static function afficherParIdProf($idCours)
   {
      $idCours = (int) $idCours;
   
       $pdo = Database::getInstance()->getConnection();
       $stmt = $pdo->prepare("SELECT * FROM CoursView WHERE id = :id and status ='Accepte'");
       $stmt->bindValue(':id', $idCours, PDO::PARAM_INT);
   
       $stmt->execute();
       $row = $stmt->fetch(PDO::FETCH_ASSOC);
   
       if (!$row) {
           throw new Exception("Course with ID $idCours not found.");
       }
   
       if ($row['contenu_type'] === 'video') {
           return new coursVideo($row['id'], $row['titre'], $row['description'], $row['categorie_id'], $row['image_path'],$row['video_url'],$row['enseignant_id'],$row['contenu_type'],$row['status']);
           
       } else {
           return new coursTexte($row['id'], $row['titre'], $row['description'], $row['categorie_id'], $row['image_path'], $row['contenu'],$row['enseignant_id'],$row['contenu_type'],$row['status']);
       }
   }
   public static function afficherParId($idCours)
   {
      $idCours = (int) $idCours;
   
       $pdo = Database::getInstance()->getConnection();
       $stmt = $pdo->prepare("SELECT * FROM CoursView WHERE id = :id ");
       $stmt->bindValue(':id', $idCours, PDO::PARAM_INT);
   
       $stmt->execute();
       $row = $stmt->fetch(PDO::FETCH_ASSOC);
   
       if (!$row) {
           throw new Exception("Course with ID $idCours not found.");
       }
   
       if ($row['contenu_type'] === 'video') {
           return new coursVideo($row['id'], $row['titre'], $row['description'], $row['categorie_id'], $row['image_path'],$row['video_url'],$row['enseignant_id'],$row['contenu_type'],$row['status']);
           
       } else {
           return new coursTexte($row['id'], $row['titre'], $row['description'], $row['categorie_id'], $row['image_path'], $row['contenu'],$row['enseignant_id'],$row['contenu_type'],$row['status']);
       }
   }
   public static function afficherTousParProf($id_enseignant){
  
    $pdo = Database::getInstance()->getConnection();
    $stmt = $pdo->prepare("SELECT * FROM Cours where enseignant_id  = :id ");
    $stmt->bindValue(':id',$id_enseignant,PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $coursList = [];
    foreach ($result as $row) {
        if($row['contenu_type'] == 'video')
        {
            $coursList[] = new coursVideo($row['id'], $row['titre'], $row['description'], $row['categorie_id'], $row['image_path'],$row['enseignant_id'] ,$row['video_url'],$row['contenu_type'],$row['status']);
        } else 
        {
            $coursList[] = new coursTexte($row['id'], $row['titre'], $row['description'], $row['categorie_id'], $row['image_path'],$row['enseignant_id'] , $row['contenu'],$row['contenu_type'],$row['status']);

        }
    }
    return $coursList;

}
   public static function afficherDeux(){
  
    $pdo = Database::getInstance()->getConnection();
    $stmt = $pdo->query("SELECT * FROM CoursView ORDER BY id DESC LIMIT 2");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $coursList = [];
    foreach ($result as $row) {
        if($row['contenu_type'] == 'video')
        {
            $coursList[] = new coursVideo($row['id'], $row['titre'], $row['description'], $row['categorie_id'], $row['image_path'], $row['video_url'],$row['contenu_type']);
        } else 
        {
            $coursList[] = new coursTexte($row['id'], $row['titre'], $row['description'], $row['categorie_id'], $row['image_path'], $row['contenu'],$row['contenu_type']);

        }
    }
    return $coursList;


}
    public static function searchCours($data)
    {
        $pdo = Database::getInstance()->getConnection();
        $dataSearch = "%" . $data . "%";
        $stmt = $pdo->prepare("SELECT * from CoursView where titre LIKE :data or description LIKE :data ");
    }
   public static function totalCours()
   {
    try {
        $pdo = Database::getInstance()->getConnection();

        $stmt = $pdo->prepare("SELECT COUNT(*) as totalCours from CoursView where status = 'Accepte' ");
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res['totalCours'];
    } catch (Exception $e ) {
        return 401;

    }
   }

    public function update() {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("UPDATE Cours SET titre = :titre, description = :description, id_categorie = :id_categorie, image_path = :image_path, contenue = :contenue, type = :type WHERE id = :id");
        $stmt->bindParam(':titre', $this->titre);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':id_categorie', $this->id_categorie);
        $stmt->bindParam(':image_path', $this->image_path);
        $stmt->bindParam(':contenue', $this->contenue);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    public static function supprimer($id) {
        try {
            $db = Database::getInstance()->getConnection();
            $status = "Archive";
            $stmt = $db->prepare("UPDATE Cours set status = :status WHERE id = :id");

            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':status', $status);
            $res = $stmt->execute();
            if ($res) {
                return 202;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return "Error Deleting Course: " . $e->getMessage();
        }
    }

    public function addEtudiant($etudiant_id) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("INSERT INTO etudiant_cours (cours_id, etudiant_id) VALUES (:cours_id, :etudiant_id)");
        $stmt->bindParam(':cours_id', $this->id);
        $stmt->bindParam(':etudiant_id', $etudiant_id);

        return $stmt->execute();
    }

    public function addTag($tag_id) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("INSERT INTO cours_tag (cours_id, tag_id) VALUES (:cours_id, :tag_id)");
        $stmt->bindParam(':cours_id', $this->id);
        $stmt->bindParam(':tag_id', $tag_id);

        return $stmt->execute();
    }

    public function getId() {
        return $this->id;
    }

    public function getTitre() {
        return $this->titre;
    } 
     public function getStatus() {
        return $this->status;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getIdCategorie() {
        return $this->id_categorie;
    }

    public function setIdCategorie($id_categorie) {
        $this->id_categorie = $id_categorie;
    }

    public function getImagePath() {
        return $this->image_path;
    }

    public function setImagePath($image_path) {
        $this->image_path = $image_path;
    }
    public function getEnseignantId()
    {
        return $this->enseignant_id;
    }

    public function setContenue($contenue) {
        $this->contenue = $contenue;
    }
    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }
}
?>
