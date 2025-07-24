<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'hero_title',
        'hero_subtitle',
        'hero_cta_text',
        'hero_secondary_cta_text',
        'about_title',
        'about_description',
        'programs_title',
        'programs_description',
        'testimonials_title',
        'testimonials_description',
        'cta_section_title',
        'cta_section_description',
        'cta_primary_text',
        'cta_secondary_text',
        'statistics',
        'features',
        'programs',
        'testimonials',
        'contact_info',
        'social_media',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_active',
    ];

    protected $casts = [
        'statistics' => 'array',
        'features' => 'array',
        'programs' => 'array',
        'testimonials' => 'array',
        'contact_info' => 'array',
        'social_media' => 'array',
        'is_active' => 'boolean',
    ];

    public static function getDefaultData()
    {
        return [
            'hero_title' => 'Sistem Informasi Magang Dinas Budaya SIMADAYA',
            'hero_subtitle' => 'Program magang resmi Dinas Kebudayaan Provinsi Riau yang bertujuan untuk meningkatkan kompetensi sumber daya manusia di bidang kebudayaan melalui pengalaman kerja profesional.',
            'hero_cta_text' => 'Daftar Program Magang',
            'hero_secondary_cta_text' => 'Informasi Lengkap',
            'about_title' => 'Fitur dan Layanan Unggulan',
            'about_description' => 'SIMADAYA menyediakan berbagai fasilitas dan layanan profesional untuk mendukung program magang yang berkualitas',
            'programs_title' => 'Bidang Program Magang',
            'programs_description' => 'Berbagai program magang di bidang kebudayaan yang disesuaikan dengan kebutuhan pengembangan SDM dan pelestarian budaya daerah',
            'testimonials_title' => 'Apa Kata Alumni?',
            'testimonials_description' => 'Testimoni dari peserta magang yang telah mengikuti program SIMADAYA dan mendapatkan pengalaman berharga.',
            'cta_section_title' => 'Bergabung dengan Program Magang SIMADAYA',
            'cta_section_description' => 'Dapatkan pengalaman kerja profesional di lingkungan pemerintahan dan berkontribusi dalam pelestarian budaya Riau',
            'cta_primary_text' => 'Daftar Program Magang',
            'cta_secondary_text' => 'Unduh Panduan',
            'statistics' => [
                ['value' => 350, 'label' => 'Alumni Magang', 'suffix' => '+'],
                ['value' => 15, 'label' => 'Program Aktif', 'suffix' => ''],
                ['value' => 98, 'label' => 'Tingkat Kepuasan', 'suffix' => '%'],
            ],
            'features' => [
                [
                    'icon' => 'check-circle',
                    'title' => 'Proses Pendaftaran Terstandar',
                    'description' => 'Sistem pendaftaran online yang terstruktur dengan panduan lengkap sesuai prosedur',
                    'color' => 'green'
                ],
                [
                    'icon' => 'user-group',
                    'title' => 'Pembimbing Profesional',
                    'description' => 'Didampingi oleh ASN berpengalaman di bidang kebudayaan dan pengembangan SDM',
                    'color' => 'green'
                ],
                [
                    'icon' => 'star',
                    'title' => 'Sertifikat Resmi',
                    'description' => 'Sertifikat program magang yang diakui secara resmi oleh Pemerintah Provinsi Riau',
                    'color' => 'yellow'
                ],
                [
                    'icon' => 'chart-bar',
                    'title' => 'Monitoring Berkala',
                    'description' => 'Sistem pemantauan progress dan evaluasi berkala untuk memastikan kualitas program',
                    'color' => 'green'
                ],
                [
                    'icon' => 'mail',
                    'title' => 'Komunikasi Terstruktur',
                    'description' => 'Saluran komunikasi resmi dengan pembimbing dan tim pengelola program',
                    'color' => 'green'
                ],
                [
                    'icon' => 'clipboard-list',
                    'title' => 'Pelaporan Digital',
                    'description' => 'Sistem pelaporan digital yang memudahkan dokumentasi kegiatan magang',
                    'color' => 'yellow'
                ],
            ],
            'programs' => [
                [
                    'title' => 'Digitalisasi Warisan Budaya',
                    'description' => 'Program magang untuk dokumentasi dan digitalisasi aset budaya daerah menggunakan teknologi informasi',
                    'duration' => '1 Bulan',
                    'quota' => '15 Kuota Tersedia',
                    'color' => 'green'
                ],
                [
                    'title' => 'Manajemen Acara Budaya',
                    'description' => 'Terlibat dalam perencanaan dan pelaksanaan kegiatan serta festival budaya daerah',
                    'duration' => '4 Bulan',
                    'quota' => '12 Kuota Tersedia',
                    'color' => 'green'
                ],
                [
                    'title' => 'Komunikasi & Publikasi',
                    'description' => 'Program magang di bidang komunikasi publik dan promosi kebudayaan daerah',
                    'duration' => '6 Bulan',
                    'quota' => '10 Kuota Tersedia',
                    'color' => 'green'
                ],
            ],
            'testimonials' => [
                [
                    'quote' => 'Program ini sangat membantu saya memahami dunia kerja di instansi pemerintahan. Lingkungan kerja yang profesional dan bimbingan yang luar biasa dari para mentor.',
                    'author' => 'Rahma Putri',
                    'title' => 'Alumni Magang 2024',
                    'image' => 'https://i.pravatar.cc/100?img=32',
                ],
                [
                    'quote' => 'Saya mendapatkan pengalaman tak ternilai dalam mengelola acara budaya. Sangat menyenangkan bisa berkontribusi langsung untuk pelestarian budaya daerah.',
                    'author' => 'Andi Saputra',
                    'title' => 'Peserta Program 2023',
                    'image' => 'https://i.pravatar.cc/100?img=45',
                ],
                [
                    'quote' => 'Pelaporannya digital, pembimbingnya sangat suportif, dan saya belajar banyak tentang pentingnya dokumentasi budaya secara profesional.',
                    'author' => 'Lina Marlina',
                    'title' => 'Alumni Program Digitalisasi',
                    'image' => 'https://i.pravatar.cc/100?img=12',
                ],
            ],
            'contact_info' => [
                'address' => 'Jl. Jend. Sudirman No.149, Tengkerang Tengah, Kec. Marpoyan Damai, Kota Pekanbaru, Riau 28125',
                'phone' => '(0761) 21562',
                'email' => 'simadaya@riau.go.id',
                'map_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15945.76384802107!2d101.4548!3d0.495153!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d5aedd2565414f%3A0x61f21d93f231fbf!2sDinas%20Kebudayaan%20Riau!5e0!3m2!1sen!2sid!4v1719932095123!5m2!1sen!2sid',
            ],
            'social_media' => [
                'facebook' => '',
                'twitter' => '',
                'instagram' => '',
                'youtube' => '',
            ],
            'meta_title' => 'SIMADAYA - Sistem Magang Dinas Kebudayaan Provinsi Riau',
            'meta_description' => 'Program magang resmi Dinas Kebudayaan Provinsi Riau untuk pengembangan SDM di bidang kebudayaan.',
            'meta_keywords' => 'magang, kebudayaan, riau, simadaya, program magang, dinas kebudayaan',
            'is_active' => true,
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
