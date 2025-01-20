<?php
session_start();
if(!isset($_SESSION['logged_id']))
{
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Youdemy Platform</title>
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
                        primary: ['Playfair Display', 'serif'],
                        secondary: ['Pattaya', 'sans-serif'],
                    },
                },
            },
        };
    </script>
</head>

<body>
    <!-- main container -->
    <?php include 'header.php' ?>

    <!-- Register Form -->
    <section
        class="hero bg-blue-500/5 flex-grow flex justify-center items-center border-blue-400 bg-opacity-20 bg-cover bg-center">
        <div class="bg-white/10 backdrop-blur-lg rounded-lg p-8 shadow-lg w-full max-w-md">
            <h2 class="text-blue-400 text-center text-3xl font-semibold mb-6">Register</h2>
            <form method="post" action="../app/actions/login/login.php" name="signup-form" id="registerForm" enctype="multipart/form-data">
                <div class="relative mb-4">
                    <i class="ri-user-line text-gray-300 absolute left-4 top-2.5 text-xl"></i>
                    <input type="text" placeholder="Username" name="fullName-signup" id="username" required
                        class="w-full pl-12 pr-4 py-2 border border-gray-300 rounded-lg bg-white/10 text-gray-600 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400" />
                </div>

                <div class="relative mb-4">
                    <i class="ri-mail-line text-gray-300 absolute left-4 top-2.5 text-xl"></i>
                    <input type="email" placeholder="Email" name="email-signup" id="email" required
                        class="w-full pl-12 pr-4 py-2 border border-gray-300 rounded-lg bg-white/10 text-gray-600 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400" />
                </div>

                <div class="relative mb-4">
                    <i class="ri-lock-line text-gray-300 absolute left-4 top-2.5 text-xl"></i>
                    <input type="password" placeholder="Password" name="password-signup" id="password" required
                        class="w-full pl-12 pr-4 py-2 border border-gray-300 rounded-lg bg-white/10 text-gray-600 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400" />
                </div>
                <div class="relative mb-4">
                    <i class="ri-lock-line text-gray-300 absolute left-4 top-2.5 text-xl"></i>
                        <select name="role-signup" id="" class="w-full pl-12 pr-4 py-2 border border-gray-300 rounded-lg bg-white/10 text-gray-600 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                            <option value="etudiant">Etudiant</option>
                            <option value="enseignant">Enseignant</option>
                        </select>
                </div>

                <button type="button" id="submitBtn" name="signup"
                    class="w-full py-2 bg-blue-400 hover:bg-black text-white font-semibold rounded-lg transition duration-200 hover:bg-white hover:border hover:border-blue-400 hover:text-blue-400 hover:text-black">
                    Register
                </button>
            </form>

            <p class="text-center text-gray-600 mt-4">
                Already have an account?
                <a href="./login.php" class="text-black hover:underline text-black">Login</a>
            </p>
        </div>
    </section>

    <!-- Footer Section -->
    <?php include 'footer.php' ?>

    <script>
        document.getElementById('submitBtn').addEventListener('click', function () {
            const username = document.getElementById('username').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            // Regex patterns
            const usernameRegex = /^[a-z A-Z]{3,20}$/;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const passwordRegex = /^[a-zA-Z0-9]{3,20}$/;

            if (!usernameRegex.test(username)) {
                Swal.fire('Invalid Username', 'Username must be 3-20 characters and can include letters', 'error');
                return;
            }

            if (!emailRegex.test(email)) {
                Swal.fire('Invalid Email', 'Please enter a valid email address.', 'error');
                return;
            }

            if (!passwordRegex.test(password)) {
                Swal.fire('Invalid Password', 'Password must be at least 8 characters long and include a letter, number', 'error');
                return;
            }

            // Success
            Swal.fire({
                title: 'Registration Successful',
                text: 'Your registration details are valid.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                document.getElementById('registerForm').submit();
            });
        });
    </script>
</body>

</html>
