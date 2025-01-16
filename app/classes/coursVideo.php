<?php
require_once 'cours.php';
class coursVideo extends Cours{
    private $video_url;
    public function __construct($id = null, $titre = null, $description = null, $id_categorie = null, $image_path = null, $video_url = null,$enseignant_id = null,$type=null,$status=null) {
        parent::__construct($id,$titre,$description,$id_categorie,$image_path,$enseignant_id,$type,$status);
        $this->video_url = $video_url;
    }
    public  function ajouter()
    {
        $type = 'video';
        $this->setType($type);
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("INSERT INTO Cours (titre, description, categorie_id, image_path, video_url,contenu_type,enseignant_id) VALUES (:titre, :description, :id_categorie, :image_path, :video_url,:type,:enseignant_id)");

        $stmt->bindParam(':titre', $this->titre);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':id_categorie', $this->id_categorie);
        $stmt->bindParam(':image_path', $this->image_path);
        $stmt->bindParam(':enseignant_id', $this->enseignant_id);
        $stmt->bindParam(':video_url', $this->video_url);
        $stmt->bindParam(':type', $this->type);
        if ($stmt->execute()) {
            $this->id = $pdo->lastInsertId();
            return true;
        } else {
            return false;
        }
        
    }
    
    public function mettreAJour() {
        $sql = "UPDATE cours SET titre = :titre, description = :description, categorie_id = :categorie_id, 
                enseignant_id = :enseignant_id, video_url = :video_url WHERE id = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([
            'titre' => $this->titre,
            'description' => $this->description,
            'categorie_id' => $this->categorie_id,
            'enseignant_id' => $this->enseignant_id,
            'video_url' => $this->video_url,
            'id' => $this->id
        ]);
    }

    public function afficherCours() {
        echo $this->video_url;
        echo "<div class='aspect-video bg-gray-900 relative'>
                <video class='w-full h-full' controls>
                    <source src='./$this->video_url' type='video/mp4'>
                    Your browser does not support the video tag.
                </video>
              </div>";
    }
    
    public function getVideo_url() {
        return $this->video_url;
    }
    public function setVideo_url($video_url) {
        return $this->video_url;
    }
}
?>