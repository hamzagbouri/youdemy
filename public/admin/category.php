<?php 
require_once '../../app/actions/categorie/get.php';
session_start();
$allCategories = getCategory::getAllCategories();
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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CRM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
      integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <style>
      input[type="search"]::-webkit-search-cancel-button {
        -webkit-appearance: none;
      }

      td {
        border-bottom-width: 1px;
        border-collapse: collapse;
      }
    </style>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              primary: "#003366",
              borderColor: "#5f5d5d",
              bgcolor: "#F3F3F3",
            },
            fontFamily: {
              // primary: ['Consolas', 'monospace'],
              primary: ["Playfair Display", "serif"],
              // primary: ['EB Garamond', 'serif'],
              secondary: ["Pattaya", "sans-serif"],
            },
          },
        },
      };
    </script>
  </head>

  <body>
    <div class="flex min-h-screen h-full">
      <aside
        class="w-[16rem] border-r min-h-full flex flex-col items-center gap-16"
      >
        <div class="mt-16">
          <img class="w-32" src="../assets/images/logo-youdemy.png" alt="logo" />
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
          const carsButton = document.querySelector("button");
          const carsDropdown = document.getElementById("carsDropdown");

          carsButton.addEventListener("click", () => {
            carsDropdown.classList.toggle("hidden");
          });

          window.addEventListener("click", (e) => {
            if (!e.target.closest("div.relative")) {
              carsDropdown.classList.add("hidden");
            }
          });
        </script>
      </aside>
      <div class="grow">
        <header class="h-20 border-b">
          <nav class="h-full flex justify-between mx-8 items-center">
            <div class="flex gap-2">
              <img src="./img/Search.svg" alt="" />
              <input
                class="search outline-none border-none w-64 px-4 py-2 rounded-2xl"
                type="search"
                name="search-input"
                id="search-input"
                placeholder="Search anything here"
              />
            </div>
            <div class="flex w-72 justify-between items-center">
              <img class="cursor-pointer" src="./img/settings.svg" alt="" />
              <img class="cursor-pointer" src="./img/Icon.svg" alt="" />
              <a href="/Youdemy/app/actions/login/login.php?logout"><img src="img/logout.png" class="h-4 w-4" alt=""></a>

              <div class="flex items-center gap-2 cursor-pointer">
                <div
                  class="cursor-pointer w-10 h-10 bg-[url('img/Ana.jpg')] bg-cover rounded-full text-white relative"
                >
                  <div
                    class="bg-[#228B22] h-3 w-3 rounded-full absolute bottom-0 right-0"
                  ></div>
                </div>
                <p class="text-[#606060] font-bold">Hamza GBOURI</p>
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
            <h1>Cars</h1>
            <div class="flex gap-4">
              <button
                class="flex gap-2 items-center border px-4 py-2 rounded-lg text-[#0E2354]"
              >
                <img src="./img/Downlaod.svg" alt="" />Export
              </button>
              <button
                id="add-etd"
                class="flex gap-2 items-center bg-primary px-4 py-2 rounded-lg text-white"
              >
                <img src="./img/_Avatar add button.svg" alt="" />New Category
              </button>
            </div>
          </div>

          <div
            class="flex justify-between items-center px-4 border py-4 rounded-lg"
          >
            <div class="flex gap-2">
              <img src="./img/Search.svg" alt="" />
              <input
                class="search outline-none border-none w-72 px-4 py-2 rounded-2xl"
                type="search"
                name="search-input"
                id="search-input"
                placeholder="Search car by name..."
              />
            </div>
            <div class="flex gap-4 items-center">
              <button
                class="flex gap-2 items-center border px-4 py-2 rounded-lg"
              >
                <img src="./img/Filters lines.svg" alt="" />Filters
              </button>
              <div class="flex gap-2">
                <img
                  class="px-4 py-3 border rounded-lg cursor-pointer"
                  src="./img/Vector.svg"
                  alt=""
                />
                <img
                  class="px-4 py-2 border rounded-lg cursor-pointer"
                  src="./img/element-3.svg"
                  alt=""
                />
              </div>
            </div>
          </div>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach($allCategories as $category){ ?>

            <div
              class="bg-white rounded-lg shadow-md p-6 flex justify-between items-center"
            >
              <div class="flex-1">
                <h3 class="text-xl font-semibold text-gray-800">
                  <?php echo $category->getTitre(); ?>
                </h3>
              </div>
              <div class="flex gap-4">
                <button
                onclick="openEditModal('<?php echo $category->getTitre(); ?>', <?php echo $category->getId(); ?>)">                
                  <img src="./img/editinggh.png" alt="Edit" class="w-5 h-5" />
                </button>

                <a
                  href="../../app/actions/categorie/add.php?delete=<?php echo $category->getId(); ?>"
                  ><img src="./img/delete.png" alt="Delete" class="w-5 h-5"
                /></a>
              </div>
            </div>
            <?php } ?>
          </div>
        </section>
      </div>

      <div
        id="categoryModal"
        class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white rounded-lg w-96 p-6">
          <h2 class="text-2xl font-semibold mb-4">Add New Category</h2>
          <form
            id="categoryForm"
            method="POST"
            action="../../app/actions/categorie/add.php"
          >
            <label
              for="categoryName"
              class="block text-sm font-medium text-gray-700"
              >Category Name</label
            >
            <input
              type="text"
              id="categoryName"
              name="nom-category"
              class="w-full p-3 mt-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary"
              placeholder="Enter category name"
              required
            />
            <div class="mt-6 flex justify-end gap-4">
              <button
                type="button"
                id="closeModal"
                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400"
              >
                Cancel
              </button>
              <button
                type="submit"
                name="submit"
                class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark"
              >
                Add Category
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div
        id="categoryModal-edit"
        class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white rounded-lg w-96 p-6">
          <h2 class="text-2xl font-semibold mb-4">Modify Category</h2>
          <form
            id="categoryForm-edit"
            method="POST"
            action="../../app/actions/categorie/add.php"
          >
          <input
              type="hidden"
              id="id-category-edit"
              name="id-category-edit"
              
            />
            <label
              for="nom-category-edit"
              class="block text-sm font-medium text-gray-700"
              >Category Name</label
            >
            <input
              type="text"
              id="nom-category-edit"
              name="nom-category-edit"
              class="w-full p-3 mt-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary"
              placeholder="Enter category name"
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
                Modify Category
              </button>
            </div>
          </form>
        </div>
      </div>

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
      function openEditModal(titre,id) {
       const catTtire = <?php echo json_encode($category->getTitre()) ?>;
       const carid = <?php echo json_encode($category->getId()) ?>;

        modalEdit.classList.remove("hidden");
        document.getElementById("nom-category-edit").value = titre;
        document.getElementById("id-category-edit").value = id;
        }
      document.getElementById("closeModal-edit").addEventListener("click", () => {
        modalEdit.classList.add("hidden");
      });
    </script>
  </body>
</html>
