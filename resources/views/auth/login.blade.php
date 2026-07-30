<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/@phosphor-icons/web@2.0.3/src/bold/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f5ff;
        }

        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(0, 80, 170, 0.2);
        }

        .transition-smooth {
            transition: all 0.3s ease-in-out;
        }

        .bank-bg {
            background-color: #f0f5ff;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%230050aa' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>

<body class="min-h-screen bank-bg flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Header Logo -->
<!-- Header Logo -->
<div class="text-center mb-6">
    <div class="flex items-center justify-center mb-2">
        <img src="{{ asset('images/logobppi.png') }}" alt="Logo BPPI" class="w-12 h-12 object-contain">
    </div>
    <h1 class="text-2xl font-bold text-blue-900">
        Bank Mini <span class="text-blue-600 font-normal">SMK BPPI</span>
    </h1>
</div>

        <!-- Login Form Container -->
        <div class="bg-white rounded-xl overflow-hidden shadow-lg border border-gray-100">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-blue-800 to-blue-900 p-6">
                <h2 class="text-xl font-semibold text-white">Login Page</h2>
                <p class="text-blue-100 text-sm mt-1">Silahkan masuk untuk akses akun Anda</p>
            </div>

            <!-- Form Content -->
            <div class="bg-white p-6 sm:p-8">
                <!-- Security Notice -->
                <div class="flex items-center mb-6 bg-blue-50 p-3 rounded-lg border-l-4 border-blue-600">
                    <i class="fas fa-shield-alt text-blue-600 mr-3"></i>
                    <div class="text-sm text-blue-800">
                        Login menggunakan koneksi aman. Pastikan Anda berada di situs resmi Bank Mini.
                    </div>
                </div>

                <!-- Error Message -->
                @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                        <div class="text-red-700 text-sm">{{ $errors->first() }}</div>
                    </div>
                </div>
                @endif

                <form method="POST" action="{{ url('/login') }}" class="space-y-5">
                    @csrf

                    <!-- Username Field -->
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
                            Username
                        </label>
                        <div class="relative">
                            <input type="text" id="username" name="username" placeholder="Masukkan username" required
                                class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg input-focus focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-smooth text-gray-800">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4">
                                <i class="fas fa-user text-blue-800 opacity-70"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password
                        </label>
                        <div class="relative">
                            <input type="password" id="password" name="password" placeholder="Masukkan password" required
                                class="w-full pl-12 pr-12 py-3 border border-gray-300 rounded-lg input-focus focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-smooth text-gray-800">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4">
                                <i class="fas fa-lock text-blue-800 opacity-70"></i>
                            </div>
                            <button type="button" onclick="togglePasswordVisibility()"
                                class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-blue-600 focus:outline-none">
                                <i id="eye-icon" class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        
                        <a href="#" class="text-sm text-blue-600 hover:underline transition-smooth">
                            Lupa password?
                        </a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full py-3 px-4 bg-blue-800 text-white font-semibold rounded-lg hover:bg-blue-900 transition-smooth shadow-md flex items-center justify-center">
                        LOGIN <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </form>

                <!-- Footer Links -->
                <div class="mt-6 text-center text-sm text-gray-500 pt-4 border-t border-gray-100">
                    Belum memiliki akun? <a href="#"
                        class="text-blue-600 font-medium hover:underline transition-smooth">Hubungi Petugas Bank Mini</a>
                </div>
            </div>
        </div>

       
        <!-- Help Section -->
        <div class="text-center mt-6 text-sm">
            <a href="#" class="text-blue-600 hover:underline mr-4">
                <i class="fas fa-question-circle mr-1"></i> Bantuan
            </a>
            <a href="#" class="text-blue-600 hover:underline">
                <i class="fas fa-headset mr-1"></i> Hubungi Kami
            </a>
        </div>
    </div>

    <script>
        // Password visibility toggle
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>