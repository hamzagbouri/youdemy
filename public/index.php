<?php
session_start();
require_once __DIR__ . '../../app/actions/cours/getCours.php';
require_once __DIR__ . '../../app/actions/categorie/get.php';
$cours = getCours::getTwo();
$categories = getCategory::getAllCategories();


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
        <section
            class="hero bg-blue-500/5 flex-grow flex items-center bg-opacity-20   bg-cover bg-center">
            <div class="container mx-auto flex flex-col items-center py-12 px-6 md:px-12">
                <div class="text-center space-y-6">
                    <h1 class="text-4xl md:text-5xl font-bold">
                        Learn Anything, Anytime, Anywhere <br>
                        <span class="text-gradient md:leading-relaxed">Your Future Starts Here</span>
                    </h1>
                    <p class="text-gray-600 md:text-lg">
                        Empower Your Mind with World-Class Learning – Join Youdemy Today
                    </p>

                    <!-- Search Bar -->
                    <div class="mt-8">
                        <div class="relative">
                            <input type="text" placeholder="What Do You Need To Learn?"
                                class="w-full p-3 pl-4 rounded-full border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                            <button
                                class="bg-blue-400 absolute right-1 top-1 bottom-1 px-4 bg-bg-blue-500 text-white rounded-full hover:bg-bg-blue-500">
                                Search
                            </button>
                        </div>
                    </div>
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
            <div class="flex flex-wrap gap-6 justify-center items-center">
                <?php
                foreach($cours as $cou)
                {
                    if($cou instanceof coursVideo)
                    {
                        ?>
                        
                        <div class="bg-white rounded-2xl w-[40%] shadow-lg overflow-hidden transform transition-transform hover:scale-[1.02] hover:shadow-xl">
                    <div class="relative">
                        <div class="">
                            <img src="./<?php echo $cou->getImagePath() ?>   " alt="Course thumbnail" class="h-[20%] w-full">
                            
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
                                    Prof. <?php echo $cou->getFullName() ?>
                                </span>
                            </div>
                            <button class="text-blue-500 hover:text-blue-700 font-medium">
                                View Course →
                            </button>
                        </div>
                    </div>
                </div>
                        <?php
                    } else {
                        ?>
                <div class="bg-white rounded-2xl w-[40%] shadow-lg overflow-hidden transform transition-transform hover:scale-[1.02] hover:shadow-xl">
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
                                Dr. <?php echo $cou->getFullName() ?>
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

    </section>

    <!-- FAQs Section -->
    <section>
        <div class="py-10 md:px-12 px-6">
            <div class="flex flex-wrap justify-center items-center mb-12 text-center">
                <h2 class="text-3xl font-bold text-gray-800">
                    FAQs About <span
                        class="text-gradient bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-blue-600">Youdemy
                        Platform</span>
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                <div class="border border-blue-400 rounded-lg p-4 shadow-sm hover:shadow-md transition">
                    <button onclick="toggleAnswer(this)"
                        class="flex justify-between items-center w-full text-left font-semibold text-lg text-gray-800">
                        What is Youdemy Platform?
                        <i class="ri-arrow-down-s-line text-blue-400"></i>
                    </button>
                    <div
                        class="answer hidden max-h-0 overflow-hidden transition-[max-height] duration-300 ease-in-out mt-2">
                        <p class="text-gray-600">
                            Youdemy is a leading online learning platform offering courses in various domains to help
                            learners achieve their goals.
                        </p>
                    </div>
                </div>

                <div class="border border-blue-400 rounded-lg p-4 shadow-sm hover:shadow-md transition">
                    <button onclick="toggleAnswer(this)"
                        class="flex justify-between items-center w-full text-left font-semibold text-lg text-gray-800">
                        How can I enroll in a Youdemy course?
                        <i class="ri-arrow-down-s-line text-blue-400"></i>
                    </button>
                    <div
                        class="answer hidden max-h-0 overflow-hidden transition-[max-height] duration-300 ease-in-out mt-2">
                        <p class="text-gray-600">
                            You can enroll by signing up on our platform, browsing courses, and selecting the one that
                            suits
                            your needs.
                        </p>
                    </div>
                </div>

                <div class="border border-blue-400 rounded-lg p-4 shadow-sm hover:shadow-md transition">
                    <button onclick="toggleAnswer(this)"
                        class="flex justify-between items-center w-full text-left font-semibold text-lg text-gray-800">
                        Are the courses on Youdemy certified?
                        <i class="ri-arrow-down-s-line text-blue-400"></i>
                    </button>
                    <div
                        class="answer hidden max-h-0 overflow-hidden transition-[max-height] duration-300 ease-in-out mt-2">
                        <p class="text-gray-600">
                            Yes, many of our courses provide certificates of completion that you can showcase
                            professionally.
                        </p>
                    </div>
                </div>

                <div class="border border-blue-400 rounded-lg p-4 shadow-sm hover:shadow-md transition">
                    <button onclick="toggleAnswer(this)"
                        class="flex justify-between items-center w-full text-left font-semibold text-lg text-gray-800">
                        What is the pricing for Youdemy courses?
                        <i class="ri-arrow-down-s-line text-blue-400"></i>
                    </button>
                    <div
                        class="answer hidden max-h-0 overflow-hidden transition-[max-height] duration-300 ease-in-out mt-2">
                        <p class="text-gray-600">
                            Youdemy offers competitive pricing with occasional discounts, making high-quality education
                            affordable for everyone.
                        </p>
                    </div>
                </div>

                <div class="border border-blue-400 rounded-lg p-4 shadow-sm hover:shadow-md transition">
                    <button onclick="toggleAnswer(this)"
                        class="flex justify-between items-center w-full text-left font-semibold text-lg text-gray-800">
                        Can I access Youdemy courses offline?
                        <i class="ri-arrow-down-s-line text-blue-400"></i>
                    </button>
                    <div
                        class="answer hidden max-h-0 overflow-hidden transition-[max-height] duration-300 ease-in-out mt-2">
                        <p class="text-gray-600">
                            Yes, our mobile app allows you to download course content and access it offline at your
                            convenience.
                        </p>
                    </div>
                </div>

                <div class="border border-blue-400 rounded-lg p-4 shadow-sm hover:shadow-md transition">
                    <button onclick="toggleAnswer(this)"
                        class="flex justify-between items-center w-full text-left font-semibold text-lg text-gray-800">
                        What topics are covered on Youdemy?
                        <i class="ri-arrow-down-s-line text-blue-400"></i>
                    </button>
                    <div
                        class="answer hidden max-h-0 overflow-hidden transition-[max-height] duration-300 ease-in-out mt-2">
                        <p class="text-gray-600">
                            Topics range from technology and business to arts, health, personal development, and more.
                        </p>
                    </div>
                </div>

                <div class="border border-blue-400 rounded-lg p-4 shadow-sm hover:shadow-md transition">
                    <button onclick="toggleAnswer(this)"
                        class="flex justify-between items-center w-full text-left font-semibold text-lg text-gray-800">
                        Does Youdemy offer support for learners?
                        <i class="ri-arrow-down-s-line text-blue-400"></i>
                    </button>
                    <div
                        class="answer hidden max-h-0 overflow-hidden transition-[max-height] duration-300 ease-in-out mt-2">
                        <p class="text-gray-600">
                            Yes, we provide 24/7 support for technical issues and a dedicated community for
                            course-related
                            discussions.
                        </p>
                    </div>
                </div>

                <div class="border border-blue-400 rounded-lg p-4 shadow-sm hover:shadow-md transition">
                    <button onclick="toggleAnswer(this)"
                        class="flex justify-between items-center w-full text-left font-semibold text-lg text-gray-800">
                        Can I get a refund for Youdemy courses?
                        <i class="ri-arrow-down-s-line text-blue-400"></i>
                    </button>
                    <div
                        class="answer hidden max-h-0 overflow-hidden transition-[max-height] duration-300 ease-in-out mt-2">
                        <p class="text-gray-600">
                            Yes, Youdemy has a refund policy allowing you to request refunds within 7 days of purchase.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->

    <?php include 'footer.php'?>
</body>



</html>