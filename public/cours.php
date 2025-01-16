<?php

require_once __DIR__ . '../../app/actions/cours/getCours.php';
require_once __DIR__ . '../../app/actions/categorie/get.php';
$cours = getCours::getCoursPagination(0);
$categories = getCategory::getAllCategories();
$totalCours = getCours::totalCours();
$totalPage = ceil($totalCours/6);


if(isset($_GET['page']))
{
    $page = trim(htmlspecialchars($_GET['page']));
    $start = ($page-1) *6;
    $cours = getCours::getCoursPagination($start);
}
if(isset($_POST['search']))
{
    $cours = getCours::searchCours($data);
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

        <!-- Hero Section -->
        

    <!-- Courses Categories Section  -->
    <section class="py-16 px-4 bg-white">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-4">
                    Explore Top Courses
                    <span
                        class="bg-gradient-to-r from-blue-600 to-blue-300 bg-clip-text text-transparent">Categories</span>
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Find the perfect course to enhance your skills and advance your career. Choose from our wide range
                    of professional courses designed by industry experts.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach($categories as $categorie) 
                {
                    echo " <div
                    class='bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow border border-gray-100 hover:border-blue-400 hover:scale-105 transition-transform duration-300'>
                    <div class='flex items-center gap-4'>
                        <div class='p-3 bg-blue-400 text-white rounded-lg'>
                            <i class='ri-code-line text-2xl'></i>
                        </div>
                        <div>
                            <h3 class='font-semibold text-lg'>".$categorie->getTitre()."</h3>
                            <p class='text-gray-500 text-sm'>1 Course</p>
                        </div>
                    </div>
                </div>";
                }
                ?>

                
            </div>
           
        </div>
    </section>


    <!-- Courses Grid Section -->
    <section>
        <div class=" py-10 md:px-12 px-6">
            <h2 class="text-4xl font-bold text-gray-800 mb-6 text-center md:mb-11">
                Our Recent <span
                    class="text-gradient bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-blue-600">Courses</span>
            </h2>
            <div class="mb-10 flex justify-center">
            <div class="relative w-full max-w-lg">
                <input 
                    type="text" 
                    id="searchInput" 
                    placeholder="Search for a course..." 
                    class="w-full py-3 px-6 rounded-full border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 ease-in-out"
                />
                <div class="absolute right-4 top-3.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 hover:text-blue-500 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M18 10a8 8 0 11-16 0 8 8 0 0116 0z" />
                    </svg>
                </div>
            </div>
        </div>
            <div class="flex flex-wrap gap-6 justify-center items-center">
                <?php
                
                foreach($cours as $cou)
                {
                    
                    if($cou instanceof coursVideo)
                    {
                        ?>
                        
                        <div class="bg-white rounded-2xl w-[30%] shadow-lg overflow-hidden transform transition-transform hover:scale-[1.02] hover:shadow-xl">
                    <div class="relative">
                        <div class="">
                            <img src="./<?php echo $cou->getImagePath() ?>   " alt="Course thumbnail" class="">
                            
                        </div>
                        <div class="absolute top-4 right-4">
                            <span class="bg-blue-500 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-md">
                                Video Course
                            </span>
                        </div>
                    </div>
                    <div class="p-8">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="text-sm font-medium px-3 py-1 rounded-full bg-blue-100 text-blue-600">
                                Programming
                            </span>
                            <span class="text-sm font-medium px-3 py-1 rounded-full bg-purple-100 text-purple-600">
                                4 Hours
                            </span>
                        </div>
                        <h3 class="text-2xl font-bold mb-3 text-gray-800">
                        <?php echo $cou->getTitre() ?>
                        </h3>
                        <p class="text-gray-600 mb-6 line-clamp-2">
                        <?php echo $cou->getDescription() ?>                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <img src="instructor-avatar.jpg" alt="Instructor" class="w-10 h-10 rounded-full">
                                <span class="text-sm font-medium text-gray-700">
                                    Prof. Sarah Johnson
                                </span>
                            </div>
                            <a href="viewCours.php?coursId=<?php echo $cou->getId();?>" class="text-blue-500 hover:text-blue-700 font-medium">
                                View Course →
                            </a>
                        </div>
                    </div>
                </div>
                        <?php
                    } else {
                        ?>
                <div class="bg-white rounded-2xl w-[30%] shadow-lg overflow-hidden transform transition-transform hover:scale-[1.02] hover:shadow-xl">
                <div class="relative">
                    <div class="">
                       <img src="./<?php echo $cou->getImagePath() ?> " alt="">
                    </div>
                    <div class="absolute top-4 right-4">
                        <span class="bg-emerald-500 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-md">
                            Text Course
                        </span>
                    </div>
                </div>
                <div class="p-8">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-sm font-medium px-3 py-1 rounded-full bg-emerald-100 text-emerald-600">
                            Mathematics
                        </span>
                        <span class="text-sm font-medium px-3 py-1 rounded-full bg-teal-100 text-teal-600">
                            12 Lessons
                        </span>
                    </div>
                    <h3 class="text-2xl font-bold mb-3 text-gray-800">
                        <?php echo $cou->getTitre() ?>
                    </h3>
                    <p class="text-gray-600 mb-6 line-clamp-2">
                        <?php echo $cou->getDescription() ?>   
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <img src="instructor-avatar.jpg" alt="Instructor" class="w-10 h-10 rounded-full">
                            <span class="text-sm font-medium text-gray-700">
                                Dr. Michael Chen
                            </span>
                        </div>
                        <button class="text-emerald-500 hover:text-emerald-700 font-medium">
                            View Course →
                        </button>
                    </div>
                </div>
            </div>
                        <?php
                    }
                }
                ?>
            </div>
           
        </div>
        <div class="flex w-full justify-center items-center gap-2">
            <?php
            for($i =1;$i<=$totalPage;$i++)
            echo " <a href='cours.php?page=$i' class='py-1 px-3 rounded-xl hover:bg-blue-500 hover:text-white  border'>$i</a>
"
            ?>
                
            </div>
    </section>

    <!-- FAQs Section -->
    
    <!-- Footer Section -->

    <?php include 'footer.php'?>
    <script src="assets/scripts/main.js"></script>
</body>



</html>