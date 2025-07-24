<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $landingPage->meta_title }}</title>
    <meta name="description" content="{{ $landingPage->meta_description }}">
    <meta name="keywords" content="{{ $landingPage->meta_keywords }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'riau-green': '#16BC5C',
                        'riau-green-light': '#059669',
                        'riau-gold': '#d97706',
                        'pastel-bg': '#f0fdf4',
                        'pastel-card': '#f5f5f4'
                    }
                }
            }
        }
    </script>
    <style>
        .slide-in { animation: slideIn 1s ease-out forwards; }
        @keyframes slideIn { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-5px); box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); }
        .mobile-menu { transform: translateY(-100%); transition: transform 0.3s ease-in-out; }
        .mobile-menu.open { transform: translateY(0); }
    </style>
</head>
<body class="font-sans bg-pastel-bg">
<!-- Navigation -->
<nav class="bg-white shadow-sm fixed w-full z-50 top-0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20 sm:h-24">
            <div class="flex items-center space-x-3">
                <div class="flex items-center space-x-2">
                    <img src="https://disbud.riau.go.id/assets/guest/img/image/logo-riau.png" alt="Logo Dinas Kebudayaan Provinsi Riau" class="h-12 w-auto object-contain" onerror="this.src='/images/fallback-logo-riau.png';">
                    <img src="https://disbud.riau.go.id/assets/guest/img/image/logo-disbud.png" alt="Logo SIMADAYA" class="h-12 w-auto object-contain" onerror="this.src='/images/fallback-logo-disbud.png';">
                </div>
                <div class="text-gray-700">
                    <h1 class="font-bold text-lg text-teal-300">SIMADAYA</h1>
                    <p class="text-xs">Sistem Magang Dinas Kebudayaan</p>
                </div>
            </div>
            <div class="hidden md:flex space-x-8 items-center">
                <a href="#beranda" class="text-gray-700 hover:text-[#16BC5C] transition-colors duration-300 font-medium">Beranda</a>
                <a href="#tentang" class="text-gray-700 hover:text-[#16BC5C] transition-colors duration-300 font-medium">Tentang</a>
                <a href="#program" class="text-gray-700 hover:text-[#16BC5C] transition-colors duration-300 font-medium">Program</a>
                <a href="#kontak" class="text-gray-700 hover:text-[#16BC5C] transition-colors duration-300 font-medium">Kontak</a>
                <a href='/dashboard' class="bg-[#16BC5C] text-white px-6 py-2 rounded-lg font-medium hover:bg-riau-green-light transition-colors duration-300">
                    Dashboard
                </a>
            </div>
            <button class="md:hidden text-gray-700 text-2xl focus:outline-none" id="mobile-menu-toggle">
                ☰
            </button>
        </div>
        <div class="mobile-menu hidden md:hidden bg-white shadow-md w-full absolute left-0 top-20 sm:top-24" id="mobile-menu">
            <div class="flex flex-col items-center space-y-4 py-4">
                <a href="#beranda" class="text-gray-700 hover:text-[#16BC5C] font-medium text-lg">Beranda</a>
                <a href="#tentang" class="text-gray-700 hover:text-[#16BC5C] font-medium text-lg">Tentang</a>
                <a href="#program" class="text-gray-700 hover:text-[#16BC5C] font-medium text-lg">Program</a>
                <a href="#kontak" class="text-gray-700 hover:text-[#16BC5C] font-medium text-lg">Kontak</a>
                <a href='/dashboard' class="bg-[#16BC5C] text-white px-6 py-2 rounded-lg font-medium hover:bg-riau-green-light transition-colors duration-300 w-full max-w-xs">
                    Dashboard
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section id="beranda" class="bg-white pt-24 sm:pt-32 pb-12 sm:pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="slide-in">
                <div class="inline-block bg-gray-100 text-[#16BC5C] px-4 py-2 rounded-lg text-sm font-medium mb-4 sm:mb-6">
                    Program Resmi Pemerintah Provinsi Riau
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-4 sm:mb-6 leading-tight text-gray-900">
                    {{ $landingPage->hero_title }}
                </h1>
                <p class="text-base sm:text-lg mb-6 sm:mb-8 text-gray-600 leading-relaxed">
                    {{ $landingPage->hero_subtitle }}
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                  <button onclick="document.getElementById('program').scrollIntoView({ behavior: 'smooth' });"
    class="bg-[#16BC5C] text-white px-6 sm:px-8 py-3 rounded-lg font-medium hover:bg-riau-green-light transition-all duration-300">
    {{ $landingPage->hero_cta_text }}
