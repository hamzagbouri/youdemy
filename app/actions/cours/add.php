<?php

require_once __DIR__ . '/../../classes/coursVideo.php';
require_once __DIR__ . '/../../classes/coursTexte.php';
require_once __DIR__ . '/../../classes/tag.php';
session_start();

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //     $input = file_get_contents('php://input');
        // $data = json_decode($input, true);
//     $titre = $data['title'] ;
//     $description = $data['description'] ;
//     $id_categorie = $data['id_categorie'] ;
//     $type = $data['type'] ; 
//     $enseignant_id = 9; 

//     // Handle file uploads
//     $imagePath = null;
//     if (isset($data['image']) && $data['image']['error'] === UPLOAD_ERR_OK) {
//         $imagePath = '/uploads/images/' . basename($data['image']['name']);
//         move_uploaded_file($data['image']['tmp_name'], __DIR__ . '/../../public' . $imagePath);
//     }

//     if ($type === 'text') {
//         $contenue = $data['content'] ?? null;
//         $cours = new CoursTexte(null, $titre, $description, $id_categorie, $imagePath, $enseignant_id, $contenue, 'texte');
//     } elseif ($type === 'video') {
//         $videoPath = null;
//         if (isset($data['video']) && $data['video']['error'] === UPLOAD_ERR_OK) {
//             $videoPath = '/uploads/videos/' . basename($data['video']['name']);
//             move_uploaded_file($data['video']['tmp_name'], __DIR__ . '/../../public' . $videoPath);
//         }
//         $cours = new CoursVideo(null, $titre, $description, $id_categorie, $imagePath, $enseignant_id, $videoPath, 'video');
//     } else {
//         echo json_encode(['success' => false, 'message' => 'Invalid course type.']);
//         exit;
//     }

//     // Attempt to add the course to the database
//     if ($cours->ajouter()) {
//         echo json_encode(['success' => true, 'message' => 'Course added successfully.']);
//     } else {
//         echo json_encode(['success' => false, 'message' => 'Failed to add the course.']);
//     }
// } else {
//     echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
// }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $titre = $_POST['title'];
        $description = $_POST['description'];
        $id_categorie = $_POST['categorie'];
        $type = $_POST['type'];
        $enseignant_id = $_SESSION['logged_id'];

        $imagePath = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imagePath = '/uploads/images/' . basename($_FILES['image']['name']);
            $destination = __DIR__ . '/../../../public' . $imagePath;

            if (!move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
                throw new Exception('Failed to upload image.');
            }
        }

        if ($type === 'text') {
            $contenue = $_POST['content'] ?? null;
            $cours = new CoursTexte(null, $titre, $description, $id_categorie, $imagePath, $enseignant_id, $contenue, 'texte');
        } elseif ($type === 'video') {
            $videoPath = null;
            if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
                $videoPath = '/uploads/videos/' . basename($_FILES['video']['name']);
                $videoDestination = __DIR__ . '/../../../public' . $videoPath;

                if (!move_uploaded_file($_FILES['video']['tmp_name'], $videoDestination)) {
                    throw new Exception('Failed to upload video.');
                }
            }
            $cours = new CoursVideo(null, $titre, $description, $id_categorie, $imagePath, $videoPath, $enseignant_id,  'video');
        } else {
            throw new Exception('Invalid course type.');
        }

        if ($cours->ajouter()) {
            $selectedTags = json_decode($_POST['selectedTags'], true);
            if ($selectedTags) {
                foreach ($selectedTags as $tag) {
                    if (strpos($tag['id'], 'new') === 0) {
                        $nom = htmlspecialchars($tag['titre']);
                        $newTag = new Tag(null,$nom);
                        $result = $newTag->add(); 
                        $tagId=$newTag->getId();
                    } else {
                        $tagId = $tag['id'];
                    }
    
                    $cours->attachTag($tagId);
                }
            }
            echo json_encode(['success' => true, 'message' => 'Course added successfully.']);
        } else {
            throw new Exception('Failed to add the course to the database.');
        }
    } catch (Exception $e) {
        $errorLog = __DIR__ . '/../../../logs/error.log';
        file_put_contents($errorLog, '[' . date('Y-m-d H:i:s') . '] ' . $e->getMessage() . PHP_EOL, FILE_APPEND);

        echo json_encode(['success' => false, 'message' => 'An error occurred. Please try again later.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}

    


?>