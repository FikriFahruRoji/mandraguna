<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\User;
use App\Models\Slide;
use App\Models\Post;
use App\Models\FieldStory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Truncate tables first (except users)
        DB::table('settings')->truncate();
        DB::table('slides')->truncate();
        DB::table('posts')->truncate();
        DB::table('field_stories')->truncate();

        // === Create Default Admin User ===
        User::updateOrCreate(
            ['email' => 'admin@mandraguna.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
            ]
        );

        // === Settings Group: about_page ===
        $this->seedSettings('about_page', [
            [
                'key' => 'about_beginning_image',
                'value' => 'settings/Qg9T8tBMXd06SvqbLRZnGG4i1Z2qFN1IIRPPNl1A.jpg',
                'value_en' => null,
                'type' => 'image',
                'label' => 'Gambar Awal Mula (Sejarah Kami)',
            ],
            [
                'key' => 'about_crisis_image',
                'value' => 'settings/6wgl8EzVAiwor5qDNfvoXiRqZF1SxWXVRtnGpnaA.jpg',
                'value_en' => null,
                'type' => 'image',
                'label' => 'Gambar Krisis Lingkungan',
            ],
            [
                'key' => 'about_innovation_image',
                'value' => null,
                'value_en' => null,
                'type' => 'image',
                'label' => 'Gambar Inovasi Kami',
            ],
            [
                'key' => 'about_leadership_image',
                'value' => 'settings/86KD1dnjWAYx3YtkK1zIaCYYI6ttdD71ziwf0l1I.jpg',
                'value_en' => null,
                'type' => 'image',
                'label' => 'Gambar Stabilitas Institusi',
            ],
        ]);

        // === Settings Group: contact ===
        $this->seedSettings('contact', [
            [
                'key' => 'contact_email',
                'value' => 'info@mandraguna.com',
                'value_en' => 'info@mandraguna.com',
                'type' => 'text',
                'label' => 'Email',
            ],
            [
                'key' => 'contact_phone',
                'value' => '+62 812 3456 7890',
                'value_en' => '+62 812 3456 7890',
                'type' => 'text',
                'label' => 'Telepon',
            ],
            [
                'key' => 'contact_whatsapp',
                'value' => '6281234567890',
                'value_en' => '6281234567890',
                'type' => 'text',
                'label' => 'Nomor WhatsApp',
            ],
            [
                'key' => 'contact_address',
                'value' => 'Jl. Industri No. 1, Garut, Jawa Barat, Indonesia',
                'value_en' => 'Jl. Industri No. 1, Garut, West Java, Indonesia',
                'type' => 'text',
                'label' => 'Alamat Kantor',
            ],
            [
                'key' => 'social_instagram',
                'value' => 'https://instagram.com/mandraguna',
                'value_en' => 'https://instagram.com/mandraguna',
                'type' => 'text',
                'label' => 'Link Instagram',
            ],
            [
                'key' => 'social_facebook',
                'value' => 'https://facebook.com/mandraguna',
                'value_en' => 'https://facebook.com/mandraguna',
                'type' => 'text',
                'label' => 'Link Facebook',
            ],
            [
                'key' => 'social_youtube',
                'value' => 'https://youtube.com/@mandraguna',
                'value_en' => 'https://youtube.com/@mandraguna',
                'type' => 'text',
                'label' => 'Link YouTube',
            ],
            [
                'key' => 'contact_maps_iframe',
                'value' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4126.227084929802!2d107.92738473173488!3d-7.225844690555289!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68b1c0f015d0eb%3A0x771cf6b04d2d2e44!2sPT%20MANDRAGUNA%20PUSAKA%20INDONESIA!5e0!3m2!1sen!2sid!4v1782745913640!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>',
                'value_en' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4126.227084929802!2d107.92738473173488!3d-7.225844690555289!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68b1c0f015d0eb%3A0x771cf6b04d2d2e44!2sPT%20MANDRAGUNA%20PUSAKA%20INDONESIA!5e0!3m2!1sen!2sid!4v1782745913640!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>',
                'type' => 'iframe_embed',
                'label' => 'Iframe Google Maps',
            ],
        ]);

        // === Settings Group: general ===
        $this->seedSettings('general', [
            [
                'key' => 'site_name',
                'value' => 'Mandraguna',
                'value_en' => 'Mandraguna',
                'type' => 'text',
                'label' => 'Nama Website',
            ],
            [
                'key' => 'site_tagline',
                'value' => 'Sustainable Agriculture, Premium Quality',
                'value_en' => 'Sustainable Agriculture, Premium Quality',
                'type' => 'text',
                'label' => 'Tagline',
            ],
            [
                'key' => 'company_logo',
                'value' => null,
                'value_en' => null,
                'type' => 'image',
                'label' => 'Logo Perusahaan',
            ],
            [
                'key' => 'company_favicon',
                'value' => null,
                'value_en' => null,
                'type' => 'image',
                'label' => 'Favicon',
            ],
        ]);

        // === Settings Group: homepage_about ===
        $this->seedSettings('homepage_about', [
            [
                'key' => 'about_label',
                'value' => 'SIAPA KAMI',
                'value_en' => 'WHO WE ARE',
                'type' => 'text',
                'label' => 'Label Section',
            ],
            [
                'key' => 'about_title',
                'value' => 'Mewujudkan Kemakmuran Melalui Kesehatan Tanah',
                'value_en' => 'Realizing Prosperity Through Soil Health',
                'type' => 'text',
                'label' => 'Judul Section',
            ],
            [
                'key' => 'about_content',
                'value' => 'PT. Mandraguna Pusaka Indonesia hadir di tengah kekhawatiran masyarakat terhadap pencemaran lingkungan yang telah berlangsung selama beberapa dekade.\r\n\r\nKami melihat inovasi dan visi besar dalam pemanfaatan sisa penyamakan kulit sapi—sumber daya yang kaya akan kandungan biologis organik dan nutrisi tinggi.\r\n\r\nKami memproses limbah penyamakan kulit ini secara cermat menjadi pupuk asam amino unggulan, dengan keyakinan bahwa segala sesuatu yang diawali dengan niat baik akan menghasilkan yang terbaik untuk warisan Indonesia.',
                'value_en' => 'PT. Mandraguna Pusaka Indonesia is present amid public concern over environmental pollution that has been ongoing for decades.\r\n\r\nWe see innovation and a grand vision in utilizing the residue of cow leather tanning—a resource rich in organic biological content and high nutrients.\r\n\r\nWe carefully process this leather tanning waste into premium amino acid fertilizer, with the belief that everything started with good intentions will yield the best for Indonesia\'s legacy.',
                'type' => 'textarea',
                'label' => 'Konten Paragraf',
            ],
            [
                'key' => 'about_image',
                'value' => null,
                'value_en' => null,
                'type' => 'image',
                'label' => 'Gambar Section',
            ],
            [
                'key' => 'about_quote',
                'value' => 'Mandraguna untuk Indonesia, Mandraguna untuk Warisan Indonesia.',
                'value_en' => 'Mandraguna for Indonesia, Mandraguna for Indonesian Legacy.',
                'type' => 'text',
                'label' => 'Kutipan',
            ],
            [
                'key' => 'about_stat1_value',
                'value' => '10+',
                'value_en' => '10+',
                'type' => 'text',
                'label' => 'Statistik 1 — Nilai',
            ],
            [
                'key' => 'about_stat1_label',
                'value' => 'Tahun Inovasi',
                'value_en' => 'Years of Innovation',
                'type' => 'text',
                'label' => 'Statistik 1 — Label',
            ],
            [
                'key' => 'about_stat2_value',
                'value' => '100%',
                'value_en' => '100%',
                'type' => 'text',
                'label' => 'Statistik 2 — Nilai',
            ],
            [
                'key' => 'about_stat2_label',
                'value' => 'Bahan Organik',
                'value_en' => 'Organic Material',
                'type' => 'text',
                'label' => 'Statistik 2 — Label',
            ],
            [
                'key' => 'about_video_url',
                'value' => 'https://www.youtube.com/watch?v=aq2-5yHar0o',
                'value_en' => 'https://www.youtube.com/watch?v=aq2-5yHar0o',
                'type' => 'text',
                'label' => 'Link Video YouTube',
            ],
        ]);

        // === Settings Group: homepage_cta ===
        $this->seedSettings('homepage_cta', [
            [
                'key' => 'cta_title',
                'value' => 'Siap Merevitalisasi Tanah Anda?',
                'value_en' => 'Ready to Revitalize Your Soil?',
                'type' => 'text',
                'label' => 'Judul CTA',
            ],
            [
                'key' => 'cta_desc',
                'value' => 'Mari bergabung dalam gerakan menuju pertanian Indonesia yang lebih bersih dan produktif.',
                'value_en' => 'Let us join the movement towards cleaner and more productive Indonesian agriculture.',
                'type' => 'textarea',
                'label' => 'Deskripsi CTA',
            ],
            [
                'key' => 'cta_button_text',
                'value' => 'Hubungi Ahli Kami',
                'value_en' => 'Contact Our Experts',
                'type' => 'text',
                'label' => 'Teks Tombol CTA',
            ],
            [
                'key' => 'cta_button_link',
                'value' => '/contact',
                'value_en' => '/contact',
                'type' => 'text',
                'label' => 'Link Tombol CTA',
            ],
        ]);

        // === Settings Group: homepage_product ===
        $this->seedSettings('homepage_product', [
            [
                'key' => 'product_section_label',
                'value' => 'PILIHAN PRODUK KAMI',
                'value_en' => 'OUR PRODUCT SELECTION',
                'type' => 'text',
                'label' => 'Label Section',
            ],
            [
                'key' => 'product_section_title',
                'value' => 'Keunggulan Mandraguna',
                'value_en' => 'The Mandraguna Advantage',
                'type' => 'text',
                'label' => 'Judul Section',
            ],
            [
                'key' => 'product_featured_name',
                'value' => 'Mandraguna Grow™',
                'value_en' => 'Mandraguna Grow™',
                'type' => 'text',
                'label' => 'Nama Produk Unggulan',
            ],
            [
                'key' => 'product_featured_desc',
                'value' => 'Formula asam amino unggulan kami yang dirancang khusus untuk berbagai komoditas pertanian di Indonesia. Diformulasikan khusus untuk mengaktifkan nutrisi tanah yang tidak aktif.',
                'value_en' => 'Our flagship amino acid formula specifically designed for various agricultural commodities in Indonesia. Specially formulated to activate dormant soil nutrients.',
                'type' => 'textarea',
                'label' => 'Deskripsi Produk Unggulan',
            ],
            [
                'key' => 'product_featured_image',
                'value' => 'settings/hUMkHAcTqpcOeATE29wRI3MK2dJsbRN0TvJFsggq.png',
                'value_en' => null,
                'type' => 'image',
                'label' => 'Gambar Produk Unggulan',
            ],
            [
                'key' => 'product_spec1_label',
                'value' => 'Bahan Organik',
                'value_en' => 'Organic Matter',
                'type' => 'text',
                'label' => 'Spesifikasi 1 — Label',
            ],
            [
                'key' => 'product_spec1_value',
                'value' => '85%+',
                'value_en' => '85%+',
                'type' => 'text',
                'label' => 'Spesifikasi 1 — Nilai',
            ],
            [
                'key' => 'product_spec2_label',
                'value' => 'Profil Asam Amino',
                'value_en' => 'Amino Acid Profile',
                'type' => 'text',
                'label' => 'Spesifikasi 2 — Label',
            ],
            [
                'key' => 'product_spec2_value',
                'value' => 'Spektrum Penuh',
                'value_en' => 'Full Spectrum',
                'type' => 'text',
                'label' => 'Spesifikasi 2 — Nilai',
            ],
            [
                'key' => 'product_spec3_label',
                'value' => 'Kelarutan dalam Air',
                'value_en' => 'Water Solubility',
                'type' => 'text',
                'label' => 'Spesifikasi 3 — Label',
            ],
            [
                'key' => 'product_spec3_value',
                'value' => '100%',
                'value_en' => '100%',
                'type' => 'text',
                'label' => 'Spesifikasi 3 — Nilai',
            ],
        ]);

        // === Settings Group: homepage_tech ===
        $this->seedSettings('homepage_tech', [
            [
                'key' => 'tech_title',
                'value' => 'Hasil Terbukti',
                'value_en' => 'Proven Results',
                'type' => 'text',
                'label' => 'Judul Section',
            ],
            [
                'key' => 'tech_desc',
                'value' => 'Analisis teknis kami menunjukkan kualitas dan dampak yang konsisten dari pupuk Mandraguna pada berbagai jenis tanah.',
                'value_en' => 'Our technical analysis shows consistent quality and impact of Mandraguna fertilizer on various soil types.',
                'type' => 'textarea',
                'label' => 'Deskripsi Section',
            ],
            [
                'key' => 'tech_image',
                'value' => null,
                'value_en' => null,
                'type' => 'image',
                'label' => 'Gambar Grafik',
            ],
            [
                'key' => 'tech_spec1_label',
                'value' => 'Kandungan Nitrogen (N)',
                'value_en' => 'Nitrogen Content (N)',
                'type' => 'text',
                'label' => 'Spesifikasi 1 — Label',
            ],
            [
                'key' => 'tech_spec1_val',
                'value' => 'Rentang Optimum',
                'value_en' => 'Optimum Range',
                'type' => 'text',
                'label' => 'Spesifikasi 1 — Nilai',
            ],
            [
                'key' => 'tech_spec2_label',
                'value' => 'Karbon Organik',
                'value_en' => 'Organic Carbon',
                'type' => 'text',
                'label' => 'Spesifikasi 2 — Label',
            ],
            [
                'key' => 'tech_spec2_val',
                'value' => 'Sangat Tinggi',
                'value_en' => 'Very High',
                'type' => 'text',
                'label' => 'Spesifikasi 2 — Nilai',
            ],
            [
                'key' => 'tech_spec3_label',
                'value' => 'Status Patogen',
                'value_en' => 'Pathogen Status',
                'type' => 'text',
                'label' => 'Spesifikasi 3 — Label',
            ],
            [
                'key' => 'tech_spec3_val',
                'value' => 'Bebas Patogen',
                'value_en' => 'Pathogen Free',
                'type' => 'text',
                'label' => 'Spesifikasi 3 — Nilai',
            ],
            [
                'key' => 'tech_spec4_label',
                'value' => 'Tingkat Kelembaban',
                'value_en' => 'Moisture Level',
                'type' => 'text',
                'label' => 'Spesifikasi 4 — Label',
            ],
            [
                'key' => 'tech_spec4_val',
                'value' => 'Terkontrol',
                'value_en' => 'Controlled',
                'type' => 'text',
                'label' => 'Spesifikasi 4 — Nilai',
            ],
            [
                'key' => 'tech_spec5_label',
                'value' => 'Skor Keberlanjutan',
                'value_en' => 'Sustainability Score',
                'type' => 'text',
                'label' => 'Spesifikasi 5 — Label',
            ],
            [
                'key' => 'tech_spec5_val',
                'value' => 'Sertifikasi A+',
                'value_en' => 'A+ Certification',
                'type' => 'text',
                'label' => 'Spesifikasi 5 — Nilai',
            ],
        ]);

        // === Settings Group: homepage_transform ===
        $this->seedSettings('homepage_transform', [
            [
                'key' => 'transform_label',
                'value' => 'TRANSFORMASI',
                'value_en' => 'TRANSFORMATION',
                'type' => 'text',
                'label' => 'Label Section',
            ],
            [
                'key' => 'transform_title',
                'value' => 'Sains untuk Hasil Panen yang Lebih Baik',
                'value_en' => 'The Science of Better Yields',
                'type' => 'text',
                'label' => 'Judul Section',
            ],
            [
                'key' => 'transform_card1_title',
                'value' => 'Tantangan Bahan Kimia',
                'value_en' => 'The Chemical Challenge',
                'type' => 'text',
                'label' => 'Card 1 — Judul',
            ],
            [
                'key' => 'transform_card1_desc',
                'value' => 'Pupuk kimia tradisional menyebabkan degradasi tanah, menurunkan kesuburan jangka panjang, dan memicu toksisitas lingkungan. Kami hadir memberikan solusi alternatif.',
                'value_en' => 'Traditional chemical fertilizers lead to soil degradation, reduced long-term fertility, and environmental toxicity. We provide the alternative.',
                'type' => 'textarea',
                'label' => 'Card 1 — Deskripsi',
            ],
            [
                'key' => 'transform_card1_image',
                'value' => 'settings/ihLxbSlTFN5xTlfkrGNPkr1TdOVcXoZTlF69NvaX.jpg',
                'value_en' => null,
                'type' => 'image',
                'label' => 'Card 1 — Gambar',
            ],
            [
                'key' => 'transform_card2_title',
                'value' => 'Kekuatan Amino',
                'value_en' => 'Amino Power',
                'type' => 'text',
                'label' => 'Card 2 — Judul',
            ],
            [
                'key' => 'transform_card2_desc',
                'value' => 'Kandungan organik tinggi yang kaya akan nutrisi esensial untuk penyerapan cepat oleh tanaman.',
                'value_en' => 'High organic content rich in essential nutrients for rapid absorption.',
                'type' => 'textarea',
                'label' => 'Card 2 — Deskripsi',
            ],
            [
                'key' => 'transform_card2_image',
                'value' => 'settings/tWJyEBtmVOuFskxcUm1oHjHfW6Pvcrq3fsY3v1Dg.jpg',
                'value_en' => null,
                'type' => 'image',
                'label' => 'Card 2 — Gambar',
            ],
            [
                'key' => 'transform_card3_title',
                'value' => 'Kemurnian Alami',
                'value_en' => 'Pure Nature',
                'type' => 'text',
                'label' => 'Card 3 — Judul',
            ],
            [
                'key' => 'transform_card3_desc',
                'value' => 'Bebas residu beracun. Aman untuk petani, aman untuk ekosistem, sangat penting untuk tanaman.',
                'value_en' => 'Zero toxic residues. Safe for farmers, safe for the ecosystem, vital for crops.',
                'type' => 'textarea',
                'label' => 'Card 3 — Deskripsi',
            ],
            [
                'key' => 'transform_card3_image',
                'value' => 'settings/lVU2q3Gozq8mA92QeZ3ExgnqH6IXqfT3GGKu5Hup.jpg',
                'value_en' => null,
                'type' => 'image',
                'label' => 'Card 3 — Gambar',
            ],
        ]);

        // === Settings Group: product_page ===
        $this->seedSettings('product_page', [
            [
                'key' => 'product_why_choose_title',
                'value' => 'Mengapa Memilih Mandraguna Grow?',
                'value_en' => 'Why Choose Mandraguna Grow?',
                'type' => 'text',
                'label' => 'Judul Section Keunggulan',
            ],
            [
                'key' => 'product_why_choose_subtitle',
                'value' => 'Pupuk Asam Amino Yang Di Hasilkan Dari Lemak Hewani.\r\nKaya Akan Protein Sehingga Dapat Menutrisi Tanaman Dengan Maksimal dan Juga Meningkatkan Imunitas Tanaman Sehingga Rentan Terhadap Hama Dan Penyakit.',
                'value_en' => 'Amino acid fertilizer produced from animal fat.\r\nRich in protein, it helps nourish plants optimally and increases plant immunity, making them less susceptible to pests and diseases.',
                'type' => 'textarea',
                'label' => 'Subjudul Section Keunggulan',
            ],
            [
                'key' => 'product_benefit1_title',
                'value' => 'Profil Nutrisi Lengkap',
                'value_en' => 'Complete Nutrient Profile',
                'type' => 'text',
                'label' => 'Keunggulan 1 — Judul',
            ],
            [
                'key' => 'product_benefit1_desc',
                'value' => 'Diformulasikan dengan campuran seimbang makro dan mikro-nutrisi esensial untuk tahap awal pertumbuhan tanaman. Memastikan perkembangan daun yang cepat dan pembentukan batang yang kuat.',
                'value_en' => 'Formulated with a balanced blend of essential macro and micro-nutrients for early stages of plant growth. Ensures rapid leaf development and sturdy stem formation.',
                'type' => 'textarea',
                'label' => 'Keunggulan 1 — Deskripsi',
            ],
            [
                'key' => 'product_benefit2_title',
                'value' => 'Enzim Biologis Aktif',
                'value_en' => 'Active Biological Enzymes',
                'type' => 'text',
                'label' => 'Keunggulan 2 — Judul',
            ],
            [
                'key' => 'product_benefit2_desc',
                'value' => 'Mengandung enzim biologis aktif yang mempercepat proses penyerapan nutrisi oleh tanaman dan meningkatkan aktivitas mikroba tanah yang menguntungkan.',
                'value_en' => 'Contains active biological enzymes that accelerate plant nutrient absorption and enhance beneficial soil microbial activity.',
                'type' => 'textarea',
                'label' => 'Keunggulan 2 — Deskripsi',
            ],
            [
                'key' => 'product_benefit3_title',
                'value' => 'Daya Tahan Tanaman',
                'value_en' => 'Plant Resilience',
                'type' => 'text',
                'label' => 'Keunggulan 3 — Judul',
            ],
            [
                'key' => 'product_benefit3_desc',
                'value' => 'Meningkatkan sistem imun alami tanaman, menjadikannya lebih tahan terhadap hama, penyakit, serta kondisi cuaca ekstrem seperti kekeringan.',
                'value_en' => 'Boosts the natural immune system of plants, making them more resistant to pests, diseases, and extreme weather conditions like drought.',
                'type' => 'textarea',
                'label' => 'Keunggulan 3 — Deskripsi',
            ],
            [
                'key' => 'product_tech_title',
                'value' => 'Data Teknis Resmi',
                'value_en' => 'Official Technical Data',
                'type' => 'text',
                'label' => 'Judul Data Teknis',
            ],
            [
                'key' => 'product_tech_desc',
                'value' => 'Komposisi organik bersertifikat yang menjelaskan kandungan aktif esensial dan kadar nutrisi utama.',
                'value_en' => 'Certified organic composition detailing essential active ingredients and key nutrient levels.',
                'type' => 'textarea',
                'label' => 'Deskripsi Data Teknis',
            ],
            [
                'key' => 'product_tech_image',
                'value' => null,
                'value_en' => null,
                'type' => 'image',
                'label' => 'Gambar/Grafik Data Teknis',
            ],
            [
                'key' => 'product_hero_image',
                'value' => 'settings/mS7gNkjQubuucguXKFtksTorm9PfkVWXRg8RupuB.png',
                'value_en' => null,
                'type' => 'image',
                'label' => 'Gambar Hero Produk',
            ],
        ]);

        // === Settings Group: sustainability ===
        $this->seedSettings('sustainability', [
            [
                'key' => 'sustainability_waste_processed',
                'value' => '2500',
                'value_en' => '2500',
                'type' => 'number',
                'label' => 'Limbah Kulit Diolah (Ton)',
            ],
            [
                'key' => 'sustainability_co2_reduced',
                'value' => '850',
                'value_en' => '850',
                'type' => 'number',
                'label' => 'Emisi CO2 Ditekan (Ton)',
            ],
            [
                'key' => 'sustainability_farmers_served',
                'value' => '1200',
                'value_en' => '1200',
                'type' => 'number',
                'label' => 'Petani Dilayani',
            ],
            [
                'key' => 'sustainability_hectares_covered',
                'value' => '3500',
                'value_en' => '3500',
                'type' => 'number',
                'label' => 'Luas Lahan Tercakup (Ha)',
            ],
            [
                'key' => 'sustainability_hero_image',
                'value' => null,
                'value_en' => null,
                'type' => 'image',
                'label' => 'Gambar Hero Keberlanjutan',
            ],
            [
                'key' => 'sustainability_impact_image',
                'value' => null,
                'value_en' => null,
                'type' => 'image',
                'label' => 'Gambar Dampak Keberlanjutan',
            ],
            [
                'key' => 'sustainability_biodiversity_image',
                'value' => null,
                'value_en' => null,
                'type' => 'image',
                'label' => 'Gambar Keanekaragaman Hayati',
            ],
        ]);


        // === Seed Default Banner Slides ===
        Slide::create([
            'title' => 'Mengubah Limbah Kulit Menjadi Emas Pertanian',
            'title_en' => 'Transforming Leather Waste Into Agricultural Gold',
            'subtitle' => 'Pupuk organik cair & padat kaya asam amino esensial dari limbah sisa penyamakan kulit sapi. Solusi pertanian sirkular berkinerja tinggi.',
            'subtitle_en' => 'Liquid & solid organic fertilizer rich in essential amino acids from leftover cow hide tanning waste. High-performance circular agriculture solution.',
            'cta_text' => 'Katalog Produk',
            'cta_text_en' => 'Product Catalog',
            'cta_link' => '/products',
            'image_path' => 'slides/NYhPOmXf98EpBeluIEVrerWxmbPfjZKrq5MvRtgc.jpg',
            'sort_order' => 0,
        ]);

        Slide::create([
            'title' => 'Inovasi Pertanian Berkelanjutan & Mandiri',
            'title_en' => 'Sustainable & Independent Agricultural Innovation',
            'subtitle' => 'Meningkatkan kesuburan tanah, mempercepat tumbuh kembang tanaman, dan melestarikan lingkungan melalui zero-waste processing.',
            'subtitle_en' => 'Improving soil fertility, accelerating crop growth, and conserving the environment through zero-waste processing.',
            'cta_text' => 'Pelajari Dampak Ekologi',
            'cta_text_en' => 'Learn Ecological Impact',
            'cta_link' => '/sustainability',
            'image_path' => 'slides/sXTW0el91H9BFDwSwDNM24vd8gNQhLn3witYIFfl.jpg',
            'sort_order' => 1,
        ]);


        // === Seed Default Posts (News) ===
        Post::create([
            'title' => 'H. Muhammad Rian: Pelopor Inovasi Pupuk Organik Cair dari Limbah Penyamkan Kulit',
            'title_en' => 'H. Muhammad Rian: Pioneer of Liquid Organic Fertilizer Innovation from Tannery Waste',
            'slug' => 'h-muhammad-rian-pelopor-inovasi-pupuk-organik-cair-dari-limbah-penyamkan-kulit',
            'excerpt' => 'Pengusaha muda asal Garut, H. Muhammad Rian, berhasil mengubah limbah penyamakan kulit yang dulunya menjadi permasalahan serius di Sukaregang, menjadi produk pupuk organik cair yang kini banyak digunakan oleh petani di Jawa Barat hingga luar Pulau Jawa.',
            'excerpt_en' => 'Young entrepreneur from Garut, H. Muhammad Rian, successfully transformed leather tanning waste, which was once a serious issue in Sukaregang, into liquid organic fertilizer products now widely used by farmers in West Java and beyond.',
            'content' => '<p>Masalah pencemaran lingkungan yang diakibatkan oleh limbah penyamakan kulit di Sukaregang, Garut, akhirnya menemukan solusinya. Pengusaha muda asal Garut, H. Muhammad Rian, berhasil mengubah limbah penyamakan kulit (fleshing) yang dulunya menjadi permasalahan serius, menjadi produk pupuk organik cair yang kaya akan asam amino esensial.</p><p>\r\nInovasi ini tidak hanya mengurangi pencemaran lingkungan secara signifikan tetapi juga memberikan alternatif pupuk organik berkinerja tinggi bagi para petani untuk meningkatkan kesuburan tanah dan mengoptimalkan hasil panen mereka secara berkelanjutan.</p><p><img></p><p><img></p>',
            'content_en' => '<p>The environmental pollution problem caused by leather tanning waste in Sukaregang, Garut, has finally found its solution. H. Muhammad Rian, a young entrepreneur from Garut, succeeded in converting leather tanning waste (fleshing), which used to be a serious issue, into liquid organic fertilizer rich in essential amino acids.\r\n\r\nThis innovation not only significantly reduces environmental pollution but also provides a high-performance organic fertilizer alternative for farmers to improve soil fertility and optimize crop yields sustainably.</p>',
            'image_path' => 'posts/post_1.jpg',
            'is_published' => true,
            'published_at' => '2024-10-17 20:39:22',
            'views' => 125,
        ]);

        Post::create([
            'title' => 'Sawah Dilanda Kekeringan, Petani di Kampung Mentan Andi Amran Panen Padi 7,3 Ton Per Hektare',
            'title_en' => 'Fields Struck by Drought, Farmers in Mentan Andi Amran Home Village Harvest 7.3 Tons of Rice per Hectare',
            'slug' => 'sawah-dilanda-kekeringan-petani-di-kampung-mentan-andi-amran-panen-padi-73-ton-per-hektare',
            'excerpt' => 'Petani di Kampung Menteri Pertanian (Mentan) RI, Andi Amran Sulaiman, di Desa Ponre-ponre, Kabupaten Bone, tersenyum lebar setelah panen perdana padi program Gernas. Meskipun dilanda kekeringan, sawah menghasilkan 7,3 ton per hektare berkat pemanfaatan Pupuk Trubus hasil kolaborasi dengan PT Mandraguna Pusaka Indonesia.',
            'excerpt_en' => 'Farmers in the hometown of the Minister of Agriculture (Mentan) RI, Andi Amran Sulaiman, in Ponre-ponre Village, Bone Regency, smiled widely after the inaugural rice harvest of the Gernas program. Despite the drought, the fields yielded 7.3 tons per hectare thanks to the use of Trubus Fertilizer in collaboration with PT Mandraguna Pusaka Indonesia.',
            'content' => 'Kelompok Tani Desa Ponre-ponre, Kecamatan Libureng, Kabupaten Bone, Provinsi Sulawesi Selatan berhasil melakukan panen perdana padi program Gernas Tahun 2023. Meski sawah dilanda kondisi kekeringan yang parah, hasil panennya terbilang melimpah mencapai 7,35 ton per hektare.\n\nRahasia sukses di balik panen melimpah ini tidak lepas dari penggunaan Pupuk Trubus yang dikerjasamakan dengan PT Mandraguna Pusaka Indonesia. Dengan hanya menggunakan 5 liter pupuk Trubus per hektare, petani dapat menghemat biaya dibanding menggunakan pupuk kimia tradisional, sekaligus mempercepat pertumbuhan padi, meningkatkan jumlah anakan, dan mengurangi penggunaan pestisida kimia.',
            'content_en' => 'The Ponre-ponre Village Farmer Group, Libureng District, Bone Regency, South Sulawesi Province successfully conducted the first rice harvest of the 2023 Gernas program. Although the fields were hit by severe drought conditions, the harvest was abundant, reaching 7.35 tons per hectare.\n\nThe secret to success behind this bumper harvest is the use of Trubus Fertilizer in partnership with PT Mandraguna Pusaka Indonesia. By using only 5 liters of Trubus fertilizer per hectare, farmers can save costs compared to traditional chemical fertilizers, while accelerating rice growth, increasing tillering, and reducing chemical pesticide usage.',
            'image_path' => 'posts/post_2.jpg',
            'is_published' => true,
            'published_at' => '2024-03-06 15:31:00',
            'views' => 89,
        ]);

        Post::create([
            'title' => 'H. Rian, Pengusaha Muda Visioner dari Garut Mengubah Limbah Menjadi Berkah',
            'title_en' => 'H. Rian, Visionary Young Entrepreneur from Garut Turns Waste into Blessing',
            'slug' => 'h-rian-pengusaha-muda-visioner-dari-garut-mengubah-limbah-menjadi-berkah',
            'excerpt' => 'Kabupaten Garut kembali melahirkan sosok inspiratif, H. Muhammad Rian. Pengusaha muda visioner ini sukses mendirikan Mandraguna Grow yang mengolah limbah organik penyamakan kulit menjadi produk bernilai tinggi seperti pupuk organik cair berkualitas tinggi.',
            'excerpt_en' => 'Garut Regency has once again given birth to an inspiring figure, H. Muhammad Rian. This visionary young entrepreneur successfully founded Mandraguna Grow, which processes organic leather tanning waste into high-value products such as high-quality liquid organic fertilizer.',
            'content' => 'Kabupaten Garut kembali melahirkan sosok inspiratif, H. Muhammad Rian, seorang pengusaha muda visioner yang berhasil mengubah limbah penyamakan kulit menjadi berkah melalui inovasi Mandraguna Grow. Mandraguna Grow fokus pada pengolahan limbah organik fleshing dari penyamakan kulit menjadi pupuk organik cair berkualitas tinggi yang kaya akan kandungan asam amino lengkap.\n\nInovasi pupuk organik ini menjadi solusi vital untuk mengembalikan kesuburan tanah Indonesia, meningkatkan sistem imun tanaman dari hama, meningkatkan kadar klorofil dan laju fotosintesis, serta meminimalisasi stres lingkungan pada tanaman pangan.',
            'content_en' => 'Garut Regency has once again given birth to an inspiring figure, H. Muhammad Rian, a visionary young entrepreneur who turned leather tanning waste into a blessing through the Mandraguna Grow innovation. Mandraguna Grow focuses on processing organic fleshing waste from leather tanning into high-quality liquid organic fertilizer rich in a complete profile of amino acids.\n\nThis organic fertilizer innovation is a vital solution to restore the fertility of Indonesian soils, boost plant immune systems against pests, increase chlorophyll levels and photosynthesis rates, and minimize environmental stress on food crops.',
            'image_path' => 'posts/post_3.jpg',
            'is_published' => true,
            'published_at' => '2024-11-26 15:31:00',
            'views' => 211,
        ]);


        // === Seed Default Field Stories (Kabar Lapangan) ===
        FieldStory::create([
            'title' => 'Inovasi Rumah Kaca di Subang',
            'title_en' => 'Greenhouse Innovation in Subang',
            'slug' => 'inovasi-rumah-kaca-di-subang',
            'excerpt' => 'Bekerja sama erat dengan para pemimpin pertanian setempat untuk menerapkan protokol pemberian nutrisi organik di lingkungan terkendali, menghasilkan dedaunan yang lebih lebat dan sistem perakaran yang kokoh.',
            'excerpt_en' => 'Working closely with local agricultural leaders to implement organic nutrient protocols in controlled environments, resulting in denser foliage and robust root systems.',
            'content' => 'Proyek rumah kaca di Subang merupakan kolaborasi intensif antara tim Mandraguna dengan kelompok tani lokal di Kecamatan Pagaden. Dengan menerapkan protokol pemberian nutrisi organik berbasis asam amino di lingkungan terkendali, kami berhasil mengamati peningkatan signifikan pada kualitas tanaman.\n\nDedaunan tampak lebih lebat dan hijau, sistem perakaran semakin kokoh, dan tingkat ketahanan terhadap hama meningkat drastis. Hasil ini membuka peluang besar untuk replikasi program di wilayah lain.',
            'content_en' => 'The greenhouse project in Subang is an intensive collaboration between the Mandraguna team and local farmer groups in Pagaden District. By implementing amino acid-based organic nutrient protocols in controlled environments, we successfully observed significant improvements in plant quality.\n\nFoliage appeared denser and greener, root systems grew stronger, and the resistance level to pests increased drastically. These results open up great opportunities for program replication in other regions.',
            'image_path' => 'field_stories/eAeKG8dLYUFIxGWvot0vCspYlFC6tiJNvCclW4pa.jpg',
            'is_published' => true,
            'published_at' => '2024-09-15 10:00:00',
            'views' => 58,
        ]);

        FieldStory::create([
            'title' => 'Pemanenan Mekanis & Sinergi Organik',
            'title_en' => null,
            'slug' => 'pemanenan-mekanis-sinergi-organik',
            'excerpt' => 'Mengintegrasikan operasi mekanis skala besar dengan aplikasi pupuk organik yang presisi. Memastikan integritas tanah tidak terkompromi selama siklus panen hasil tinggi.',
            'excerpt_en' => null,
            'content' => 'Program integrasi mekanisasi pertanian dengan pupuk organik Mandraguna telah berhasil diimplementasikan di beberapa lahan sawah besar di Jawa Barat. Kombinasi antara penggunaan alat mekanis modern dengan pemberian pupuk organik yang tepat waktu dan dosis yang presisi terbukti mampu meningkatkan efisiensi panen hingga 40%.\r\n\r\nYang lebih penting, integritas dan kesuburan tanah tetap terjaga bahkan setelah beberapa siklus panen berturut-turut. Ini membuktikan bahwa produktivitas tinggi dan kelestarian lingkungan bisa berjalan beriringan.',
            'content_en' => null,
            'image_path' => 'field_stories/TaZJL2BZkcvzpDEJwDqTr4zKulxatSTxth3TmysJ.jpg',
            'is_published' => true,
            'published_at' => '2024-08-20 14:30:00',
            'views' => 46,
        ]);

        FieldStory::create([
            'title' => 'Pemanenan Mekanis & Sinergi Organik',
            'title_en' => 'Mechanical Harvesting & Organic Synergy',
            'slug' => 'pemanenan-mekanis-dan-sinergi-organik',
            'excerpt' => 'Mengintegrasikan operasi mekanis skala besar dengan aplikasi pupuk organik yang presisi. Memastikan integritas tanah tidak terkompromi selama siklus panen hasil tinggi.',
            'excerpt_en' => 'Integrating large-scale mechanical operations with precise organic fertilizer application. Ensuring soil integrity is not compromised during high-yield harvest cycles.',
            'content' => 'Program integrasi mekanisasi pertanian dengan pupuk organik Mandraguna telah berhasil diimplementasikan di beberapa lahan sawah besar di Jawa Barat. Kombinasi antara penggunaan alat mekanis modern dengan pemberian pupuk organik yang tepat waktu dan dosis yang presisi terbukti mampu meningkatkan efisiensi panen hingga 40%.\n\nYang lebih penting, integritas dan kesuburan tanah tetap terjaga bahkan setelah beberapa siklus panen berturut-turut. Ini membuktikan bahwa produktivitas tinggi dan kelestarian lingkungan bisa berjalan beriringan.',
            'content_en' => 'The program integrating agricultural mechanization with Mandraguna organic fertilizer has been successfully implemented in several large paddy fields in West Java. The combination of using modern mechanical tools with timely and precise application of organic fertilizer is proven to increase harvest efficiency by up to 40%.\n\nMore importantly, soil integrity and fertility are maintained even after several consecutive harvest cycles. This proves that high productivity and environmental sustainability can go hand in hand.',
            'image_path' => null,
            'is_published' => true,
            'published_at' => '2024-08-20 14:30:00',
            'views' => 44,
        ]);
    }

    private function seedSettings(string $group, array $items): void
    {
        foreach ($items as $index => $item) {
            Setting::updateOrCreate(
                ['key' => $item['key']],
                [
                    'value'      => $item['value'],
                    'value_en'   => $item['value_en'] ?? null,
                    'type'       => $item['type'],
                    'group'      => $group,
                    'label'      => $item['label'],
                    'sort_order' => $index,
                ]
            );
        }
    }
}
