<?php?><?php

require_once __DIR__. '/../app/actions/categorie/get.php';
require_once __DIR__ . '/../app/actions/cours/getCours.php';
require_once __DIR__ . '/../app/actions/etudiant/coursEtudiant.php';
if(!isset($_SESSION['logged_id']) || !isset($_GET['coursId']))
{
        header('Location: index.php');
    
}
$mine = false;

$idCours = trim(htmlspecialchars($_GET['coursId']));

$id = $_SESSION['logged_id'];
$categories = getCategory::getAllCategories();
$cours = getCours::getById($idCours);
$allEtudiants = coursEtudiant::getEtudiantsByCours($cours->getId());

if($_SESSION['role'] == 'enseignant')
{
   
    $cours = getCours::getByIdProf($idCours);
    if($cours->getEnseignantId() == $id)
    {
        $mine = true;
    }
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="./assets/images/favicon.svg">
    <script src="./assets/scripts/main.js" defer></script>
    <style>
        .text-gradient {
            background: linear-gradient(to right, #87CEEB, #003366);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
   
     <script>
        tailwind.config = {
            theme: {
            extend: {
                colors: {
                primary: '#003366',
                borderColor: '#5f5d5d',
                secondary: '#1A73E8',
                },
                fontFamily: {
                // primary: ['Consolas', 'monospace'],
                primary: ['Playfair Display', 'serif'],
                // primary: ['EB Garamond', 'serif'],
                secondary: ['Pattaya', 'sans-serif'],
                },
            },
            },
        };
        </script>
</head>

<body>



        <!-- Header -->
       <?php include 'header.php'?>




    <!-- Courses Categories Section  -->


    <!-- Courses Grid Section -->


    <section>
    <div class="container mx-auto px-4 py-12">
        <!-- Course Header -->
        <div class="max-w-5xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg mb-8">
                <div class="p-8">
                    <div class="flex gap-3 mb-4">
                        <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm font-medium">
                            Programming
                        </span>
                        <span class="bg-purple-100 text-purple-600 px-3 py-1 rounded-full text-sm font-medium">
                            Video Course
                        </span>
                    </div>
                    <?php if($mine): ?>
                    <div class="flex gap-2">
                        <button 
                            onclick="editCourse(<?php echo $cours->getId(); ?>)"
                            class="flex items-center gap-2 px-4 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors">
                            <i class="ri-edit-line"></i>
                            Edit
                        </button>
                        <button 
                            onclick="confirmDelete(<?php echo $cours->getId(); ?>)"
                            class="flex items-center gap-2 px-4 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors">
                            <i class="ri-delete-bin-line"></i>
                            Delete
                        </button>
                    </div>
                    <?php endif; ?>
                    <h1 class="text-3xl font-bold text-gray-800 mb-4"><?php echo $cours->getTitre() ?></h1>
                    <p class="text-gray-600 text-lg mb-6"><?php echo $cours->getDescription() ?>.</p>
                    
                    <!-- Instructor Info -->
                    <div class="flex items-center gap-4 pb-4 border-b">
                        <img src="https://placehold.co/48x48" alt="Instructor" class="w-12 h-12 rounded-full">
                        <div>
                            <p class="font-medium text-gray-800">Dr. <?php echo $cours->getFullName() ?></p>
                            <p class="text-gray-500 text-sm">Senior Web Development Instructor</p>
                        </div>
                    </div>
                </div>
                
                <?php  $cours->afficherCours() ?>
   
         
                
                
                <!-- Course Content -->
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Main Content -->
                        <div class="md:col-span-2">
                            <h2 class="text-2xl font-bold mb-6">Course Overview </h2>
                          
                            <div class="prose max-w-none">
                                <p class="text-gray-600 mb-4">In this comprehensive course, you'll learn:</p>
                                <ul class="space-y-2 text-gray-600">
                                    <li>HTML5 semantic elements and modern markup</li>
                                    <li>CSS3 layouts, animations, and responsive design</li>
                                    <li>JavaScript ES6+ and DOM manipulation</li>
                                    <li>Modern framework integration and best practices</li>
                                </ul>
                            </div>

                            <!-- Text Content Example -->
                            <div class="mt-8 p-6 bg-gray-50 rounded-xl">
                                <h3 class="text-xl font-bold mb-4">Introduction to Web Development</h3>
                                <div class="prose max-w-none text-gray-600">
                                    <p>Web development is the process of building and maintaining websites. It encompasses several different aspects, including web design, web publishing, web programming, and database management...</p>
                                </div>
                            </div>
                        </div>

                        <!-- Sidebar -->
                        <div class="md:col-span-1">
                            <div class="bg-gray-50 rounded-xl p-6">
                                <h3 class="font-bold mb-4">Course Modules</h3>
                                <div class="space-y-3">
                                    <div class="flex items-center gap-3 p-3 bg-blue-50 rounded-lg">
                                        <i class="ri-play-circle-line text-xl text-blue-500"></i>
                                        <span class="flex-1 font-medium">Getting Started</span>
                                        <span class="text-sm text-gray-500">15:00</span>
                                    </div>
                                    <div class="flex items-center gap-3 p-3 hover:bg-gray-100 rounded-lg">
                                        <i class="ri-file-text-line text-xl text-gray-400"></i>
                                        <span class="flex-1">HTML Basics</span>
                                        <span class="text-sm text-gray-500">20:30</span>
                                    </div>
                                    <div class="flex items-center gap-3 p-3 hover:bg-gray-100 rounded-lg">
                                        <i class="ri-file-text-line text-xl text-gray-400"></i>
                                        <span class="flex-1">CSS Fundamentals</span>
                                        <span class="text-sm text-gray-500">25:15</span>
                                    </div>
                                </div>

                                <!-- Course Resources -->
                                <div class="mt-6">
                                    <h3 class="font-bold mb-4">Course Resources</h3>
                                    <div class="space-y-3">
                                        <div class="flex items-center gap-3 p-3 bg-white rounded-lg shadow-sm">
                                            <i class="ri-file-pdf-line text-xl text-red-500"></i>
                                            <span class="flex-1 text-sm">Course Syllabus</span>
                                            <i class="ri-download-line text-gray-400"></i>
                                        </div>
                                        <div class="flex items-center gap-3 p-3 bg-white rounded-lg shadow-sm">
                                            <i class="ri-file-zip-line text-xl text-orange-500"></i>
                                            <span class="flex-1 text-sm">Project Files</span>
                                            <i class="ri-download-line text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php if($mine) {?>
    <div class="p-8 border-t">
    <h2 class="text-2xl font-bold mb-6">Enrolled Students</h2>
    
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <!-- Table Header -->
        <div class="grid grid-cols-3 gap-4 p-4 bg-gray-50 border-b text-sm font-medium text-gray-600">
            <div>Student Name</div>
            <div>Email</div>
            <div>Inscription Date</div>
        </div>
        
        <!-- Table Body -->
        <div class="divide-y">
            <?php foreach($allEtudiants as $etudiant): ?>
            <div class="grid grid-cols-3 gap-4 p-4 items-center hover:bg-gray-50 transition-colors">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <span class="text-blue-600 font-medium">
                            <?php echo substr($etudiant['fullName'], 0, 1); ?>
                        </span>
                    </div>
                    <span class="font-medium text-gray-800"><?php echo $etudiant['fullName']; ?></span>
                </div>
                <div class="text-gray-600"><?php echo $etudiant['email']; ?></div>
                <div class="text-gray-600">
                    <?php echo date('d M Y', strtotime($etudiant['date_inscription'])); ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php } ?>
<script >
function confirmDelete(courseId) {
    Swal.fire({
        title: 'Delete Course?',
        text: "This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `../app/actions/cours/delete.php?idCours=${courseId}`;
        }
    });
}
</script>

    <!-- FAQs Section -->
   

    <!-- Footer Section -->

    <?php include 'footer.php'?>
</body>



</html>