<?php?><?php
// session_start();
// if(!isset($_SESSION['logged_id']) || $_SESSION['role'] !== 'enseignant')
// {
//         header('Location: index.php');
    
// }
// require_once dirname(__DIR__, 3) . '/Youdemy/app/actions/categorie/get.php';
// require_once dirname(__DIR__, 3) . '/Youdemy/app/actions/cours/getCours.php';
// $categories = getCategory::getAllCategories();
// $cours = getCours::getAll();



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
        <section
            class="hero bg-blue-500/5 flex-grow flex items-center bg-opacity-20   bg-cover bg-center">
            <div class="container mx-auto flex flex-col items-center py-12 px-6 md:px-12">
                <div class="text-center space-y-6">
                    <h1 class="text-4xl md:text-5xl font-bold">
                        Share with us your courses<br>
                        <span class="text-gradient md:leading-relaxed">Your Courses are here</span>
                    </h1>
                    <p class="text-gray-600 md:text-lg">
                        Empower Your Mind with World-Class Learning – Join Youdemy Today
                    </p>

                    <!-- Search Bar -->
                    
                    <div class="flex items-center flex justify-center space-x-2">
                        <span class="text-blue-400 text-xl">
                            <i class="ri-star-fill"></i>
                        </span>
                        <p class="text-gray-600">5-Star Ratings for Learning, Course Quality, and Student Success</p>
                    </div>

                </div>
            </div>
        </section>
    </div>


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
                    <h1 class="text-3xl font-bold text-gray-800 mb-4">Complete Web Development Bootcamp 2024</h1>
                    <p class="text-gray-600 text-lg mb-6">Master modern web development with this comprehensive course covering HTML, CSS, JavaScript, and popular frameworks.</p>
                    
                    <!-- Instructor Info -->
                    <div class="flex items-center gap-4 pb-4 border-b">
                        <img src="https://placehold.co/48x48" alt="Instructor" class="w-12 h-12 rounded-full">
                        <div>
                            <p class="font-medium text-gray-800">Dr. Sarah Johnson</p>
                            <p class="text-gray-500 text-sm">Senior Web Development Instructor</p>
                        </div>
                    </div>
                </div>
                
                <!-- Video Content Example -->
                <div class="aspect-video bg-gray-900">
                    <div class="w-full h-full flex items-center justify-center">
                        <div class="text-center">
                            <div class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="ri-play-fill text-4xl text-white"></i>
                            </div>
                            <p class="text-white/70 text-sm">Preview video available</p>
                        </div>
                    </div>
                </div>
                
                <!-- Course Content -->
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Main Content -->
                        <div class="md:col-span-2">
                            <h2 class="text-2xl font-bold mb-6">Course Overview</h2>
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
<script src = "cours.js">

</script>

    <!-- FAQs Section -->
   

    <!-- Footer Section -->

    <?php include 'footer.php'?>
</body>



</html>