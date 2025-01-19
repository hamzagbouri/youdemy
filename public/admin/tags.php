<?php 
require_once '../../app/actions/tag/get.php';
session_start();
$allTags = getTag::getAllTags();
if (isset($_SESSION['message'])) {
        
    $message = $_SESSION['message'];
    $type = $_SESSION['message_type'] ?? 'success'; 
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                text: '$message',
                icon: '$type',
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>";
    unset($_SESSION['message'], $_SESSION['message_type']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation-Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style >
 
        input[type="search"]::-webkit-search-cancel-button
        {
        -webkit-appearance:none;
        }
        td {
            border-bottom-width: 1px ;
            border-collapse: collapse;
            

        }
       
    </style>
    <script>
        tailwind.config = {
            theme: {
            extend: {
                colors: {
                primary: '#003366',
                borderColor: '#5f5d5d',
                bgcolor: '#F3F3F3',
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

<body >

<div class="flex min-h-screen h-full ">
    <aside class="w-52 border-r min-h-full  flex flex-col items-center gap-16 ">
        <div class="mt-16">
            <img class="w-32" src="../assets/images/logo-youdemy.png" alt="logo">
        </div>
        <div class="">
        <div class="grid gap-4 w-[100%]">
                    <a href="index.php" class="flex gap-4 px-4 py-2 rounded-2xl">
                        <img src="./img/home.svg" alt=""> Dashboard
                    </a>
                    <!-- Cars Link -->
                    <div class="relative">
                        <button class="flex gap-4 px-4 py-2 rounded-2xl w-full">
                            <img src='./img/briefcase.svg' alt=''> Cours
                        </button>
                        <!-- Dropdown Options for Cars -->
                        <div id="carsDropdown" class="hidden absolute left-0 mt-2 bg-white shadow-lg rounded-xl w-full">
                            <a href="category.php" class="flex gap-4 px-4 py-2 rounded-2xl hover:bg-gray-100">
                                <img src='./img/category.svg' alt=''> Categories
                            </a>
                            <a href="cours.php" class="flex gap-4 px-4 py-2 rounded-2xl hover:bg-gray-100">
                                <img src='./img/car.svg' alt=''> Cours
                            </a>
                        </div>
                    </div>
                    <a href='user.php' class='flex gap-4 px-4 py-2 rounded-2xl'>
                        <img id='btn-icon' class='mt-1' src='./img/3 User.svg' alt=''> Users
                    </a>
                    <a href='tags.php' class='flex gap-4 px-4 py-2 rounded-2xl'>
                        <img id='btn-icon' class='mt-1' src='./img/3 User.svg' alt=''> Tags
                    </a>
            </div>
        </div>
            <script>
        const carsButton = document.querySelector('button');
        const carsDropdown = document.getElementById('carsDropdown');

        carsButton.addEventListener('click', () => {
            carsDropdown.classList.toggle('hidden');
        });

        window.addEventListener('click', (e) => {
            if (!e.target.closest('div.relative')) {
                carsDropdown.classList.add('hidden');
            }
        });
    </script>   
    </aside>
    <div class="grow">
        <header class=" h-20 border-b">
            <nav class=" h-full flex justify-between mx-8 items-center">
                <div class="flex gap-2">
                    <img src="./img/Search.svg" alt="">
                    <input class="search outline-none border-none w-64 px-4 py-2 rounded-2xl" type="search" name="search-input" id="search-input" placeholder="Search anything here">
                </div>
                <div class="flex w-72 justify-between  items-center ">
                    <img class="cursor-pointer" src="./img/settings.svg" alt="">
                    <img class="cursor-pointer" src="./img/Icon.svg" alt="">
                    <a href="/Youdemy/app/actions/login/login.php?logout"><img src="img/logout.png" class="h-4 w-4" alt=""></a>

                    <div class="flex items-center gap-2 cursor-pointer">
                        <div class=" cursor-pointer w-10 h-10 bg-[url('img/Ana.jpg')] bg-cover rounded-full text-white relative ">
                        <div class="bg-[#228B22] h-3 w-3 rounded-full absolute bottom-0 right-0  "></div>
                        </div>
                       <p class="text-[#606060] font-bold">Hamza GBOURI </p>
                    </div>
                   
                </div>
    
            </nav>
        </header>
       
    <section class="p-4 w-full flex flex-col gap-8">
        <?php
            if (isset($_SESSION['error'])) {
                set_time_limit(2);  
                echo $_SESSION['error'];  
                unset($_SESSION['error']);  
            }
            ?>
            
            <div class="flex justify-between items-center px-8">
                <h1>
                    Reservation
                </h1>
               <div class="flex gap-4">
                    <button class="flex gap-2 items-center border px-4 py-2 rounded-lg text-[#0E2354] ">
                        <img src="./img/Downlaod.svg" alt="">Export
                    </button>
                    <button
                id="add-etd"
                class="flex gap-2 items-center bg-primary px-4 py-2 rounded-lg text-white"
              >
                <img src="./img/_Avatar add button.svg" alt="" />New Tag
              </button>
                   
               </div>
            </div>

            <div class="flex justify-between items-center px-4 border py-4 rounded-lg">
                <div class="flex gap-2">
                    <img src="./img/Search.svg" alt="">
                    <input class="search outline-none border-none w-72 px-4 py-2 rounded-2xl" type="search" name="search-input" id="search-input" placeholder="Search reservation by name...">
                </div>
               <div class="flex gap-4 items-center">
                    <button class="flex gap-2 items-center border px-4 py-2 rounded-lg">
                        <img src="./img/Filters lines.svg" alt="">Filters
                    </button>
                    <div class="flex gap-2">
                        <img class="px-4 py-3 border rounded-lg cursor-pointer" src="./img/Vector.svg" alt="">
                        <img class="px-4 py-2 border rounded-lg cursor-pointer" src="./img/element-3.svg" alt="">
                    </div>
               </div>
            </div>
            <div class="flex flex-wrap gap-4 p-6 bg-gray-50 rounded-lg shadow-sm">
    <?php foreach ($allTags as $tag): ?>
        <div class="group relative flex items-center gap-2 px-4 py-2 bg-white rounded-full border border-gray-200 shadow-sm transition-all duration-300 hover:shadow-md hover:-translate-y-1 hover:border-blue-300">
            <span class="text-gray-700 font-medium">
                <?php echo htmlspecialchars($tag->getTitre()) ?>
            </span>
            
            <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                <!-- Edit Button -->
                <button 
                onclick="openEditModal('<?php echo $tag->getTitre(); ?>', <?php echo $tag->getId(); ?>)"
                    class="p-1 hover:bg-gray-100 rounded-full transition-colors duration-200"
                    title="Edit tag"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                    </svg>
                </button>

                <!-- Delete Button -->
                <a 
                    href="../../app/actions/tag/add.php?delete=<?php echo $tag->getId(); ?>"
                    class="p-1 hover:bg-gray-100 rounded-full transition-colors duration-200"
                    title="Delete tag"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                    </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<div
  id="categoryModal"
  class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
  <div class="bg-white rounded-lg w-96 p-6">
    <h2 class="text-2xl font-semibold mb-4">Add New Tags</h2>
    <form
      id="categoryForm"
      method="POST"
      action="../../app/actions/tag/add.php">
      <div id="tagsContainer">
        <label
          for="categoryName"
          class="block text-sm font-medium text-gray-700"
          >Tag Name</label
        >
        <input
          type="text"
          id="categoryName"
          name="tags[]"
          class="w-full p-3 mt-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary"
          placeholder="Enter tag name"
          required
        />
      </div>
      <button
        type="button"
        id="addTagField"
        class="mt-3 text-blue-500 hover:underline">
        + Add another tag
      </button>
      <div class="mt-6 flex justify-end gap-4">
        <button
          type="button"
          id="closeModal"
          class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
          Cancel
        </button>
        <button
          type="submit"
          name="submit"
          class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">
          Add Tags
        </button>
      </div>
    </form>
  </div>
</div>

    <div
        id="categoryModal-edit"
        class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white rounded-lg w-96 p-6">
          <h2 class="text-2xl font-semibold mb-4">Modify Tag</h2>
          <form
            id="categoryForm-edit"
            method="POST"
            action="../../app/actions/tag/add.php"
          >
          <input
              type="hidden"
              id="id-category-edit"
              name="id-category-edit"
              
            />
            <label
              for="nom-category-edit"
              class="block text-sm font-medium text-gray-700"
              >Tag Name</label
            >
            <input
              type="text"
              id="nom-category-edit"
              name="nom-category-edit"
              class="w-full p-3 mt-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary"
              placeholder="Enter tag name"
              required
            />
            <div class="mt-6 flex justify-end gap-4">
              <button
                type="button"
                id="closeModal-edit"
                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400"
              >
                Cancel
              </button>
              <button
                type="submit"
                name="edit"
                class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark"
              >
                Modify Tag
              </button>
            </div>
          </form>
        </div>
      </div>

<script>
  document.getElementById("addTagField").addEventListener("click", function () {
  const tagsContainer = document.getElementById("tagsContainer");
  const newInput = document.createElement("input");
  newInput.type = "text";
  newInput.name = "tags[]";
  newInput.placeholder = "Enter another tag name";
  newInput.className =
    "w-full p-3 mt-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary";
  tagsContainer.appendChild(newInput);
});


</script>
<script>
      const modalEdit = document.getElementById("categoryModal-edit");
      const modal = document.getElementById("categoryModal");
      const addCategoryButton = document.getElementById("add-etd");
      const closeModalButton = document.getElementById("closeModal");
      const categoryForm = document.getElementById("categoryForm");

      addCategoryButton.addEventListener("click", () => {
        modal.classList.remove("hidden");
      });

      closeModalButton.addEventListener("click", () => {
        modal.classList.add("hidden");
      });

      window.addEventListener("click", (e) => {
        if (e.target === modal) {
          modal.classList.add("hidden");
        }
      });
      function openEditModal(titre, id) {
    
        modalEdit.classList.remove("hidden");
        document.getElementById("nom-category-edit").value = titre;
        document.getElementById("id-category-edit").value = id;
        }
      document.getElementById("closeModal-edit").addEventListener("click", () => {
        modalEdit.classList.add("hidden");
      });
    </script>

 
          
        </section>

    </div>
   
             
        
</body>
</html>
