@extends('user.layout')

@section('content')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

        <div class="overflow-hidden h-screen relative bg-gray-100 flex flex-col" style="font-family: 'Poppins', sans-serif;">
            <!-- Floating Bubbles for Mobile Navigation -->
            <div class="fixed bottom-6 left-0 right-0 flex justify-center space-x-3 z-20 md:hidden bubble-nav">
                @for ($i = 0; $i < 7; $i++)
                    <button onclick="scrollToSlide({{ $i }})"
                        class="w-4 h-4 rounded-full bg-white/40 border border-white/60 transition-all duration-300 bubble-dot"
                        data-slide="{{ $i }}"></button>
                @endfor
            </div>

            <!-- Carousel Container -->
            <div class="flex-1 flex w-full transition-transform duration-700 ease-[cubic-bezier(0.16,1,0.3,1)]" id="carousel"
                style="width: calc(100vw * 7);">
                <!-- Slide 1: Header -->
                <div
                    class="w-screen h-full flex-shrink-0 relative overflow-hidden bg-gradient-to-br from-indigo-600 to-purple-700">
                    <div
                        class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=1470&auto=format&fit=crop')] bg-cover bg-center opacity-10">
                    </div>
                    <div class="absolute inset-0 flex flex-col justify-center items-center text-center px-4 z-10">
                        <div class="animate__animated animate__fadeInDown animate__fast">
                            <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">Tentang Kami</h1>
                            <div class="w-24 h-1.5 bg-white/60 rounded-full mx-auto mb-8"></div>
                            <p class="text-xl text-white/90 mb-8 max-w-2xl px-4">
                                Pelajari lebih lanjut tentang SMK BPPI, Bank Mini, dan tim pengembang di balik website ini.
                            </p>
                        </div>

                        <div class="animate__animated animate__fadeInUp animate__fast animate__delay-1s">
                            <div class="flex flex-col sm:flex-row justify-center gap-4">
                                <button onclick="scrollToSlide(1)"
                                    class="bg-white text-indigo-600 px-8 py-3 rounded-full hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-lg font-medium flex items-center group">
                                    Mulai Jelajah
                                    <span class="ml-2 group-hover:translate-x-1 transition-transform duration-300">
                                        <i class="fas fa-arrow-right"></i>
                                    </span>
                                </button>
                                <a href="{{ route('user.dashboard') }}"
                                    class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-full hover:bg-white/10 transition-all duration-300 transform hover:scale-105 font-medium flex items-center group">
                                    <span class="mr-2 group-hover:-translate-x-1 transition-transform duration-300">
                                        <i class="fas fa-arrow-left"></i>
                                    </span>
                                    Kembali
                                </a>

                            </div>
                        </div>
                    </div>

                    <div class="absolute bottom-8 left-0 right-0 flex justify-center animate-bounce-slow z-10">
                        <button onclick="scrollToSlide(1)" class="text-white/80 text-2xl hover:text-white transition-colors">
                            <i class="fas fa-chevron-down"></i>
                        </button>
                    </div>
                </div>

                <!-- Slide 2: SMK BPPI -->
                <div class="w-screen h-full flex-shrink-0 relative overflow-hidden bg-gray-50">
                    <div class="absolute inset-0 flex items-center justify-center p-4">
                        <div
                            class="bg-white rounded-2xl shadow-2xl w-full h-full max-w-6xl flex flex-col md:flex-row overflow-hidden transition-all duration-500 hover:shadow-2xl">
                            <div
                                class="w-full md:w-2/5 bg-gradient-to-b from-blue-500 to-blue-600 flex items-center justify-center p-8 relative overflow-hidden">
                                <div
                                    class="absolute inset-0 opacity-10 pattern-dots pattern-blue-400 pattern-bg-transparent pattern-size-6 pattern-opacity-100">
                                </div>
                                <div
                                    class="relative z-10 p-6 bg-white/90 backdrop-blur-sm rounded-full shadow-lg animate-float">
                                    <img src="{{ asset('images/bppi.png') }}"
                                        class="w-48 h-48 object-contain rounded-full border-4 border-white/80">
                                </div>
                            </div>

                            <div class="w-full md:w-3/5 p-8 md:p-10 overflow-y-auto custom-scroll">
                                <h2 class="text-3xl font-bold text-gray-800 mb-4">Tentang SMK BPPI Baleendah</h2>
                                <div class="w-16 h-1.5 bg-blue-500 rounded-full mb-6"></div>
                                <p
                                    class="text-gray-600 text-lg leading-relaxed mb-6 animate__animated animate__fadeIn animate__fast">
                                    SMK BPPI Baleendah adalah sekolah kejuruan yang berfokus pada pengembangan keterampilan
                                    siswa di bidang teknologi, bisnis, dan industri. Dengan fasilitas modern dan tenaga pengajar
                                    profesional, SMK BPPI berkomitmen untuk mencetak lulusan yang siap bersaing di dunia kerja.
                                </p>
                                <ul class="space-y-4">
                                    <li
                                        class="flex items-start animate__animated animate__fadeInRight animate__fast animate__delay-1s">
                                        <div class="bg-blue-100 p-2 rounded-full mr-4 flex-shrink-0">
                                            <i class="fas fa-check-circle text-blue-500 text-lg"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-gray-800">Fasilitas Modern</h3>
                                            <p class="text-gray-600 text-sm">Berbasis industri dengan teknologi terkini</p>
                                        </div>
                                    </li>
                                    <li
                                        class="flex items-start animate__animated animate__fadeInRight animate__fast animate__delay-1s">
                                        <div class="bg-blue-100 p-2 rounded-full mr-4 flex-shrink-0">
                                            <i class="fas fa-chalkboard-teacher text-blue-500 text-lg"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-gray-800">Pengajar Profesional</h3>
                                            <p class="text-gray-600 text-sm">Tenaga pengajar berpengalaman di bidangnya</p>
                                        </div>
                                    </li>
                                    <li
                                        class="flex items-start animate__animated animate__fadeInRight animate__fast animate__delay-1s">
                                        <div class="bg-blue-100 p-2 rounded-full mr-4 flex-shrink-0">
                                            <i class="fas fa-book text-blue-500 text-lg"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-gray-800">Kurikulum Kompetensi</h3>
                                            <p class="text-gray-600 text-sm">Berorientasi pada kebutuhan dunia kerja</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 3: Bank Mini -->
                <div
                    class="w-screen h-full flex-shrink-0 relative overflow-hidden bg-gradient-to-br from-teal-500 to-emerald-600">
                    <div class="absolute inset-0 flex items-center justify-center p-4">
                        <div
                            class="bg-white rounded-2xl shadow-2xl w-full h-full max-w-6xl flex flex-col md:flex-row overflow-hidden transition-all duration-500 hover:shadow-2xl">
                            <div class="w-full md:w-1/2 p-8 md:p-10 order-2 md:order-1 overflow-y-auto custom-scroll">
                                <h2 class="text-3xl font-bold text-gray-800 mb-4">Tentang Bank Mini</h2>
                                <div class="w-16 h-1.5 bg-teal-500 rounded-full mb-6"></div>
                                <p
                                    class="text-gray-600 text-lg leading-relaxed mb-6 animate__animated animate__fadeIn animate__fast">
                                    Bank Mini adalah platform simulasi perbankan yang dirancang untuk siswa SMK BPPI. Tujuannya
                                    adalah memberikan pengalaman praktis dalam mengelola keuangan, seperti menabung, mencatat
                                    transaksi, dan memahami konsep perbankan modern.
                                </p>

                                <div class="grid grid-cols-2 gap-4">
                                    <div
                                        class="bg-teal-50 p-4 rounded-xl hover:bg-teal-100 transition-all duration-300 transform hover:-translate-y-1 animate__animated animate__fadeIn animate__delay-1s">
                                        <div
                                            class="bg-teal-100 w-12 h-12 rounded-full flex items-center justify-center mb-3 mx-auto">
                                            <i class="fas fa-piggy-bank text-teal-600 text-xl"></i>
                                        </div>
                                        <h3 class="font-semibold text-center">Simulasi Tabungan</h3>
                                    </div>
                                    <div
                                        class="bg-teal-50 p-4 rounded-xl hover:bg-teal-100 transition-all duration-300 transform hover:-translate-y-1 animate__animated animate__fadeIn animate__delay-1s">
                                        <div
                                            class="bg-teal-100 w-12 h-12 rounded-full flex items-center justify-center mb-3 mx-auto">
                                            <i class="fas fa-exchange-alt text-teal-600 text-xl"></i>
                                        </div>
                                        <h3 class="font-semibold text-center">Transaksi Real-time</h3>
                                    </div>
                                    <div
                                        class="bg-teal-50 p-4 rounded-xl hover:bg-teal-100 transition-all duration-300 transform hover:-translate-y-1 animate__animated animate__fadeIn animate__delay-1s">
                                        <div
                                            class="bg-teal-100 w-12 h-12 rounded-full flex items-center justify-center mb-3 mx-auto">
                                            <i class="fas fa-chart-line text-teal-600 text-xl"></i>
                                        </div>
                                        <h3 class="font-semibold text-center">Laporan Keuangan</h3>
                                    </div>
                                    <div
                                        class="bg-teal-50 p-4 rounded-xl hover:bg-teal-100 transition-all duration-300 transform hover:-translate-y-1 animate__animated animate__fadeIn animate__delay-1s">
                                        <div
                                            class="bg-teal-100 w-12 h-12 rounded-full flex items-center justify-center mb-3 mx-auto">
                                            <i class="fas fa-user-graduate text-teal-600 text-xl"></i>
                                        </div>
                                        <h3 class="font-semibold text-center">Edukasi Finansial</h3>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="w-full md:w-1/2 bg-gradient-to-b from-teal-600 to-emerald-700 flex items-center justify-center p-8 order-1 md:order-2 relative overflow-hidden">
                                <div
                                    class="absolute inset-0 opacity-10 pattern-dots pattern-teal-400 pattern-bg-transparent pattern-size-6 pattern-opacity-100">
                                </div>
                                <div
                                    class="relative z-10 p-6 bg-white/90 backdrop-blur-sm rounded-full shadow-lg animate-float-slow">
                                    <img src="{{ asset('images/bank.png') }}"
                                        class="w-48 h-48 object-contain rounded-full border-4 border-white/80">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 4: Studio Pengembang -->
                <div
                    class="w-screen h-full flex-shrink-0 relative overflow-hidden bg-gradient-to-br from-purple-600 to-indigo-700">
                    <div class="absolute inset-0 flex items-center justify-center p-4">
                        <div
                            class="bg-white rounded-2xl shadow-2xl w-full h-full max-w-6xl overflow-hidden transition-all duration-500 hover:shadow-2xl">
                            <div class="w-full p-8 md:p-10 text-center overflow-y-auto custom-scroll">
                                <div class="flex justify-center mb-8 animate__animated animate__zoomIn">
                                    <div class="p-4 bg-white/90 backdrop-blur-sm rounded-full shadow-lg inline-block">
                                        <img src="{{ asset('images/pplg.png') }}"
                                            class="w-32 h-32 object-contain rounded-full border-4 border-white/80">
                                    </div>
                                </div>

                                <h2 class="text-3xl font-bold text-gray-800 mb-4 animate__animated animate__fadeIn">Tentang
                                    Studio Pengembang</h2>
                                <div class="w-16 h-1.5 bg-purple-500 rounded-full mb-6 mx-auto"></div>

                                <p
                                    class="text-gray-600 text-lg leading-relaxed mb-8 max-w-3xl mx-auto animate__animated animate__fadeIn animate__fast">
                                    Website ini dikembangkan oleh tim pengembang dari Studio Kreatif BPPI. Kami berfokus pada
                                    pembuatan aplikasi berbasis web yang inovatif dan user-friendly untuk mendukung kebutuhan
                                    pendidikan dan bisnis.
                                </p>

                                <div class="flex flex-wrap justify-center gap-6">
                                    <div
                                        class="bg-purple-50 p-6 rounded-xl w-full sm:w-64 transform hover:-translate-y-2 transition-all duration-300 hover:shadow-lg animate__animated animate__fadeInUp animate__delay-1s">
                                        <div
                                            class="bg-purple-100 w-14 h-14 rounded-full flex items-center justify-center mb-4 mx-auto">
                                            <i class="fas fa-code text-purple-600 text-2xl"></i>
                                        </div>
                                        <h3 class="font-bold text-lg mb-2">Teknologi Modern</h3>
                                        <p class="text-gray-600 text-sm">Menggunakan framework terbaru untuk performa optimal
                                        </p>
                                    </div>

                                    <div
                                        class="bg-purple-50 p-6 rounded-xl w-full sm:w-64 transform hover:-translate-y-2 transition-all duration-300 hover:shadow-lg animate__animated animate__fadeInUp animate__delay-1s">
                                        <div
                                            class="bg-purple-100 w-14 h-14 rounded-full flex items-center justify-center mb-4 mx-auto">
                                            <i class="fas fa-mobile-alt text-purple-600 text-2xl"></i>
                                        </div>
                                        <h3 class="font-bold text-lg mb-2">Responsive Design</h3>
                                        <p class="text-gray-600 text-sm">Akses dari perangkat apapun dengan tampilan optimal</p>
                                    </div>

                                    <div
                                        class="bg-purple-50 p-6 rounded-xl w-full sm:w-64 transform hover:-translate-y-2 transition-all duration-300 hover:shadow-lg animate__animated animate__fadeInUp animate__delay-1s">
                                        <div
                                            class="bg-purple-100 w-14 h-14 rounded-full flex items-center justify-center mb-4 mx-auto">
                                            <i class="fas fa-shield-alt text-purple-600 text-2xl"></i>
                                        </div>
                                        <h3 class="font-bold text-lg mb-2">Keamanan Data</h3>
                                        <p class="text-gray-600 text-sm">Proteksi data pengguna dengan sistem enkripsi</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 5: Unit Produksi -->
                <div
                    class="w-screen h-full flex-shrink-0 relative overflow-hidden bg-gradient-to-br from-amber-500 to-orange-600">
                    <div class="absolute inset-0 flex items-center justify-center p-4">
                        <div
                            class="bg-white rounded-2xl shadow-2xl w-full h-full max-w-6xl flex flex-col md:flex-row overflow-hidden transition-all duration-500 hover:shadow-2xl">
                            <div class="w-full md:w-1/2 p-0 overflow-hidden relative">
                                <img src="https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
                                    class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                            </div>

                            <div class="w-full md:w-1/2 p-8 md:p-10 overflow-y-auto custom-scroll">
                                <h2 class="text-3xl font-bold text-gray-800 mb-4">Tentang Unit Produksi</h2>
                                <div class="w-16 h-1.5 bg-amber-500 rounded-full mb-6"></div>

                                <p
                                    class="text-gray-600 text-lg leading-relaxed mb-6 animate__animated animate__fadeIn animate__fast">
                                    Unit Produksi SMK BPPI adalah bagian dari sekolah yang menyediakan layanan dan produk untuk
                                    masyarakat. Tujuannya adalah memberikan pengalaman kerja nyata kepada siswa melalui kegiatan
                                    produksi dan layanan berbasis industri.
                                </p>

                                <div class="space-y-5">
                                    <div
                                        class="flex items-start animate__animated animate__fadeInRight animate__fast animate__delay-1s">
                                        <div class="bg-amber-100 p-3 rounded-full mr-4 flex-shrink-0">
                                            <i class="fas fa-industry text-amber-600 text-lg"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-gray-800">Praktik Industri</h3>
                                            <p class="text-gray-600 text-sm">Siswa mendapatkan pengalaman kerja langsung di
                                                lingkungan produksi nyata</p>
                                        </div>
                                    </div>

                                    <div
                                        class="flex items-start animate__animated animate__fadeInRight animate__fast animate__delay-1s">
                                        <div class="bg-amber-100 p-3 rounded-full mr-4 flex-shrink-0">
                                            <i class="fas fa-boxes text-amber-600 text-lg"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-gray-800">Produk Nyata</h3>
                                            <p class="text-gray-600 text-sm">Menghasilkan produk dan jasa yang digunakan oleh
                                                masyarakat umum</p>
                                        </div>
                                    </div>

                                    <div
                                        class="flex items-start animate__animated animate__fadeInRight animate__fast animate__delay-1s">
                                        <div class="bg-amber-100 p-3 rounded-full mr-4 flex-shrink-0">
                                            <i class="fas fa-hand-holding-usd text-amber-600 text-lg"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-gray-800">Kewirausahaan</h3>
                                            <p class="text-gray-600 text-sm">Mengembangkan jiwa wirausaha dan manajemen bisnis
                                                siswa</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 6: Lokasi -->
                <div class="w-screen h-full flex-shrink-0 relative overflow-hidden bg-gradient-to-br from-rose-600 to-pink-700">
                    <div class="absolute inset-0 flex items-center justify-center p-4">
                        <div
                            class="bg-white rounded-2xl shadow-2xl w-full h-full max-w-6xl overflow-hidden transition-all duration-500 hover:shadow-2xl">
                            <div class="w-full h-full flex flex-col md:flex-row">
                                <div class="w-full md:w-1/2 p-8 md:p-10 overflow-y-auto custom-scroll">
                                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Lokasi Kami</h2>
                                    <div class="w-16 h-1.5 bg-rose-500 rounded-full mb-6"></div>

                                    <div class="space-y-6">
                                        <div class="animate__animated animate__fadeIn animate__fast">
                                            <h3 class="font-semibold text-lg flex items-center">
                                                <div
                                                    class="bg-rose-100 w-10 h-10 rounded-full flex items-center justify-center mr-3">
                                                    <i class="fas fa-map-marker-alt text-rose-600"></i>
                                                </div>
                                                Alamat
                                            </h3>
                                            <p class="text-gray-600 mt-2 ml-13">
                                                SMK BPPI Baleendah, Jl. Raya Laswi No.1, Baleendah, Kabupaten Bandung, Jawa
                                                Barat, Indonesia.
                                            </p>
                                        </div>

                                        <div class="animate__animated animate__fadeIn animate__fast">
                                            <h3 class="font-semibold text-lg flex items-center">
                                                <div
                                                    class="bg-rose-100 w-10 h-10 rounded-full flex items-center justify-center mr-3">
                                                    <i class="fas fa-clock text-rose-600"></i>
                                                </div>
                                                Jam Operasional
                                            </h3>
                                            <p class="text-gray-600 mt-2 ml-13">
                                                Senin - Jumat: 07:00 - 16:00 WIB<br>
                                                Sabtu: 08:00 - 14:00 WIB
                                            </p>
                                        </div>

                                        <div class="animate__animated animate__fadeIn animate__fast">
                                            <h3 class="font-semibold text-lg flex items-center">
                                                <div
                                                    class="bg-rose-100 w-10 h-10 rounded-full flex items-center justify-center mr-3">
                                                    <i class="fas fa-phone-alt text-rose-600"></i>
                                                </div>
                                                Kontak
                                            </h3>
                                            <p class="text-gray-600 mt-2 ml-13">
                                                Telepon: (022) 1234567<br>
                                                Email: info@smkbppi.sch.id
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-full md:w-1/2 h-64 md:h-auto relative">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31686.123456789!2d107.612345!3d-6.987654!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e1234567890!2sSMK%20BPPI%20Baleendah!5e0!3m2!1sen!2sid!4v1234567890"
                                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                                        class="absolute inset-0">
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 7: Footer -->
                <div
                    class="w-screen h-full flex-shrink-0 relative overflow-hidden bg-gradient-to-br from-blue-800 to-indigo-900">
                    <div
                        class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1518655048521-f130df041f66?q=80&w=1470&auto=format&fit=crop')] bg-cover bg-center opacity-10">
                    </div>
                    <div class="absolute inset-0 flex flex-col items-center justify-center p-8 text-center z-10">
                        <div class="max-w-2xl animate__animated animate__zoomIn">
                            <h2 class="text-4xl font-bold text-white mb-6">Terima Kasih</h2>
                            <div class="w-24 h-1.5 bg-white/60 rounded-full mx-auto mb-8"></div>
                            <p class="text-xl text-white/90 mb-8 leading-relaxed">
                                Terima kasih telah mengunjungi halaman tentang kami. Semoga informasi ini bermanfaat dan
                                memberikan gambaran lengkap tentang SMK BPPI Baleendah.
                            </p>

                            <div class="flex justify-center space-x-6 mb-8">
                                <a href="#"
                                    class="text-white text-2xl hover:text-blue-300 transition-all duration-300 transform hover:scale-125">
                                    <i class="fab fa-facebook"></i>
                                </a>
                                <a href="#"
                                    class="text-white text-2xl hover:text-blue-400 transition-all duration-300 transform hover:scale-125">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#"
                                    class="text-white text-2xl hover:text-pink-500 transition-all duration-300 transform hover:scale-125">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="#"
                                    class="text-white text-2xl hover:text-red-500 transition-all duration-300 transform hover:scale-125">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </div>

                            <p class="text-white/80 text-sm mb-8">
                                &copy; {{ date('Y') }} Bank Mini | SMK BPPI Baleendah. Dikembangkan oleh Studio Kreatif BPPI.
                            </p>

                            <button onclick="scrollToSlide(0)"
                                class="bg-white text-blue-600 px-8 py-3 rounded-full hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-lg font-medium flex items-center mx-auto group">
                                <span class="mr-2 group-hover:-rotate-360 transition-transform duration-700">
                                    <i class="fas fa-redo"></i>
                                </span>
                                Kembali ke Awal
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Arrows -->
            <button onclick="prevSlide()"
                class="hidden md:block fixed left-4 top-1/2 transform -translate-y-1/2 bg-white/90 text-gray-800 p-4 rounded-full shadow-lg hover:bg-white transition-all duration-300 z-10 hover:scale-110 group">
                <i class="fas fa-chevron-left group-hover:-translate-x-1 transition-transform duration-300"></i>
            </button>
            <button onclick="nextSlide()"
                class="hidden md:block fixed right-4 top-1/2 transform -translate-y-1/2 bg-white/90 text-gray-800 p-4 rounded-full shadow-lg hover:bg-white transition-all duration-300 z-10 hover:scale-110 group">
                <i class="fas fa-chevron-right group-hover:translate-x-1 transition-transform duration-300"></i>
            </button>
        </div>

        <script>
            let currentSlide = 0;
            const totalSlides = document.querySelectorAll('#carousel > div').length;
            const carousel = document.getElementById('carousel');
            const dots = document.querySelectorAll('.bubble-dot');

            function updateCarousel() {
                carousel.style.transform = `translateX(-${currentSlide * 100}vw)`;
                dots.forEach((dot, index) => {
                    if (index === currentSlide) {
                        dot.classList.add('bg-white', 'w-6');
                        dot.classList.remove('bg-white/40', 'w-4');
                    } else {
                        dot.classList.remove('bg-white', 'w-6');
                        dot.classList.add('bg-white/40', 'w-4');
                    }
                });
            }

            function scrollToSlide(index) {
                currentSlide = index;
                updateCarousel();

                // Animate the active bubble
                const activeBubble = document.querySelector(`.bubble-dot[data-slide="${index}"]`);
                activeBubble.classList.add('animate-pulse');
                setTimeout(() => {
                    activeBubble.classList.remove('animate-pulse');
                }, 500);
            }

            function nextSlide() {
                if (currentSlide < totalSlides - 1) {
                    currentSlide++;
                    updateCarousel();
                }
            }

            function prevSlide() {
                if (currentSlide > 0) {
                    currentSlide--;
                    updateCarousel();
                }
            }

            // Keyboard navigation
            document.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowRight') nextSlide();
                if (e.key === 'ArrowLeft') prevSlide();
            });

            // Swipe support
            let touchStartX = 0;
            let touchEndX = 0;

            carousel.addEventListener('touchstart', e => {
                touchStartX = e.changedTouches[0].screenX;
            }, { passive: true });

            carousel.addEventListener('touchend', e => {
                touchEndX = e.changedTouches[0].screenX;
                if (touchEndX < touchStartX - 50) nextSlide();
                if (touchEndX > touchStartX + 50) prevSlide();
            }, { passive: true });

            // Add animation classes when elements come into view
            const observerOptions = {
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate__animated', 'animate__fadeIn');
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.animate-on-scroll').forEach(el => {
                observer.observe(el);
            });

            updateCarousel();
        </script>

        <style>
            html,
            body {
                margin: 0;
                padding: 0;
                overflow-x: hidden;
                height: 100%;
                scroll-behavior: smooth;
            }

            #carousel {
                display: flex;
                width: calc(100vw * 7);
                scroll-snap-type: x mandatory;
            }

            #carousel>div {
                width: 100vw;
                flex-shrink: 0;
                height: 100vh;
                scroll-snap-align: start;
            }

            /* Custom scrollbar */
            .custom-scroll::-webkit-scrollbar {
                width: 6px;
                height: 6px;
            }

            .custom-scroll::-webkit-scrollbar-track {
                background: rgba(0, 0, 0, 0.05);
                border-radius: 10px;
            }

            .custom-scroll::-webkit-scrollbar-thumb {
                background: rgba(0, 0, 0, 0.2);
                border-radius: 10px;
            }

            .custom-scroll::-webkit-scrollbar-thumb:hover {
                background: rgba(0, 0, 0, 0.3);
            }

            /* Bubble Navigation */
            .bubble-nav {
                background: rgba(0, 0, 0, 0.2);
                backdrop-filter: blur(10px);
                padding: 10px 16px;
                border-radius: 999px;
                width: fit-content;
                margin: 0 auto;
            }

            .bubble-dot {
                transition: all 0.3s ease;
            }

            /* Animations */
            @keyframes bounce-slow {

                0%,
                100% {
                    transform: translateY(0);
                }

                50% {
                    transform: translateY(-10px);
                }
            }

            .animate-bounce-slow {
                animation: bounce-slow 2s infinite;
            }

            @keyframes float {

                0%,
                100% {
                    transform: translateY(0);
                }

                50% {
                    transform: translateY(-10px);
                }
            }

            @keyframes float-slow {

                0%,
                100% {
                    transform: translateY(0);
                }

                50% {
                    transform: translateY(-8px);
                }
            }

            .animate-float {
                animation: float 4s ease-in-out infinite;
            }

            .animate-float-slow {
                animation: float-slow 5s ease-in-out infinite;
            }

            /* Dot patterns */
            .pattern-dots {
                background-image: radial-gradient(currentColor 1px, transparent 1px);
                background-size: 15px 15px;
            }

            /* Image integration */
            img {
                background-color: white;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            }

            /* Responsive adjustments */
            @media (max-width: 768px) {
                .bubble-nav {
                    bottom: 20px;
                }

                #carousel>div {
                    padding-bottom: 60px;
                }
            }
        </style>
@endsection