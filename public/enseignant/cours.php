<?php?><?php
session_start();
if(!isset($_SESSION['logged_id']) || $_SESSION['role'] !== 'enseignant')
{
        header('Location: ../index.php');
    
}
require_once dirname(__DIR__, 3) . '/Youdemy/app/actions/categorie/get.php';
require_once dirname(__DIR__, 3) . '/Youdemy/app/actions/cours/getCours.php';
$categories = getCategory::getAllCategories();
$cours = getCours::getAll();



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
    <div class="py-10 md:px-12 px-6">
        <button 
            class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600 transition"
            onclick="toggleModal(true)">
            Add Course
        </button>

        <!-- Existing Course Card -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <?php
        foreach($cours as $courItem)
        {
            ?>
        <div class="mt-6 ">
            <div class="bg-white border border-blue-400 rounded-lg shadow-md p-4 hover:scale-105 transition-transform">
                <img src="../<?php echo $courItem->getImagePath();?>" alt="Course Image" class="rounded-t-lg  w-[100%]">
                <div class="py-3">
                    <p class="text-sm text-gray-500 flex items-center space-x-2">
                        <span><i class="ri-calendar-line"></i> 8 Nov, 2023</span>
                        <span><i class="ri-file-list-line"></i> 3 Curriculum</span>
                        <span><i class="ri-group-line"></i> 7 Students</span>
                    </p>
                    <h3 class="text-lg font-semibold text-gray-800 mt-2"><?php echo $courItem->getTitre();?></h3>
                    <p class="text-gray-600 text-sm mt-1">
                    <?php echo $courItem->getDescription();?>
                    </p>
                    <div class="flex items-center justify-between mt-3">
                        <p class="text-blue-400 font-bold">Free</p>
                        <p class="text-blue-400 flex items-center"><i class="ri-star-fill"></i> 4.4</p>
                    </div>
                </div>
            </div>
        </div>
            <?php
        }
        ?>
        </div>
    </div>

    <!-- Modal for Adding a Course -->
    <div id="addCourseModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-lg w-[80%] p-6 overflow-y-auto h-[80%]">
            <h2 class="text-lg font-semibold text-gray-800">Add New Course</h2>
            <form id="addCourseForm" class="mt-4 space-y-4"  enctype="multipart/form-data">
                <div>
                    <label for="courseTitle" class="block text-sm font-medium text-gray-700">Title</label>
                    <input 
                        type="text" 
                        id="courseTitle" 
                        name="title" 
                        class="block w-full  px-3 py-2 mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div>
                    <label for="courseDescription" class="block  text-sm font-medium text-gray-700">Description</label>
                    <textarea 
                        id="courseDescription" 
                        name="description" 
                        class="block w-full mt-1 border px-3 py-2 h-32 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </textarea>
                </div>
                <div>
                    <label for="courseImage" class="block  text-sm font-medium text-gray-700">Image</label>
                    <input 
                        type="file" 
                        id="courseImage" 
                        name="image" 
                        accept="image/*"
                        class="block w-full mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">                </div>
                <div>
                    <label for="courseTags" class="block text-sm font-medium text-gray-700">Tags</label>
                    <input 
                        type="text" 
                        id="courseTags" 
                        name="tags" 
                        class="block w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" 
                        placeholder="Type and press Enter to add tags">
                    <div id="tagsList" class="hidden bg-white border mt-1 rounded-md shadow-md overflow-y-auto max-h-32 w-full"></div>
                    <div id="selectedTags" class="mt-2 flex flex-wrap gap-2"></div>
                    <!-- <input type="hidden" name="tags[]" id="tags"> -->
                </div>
                <div>
                    <label for="courseCategorie" class="block text-sm font-medium text-gray-700">Categorie</label>
                    <select 
                        id="courseCategorie" 
                        name="categorie" 
                        class="block px-3 py-2 w-full mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <?php
                            foreach($categories as $categorie)
                            {
                                echo "<option value ='".$categorie->getId()."'>".$categorie->getTitre()."</option>";
                            }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="courseType" class="block text-sm font-medium text-gray-700">Type</label>
                    <select 
                        id="courseType" 
                        name="type" 
                        class="block px-3 py-2 w-full mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        onchange="toggleContentField()">
                        <option value="text">Text</option>
                        <option value="video">Video</option>
                    </select>
                </div>
                <div id="textContentField" class="hidden">
                    <label for="courseText" class="block text-sm font-medium text-gray-700">Text Content</label>
                    <textarea 
                        id="courseText" 
                        name="content" 
                        class="block w-full mt-1 border x-3 py-2 h-32 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </textarea>
                </div>
                <div id="videoContentField" class="hidden">
                    <label for="courseVideo" class="block text-sm font-medium text-gray-700">Video File</label>
                    <input 
                        type="file" 
                        id="courseVideo" 
                        name="video" 
                        accept="video/*"
                        class="block w-full mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div class="flex justify-end space-x-4">
                    <button 
                        type="button" 
                        class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg shadow-md hover:bg-gray-400 transition"
                        onclick="toggleModal(false)">
                        Cancel
                    </button>
                    <button 
                    id="addCours"
                        type="submit" 
                        class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600 transition">
                        Add Course
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
<script src = "cours.js">

</script>

    <!-- FAQs Section -->
   

    <!-- Footer Section -->

    <?php include '../footer.php'?>
</body>



</html>