

<?php

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
<div class="min-h-screen flex flex-col">

<div class="hidden md:block w-full bg-primary text-white">
    <div class="container mx-auto px-4 py-2">
        <div class="flex justify-between items-center text-sm">
            <div class="flex items-center space-x-6">
                <span class="flex items-center">
                    <i class="ri-phone-line mr-2"></i> +212 772508881
                </span>
                <span class="flex items-center">
                    <i class="ri-mail-line mr-2"></i> contact@youdemy.com
                </span>
            </div>
            <span class="flex items-center">
                <i class="ri-map-pin-line mr-2"></i> Massira N641 Safi, Morocco
            </span>
        </div>
    </div>
</div>
<header class="border-b bg-white">
            <div class="container mx-auto px-4">
                <div class="flex items-center justify-between py-4">
                    <a href="/Youdemy/public/index.php">
                    <img class="w-32 h-16" src="/Youdemy/public/assets/images/logo-youdemy.png" alt="Youdemy Platform">
                    </a>
                    <nav class="hidden md:flex items-center space-x-6">
                        <a href="/Youdemy/public/index.php" class="text-gray-900 hover:text-blue-500 transition-colors">Home</a>
                        <a href="/Youdemy/public/cours.php"
                            class="text-gray-900 hover:text-blue-500 transition-colors">Cours</a>
                        <a href="#"
                            class="text-gray-900 hover:text-blue-500 transition-colors">Contact</a>
                            <?php 
                            if(isset($_SESSION['logged_id']))
                
                            {
                                if($_SESSION['role'] == 'etudiant')
                                {
                                    echo "<a href='etudiant/cours.php'
                            class='text-gray-900 hover:text-blue-500 transition-colors'>Mes Cours</a>";
                                } else {
                                    echo "<a href='enseignant/cours.php'
                            class='text-gray-900 hover:text-blue-500 transition-colors'>Mes Cours end</a>";

                                }

                            } 
                            ?>
                      
                    </nav>
                    <div class="flex items-center space-x-4">
                       <?php
                       if (!isset($_SESSION['logged_id'])){
                       ?>
                        <button
                            class="p-2 px-4 bg-primary text-white rounded-full hover:bg-white hover:text-primary hover:border hover:border-secondary transition-colors">
                            <a href="/Youdemy/public/login.php">Login</a>
                        </button>
                        <button
                            class="p-2 px-4 bg-primary text-white rounded-full hover:bg-white hover:text-primary hover:border hover:border-secondary transition-colors">
                            <a href="/Youdemy/public/register.php">Register</a>
                        </button>
                        <?php
                       } else {
                        ?>
                         <button
                            class="p-2 px-4 bg-primary text-white rounded-full hover:bg-white hover:text-primary hover:border hover:border-secondary transition-colors">
                            <a href="/Youdemy/app/actions/login/login.php?logout">Logout</a>
                        </button>
                        <?php
                       }
                        ?>
                        <button id="mobile-menu-btn" class="p-2 hover:text-yellow-500 transition-colors md:hidden">
                            <i class="ri-menu-4-fill text-2xl"></i>
                        </button>
                    </div>
                </div>

                <!-- Mobile Menu-->
                <div id="mobile-menu" class="hidden md:hidden py-4">
                    <nav class="flex flex-col space-y-4">
                    <a href="/Youdemy/public/index.php" class="text-yellow-400 font-bold  hover:text-bg-yellow-500 transition-colors">Home</a>
                        <a href="/Youdemy/public/pages/courses.php" class="text-gray-900 hover:text-bg-yellow-500 transition-colors">Courses</a>
                        <a href="/Youdemy/public/pages/pricing.php" class="text-gray-900 hover:text-bg-yellow-500 transition-colors">Pricing</a>
                        <a href="/Youdemy/public/pages/features.php" class="text-gray-900 hover:text-bg-yellow-500 transition-colors">Features</a>
                        <a href="/Youdemy/public/pages/features.php" class="text-gray-900 hover:text-bg-yellow-500 transition-colors">Blog</a>
                        <a href="/Youdemy/public/pages/contact.php" class="text-gray-900 hover:text-bg-yellow-500 transition-colors">Help Center</a>
                    </nav>
                </div>
            </div>
        </header>