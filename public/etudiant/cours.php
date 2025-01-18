<?php?><?php
session_start();
require_once dirname(__DIR__, 3) . '/Youdemy/app/actions/categorie/get.php';
require_once dirname(__DIR__, 3) . '/Youdemy/app/actions/cours/getCours.php';
if(!isset($_SESSION['logged_id']) || $_SESSION['role'] !== 'etudiant')
{
        header('Location: ../index.php');
    
}
$idStudent = $_SESSION['logged_id'];
$categories = getCategory::getAllCategories();
$allCours = getCours::getAllByStudent($idStudent);



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
       <?php include '../header.php'?>

        <!-- Hero Section -->
        <section class="bg-blue-500/5 py-12 px-6 md:px-12">
  <div class="container mx-auto">
    <div class="text-center mb-10">
      <h1 class="text-4xl md:text-5xl font-bold mb-4">
        Tableau de Bord
        <span class="block text-gradient">Statistiques des Cours</span>
      </h1>
      <p class="text-gray-600 md:text-lg">Aperçu de vos performances et de l'engagement des étudiants</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      <!-- Total Students Card -->
      

      <!-- Total Courses Card -->
      <div class="bg-white p-6 rounded-lg shadow-md border border-blue-100 hover:border-blue-300 transition-all">
        <div class="flex items-center justify-between mb-4">
          <div class="p-3 bg-blue-100 rounded-lg">
            <i class="ri-book-open-line text-2xl text-blue-600"></i>
          </div>
          <span class="text-sm text-gray-500">Total Cours</span>
        </div>
        <h3 class="text-3xl font-bold text-gray-800">156</h3>
        <p class="text-green-500 text-sm mt-2 flex items-center">
          <i class="ri-arrow-up-line mr-1"></i>
          +5.3% ce mois
        </p>
      </div>

      <!-- Average Rating Card -->
      <div class="bg-white p-6 rounded-lg shadow-md border border-blue-100 hover:border-blue-300 transition-all">
        <div class="flex items-center justify-between mb-4">
          <div class="p-3 bg-blue-100 rounded-lg">
            <i class="ri-star-line text-2xl text-blue-600"></i>
          </div>
          <span class="text-sm text-gray-500">Note Moyenne</span>
        </div>
        <h3 class="text-3xl font-bold text-gray-800">4.8</h3>
        <p class="text-green-500 text-sm mt-2 flex items-center">
          <i class="ri-arrow-up-line mr-1"></i>
          +0.3 ce mois
        </p>
      </div>

      <!-- Completion Rate Card -->
      <div class="bg-white p-6 rounded-lg shadow-md border border-blue-100 hover:border-blue-300 transition-all">
        <div class="flex items-center justify-between mb-4">
          <div class="p-3 bg-blue-100 rounded-lg">
            <i class="ri-medal-line text-2xl text-blue-600"></i>
          </div>
          <span class="text-sm text-gray-500">Taux Completion</span>
        </div>
        <h3 class="text-3xl font-bold text-gray-800">85%</h3>
        <p class="text-green-500 text-sm mt-2 flex items-center">
          <i class="ri-arrow-up-line mr-1"></i>
          +2.1% ce mois
        </p>
      </div>
    </div>
  </div>
</section>
   


    <!-- Courses Categories Section  -->


    <!-- Courses Grid Section -->

    <section>
    <div class="py-10 md:px-12 px-6">
        <button 
            class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600 transition"
            onclick="toggleModal(true)">
            Add Course
        </button>

        <!-- Existing Course Card -->
        <div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="min-w-full table-auto">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cours</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Enseignant</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date d'inscription</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach ($allCours as $cours): ?>
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <!-- Course Info -->
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="h-12 w-12 flex-shrink-0">
                                <img class="h-12 w-12 rounded-lg object-cover" 
                                     src="../<?php echo htmlspecialchars($cours->getImagePath()); ?>" 
                                     alt="<?php echo htmlspecialchars($cours->getTitre()); ?>">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    <?php echo htmlspecialchars($cours->getTitre()); ?>
                                </div>
                                <div class="text-sm text-gray-500">
                                    <?php echo htmlspecialchars(substr($cours->getDescription(), 0, 60)) . '...'; ?>
                                </div>
                            </div>
                        </div>
                    </td>

                    <!-- Teacher -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900"><?php echo htmlspecialchars($cours->getFullName()); ?></div>
                    </td>

                    <!-- Content Type -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                            <?php echo $cours->getType() === 'video' 
                                ? 'bg-purple-100 text-purple-800' 
                                : 'bg-blue-100 text-blue-800'; ?>">
                            <?php echo $cours->getType() === 'video' ? 'video' : 'text'; ?>
                        </span>
                    </td>

                    <!-- Enrollment Date -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <?php echo date('d/m/Y'); // Replace with actual enrollment date if available ?>
                        </div>
                    </td>

                    <!-- View Action -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="../viewCours.php?coursId=<?php echo $cours->getId(); ?>" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Voir le cours
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Delete Confirmation Modal Script -->
<script>
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
            window.location.href = `../../app/actions/cours/delete.php?idCours=${courseId}`;
        }
    });
}

function editCourse(courseId) {
    // Add your edit course logic here
    // window.location.href = `edit_course.php?id=${courseId}`;
}
</script>
    </div>

    <!-- Modal for Adding a Course -->
    
</section>

<script src = "cours.js">

</script>

    <!-- FAQs Section -->
   

    <!-- Footer Section -->

    <?php include '../footer.php'?>
</body>



</html>