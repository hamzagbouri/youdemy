<?php
require_once __DIR__ . '/../../classes/coursVideo.php';
require_once __DIR__ . '/../../classes/coursTexte.php';
require_once __DIR__ . '/../../classes/tag.php';
session_start();
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     try {
//         $courseId = $_POST['courseId'];
//         $titre = $_POST['title'];
//         $description = $_POST['description'];
//         $id_categorie = $_POST['categorie'];
//         $type = $_POST['type'];
//         $enseignant_id = $_SESSION['logged_id'];
//         $cours = Cours::afficherParId($courseId); 
//         if (!$cours) {
//             throw new Exception('Course not found.');
//         }


//         if (($cours instanceof CoursTexte && $type === 'video') || ($cours instanceof CoursVideo && $type === 'texte')) {
//             $cours->detachAllTags();
//             Cours::supprimer($cours->getId());
//             if ($type === 'texte') {
//                 $contenue = $_POST['content'] ?? null;
//                 $newCourse = new CoursTexte(null, $titre, $description, $id_categorie, $cours->getImagePath(), $enseignant_id, $contenue, 'texte');
//             } elseif ($type === 'video') {
//                 $videoPath = null;
//                 if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
//                     $videoPath = '/uploads/videos/' . basename($_FILES['video']['name']);
//                     $videoDestination = __DIR__ . '/../../../public' . $videoPath;

//                     if (!move_uploaded_file($_FILES['video']['tmp_name'], $videoDestination)) {
//                         throw new Exception('Failed to upload video.');
//                     }
//                 }
//                 $newCourse = new CoursVideo(null, $titre, $description, $id_categorie, $cours->getImagePath(), $videoPath, $enseignant_id, 'video');
//             }


//             if (!$newCourse->ajouter()) {
//                 throw new Exception('Failed to save the updated course.');
//             }

//             $cours = $newCourse; 
//         } else {
            
//             $cours->setTitre($titre);
//             $cours->setDescription($description);
//             $cours->setCategorieId($id_categorie);

          
//             if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
//                 $imagePath = '/uploads/images/' . basename($_FILES['image']['name']);
//                 $destination = __DIR__ . '/../../../public' . $imagePath;

//                 if (!move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
//                     throw new Exception('Failed to upload image.');
//                 }
//                 $cours->setImagePath($imagePath);
//             }

       
//             if ($type === 'texte') {
//                 $contenue = $_POST['content'] ?? null;
//                 $cours->setContenue($contenue);
//             } elseif ($type === 'video') {
//                 if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
//                     $videoPath = '/uploads/videos/' . basename($_FILES['video']['name']);
//                     $videoDestination = __DIR__ . '/../../../public' . $videoPath;

//                     if (!move_uploaded_file($_FILES['video']['tmp_name'], $videoDestination)) {
//                         throw new Exception('Failed to upload video.');
//                     }
//                     $cours->setVideoPath($videoPath);
//                 }
//             }

            
//             if (!$cours->update()) {
//                 throw new Exception('Failed to update the course.');
//             }
//         }

        
//         $selectedTags = json_decode($_POST['selectedTags'], true);
//         if ($selectedTags) {
//             $cours->detachAllTags();
//             foreach ($selectedTags as $tag) {
//                 if (strpos($tag['id'], 'new') === 0) {
//                     $nom = htmlspecialchars($tag['titre']);
//                     $newTag = new Tag(null, $nom);
//                     $newTag->add();
//                     $tagId = $newTag->getId();
//                 } else {
//                     $tagId = $tag['id'];
//                 }
//                 $cours->addTag($tagId);
//             }
//         }

//         echo json_encode(['success' => true, 'message' => 'Course updated successfully.']);
//     } catch (Exception $e) {
//         $errorLog = __DIR__ . '/../../../logs/error.log';
//         file_put_contents($errorLog, '[' . date('Y-m-d H:i:s') . '] ' . $e->getMessage() . PHP_EOL, FILE_APPEND);
//         echo json_encode(['success' => false, 'message' => 'An error occurred. Please try again later.']);
//     }
// } else {
//     echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
// }






if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {

        $courseId = $_POST['courseId'];
        $titre = $_POST['title'];
        $description = $_POST['description'];
        $id_categorie = $_POST['categorie'];
        $type = $_POST['type'];
        $enseignant_id = $_SESSION['logged_id'];
        // $enseignant_id = 14;
        $cours = Cours::afficherParId($courseId); 
        if (!$cours) {
            throw new Exception('Course not found.');
        }


        if (($cours instanceof CoursTexte && $type === 'video') || ($cours instanceof CoursVideo && $type === 'texte')) {
            $cours->detachAllTags();
           
            Cours::supprimerCours($cours->getId());
            if ($type === 'texte') {
                $contenue = $_POST['content'] ?? null;
                $newCourse = new CoursTexte(null, $titre, $description, $id_categorie, $cours->getImagePath(), $enseignant_id, $contenue, 'texte');
            } elseif ($type === 'video') {
                $videoPath = null;
                if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
                    $videoPath = '/uploads/videos/' . basename($_FILES['video']['name']);
                    $videoDestination = __DIR__ . '/../../../public' . $videoPath;

                    if (!move_uploaded_file($_FILES['video']['tmp_name'], $videoDestination)) {
                        throw new Exception('Failed to upload video.');
                    }
                }
                $newCourse = new CoursVideo(null, $titre, $description, $id_categorie, $cours->getImagePath(), $videoPath, $enseignant_id, 'video');
            }


            if (!$newCourse->ajouter()) {
                throw new Exception('Failed to save the updated course.');
            }

            $cours = $newCourse; 
        } else {
            
            $cours->setTitre($titre);
            $cours->setDescription($description);
            $cours->setIdCategorie($id_categorie);

          
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $imagePath = '/uploads/images/' . basename($_FILES['image']['name']);
                $destination = __DIR__ . '/../../../public' . $imagePath;

                if (!move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
                    throw new Exception('Failed to upload image.');
                }
                $cours->setImagePath($imagePath);
            }

       
            if ($type === 'texte') {
                $contenue = trim($_POST['content']) ?? null;
                $cours->setContenue($contenue);
            } elseif ($type === 'video') {
                if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
                    $videoPath = '/uploads/videos/' . basename($_FILES['video']['name']);
                    $videoDestination = __DIR__ . '/../../../public' . $videoPath;

                    if (!move_uploaded_file($_FILES['video']['tmp_name'], $videoDestination)) {
                        throw new Exception('Failed to upload video.');
                    }
                    $cours->setVideoPath($videoPath);
                }
            }
            
            $res = $cours->mettreAJour();
            
            if (!$res) {
                throw new Exception('Failed to update the course.');
            }
        }

        
        $selectedTags = json_decode($_POST['selectedTags'], true);
        // $selectedTags = $data['selectedTags'];
        if ($selectedTags) {
            $cours->detachAllTags();
            foreach ($selectedTags as $tag) {
                if (strpos($tag['id'], 'new') === 0) {
                    $nom = htmlspecialchars($tag['titre']);
                    $newTag = new Tag(null, $nom);
                    $newTag->add();
                    $tagId = $newTag->getId();
                } else {
                    $tagId = $tag['id'];
                }
                $cours->addTag($tagId);
            }
        }

        echo json_encode(['success' => true, 'message' => 'Course updated successfully.','coursId' => $cours->getId()]);
    } catch (Exception $e) {
        $errorLog = __DIR__ . '/../../../logs/error.log';
        file_put_contents($errorLog, '[' . date('Y-m-d H:i:s') . '] ' . $e->getMessage() . PHP_EOL, FILE_APPEND);
        echo json_encode(['success' => false, 'message' => 'An error occurred. Please try again later.'. $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     try {
//         $input = file_get_contents('php://input');
//         $data = json_decode($input, true);
//         $courseId = $data['courseId'];
//         $titre = $data['title'];
//         $description = $data['description'];
//         $id_categorie = $data['categorie'];
//         $type = $data['type'];
//         // $enseignant_id = $_SESSION['logged_id'];
//         $enseignant_id = 14;
//         $cours = Cours::afficherParId($courseId); 
//         if (!$cours) {
//             throw new Exception('Course not found.');
//         }


//         if (($cours instanceof CoursTexte && $type === 'video') || ($cours instanceof CoursVideo && $type === 'texte')) {
//             $cours->detachAllTags();
//             echo "hna";
//             Cours::supprimerCours($cours->getId());
//             if ($type === 'texte') {
//                 $contenue = $data['content'] ?? null;
//                 $newCourse = new CoursTexte(null, $titre, $description, $id_categorie, $cours->getImagePath(), $enseignant_id, $contenue, 'texte');
//             } elseif ($type === 'video') {
//                 $videoPath = null;
//                 if (isset($data['video']) && $data['video']['error'] === UPLOAD_ERR_OK) {
//                     $videoPath = '/uploads/videos/' . basename($data['video']['name']);
//                     $videoDestination = __DIR__ . '/../../../public' . $videoPath;

//                     if (!move_uploaded_file($data['video']['tmp_name'], $videoDestination)) {
//                         throw new Exception('Failed to upload video.');
//                     }
//                 }
//                 $newCourse = new CoursVideo(null, $titre, $description, $id_categorie, $cours->getImagePath(), $videoPath, $enseignant_id, 'video');
//             }


//             if (!$newCourse->ajouter()) {
//                 throw new Exception('Failed to save the updated course.');
//             }

//             $cours = $newCourse; 
//         } else {
            
//             $cours->setTitre($titre);
//             $cours->setDescription($description);
//             $cours->setIdCategorie($id_categorie);

          
//             if (isset($data['image']) && $data['image']['error'] === UPLOAD_ERR_OK) {
//                 $imagePath = '/uploads/images/' . basename($data['image']['name']);
//                 $destination = __DIR__ . '/../../../public' . $imagePath;

//                 if (!move_uploaded_file($data['image']['tmp_name'], $destination)) {
//                     throw new Exception('Failed to upload image.');
//                 }
//                 $cours->setImagePath($imagePath);
//             }

       
//             if ($type === 'texte') {
//                 $contenue = $data['content'] ?? null;
//                 $cours->setContenue($contenue);
//             } elseif ($type === 'video') {
//                 if (isset($data['video']) && $data['video']['error'] === UPLOAD_ERR_OK) {
//                     $videoPath = '/uploads/videos/' . basename($data['video']['name']);
//                     $videoDestination = __DIR__ . '/../../../public' . $videoPath;

//                     if (!move_uploaded_file($data['video']['tmp_name'], $videoDestination)) {
//                         throw new Exception('Failed to upload video.');
//                     }
//                     $cours->setVideoPath($videoPath);
//                 }
//             }
//             echo 'aa';
//             $res = $cours->mettreAJour();
//             var_dump($res);
//             if (!$res) {
//                 throw new Exception('Failed to update the course.');
//             }
//         }

        
//         // $selectedTags = json_decode($data['selectedTags'], true);
//         $selectedTags = $data['selectedTags'];
//         if ($selectedTags) {
//             $cours->detachAllTags();
//             foreach ($selectedTags as $tag) {
//                 if (strpos($tag['id'], 'new') === 0) {
//                     $nom = htmlspecialchars($tag['titre']);
//                     $newTag = new Tag(null, $nom);
//                     $newTag->add();
//                     $tagId = $newTag->getId();
//                 } else {
//                     $tagId = $tag['id'];
//                 }
//                 $cours->addTag($tagId);
//             }
//         }

//         echo json_encode(['success' => true, 'message' => 'Course updated successfully.']);
//     } catch (Exception $e) {
//         $errorLog = __DIR__ . '/../../../logs/error.log';
//         file_put_contents($errorLog, '[' . date('Y-m-d H:i:s') . '] ' . $e->getMessage() . PHP_EOL, FILE_APPEND);
//         echo json_encode(['success' => false, 'message' => 'An error occurred. Please try again later.'. $e->getMessage()]);
//     }
// } else {
//     echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
// }
