<?php
session_start();
if(isset($_SESSION['logged_id']))
{
    header('Location: index.php');
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Youdemy Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.svg">

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

    <!-- main container -->
   

        <?php include 'header.php'?>


        <script>
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const sidebarMenu = document.getElementById('sidebar-menu');
            const closeSidebar = document.getElementById('close-sidebar');

            mobileMenuBtn.addEventListener('click', () => {
                sidebarMenu.classList.remove('hidden');
            });

            closeSidebar.addEventListener('click', () => {
                sidebarMenu.classList.add('hidden');
            });

            sidebarMenu.addEventListener('click', (e) => {
                if (e.target === sidebarMenu) {
                    sidebarMenu.classList.add('hidden');
                }
            });
        </script>






        <!-- Login Form -->
        <section
            class="hero bg-blue-500/5 flex-grow flex justify-center items-center border-blue-400 bg-opacity-20   bg-cover bg-center">
            <div class="bg-white/10 backdrop-blur-lg rounded-lg p-8 shadow-lg w-full max-w-md">
                <h2 class="text-blue-400 text-center text-3xl font-semibold mb-6">Login</h2>
                <span class="flex justify-center text-center text-red-700 mb-5">
                    <?php if (!empty($errorMessage)): ?>
                        <?= htmlspecialchars($errorMessage) ?>
                    <?php endif; ?>
                </span>
                <form method="post" action="../app/actions/login/login.php">
                    <div class="relative mb-4">
                        <i class="ri-user-line text-gray-300 absolute left-4 top-2 text-xl"></i>
                        <input type="text" placeholder="Username" name="username"
                            class="w-full pl-12 pr-4 py-2 border border-gray-300 rounded-lg bg-white/10 text-gray-600 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400" />
                    </div>

                    <div class="relative mb-4">
                        <i class="ri-lock-line text-gray-300 absolute left-4 top-2 text-xl"></i>
                        <input type="password" placeholder="Password" name="password"
                            class="w-full pl-12 border border-gray-300 pr-4 py-2 rounded-lg bg-white/10 text-gray-600 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400" />
                    </div>

                    <div class="flex justify-between text-white text-sm mb-6">
                        <label class="flex items-center text-gray-600">
                            <input type="checkbox" class="mr-2 black" />
                            Remember Me
                        </label>
                        <a href="#" class="hover:underline text-gray-600">Forgot Password?</a>
                    </div>

                    <button type="submit" name="login"
                        class="w-full py-2 bg-blue-400 hover:bg-black text-white font-semibold rounded-lg transition duration-200 hover:bg-white hover:border hover:border-blue-400 hover:text-blue-400 hover:text-black">
                        Login
                    </button>
                </form>

                <p class="text-center text-gray-600  mt-4">
                    Don't have an account?
                    <a href="./register.php" class="text-black hover:underline">Register</a>
                </p>
            </div>
        </section>
    </div>




    <!-- Footer Section -->
    <?php include 'footer.php'?>

</body>

</html>