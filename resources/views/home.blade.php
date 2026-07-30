<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bank Mini SMK BPPI - Solusi Menabung Digital Sekolah</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }

    .gradient-bg {
      background: linear-gradient(135deg, #0466c8 0%, #0353a4 100%);
    }

    .card-hover:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px -5px rgba(4, 102, 200, 0.4);
    }

    .feature-icon {
      transition: all 0.3s ease;
    }

    .feature-card:hover .feature-icon {
      transform: scale(1.1);
    }
  </style>
</head>

<body class="bg-gray-50 text-gray-800">

  <!-- Navbar -->
  <header class="bg-white shadow-lg sticky top-0 z-50 animate__animated animate__fadeInDown">
    <div class="container mx-auto flex justify-between items-center py-4 px-6">
<!-- Logo -->
<div class="flex items-center">
  <img src="{{ asset('images/logobppi.png') }}" alt="Logo BPPI" class="w-10 h-10 mr-3 object-contain">
  <h1 class="text-2xl font-bold text-blue-700">Bank Mini</h1>
</div>


<!-- Desktop Navigation -->
<nav class="hidden md:flex space-x-6 items-center text-center md:text-left">
  <a href="#home" class="hover:text-blue-600 font-medium transition-colors py-2">Home</a>
  <a href="#about" class="hover:text-blue-600 font-medium transition-colors py-2">Tentang</a>
  <a href="#features" class="hover:text-blue-600 font-medium transition-colors py-2">Fitur</a>
  <a href="#contact" class="hover:text-blue-600 font-medium transition-colors py-2">Kontak</a>
  <a href="{{ route('login') }}"
    class="inline-flex items-center px-6 py-3 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
    Login
  </a>