</button>
                    <button class="border-2 border-[#16BC5C] text-[#16BC5C] px-6 sm:px-8 py-3 rounded-lg font-medium hover:bg-[#16BC5C] hover:text-white transition-all duration-300">
                        {{ $landingPage->hero_secondary_cta_text }}
                    </button>
                </div>

            </div>
            <div class="relative">
                <div class="bg-pastel-card rounded-2xl p-6 sm:p-8 shadow-lg">
                    <div class="text-center">
                        <div class="w-16 sm:w-20 h-16 sm:h-20 bg-[#16BC5C] rounded-xl mx-auto mb-4 sm:mb-6 flex items-center justify-center">
                            <svg class="w-8 sm:w-10 h-8 sm:h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"></path>
                                <path d="M3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762z"></path>
                                <path d="M9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0z"></path>
                                <path d="M6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-4">Platform Terintegrasi</h3>
                        <p class="text-gray-600 mb-4 sm:mb-6 text-sm sm:text-base">Sistem digital terpadu untuk pengelolaan program magang yang profesional dan akuntabel</p>
                        <div class="grid grid-cols-3 gap-4 text-center">
                            @foreach ($landingPage->statistics as $stat)
                                <div>
                                    <div class="text-xl sm:text-2xl font-bold {{ $stat['label'] === 'Tingkat Kepuasan' ? 'text-riau-gold' : 'text-[#16BC5C]' }}">
                                        {{ $stat['value'] }}
                                    </div>
                                    <div class="text-xs sm:text-sm text-gray-600">{{ $stat['label'] }}{{ $stat['suffix'] }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="tentang" class="py-12 sm:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 sm:mb-16">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-6">{{ $landingPage->about_title }}</h2>
            <p class="text-base sm:text-lg text-gray-600 max-w-3xl mx-auto">
                {{ $landingPage->about_description }}
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            @foreach ($landingPage->features as $feature)
                <div class="bg-pastel-card border border-gray-200 p-6 rounded-xl card-hover">
                    <div class="w-12 h-12 bg-{{ $feature['color'] === 'yellow' ? 'riau-gold' : 'riau-green' }} rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            @if ($feature['icon'] === 'check-circle')
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            @elseif ($feature['icon'] === 'user-group')
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                            @elseif ($feature['icon'] === 'star')
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            @elseif ($feature['icon'] === 'chart-bar')
                                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                            @elseif ($feature['icon'] === 'mail')
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                            @elseif ($feature['icon'] === 'clipboard-list')
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                            @elseif ($feature['icon'] === 'academic-cap')
                                <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.825-2.998 12.083 12.083 0 01.665-6.479L12 14z"></path>
                            @endif
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">{{ $feature['title'] }}</h3>
                    <p class="text-gray-600 text-sm sm:text-base">{{ $feature['description'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Programs Section -->
<section id="program" class="py-12 sm:py-20 bg-pastel-bg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 sm:mb-16">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-6">{{ $landingPage->programs_title }}</h2>
            <p class="text-base sm:text-lg text-gray-600 max-w-3xl mx-auto">
                {{ $landingPage->programs_description }}
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            @foreach ($landingPage->programs as $program)
                <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-200 card-hover">
                    <!-- Background Image Header -->
                    <div class="h-24 sm:h-32 bg-cover bg-center bg-no-repeat relative"
                         style="background-image: url('{{ $program['image'] ?? '/images/default-program.jpg' }}');">
                        <!-- Overlay untuk memastikan text terlihat -->
                        <div class="absolute inset-0 bg-black bg-opacity-30"></div>
                        <div class="absolute bottom-4 left-6">
                            <div class="bg-white text-{{ $program['color'] === 'yellow' ? 'riau-gold' : 'riau-green' }} px-3 py-1 rounded-lg text-sm font-medium shadow-sm">
                                {{ $program['duration'] }}
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">{{ $program['title'] }}</h3>
                        <p class="text-gray-600 mb-4 text-sm sm:text-base">{{ $program['description'] }}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-{{ $program['color'] === 'yellow' ? 'riau-gold' : 'riau-green' }} font-medium">{{ $program['quota'] }}</span>
                            <button class="bg-{{ $program['color'] === 'yellow' ? 'riau-gold' : 'riau-green' }} text-white px-4 py-2 rounded-lg text-sm hover:bg-{{ $program['color'] === 'yellow' ? 'riau-gold' : 'riau-green-light' }} transition-colors duration-300">
                                Lihat Detail
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="bg-white py-12 sm:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 sm:mb-16">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-6">{{ $landingPage->testimonials_title }}</h2>
            <p class="text-base sm:text-lg text-gray-600 max-w-3xl mx-auto">
                {{ $landingPage->testimonials_description }}
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            @foreach ($landingPage->testimonials as $testimonial)
                <div class="bg-pastel-card border border-gray-200 p-6 rounded-xl shadow-sm">
                    <p class="text-gray-600 italic mb-4">{{ $testimonial['quote'] }}</p>
                    <div class="flex items-center space-x-4">
                        <img src="{{ $testimonial['image'] ?: 'https://via.placeholder.com/48' }}" alt="{{ $testimonial['author'] }}" class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <h4 class="font-semibold text-gray-900 text-sm">{{ $testimonial['author'] }}</h4>
                            <p class="text-xs text-gray-500">{{ $testimonial['title'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="bg-gradient-to-r from-[#16BC5C] to-riau-green-light py-12 sm:py-16">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <div class="text-white">
            <h2 class="text-2xl sm:text-3xl font-bold mb-6">{{ $landingPage->cta_section_title }}</h2>
            <p class="text-base sm:text-lg mb-6 sm:mb-8 opacity-90">{{ $landingPage->cta_section_description }}</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button onclick="document.getElementById('program').scrollIntoView({ behavior: 'smooth' });" class="bg-white text-[#16BC5C] px-6 sm:px-8 py-3 rounded-lg font-medium hover:bg-gray-100 transition-all duration-300">
                    {{ $landingPage->cta_primary_text }}
                </button>
                <button class="border-2 border-white text-white px-6 sm:px-8 py-3 rounded-lg font-medium hover:bg-white hover:text-[#16BC5C] transition-all duration-300">
                {{ $landingPage->cta_secondary_text}}
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
                    <div class="flex items-center space-x-2">
                        <img src="https://disbud.riau.go.id/assets/guest/img/image/logo-riau.png" alt="Logo Dinas Kebudayaan Provinsi Riau" class="h-12 w-auto object-contain" onerror="this.src='/images/fallback-logo-riau.png';">
                        <img src="https://disbud.riau.go.id/assets/guest/img/image/logo-disbud.png" alt="Logo SIMADAYA" class="h-12 w-auto object-contain" onerror="this.src='/images/fallback-logo-disbud.png';">
                    </div>
                    <div>
                        <h3 class="font-bold text-xl text-white">SIMADAYA</h3>
                        <p class="text-gray-400 text-sm">Dinas Kebudayaan Provinsi Riau</p>
                    </div>
                </div>
                <p class="text-gray-400 mb-6 leading-relaxed text-sm sm:text-base">
                    Sistem Magang Dinas Kebudayaan yang dikelola oleh Dinas Kebudayaan Provinsi Riau untuk mendukung pengembangan sumber daya manusia di bidang kebudayaan.
                </p>
            </div>
            <div>
                <h4 class="font-semibold text-lg mb-4 text-white">Menu</h4>
                <ul class="space-y-2">
                    <li><a href="#beranda" class="text-gray-400 hover:text-white transition-colors duration-300 text-sm sm:text-base">Beranda</a></li>
                    <li><a href="#tentang" class="text-gray-400 hover:text-white transition-colors duration-300 text-sm sm:text-base">Tentang</a></li>
                    <li><a href="#program" class="text-gray-400 hover:text-white transition-colors duration-300 text-sm sm:text-base">Program</a></li>
                    <li><a href="#kontak" class="text-gray-400 hover:text-white transition-colors duration-300 text-sm sm:text-base">Kontak</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold text-lg mb-4 text-white">Kontak</h4>
                <div class="space-y-3">
                    <div class="flex items-start space-x-3">
                        <span class="material-icons-outlined text-yellow-400 text-base mt-1">location_on</span>
                        <span class="text-gray-400 text-sm">{{ $landingPage->contact_info['address'] }}</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="material-icons-outlined text-yellow-400 text-base">phone</span>
                        <span class="text-gray-400 text-sm">{{ $landingPage->contact_info['phone'] }}</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="material-icons-outlined text-yellow-400 text-base">mail</span>
                        <span class="text-gray-400 text-sm">{{ $landingPage->contact_info['email'] }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-10">
            <h4 class="text-white text-lg mb-4 font-semibold">Peta Lokasi Kami</h4>
            <iframe src="{{ $landingPage->contact_info['map_embed'] }}" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="rounded-lg shadow-lg"></iframe>
        </div>
        <div class="border-t border-gray-700 mt-8 pt-8 text-center">
            <p class="text-gray-500 text-sm">© 2025 SIMADAYA - Dinas Kebudayaan Provinsi Riau. Hak Cipta Dilindungi.</p>
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
            const mobileMenu = document.getElementById('mobile-menu');
            if (mobileMenu.classList.contains('open')) {
                mobileMenu.classList.add('hidden');
                mobileMenu.classList.remove('open');
                document.getElementById('mobile-menu-toggle').innerHTML = '☰';
            }
        });
    });

    // Fade in animation on scroll
    const observerOptions = { threshold: 0.1, rootMargin: '0px 0px -50px 0px' };
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

    // Mobile menu toggle
    const mobileMenuButton = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', () => {
            const isOpen = mobileMenu.classList.contains('open');
            if (isOpen) {
                mobileMenu.classList.add('hidden');
                mobileMenu.classList.remove('open');
                mobileMenuButton.innerHTML = '☰';
            } else {
                mobileMenu.classList.remove('hidden');
                mobileMenu.classList.add('open');
                mobileMenuButton.innerHTML = '✕';
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
    const counters = document.querySelectorAll('.text-xl.sm\\:text-2xl.font-bold');
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                counters.forEach(counter => {
                    const target = parseInt(counter.textContent.replace(/[^0-9]/g, '')) || 0;
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
