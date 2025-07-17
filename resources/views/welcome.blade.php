<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMADAYA - Sistem Magang Dinas Kebudayaan Provinsi Riau</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'riau-green': '#16BC5C',  // Warna baru
                        'riau-green-light': '#059669',  // Tetap sama
                        'riau-gold': '#d97706',
                        'pastel-bg': '#f0fdf4',
                        'pastel-card': '#f5f5f4'
                    }
                }
            }
        }
    </script>
    <style>
        .slide-in {
            animation: slideIn 1s ease-out forwards;
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="font-sans bg-pastel-bg">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm fixed w-full z-50 top-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-[#16BC5C] rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-lg">S</span>
                    </div>
                    <div class="text-gray-700">
                        <h1 class="font-bold text-lg">SIMADAYA</h1>
                        <p class="text-xs">Dinas Kebudayaan Provinsi Riau</p>
                    </div>
                </div>
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="#beranda" class="text-gray-700 hover:text-[#16BC5C] transition-colors duration-300 font-medium">Beranda</a>
                    <a href="#tentang" class="text-gray-700 hover:text-[#16BC5C] transition-colors duration-300 font-medium">Tentang</a>
                    <a href="#program" class="text-gray-700 hover:text-[#16BC5C] transition-colors duration-300 font-medium">Program</a>
                    <a href="#kontak" class="text-gray-700 hover:text-[#16BC5C] transition-colors duration-300 font-medium">Kontak</a>
                    <button class="bg-[#16BC5C] text-white px-6 py-2 rounded-lg font-medium hover:bg-riau-green-light transition-colors duration-300">
                        Pendaftaran
                    </button>
                </div>
                <button class="md:hidden text-gray-700 text-2xl">
                    ☰
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="bg-white pt-32 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="slide-in">
                    <div class="inline-block bg-gray-100 text-[#16BC5C] px-4 py-2 rounded-lg text-sm font-medium mb-6">
                        Program Resmi Pemerintah Provinsi Riau
                    </div>
                    <h1 class="text-4xl lg:text-5xl font-bold mb-6 leading-tight text-gray-900">
                        Sistem Informasi Magang Daerah
                        <span class="text-[#16BC5C]">SIMADAYA</span>
                    </h1>
                    <p class="text-lg mb-8 text-gray-600 leading-relaxed">
                        Program magang resmi Dinas Kebudayaan Provinsi Riau yang bertujuan untuk meningkatkan kompetensi sumber daya manusia di bidang kebudayaan melalui pengalaman kerja profesional.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button class="bg-[#16BC5C] text-white px-8 py-3 rounded-lg font-medium hover:bg-riau-green-light transition-all duration-300">
                            Daftar Program Magang
                        </button>
                        <button class="border-2 border-[#16BC5C] text-[#16BC5C] px-8 py-3 rounded-lg font-medium hover:bg-[#16BC5C] hover:text-white transition-all duration-300">
                            Informasi Lengkap
                        </button>
                    </div>
                </div>
                <div class="relative">
                    <div class="bg-pastel-card rounded-2xl p-8 shadow-lg">
                        <div class="text-center">
                            <div class="w-20 h-20 bg-[#16BC5C] rounded-xl mx-auto mb-6 flex items-center justify-center">
                                <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"></path>
                                    <path d="M3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762z"></path>
                                    <path d="M9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0z"></path>
                                    <path d="M6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Platform Terintegrasi</h3>
                            <p class="text-gray-600 mb-6">Sistem digital terpadu untuk pengelolaan program magang yang profesional dan akuntabel</p>
                            <div class="grid grid-cols-3 gap-4 text-center">
                                <div>
                                    <div class="text-2xl font-bold text-[#16BC5C]">350+</div>
                                    <div class="text-sm text-gray-600">Alumni Magang</div>
                                </div>
                                <div>
                                    <div class="text-2xl font-bold text-[#16BC5C]">15+</div>
                                    <div class="text-sm text-gray-600">Program Aktif</div>
                                </div>
                                <div>
                                    <div class="text-2xl font-bold text-riau-gold">98%</div>
                                    <div class="text-sm text-gray-600">Tingkat Kepuasan</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="tentang" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <div class="inline-block bg-gray-100 text-[#16BC5C] px-4 py-2 rounded-lg text-sm font-medium mb-4">
                    Keunggulan SIMADAYA
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Fitur dan Layanan Unggulan</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    SIMADAYA menyediakan berbagai fasilitas dan layanan profesional untuk mendukung program magang yang berkualitas
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-pastel-card border border-gray-200 p-6 rounded-xl card-hover">
                    <div class="w-12 h-12 bg-[#16BC5C] rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Proses Pendaftaran Terstandar</h3>
                    <p class="text-gray-600">Sistem pendaftaran online yang terstruktur dengan panduan lengkap sesuai prosedur</p>
                </div>

                <div class="bg-pastel-card border border-gray-200 p-6 rounded-xl card-hover">
                    <div class="w-12 h-12 bg-[#16BC5C] rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Pembimbing Profesional</h3>
                    <p class="text-gray-600">Didampingi oleh ASN berpengalaman di bidang kebudayaan dan pengembangan SDM</p>
                </div>

                <div class="bg-pastel-card border border-gray-200 p-6 rounded-xl card-hover">
                    <div class="w-12 h-12 bg-riau-gold rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Sertifikat Resmi</h3>
                    <p class="text-gray-600">Sertifikat program magang yang diakui secara resmi oleh Pemerintah Provinsi Riau</p>
                </div>

                <div class="bg-pastel-card border border-gray-200 p-6 rounded-xl card-hover">
                    <div class="w-12 h-12 bg-[#16BC5C] rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Monitoring Berkala</h3>
                    <p class="text-gray-600">Sistem pemantauan progress dan evaluasi berkala untuk memastikan kualitas program</p>
                </div>

                <div class="bg-pastel-card border border-gray-200 p-6 rounded-xl card-hover">
                    <div class="w-12 h-12 bg-[#16BC5C] rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Komunikasi Terstruktur</h3>
                    <p class="text-gray-600">Saluran komunikasi resmi dengan pembimbing dan tim pengelola program</p>
                </div>

                <div class="bg-pastel-card border border-gray-200 p-6 rounded-xl card-hover">
                    <div class="w-12 h-12 bg-riau-gold rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Pelaporan Digital</h3>
                    <p class="text-gray-600">Sistem pelaporan digital yang memudahkan dokumentasi kegiatan magang</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Programs Section -->
    <section id="program" class="py-20 bg-pastel-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <div class="inline-block bg-white text-[#16BC5C] px-4 py-2 rounded-lg text-sm font-medium mb-4 border border-[#16BC5C]">
                    Program Magang Tersedia
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Bidang Program Magang</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    Berbagai program magang di bidang kebudayaan yang disesuaikan dengan kebutuhan pengembangan SDM dan pelestarian budaya daerah
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-200 card-hover">
                    <div class="h-32 bg-gradient-to-r from-[#16BC5C] to-riau-green-light relative">
                        <div class="absolute bottom-4 left-6">
                            <div class="bg-white text-[#16BC5C] px-3 py-1 rounded-lg text-sm font-medium">
                                3 Bulan
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Digitalisasi Warisan Budaya</h3>
                        <p class="text-gray-600 mb-4">Program magang untuk dokumentasi dan digitalisasi aset budaya daerah menggunakan teknologi informasi</p>
                        <div class="flex items-center justify-between">
                            <span class="text-[#16BC5C] font-medium">15 Kuota Tersedia</span>
                            <button class="bg-[#16BC5C] text-white px-4 py-2 rounded-lg text-sm hover:bg-riau-green-light transition-colors duration-300">
                                Lihat Detail
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-200 card-hover">
                    <div class="h-32 bg-gradient-to-r from-[#16BC5C] to-riau-green-light relative">
                        <div class="absolute bottom-4 left-6">
                            <div class="bg-white text-[#16BC5C] px-3 py-1 rounded-lg text-sm font-medium">
                                4 Bulan
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Manajemen Acara Budaya</h3>
                        <p class="text-gray-600 mb-4">Terlibat dalam perencanaan dan pelaksanaan kegiatan serta festival budaya daerah</p>
                        <div class="flex items-center justify-between">
                            <span class="text-[#16BC5C] font-medium">12 Kuota Tersedia</span>
                            <button class="bg-[#16BC5C] text-white px-4 py-2 rounded-lg text-sm hover:bg-riau-green-light transition-colors duration-300">
                                Lihat Detail
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-200 card-hover">
                    <div class="h-32 bg-gradient-to-r from-riau-gold to-yellow-500 relative">
                        <div class="absolute bottom-4 left-6">
                            <div class="bg-white text-riau-gold px-3 py-1 rounded-lg text-sm font-medium">
                                6 Bulan
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Komunikasi & Publikasi</h3>
                        <p class="text-gray-600 mb-4">Program magang di bidang komunikasi publik dan promosi kebudayaan daerah</p>
                        <div class="flex items-center justify-between">
                            <span class="text-riau-gold font-medium">10 Kuota Tersedia</span>
                            <button class="bg-riau-gold text-white px-4 py-2 rounded-lg text-sm hover:bg-yellow-600 transition-colors duration-300">
                                Lihat Detail
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-gradient-to-r from-[#16BC5C] to-riau-green-light py-16">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <div class="text-white">
                <h2 class="text-3xl font-bold mb-6">
                    Bergabung dengan Program Magang SIMADAYA
                </h2>
                <p class="text-lg mb-8 opacity-90">
                    Dapatkan pengalaman kerja profesional di lingkungan pemerintahan dan berkontribusi dalam pelestarian budaya Riau
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button class="bg-white text-[#16BC5C] px-8 py-3 rounded-lg font-medium hover:bg-gray-100 transition-all duration-300">
                        Daftar Program Magang
                    </button>
                    <button class="border-2 border-white text-white px-8 py-3 rounded-lg font-medium hover:bg-white hover:text-[#16BC5C] transition-all duration-300">
                        Unduh Panduan
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="kontak" class="bg-gray-900 text-gray-300 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-12 h-12 bg-[#16BC5C] rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-xl">S</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-xl text-white">SIMADAYA</h3>
                            <p class="text-gray-400">Dinas Kebudayaan Provinsi Riau</p>
                        </div>
                    </div>
                    <p class="text-gray-400 mb-6 leading-relaxed">
                        Sistem Informasi Magang Daerah yang dikelola oleh Dinas Kebudayaan Provinsi Riau untuk mendukung pengembangan sumber daya manusia di bidang kebudayaan.
                    </p>
                </div>
                <div>
                    <h4 class="font-semibold text-lg mb-4 text-white">Menu</h4>
                    <ul class="space-y-2">
                        <li><a href="#beranda" class="text-gray-400 hover:text-white transition-colors duration-300">Beranda</a></li>
                        <li><a href="#tentang" class="text-gray-400 hover:text-white transition-colors duration-300">Tentang</a></li>
                        <li><a href="#program" class="text-gray-400 hover:text-white transition-colors duration-300">Program</a></li>
                        <li><a href="#kontak" class="text-gray-400 hover:text-white transition-colors duration-300">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-lg mb-4 text-white">Kontak</h4>
                    <div class="space-y-3">
                        <div class="flex items-start space-x-3">
                            <div class="w-5 h-5 bg-[#16BC5C] rounded-full flex-shrink-0 mt-1"></div>
                            <span class="text-gray-400 text-sm">Jl. Diponegoro No. 43, Pekanbaru, Riau 28116</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-5 h-5 bg-[#16BC5C] rounded-full flex-shrink-0"></div>
                            <span class="text-gray-400 text-sm">(0761) 21562</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-5 h-5 bg-riau-gold rounded-full flex-shrink-0"></div>
                            <span class="text-gray-400 text-sm">simadaya@riau.go.id</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                <p class="text-gray-500 text-sm">&copy; 2025 SIMADAYA - Dinas Kebudayaan Provinsi Riau. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>
    <script>
        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Fade in animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('slide-in');
                }
            });
        }, observerOptions);

        document.querySelectorAll('section').forEach(section => {
            observer.observe(section);
        });

        // Mobile menu
        const mobileMenuButton = document.querySelector('button.md\\:hidden');
        const navLinks = document.querySelector('.hidden.md\\:flex');

        if (mobileMenuButton && navLinks) {
            let isMobileMenuOpen = false;
            mobileMenuButton.addEventListener('click', () => {
                isMobileMenuOpen = !isMobileMenuOpen;
                if (isMobileMenuOpen) {
                    navLinks.classList.remove('hidden');
                    navLinks.classList.add('flex', 'flex-col', 'absolute', 'top-20', 'left-0', 'w-full', 'bg-white', 'p-4', 'space-y-4', 'shadow-md');
                    mobileMenuButton.innerHTML = '✕';
                } else {
                    navLinks.classList.add('hidden');
                    navLinks.classList.remove('flex', 'flex-col', 'absolute', 'top-20', 'left-0', 'w-full', 'bg-white', 'p-4', 'space-y-4', 'shadow-md');
                    mobileMenuButton.innerHTML = '☰';
                }
            });
        }

        // Counter animation
        function animateCounter(element, target, suffix = '') {
            let current = 0;
            const increment = target / 80;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                element.textContent = Math.floor(current) + suffix;
            }, 25);
        }

        const heroSection = document.querySelector('#beranda');
        const counters = document.querySelectorAll('.text-2xl.font-bold');

        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    counters.forEach(counter => {
                        const target = parseInt(counter.textContent);
                        const suffix = counter.nextElementSibling.textContent.includes('%') ? '%' : '+';
                        animateCounter(counter, target, suffix);
                    });
                    counterObserver.disconnect();
                }
            });
        }, { threshold: 0.5 });

        counterObserver.observe(heroSection);
    </script>
</body>
</html>
