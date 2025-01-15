<?php

abstract class Cours {
    protected $id;
    protected $titre;
    protected $description;
    protected $categorie_id;
    protected $type;
    protected $enseignant_id;

    protected static $pdo;

    public function __construct($titre, $description, $categorie_id, $type, $enseignant_id) {
        $this->titre = $titre;
        $this->description = $description;
        $this->categorie_id = $categorie_id;
        $this->type = $type;
        $this->enseignant_id = $enseignant_id;
    }

    // Initialisation de la connexion PDO
 

    // Méthodes abstraites pour le polymorphisme
    abstract public function ajouter();
    abstract public function afficher();

    // Méthode de suppression
    public static function supprimer($id) {
        $sql = "DELETE FROM cours WHERE id = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

    // Méthode pour lire un cours par ID
    public static function lireParId($id) {
        $sql = "SELECT * FROM cours WHERE id = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Méthode pour lire tous les cours
    public static function lireTous() {
        $sql = "SELECT * FROM cours";
        $stmt = self::$pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode de mise à jour (à implémenter dans les sous-classes si nécessaire)
    abstract public function mettreAJour($id);
}

class CoursVideo extends Cours {
    private $video_url;

    public function __construct($titre, $description, $categorie_id, $enseignant_id, $video_url) {
        parent::__construct($titre, $description, $categorie_id, 'video', $enseignant_id);
        $this->video_url = $video_url;
    }

    public function ajouter() {
        $sql = "INSERT INTO cours (titre, description, categorie_id, enseignant_id, contenu_type, video_url) 
                VALUES (:titre, :description, :categorie_id, :enseignant_id, 'video', :video_url)";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([
            'titre' => $this->titre,
            'description' => $this->description,
            'categorie_id' => $this->categorie_id,
            'enseignant_id' => $this->enseignant_id,
            'video_url' => $this->video_url
        ]);
    }

    public function afficher() {
        return "<video src ='".$this->video_url."'>";
    }

    public function mettreAJour($id) {
        $sql = "UPDATE cours SET titre = :titre, description = :description, categorie_id = :categorie_id, 
                enseignant_id = :enseignant_id, video_url = :video_url WHERE id = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([
            'titre' => $this->titre,
            'description' => $this->description,
            'categorie_id' => $this->categorie_id,
            'enseignant_id' => $this->enseignant_id,
            'video_url' => $this->video_url,
            'id' => $id
        ]);
    }
}
class CoursTexte extends Cours {
    private $contenu;

    public function __construct($titre, $description, $categorie_id, $enseignant_id, $contenu) {
        parent::__construct($titre, $description, $categorie_id, 'texte', $enseignant_id);
        $this->contenu = $contenu;
    }

    public function ajouter() {
        $sql = "INSERT INTO cours (titre, description, categorie_id, enseignant_id, contenu_type, contenu) 
                VALUES (:titre, :description, :categorie_id, :enseignant_id, 'texte', :contenu)";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([
            'titre' => $this->titre,
            'description' => $this->description,
            'categorie_id' => $this->categorie_id,
            'enseignant_id' => $this->enseignant_id,
            'contenu' => $this->contenu
        ]);
    }

    public function afficher() {
        return "<p> ".$this->contenu." </p>";
    }

    public function mettreAJour($id) {
        $sql = "UPDATE cours SET titre = :titre, description = :description, categorie_id = :categorie_id, 
                enseignant_id = :enseignant_id, contenu = :contenu WHERE id = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([
            'titre' => $this->titre,
            'description' => $this->description,
            'categorie_id' => $this->categorie_id,
            'enseignant_id' => $this->enseignant_id,
            'contenu' => $this->contenu,
            'id' => $id
        ]);
    }
}
?>


<div class="cours-container">
<?php foreach ($cours as $coursItem): ?>
    <div class="cours-card">
        <h2><?= htmlspecialchars($coursItem->titre) ?></h2>
        <p><?= htmlspecialchars($coursItem->description) ?></p>
        <p><strong>Catégorie :</strong> <?= htmlspecialchars($coursItem->categorie_id) ?></p>
        <p><strong>Type :</strong> <?= htmlspecialchars($coursItem->type) ?></p>
        <div class="contenu">
            <?php if ($coursItem instanceof CoursVideo):
                $coursItem->afficher();
                ?>
             
            <?php elseif ($coursItem instanceof CoursTexte): 
                $coursItem->afficher();?>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>
</div>