</nav>

  
      <!-- Mobile Hamburger Button -->
      <button id="hamburger-btn" class="md:hidden text-gray-800 focus:outline-none">
        <i class="fas fa-bars text-2xl"></i>
      </button>
    </div>
  
    <!-- Mobile Navigation (Hidden by default) -->
    <nav id="mobile-menu"
     class="hidden md:hidden bg-white shadow-inner px-6 pb-4 transition-all duration-300 ease-in-out">
      <ul class="flex flex-col space-y-3 pt-2">
        <li><a href="#home" class="block hover:text-blue-600 font-medium transition-colors py-2">Home</a></li>
        <li><a href="#about" class="block hover:text-blue-600 font-medium transition-colors py-2">Tentang</a></li>
        <li><a href="#features" class="block hover:text-blue-600 font-medium transition-colors py-2">Fitur</a></li>
        <li><a href="#contact" class="block hover:text-blue-600 font-medium transition-colors py-2">Kontak</a></li>
        <li>
          <a href="{{ route('login') }}"
            class="block text-center py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
            Login
          </a>
        </li>
      </ul>
    </nav>
  </header>


  <!-- Hero Section -->
  <section id="home" class="gradient-bg text-white py-20 px-6 text-center relative overflow-hidden">
    <div class="container mx-auto max-w-4xl relative z-10 animate__animated animate__fadeIn">
      <h2 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">Menabung Digital <br class="hidden md:block"> untuk
        Siswa SMK BPPI</h2>
      <p class="text-xl text-blue-100 max-w-2xl mx-auto mb-8">Bank Mini adalah solusi keuangan digital eksklusif untuk
        siswa SMK BPPI Baleendah, memudahkan pengelolaan tabungan sekolah secara aman dan transparan.</p>
      <div class="space-y-4 md:space-y-0 md:space-x-4 flex flex-col md:flex-row justify-center">
        <button onclick="openModal()"
          class="bg-white text-blue-600 px-8 py-4 rounded-lg shadow-lg hover:bg-gray-100 font-semibold transition-all transform hover:scale-105">
          Daftar Sekarang
        </button>
        <a href="{{ route('login') }}"
          class="border-2 border-white text-white px-8 py-4 rounded-lg hover:bg-white hover:bg-opacity-10 font-semibold transition-all transform hover:scale-105">
          Masuk Akun
        </a>
      </div>
    </div>
  </section>

  <!-- Tentang Bank Mini -->
  <section id="about" class="py-20 px-6 bg-white">
    <div class="container mx-auto max-w-5xl">
      <div class="text-center mb-16 animate__animated animate__fadeIn">
        <span class="text-blue-600 font-semibold">TENTANG KAMI</span>
        <h3 class="text-3xl font-bold mt-2 text-gray-800">Apa Itu Bank Mini?</h3>
        <div class="w-20 h-1 bg-blue-600 mx-auto mt-4"></div>
      </div>

      <div class="grid md:grid-cols-2 gap-12 items-center">
        <div class="animate__animated animate__fadeInLeft">
          <h4 class="text-2xl font-semibold text-blue-700 mb-4">Solusi Keuangan Digital untuk Siswa</h4>
          <p class="text-lg text-gray-600 mb-6 leading-relaxed">
            Bank Mini adalah platform keuangan digital inovatif yang dikembangkan khusus untuk siswa SMK BPPI Baleendah.
            Aplikasi ini memungkinkan siswa untuk menabung, memantau saldo, dan melakukan transaksi keuangan secara
            digital dengan mudah dan aman.
          </p>
          <p class="text-lg text-gray-600 mb-8 leading-relaxed">
            Sebagai proyek siswa SMK BPPI, Bank Mini tidak hanya menjadi solusi keuangan tetapi juga media pembelajaran
            nyata tentang teknologi finansial bagi seluruh warga sekolah.
          </p>
        </div>
        <div class="animate__animated animate__fadeInRight bg-blue-50 p-8 rounded-xl shadow-md">
          <div class="flex items-center mb-6">
            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
              <i class="fas fa-shield-alt text-blue-600"></i>
            </div>
            <div>
              <h4 class="font-semibold text-gray-800">Terdaftar Resmi</h4>
              <p class="text-gray-600 text-sm">Dibawah pengawasan SMK BPPI Baleendah</p>
            </div>
          </div>
          <div class="flex items-center mb-6">
            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
              <i class="fas fa-clock text-blue-600"></i>
            </div>
            <div>
              <h4 class="font-semibold text-gray-800">Jam Operasional</h4>
              <p class="text-gray-600 text-sm">Senin - Jumat: 08.00 - 15.00 WIB</p>
            </div>
          </div>
          <div class="flex items-center">
            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
              <i class="fas fa-map-marker-alt text-blue-600"></i>
            </div>
            <div>
              <h4 class="font-semibold text-gray-800">Lokasi</h4>
              <p class="text-gray-600 text-sm">Gedung Utama SMK BPPI Baleendah</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Fitur Utama -->
  <section id="features" class="py-20 px-6 bg-gray-50">
    <div class="container mx-auto max-w-5xl">
      <div class="text-center mb-16 animate__animated animate__fadeIn">
        <span class="text-blue-600 font-semibold">FITUR UNGGULAN</span>
        <h3 class="text-3xl font-bold mt-2 text-gray-800">Kemudahan Menabung Digital</h3>
        <div class="w-20 h-1 bg-blue-600 mx-auto mt-4"></div>
      </div>

      <div class="grid md:grid-cols-3 gap-8">
        <div
          class="bg-white p-8 rounded-xl shadow-md transition-all duration-300 card-hover feature-card animate__animated animate__fadeInUp">
          <div class="w-16 h-16 bg-blue-100 rounded-xl flex items-center justify-center mb-6 feature-icon">
            <i class="fas fa-wallet text-blue-600 text-2xl"></i>
          </div>
          <h4 class="text-xl font-semibold text-gray-800 mb-3">Tabungan Digital</h4>
          <p class="text-gray-600">Setoran dan penarikan mudah melalui sistem digital tanpa perlu antri. Proses cepat
            dan efisien.</p>
        </div>

        <div
          class="bg-white p-8 rounded-xl shadow-md transition-all duration-300 card-hover feature-card animate__animated animate__fadeInUp animate__delay-1s">
          <div class="w-16 h-16 bg-blue-100 rounded-xl flex items-center justify-center mb-6 feature-icon">
            <i class="fas fa-history text-blue-600 text-2xl"></i>
          </div>
          <h4 class="text-xl font-semibold text-gray-800 mb-3">Riwayat Transaksi</h4>
          <p class="text-gray-600">Pantau semua aktivitas keuangan Anda secara real-time dan transparan dengan detail
            lengkap.</p>
        </div>

        <div
          class="bg-white p-8 rounded-xl shadow-md transition-all duration-300 card-hover feature-card animate__animated animate__fadeInUp animate__delay-2s">
          <div class="w-16 h-16 bg-blue-100 rounded-xl flex items-center justify-center mb-6 feature-icon">
            <i class="fas fa-shield-alt text-blue-600 text-2xl"></i>
          </div>
          <h4 class="text-xl font-semibold text-gray-800 mb-3">Keamanan Data</h4>
          <p class="text-gray-600">Sistem enkripsi canggih melindungi data dan transaksi Anda. Privasi terjamin setiap
            saat.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimoni -->
  <section class="py-20 px-6 bg-blue-600 text-white">
    <div class="container mx-auto max-w-4xl text-center">
      <div class="animate__animated animate__fadeIn">
        <span class="text-blue-200 font-semibold">TESTIMONI</span>
        <h3 class="text-3xl font-bold mt-2 mb-12">Apa Kata Pengguna Bank Mini?</h3>
      </div>

      <div class="grid md:grid-cols-2 gap-8">
        <div class="bg-white text-gray-800 p-6 rounded-xl shadow-lg animate__animated animate__fadeInUp">
          <div class="flex justify-center mb-4">
            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
              <i class="fas fa-user text-blue-600"></i>
            </div>
          </div>
          <p class="text-md italic mb-4">
            "Bank Mini sangat memudahkan saya menabung di sekolah. Tidak perlu membawa uang tunai lagi, cukup melalui
            aplikasi saja. Saldo juga bisa dipantau kapan saja!"
          </p>
          <h4 class="font-bold text-blue-600">Ani Rahmawati</h4>
          <p class="text-sm text-gray-500">Siswa Kelas XI RPL 2</p>
        </div>

        <div
          class="bg-white text-gray-800 p-6 rounded-xl shadow-lg animate__animated animate__fadeInUp animate__delay-1s">
          <div class="flex justify-center mb-4">
            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
              <i class="fas fa-user text-blue-600"></i>
            </div>
          </div>
          <p class="text-md italic mb-4">
            "Sebagai siswa jurusan TKJ, saya bisa belajar banyak dari sistem Bank Mini. Selain memudahkan menabung, juga
            menambah pengetahuan tentang sistem perbankan digital."
          </p>
          <h4 class="font-bold text-blue-600">Budi Santoso</h4>
          <p class="text-sm text-gray-500">Siswa Kelas XII TKJ 1</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Call to Action -->
  <section class="py-20 px-6 text-center bg-white">
    <div class="container mx-auto max-w-4xl animate__animated animate__fadeIn">
      <h3 class="text-3xl font-bold text-gray-800 mb-6">Siap Memulai Pengalaman Menabung Digital?</h3>
      <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">Bergabunglah dengan ratusan siswa SMK BPPI yang sudah
        merasakan kemudahan Bank Mini.</p>
      <button onclick="openModal()"
        class="gradient-bg text-white px-10 py-4 rounded-lg shadow-lg hover:shadow-xl font-semibold transition-all transform hover:scale-105">
        Daftar Sekarang
      </button>
    </div>
  </section>

  <!-- Kontak & Footer -->
  <footer id="contact" class="bg-gray-800 text-white py-12 px-6">
    <div class="container mx-auto max-w-6xl">
      <div class="grid md:grid-cols-3 gap-8">
        <div>
          <div class="flex items-center mb-4">
            <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center mr-3">
              <i class="fas fa-landmark text-white"></i>
            </div>
            <h3 class="text-xl font-bold">Bank Mini</h3>
          </div>
          <p class="text-gray-400 text-sm mb-4">Solusi menabung digital untuk siswa SMK BPPI Baleendah.</p>
          <p class="text-gray-400 text-sm">Dengan Bank Mini, menabung jadi lebih mudah, aman, dan transparan.</p>
        </div>

        <div>
          <h4 class="text-lg font-semibold mb-4">Tautan Cepat</h4>
          <ul class="space-y-2">
            <li><a href="#home" class="text-gray-400 hover:text-white transition-colors">Home</a></li>
            <li><a href="#about" class="text-gray-400 hover:text-white transition-colors">Tentang</a></li>
            <li><a href="#features" class="text-gray-400 hover:text-white transition-colors">Fitur</a></li>
            <li><a href="{{ route('login') }}" class="text-gray-400 hover:text-white transition-colors">Login</a></li>
          </ul>
        </div>

        <div>
          <h4 class="text-lg font-semibold mb-4">Kontak & Jam Operasional</h4>
          <ul class="space-y-3 text-gray-400">
            <li class="flex items-center">
              <i class="fas fa-map-marker-alt w-5 text-blue-400"></i>
              <span class="ml-2">SMK BPPI Baleendah, Jl. Raya Baleendah</span>
            </li>
            <li class="flex items-center">
              <i class="fas fa-phone w-5 text-blue-400"></i>
              <span class="ml-2">022-12345678</span>
            </li>
            <li class="flex items-center">
              <i class="fas fa-envelope w-5 text-blue-400"></i>
              <span class="ml-2">bankmini@smkbppi.sch.id</span>
            </li>
            <li class="flex items-center">
              <i class="fas fa-clock w-5 text-blue-400"></i>
              <span class="ml-2">Senin - Jumat: 08.00 - 15.00 WIB</span>
            </li>
          </ul>
        </div>
      </div>

      <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400 text-sm">
        <p>&copy; 2025 Bank Mini SMK BPPI. Hak Cipta Dilindungi.</p>
      </div>
    </div>
  </footer>

  <!-- Modal Registration -->
  <div id="register-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg p-8 max-w-md w-full mx-4 animate__animated animate__fadeInDown">
      <div class="flex justify-between items-center mb-6">
        <h3 class="text-2xl font-bold text-blue-600">Pendaftaran Bank Mini</h3>
        <button id="close-modal" class="text-gray-400 hover:text-gray-600">
          <i class="fas fa-times text-xl"></i>
        </button>
      </div>
      <div class="text-center">
        <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
          <i class="fas fa-info-circle text-3xl text-blue-600"></i>
        </div>
        <h4 class="text-xl font-semibold text-gray-800 mb-3">Informasi Pendaftaran</h4>
        <p class="text-gray-600 mb-6">Untuk melakukan pendaftaran, silahkan kunjungi Bank Mini di sekolah dan membawa:
        </p>
        <ul class="text-left space-y-3 mb-6">
          <li class="flex items-center">
            <i class="fas fa-check-circle text-green-500 mr-2"></i>
            <span>Nomor Induk Siswa (NIS)</span>
          </li>
          <li class="flex items-center">
            <i class="fas fa-check-circle text-green-500 mr-2"></i>
            <span>Username yang diinginkan</span>
          </li>
          <li class="flex items-center">
            <i class="fas fa-check-circle text-green-500 mr-2"></i>
            <span>Password untuk akun Anda</span>
          </li>
        </ul>
        <div class="bg-blue-50 p-4 rounded-lg mb-6 text-left">
          <h5 class="font-bold text-blue-700 mb-2">Jam Operasional Pendaftaran:</h5>
          <p class="text-gray-700">Senin - Jumat: 09.00 - 14.00 WIB</p>
          <p class="text-gray-700">Lokasi: Ruang Bank Mini, Lantai 1 Gedung Utama</p>
        </div>
        <button id="understand-btn"
          class="bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition duration-300 w-full">
          Saya Mengerti
        </button>
      </div>
    </div>
  </div>

  

  <script>
    function openModal() {
        document.getElementById('register-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
      }

      document.getElementById('close-modal').addEventListener('click', function () {
        document.getElementById('register-modal').classList.add('hidden');
        document.body.style.overflow = 'auto';
      });

      document.getElementById('understand-btn').addEventListener('click', function () {
        document.getElementById('register-modal').classList.add('hidden');
        document.body.style.overflow = 'auto';
      });

      // Toggle mobile menu dengan animasi
      const hamburgerBtn = document.getElementById('hamburger-btn');
      const mobileMenu = document.getElementById('mobile-menu');

      hamburgerBtn.addEventListener('click', () => {
        if (mobileMenu.classList.contains('hidden')) {
          // Saat ditampilkan, tambahkan animasi fadeInDown
          mobileMenu.classList.remove('hidden');
          mobileMenu.classList.add('animate__fadeInDown');
        } else {
          // Opsional: tambahkan animasi fadeOutUp sebelum menyembunyikan
          mobileMenu.classList.add('animate__fadeOutUp');
          setTimeout(() => {
            mobileMenu.classList.remove('animate__fadeOutUp', 'animate__fadeInDown');
            mobileMenu.classList.add('hidden');
          }, 500); // sesuaikan dengan durasi animasi
        }
      });
  </script>
</body>

</html>