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
                'value_ja' => null,
                'type' => 'image',
                'label' => 'Gambar Awal Mula (Sejarah Kami)',
            ],
            [
                'key' => 'about_crisis_image',
                'value' => 'settings/6wgl8EzVAiwor5qDNfvoXiRqZF1SxWXVRtnGpnaA.jpg',
                'value_en' => null,
                'value_ja' => null,
                'type' => 'image',
                'label' => 'Gambar Krisis Lingkungan',
            ],
            [
                'key' => 'about_innovation_image',
                'value' => null,
                'value_en' => null,
                'value_ja' => null,
                'type' => 'image',
                'label' => 'Gambar Inovasi Kami',
            ],
            [
                'key' => 'about_leadership_image',
                'value' => 'settings/86KD1dnjWAYx3YtkK1zIaCYYI6ttdD71ziwf0l1I.jpg',
                'value_en' => null,
                'value_ja' => null,
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
                'value_ja' => 'info@mandraguna.com',
                'type' => 'text',
                'label' => 'Email',
            ],
            [
                'key' => 'contact_phone',
                'value' => '+62 812 3456 7890',
                'value_en' => '+62 812 3456 7890',
                'value_ja' => '+62 812 3456 7890',
                'type' => 'text',
                'label' => 'Telepon',
            ],
            [
                'key' => 'contact_whatsapp',
                'value' => '6281234567890',
                'value_en' => '6281234567890',
                'value_ja' => '6281234567890',
                'type' => 'text',
                'label' => 'Nomor WhatsApp',
            ],
            [
                'key' => 'contact_address',
                'value' => 'Jl. Industri No. 1, Garut, Jawa Barat, Indonesia',
                'value_en' => 'Jl. Industri No. 1, Garut, West Java, Indonesia',
                'value_ja' => 'インドネシア、西ジャワ州ガルット、インダストリ通り1号',
                'type' => 'text',
                'label' => 'Alamat Kantor',
            ],
            [
                'key' => 'social_instagram',
                'value' => 'https://instagram.com/mandraguna',
                'value_en' => 'https://instagram.com/mandraguna',
                'value_ja' => 'https://instagram.com/mandraguna',
                'type' => 'text',
                'label' => 'Link Instagram',
            ],
            [
                'key' => 'social_facebook',
                'value' => 'https://facebook.com/mandraguna',
                'value_en' => 'https://facebook.com/mandraguna',
                'value_ja' => 'https://facebook.com/mandraguna',
                'type' => 'text',
                'label' => 'Link Facebook',
            ],
            [
                'key' => 'social_youtube',
                'value' => 'https://youtube.com/@mandraguna',
                'value_en' => 'https://youtube.com/@mandraguna',
                'value_ja' => 'https://youtube.com/@mandraguna',
                'type' => 'text',
                'label' => 'Link YouTube',
            ],
            [
                'key' => 'contact_maps_iframe',
                'value' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4126.227084929802!2d107.92738473173488!3d-7.225844690555289!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68b1c0f015d0eb%3A0x771cf6b04d2d2e44!2sPT%20MANDRAGUNA%20PUSAKA%20INDONESIA!5e0!3m2!1sen!2sid!4v1782745913640!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>',
                'value_en' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4126.227084929802!2d107.92738473173488!3d-7.225844690555289!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68b1c0f015d0eb%3A0x771cf6b04d2d2e44!2sPT%20MANDRAGUNA%20PUSAKA%20INDONESIA!5e0!3m2!1sen!2sid!4v1782745913640!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>',
                'value_ja' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4126.227084929802!2d107.92738473173488!3d-7.225844690555289!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68b1c0f015d0eb%3A0x771cf6b04d2d2e44!2sPT%20MANDRAGUNA%20PUSAKA%20INDONESIA!5e0!3m2!1sen!2sid!4v1782745913640!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>',
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
                'value_ja' => 'マンドラグナ',
                'type' => 'text',
                'label' => 'Nama Website',
            ],
            [
                'key' => 'site_tagline',
                'value' => 'Sustainable Agriculture, Premium Quality',
                'value_en' => 'Sustainable Agriculture, Premium Quality',
                'value_ja' => '持続可能な農業、プレミアム品質',
                'type' => 'text',
                'label' => 'Tagline',
            ],
            [
                'key' => 'company_logo',
                'value' => null,
                'value_en' => null,
                'value_ja' => null,
                'type' => 'image',
                'label' => 'Logo Perusahaan',
            ],
            [
                'key' => 'company_favicon',
                'value' => null,
                'value_en' => null,
                'value_ja' => null,
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
                'value_ja' => '私たちについて',
                'type' => 'text',
                'label' => 'Label Section',
            ],
            [
                'key' => 'about_title',
                'value' => 'Mewujudkan Kemakmuran Melalui Kesehatan Tanah',
                'value_en' => 'Realizing Prosperity Through Soil Health',
                'value_ja' => '土壌の健康を通じた繁栄の実現',
                'type' => 'text',
                'label' => 'Judul Section',
            ],
            [
                'key' => 'about_content',
                'value' => 'PT. Mandraguna Pusaka Indonesia hadir di tengah kekhawatiran masyarakat terhadap pencemaran lingkungan yang telah berlangsung selama beberapa dekade.\r\n\r\nKami melihat inovasi dan visi besar dalam pemanfaatan sisa penyamakan kulit sapi—sumber daya yang kaya akan kandungan biologis organik dan nutrisi tinggi.\r\n\r\nKami memproses limbah penyamakan kulit ini secara cermat menjadi pupuk asam amino unggulan, dengan keyakinan bahwa segala sesuatu yang diawali dengan niat baik akan menghasilkan yang terbaik untuk warisan Indonesia.',
                'value_en' => 'PT. Mandraguna Pusaka Indonesia is present amid public concern over environmental pollution that has been ongoing for decades.\r\n\r\nWe see innovation and a grand vision in utilizing the residue of cow leather tanning—a resource rich in organic biological content and high nutrients.\r\n\r\nWe carefully process this leather tanning waste into premium amino acid fertilizer, with the belief that everything started with good intentions will yield the best for Indonesia\'s legacy.',
                'value_ja' => 'PT. Mandraguna Pusaka Indonesiaは、何十年も続いている環境汚染に対する社会的な懸念から生まれました。\r\n\r\n私たちは、有機的生物成分と高栄養に富んだ牛革鞣し工場の廃棄物を有効活用するイノベーション & 壮大なビジョンを持っています。\r\n\r\n良い意図から始まったすべてのことが、インドネシアの遺産にとって最高の結果をもたらすと信じ、この革なめし廃棄物をアミノ酸豊富な高品質の有機肥料へと丁寧に加工しています。',
                'type' => 'textarea',
                'label' => 'Konten Paragraf',
            ],
            [
                'key' => 'about_image',
                'value' => null,
                'value_en' => null,
                'value_ja' => null,
                'type' => 'image',
                'label' => 'Gambar Section',
            ],
            [
                'key' => 'about_quote',
                'value' => 'Mandraguna untuk Indonesia, Mandraguna untuk Warisan Indonesia.',
                'value_en' => 'Mandraguna for Indonesia, Mandraguna for Indonesian Legacy.',
                'value_ja' => 'インドネシアのためのマンドラグナ、インドネシアの遺産のためのマンドラグナ。',
                'type' => 'text',
                'label' => 'Kutipan',
            ],
            [
                'key' => 'about_stat1_value',
                'value' => '10+',
                'value_en' => '10+',
                'value_ja' => '10+',
                'type' => 'text',
                'label' => 'Statistik 1 — Nilai',
            ],
            [
                'key' => 'about_stat1_label',
                'value' => 'Tahun Inovasi',
                'value_en' => 'Years of Innovation',
                'value_ja' => '革新の歳月',
                'type' => 'text',
                'label' => 'Statistik 1 — Label',
            ],
            [
                'key' => 'about_stat2_value',
                'value' => '100%',
                'value_en' => '100%',
                'value_ja' => '100%',
                'type' => 'text',
                'label' => 'Statistik 2 — Nilai',
            ],
            [
                'key' => 'about_stat2_label',
                'value' => 'Bahan Organik',
                'value_en' => 'Organic Material',
                'value_ja' => '有機物',
                'type' => 'text',
                'label' => 'Statistik 2 — Label',
            ],
            [
                'key' => 'about_video_url',
                'value' => 'https://www.youtube.com/watch?v=aq2-5yHar0o',
                'value_en' => 'https://www.youtube.com/watch?v=aq2-5yHar0o',
                'value_ja' => 'https://www.youtube.com/watch?v=aq2-5yHar0o',
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
                'value_ja' => '土壌を活性化する準備はできていますか？',
                'type' => 'text',
                'label' => 'Judul CTA',
            ],
            [
                'key' => 'cta_desc',
                'value' => 'Mari bergabung dalam gerakan menuju pertanian Indonesia yang lebih bersih dan produktif.',
                'value_en' => 'Let us join the movement towards cleaner and more productive Indonesian agriculture.',
                'value_ja' => 'よりクリーンで生産性の高いインドネシアの農業に向けた運動に参加しましょう。',
                'type' => 'textarea',
                'label' => 'Deskripsi CTA',
            ],
            [
                'key' => 'cta_button_text',
                'value' => 'Hubungi Ahli Kami',
                'value_en' => 'Contact Our Experts',
                'value_ja' => '専門家に問い合わせる',
                'type' => 'text',
                'label' => 'Teks Tombol CTA',
            ],
            [
                'key' => 'cta_button_link',
                'value' => '/contact',
                'value_en' => '/contact',
                'value_ja' => '/contact',
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
                'value_ja' => '製品セレクション',
                'type' => 'text',
                'label' => 'Label Section',
            ],
            [
                'key' => 'product_section_title',
                'value' => 'Keunggulan Mandraguna',
                'value_en' => 'The Mandraguna Advantage',
                'value_ja' => 'マンドラグナの強み',
                'type' => 'text',
                'label' => 'Judul Section',
            ],
            [
                'key' => 'product_featured_name',
                'value' => 'Mandraguna Grow™',
                'value_en' => 'Mandraguna Grow™',
                'value_ja' => 'マンドラグナ・グロウ™',
                'type' => 'text',
                'label' => 'Nama Produk Unggulan',
            ],
            [
                'key' => 'product_featured_desc',
                'value' => 'Formula asam amino unggulan kami yang dirancang khusus untuk berbagai komoditas pertanian di Indonesia. Diformulasikan khusus untuk mengaktifkan nutrisi tanah yang tidak aktif.',
                'value_en' => 'Our flagship amino acid formula specifically designed for various agricultural commodities in Indonesia. Specially formulated to activate dormant soil nutrients.',
                'value_ja' => 'インドネシアのさまざまな農産物向けに特別に設計された、アミノ酸の主力処方。不活性な土壌栄養素を活性化するために特別に処方されています。',
                'type' => 'textarea',
                'label' => 'Deskripsi Produk Unggulan',
            ],
            [
                'key' => 'product_featured_image',
                'value' => 'settings/hUMkHAcTqpcOeATE29wRI3MK2dJsbRN0TvJFsggq.png',
                'value_en' => null,
                'value_ja' => null,
                'type' => 'image',
                'label' => 'Gambar Produk Unggulan',
            ],
            [
                'key' => 'product_spec1_label',
                'value' => 'Bahan Organik',
                'value_en' => 'Organic Matter',
                'value_ja' => '有機物',
                'type' => 'text',
                'label' => 'Spesifikasi 1 — Label',
            ],
            [
                'key' => 'product_spec1_value',
                'value' => '85%+',
                'value_en' => '85%+',
                'value_ja' => '85%+',
                'type' => 'text',
                'label' => 'Spesifikasi 1 — Nilai',
            ],
            [
                'key' => 'product_spec2_label',
                'value' => 'Profil Asam Amino',
                'value_en' => 'Amino Acid Profile',
                'value_ja' => 'アミノ酸プロファイル',
                'type' => 'text',
                'label' => 'Spesifikasi 2 — Label',
            ],
            [
                'key' => 'product_spec2_value',
                'value' => 'Spektrum Penuh',
                'value_en' => 'Full Spectrum',
                'value_ja' => 'フルスペクトラム',
                'type' => 'text',
                'label' => 'Spesifikasi 2 — Nilai',
            ],
            [
                'key' => 'product_spec3_label',
                'value' => 'Kelarutan dalam Air',
                'value_en' => 'Water Solubility',
                'value_ja' => '水溶性',
                'type' => 'text',
                'label' => 'Spesifikasi 3 — Label',
            ],
            [
                'key' => 'product_spec3_value',
                'value' => '100%',
                'value_en' => '100%',
                'value_ja' => '100%',
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
                'value_ja' => '実証された実績',
                'type' => 'text',
                'label' => 'Judul Section',
            ],
            [
                'key' => 'tech_desc',
                'value' => 'Analisis teknis kami menunjukkan kualitas dan dampak yang konsisten dari pupuk Mandraguna pada berbagai jenis tanah.',
                'value_en' => 'Our technical analysis shows consistent quality and impact of Mandraguna fertilizer on various soil types.',
                'value_ja' => '私たちの技術分析は、さまざまな土壌タイプに対するマンドラグナ肥料の一貫した品質と影響を示しています。',
                'type' => 'textarea',
                'label' => 'Deskripsi Section',
            ],
            [
                'key' => 'tech_image',
                'value' => null,
                'value_en' => null,
                'value_ja' => null,
                'type' => 'image',
                'label' => 'Gambar Grafik',
            ],
            [
                'key' => 'tech_spec1_label',
                'value' => 'Kandungan Nitrogen (N)',
                'value_en' => 'Nitrogen Content (N)',
                'value_ja' => '窒素含有量 (N)',
                'type' => 'text',
                'label' => 'Spesifikasi 1 — Label',
            ],
            [
                'key' => 'tech_spec1_val',
                'value' => 'Rentang Optimum',
                'value_en' => 'Optimum Range',
                'value_ja' => '最適な範囲',
                'type' => 'text',
                'label' => 'Spesifikasi 1 — Nilai',
            ],
            [
                'key' => 'tech_spec2_label',
                'value' => 'Karbon Organik',
                'value_en' => 'Organic Carbon',
                'value_ja' => '有機炭素',
                'type' => 'text',
                'label' => 'Spesifikasi 2 — Label',
            ],
            [
                'key' => 'tech_spec2_val',
                'value' => 'Sangat Tinggi',
                'value_en' => 'Very High',
                'value_ja' => '非常に高い',
                'type' => 'text',
                'label' => 'Spesifikasi 2 — Nilai',
            ],
            [
                'key' => 'tech_spec3_label',
                'value' => 'Status Patogen',
                'value_en' => 'Pathogen Status',
                'value_ja' => '病原体の状態',
                'type' => 'text',
                'label' => 'Spesifikasi 3 — Label',
            ],
            [
                'key' => 'tech_spec3_val',
                'value' => 'Bebas Patogen',
                'value_en' => 'Pathogen Free',
                'value_ja' => '無病原体',
                'type' => 'text',
                'label' => 'Spesifikasi 3 — Nilai',
            ],
            [
                'key' => 'tech_spec4_label',
                'value' => 'Tingkat Kelembaban',
                'value_en' => 'Moisture Level',
                'value_ja' => '湿度レベル',
                'type' => 'text',
                'label' => 'Spesifikasi 4 — Label',
            ],
            [
                'key' => 'tech_spec4_val',
                'value' => 'Terkontrol',
                'value_en' => 'Controlled',
                'value_ja' => '管理された',
                'type' => 'text',
                'label' => 'Spesifikasi 4 — Nilai',
            ],
            [
                'key' => 'tech_spec5_label',
                'value' => 'Skor Keberlanjutan',
                'value_en' => 'Sustainability Score',
                'value_ja' => 'サステナビリティスコア',
                'type' => 'text',
                'label' => 'Spesifikasi 5 — Label',
            ],
            [
                'key' => 'tech_spec5_val',
                'value' => 'Sertifikasi A+',
                'value_en' => 'A+ Certification',
                'value_ja' => 'A+認証',
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
                'value_ja' => '変革',
                'type' => 'text',
                'label' => 'Label Section',
            ],
            [
                'key' => 'transform_title',
                'value' => 'Sains untuk Hasil Panen yang Lebih Baik',
                'value_en' => 'The Science of Better Yields',
                'value_ja' => 'より良い収穫のための科学',
                'type' => 'text',
                'label' => 'Judul Section',
            ],
            [
                'key' => 'transform_card1_title',
                'value' => 'Tantangan Bahan Kimia',
                'value_en' => 'The Chemical Challenge',
                'value_ja' => '化学物質の課題',
                'type' => 'text',
                'label' => 'Card 1 — Judul',
            ],
            [
                'key' => 'transform_card1_desc',
                'value' => 'Pupuk kimia tradisional menyebabkan degradasi tanah, menurunkan kesuburan jangka panjang, dan memicu toksisitas lingkungan. Kami hadir memberikan solusi alternatif.',
                'value_en' => 'Traditional chemical fertilizers lead to soil degradation, reduced long-term fertility, and environmental toxicity. We provide the alternative.',
                'value_ja' => '従来の化学肥料は土壌の劣化を引き起こし、長期的な肥沃度を低下させ、環境毒性を誘発します。私たちは代替ソリューションを提供します。',
                'type' => 'textarea',
                'label' => 'Card 1 — Deskripsi',
            ],
            [
                'key' => 'transform_card1_image',
                'value' => 'settings/ihLxbSlTFN5xTlfkrGNPkr1TdOVcXoZTlF69NvaX.jpg',
                'value_en' => null,
                'value_ja' => null,
                'type' => 'image',
                'label' => 'Card 1 — Gambar',
            ],
            [
                'key' => 'transform_card2_title',
                'value' => 'Kekuatan Amino',
                'value_en' => 'Amino Power',
                'value_ja' => 'アミノ酸の力',
                'type' => 'text',
                'label' => 'Card 2 — Judul',
            ],
            [
                'key' => 'transform_card2_desc',
                'value' => 'Kandungan organik tinggi yang kaya akan nutrisi esensial untuk penyerapan cepat oleh tanaman.',
                'value_en' => 'High organic content rich in essential nutrients for rapid absorption.',
                'value_ja' => '植物への迅速な吸収に不可欠な栄養素が豊富な高有機含有量。',
                'type' => 'textarea',
                'label' => 'Card 2 — Deskripsi',
            ],
            [
                'key' => 'transform_card2_image',
                'value' => 'settings/tWJyEBtmVOuFskxcUm1oHjHfW6Pvcrq3fsY3v1Dg.jpg',
                'value_en' => null,
                'value_ja' => null,
                'type' => 'image',
                'label' => 'Card 2 — Gambar',
            ],
            [
                'key' => 'transform_card3_title',
                'value' => 'Kemurnian Alami',
                'value_en' => 'Pure Nature',
                'value_ja' => '自然の純粋さ',
                'type' => 'text',
                'label' => 'Card 3 — Judul',
            ],
            [
                'key' => 'transform_card3_desc',
                'value' => 'Bebas residu beracun. Aman untuk petani, aman untuk ekosistem, sangat penting untuk tanaman.',
                'value_en' => 'Zero toxic residues. Safe for farmers, safe for the ecosystem, vital for crops.',
                'value_ja' => '毒性残留物ゼロ。農家にとって安全で、生態系にとって安全であり、作物にとって極めて重要です。',
                'type' => 'textarea',
                'label' => 'Card 3 — Deskripsi',
            ],
            [
                'key' => 'transform_card3_image',
                'value' => 'settings/lVU2q3Gozq8mA92QeZ3ExgnqH6IXqfT3GGKu5Hup.jpg',
                'value_en' => null,
                'value_ja' => null,
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
                'value_ja' => 'マンドラグナ・グロウを選ぶ理由',
                'type' => 'text',
                'label' => 'Judul Section Keunggulan',
            ],
            [
                'key' => 'product_why_choose_subtitle',
                'value' => 'Pupuk Asam Amino Yang Di Hasilkan Dari Lemak Hewani.\r\nKaya Akan Protein Sehingga Dapat Menutrisi Tanaman Dengan Maksimal dan Juga Meningkatkan Imunitas Tanaman Sehingga Rentan Terhadap Hama Dan Penyakit.',
                'value_en' => 'Amino acid fertilizer produced from animal fat.\r\nRich in protein, it helps nourish plants optimally and increases plant immunity, making them less susceptible to pests and diseases.',
                'value_ja' => '動物性脂肪から作られたアミノ酸肥料です。\r\nタンパク質を豊富に含んでいるため、植物に十分な栄養を与え、植物の免疫力を高め、害虫や病気にかかりにくくします。',
                'type' => 'textarea',
                'label' => 'Subjudul Section Keunggulan',
            ],
            [
                'key' => 'product_benefit1_title',
                'value' => 'Profil Nutrisi Lengkap',
                'value_en' => 'Complete Nutrient Profile',
                'value_ja' => '完全な栄養プロファイル',
                'type' => 'text',
                'label' => 'Keunggulan 1 — Judul',
            ],
            [
                'key' => 'product_benefit1_desc',
                'value' => 'Diformulasikan dengan campuran seimbang makro dan mikro-nutrisi esensial untuk tahap awal pertumbuhan tanaman. Memastikan perkembangan daun yang cepat dan pembentukan batang yang kuat.',
                'value_en' => 'Formulated with a balanced blend of essential macro and micro-nutrients for early stages of plant growth. Ensures rapid leaf development and sturdy stem formation.',
                'value_ja' => '植物の初期成長段階に必要な主要栄養素と微量栄養素をバランスよく配合。迅速な葉の発育と頑丈な茎の形成を保証します。',
                'type' => 'textarea',
                'label' => 'Keunggulan 1 — Deskripsi',
            ],
            [
                'key' => 'product_benefit2_title',
                'value' => 'Enzim Biologis Aktif',
                'value_en' => 'Active Biological Enzymes',
                'value_ja' => '活性生物酵素',
                'type' => 'text',
                'label' => 'Keunggulan 2 — Judul',
            ],
            [
                'key' => 'product_benefit2_desc',
                'value' => 'Mengandung enzim biologis aktif yang mempercepat proses penyerapan nutrisi oleh tanaman dan meningkatkan aktivitas mikroba tanah yang menguntungkan.',
                'value_en' => 'Contains active biological enzymes that accelerate plant nutrient absorption and enhance beneficial soil microbial activity.',
                'value_ja' => '植物の栄養吸収プロセスを加速し、有益な土壌微生物活性を高める活性生物酵素が含まれています。',
                'type' => 'textarea',
                'label' => 'Keunggulan 2 — Deskripsi',
            ],
            [
                'key' => 'product_benefit3_title',
                'value' => 'Daya Tahan Tanaman',
                'value_en' => 'Plant Resilience',
                'value_ja' => '耐性の向上',
                'type' => 'text',
                'label' => 'Keunggulan 3 — Judul',
            ],
            [
                'key' => 'product_benefit3_desc',
                'value' => 'Meningkatkan sistem imun alami tanaman, menjadikannya lebih tahan terhadap hama, penyakit, serta kondisi cuaca ekstrem seperti kekeringan.',
                'value_en' => 'Boosts the natural immune system of plants, making them more resistant to pests, diseases, and extreme weather conditions like drought.',
                'value_ja' => '植物が病気や環境ストレスに対する自然な防御力を構築するのを助けます。過酷な条件下でも収量を安定させます。',
                'type' => 'textarea',
                'label' => 'Keunggulan 3 — Deskripsi',
            ],
            [
                'key' => 'product_tech_title',
                'value' => 'Data Teknis Resmi',
                'value_en' => 'Official Technical Data',
                'value_ja' => '技術データ',
                'type' => 'text',
                'label' => 'Judul Data Teknis',
            ],
            [
                'key' => 'product_tech_desc',
                'value' => 'Komposisi organik bersertifikat yang menjelaskan kandungan aktif esensial dan kadar nutrisi utama.',
                'value_en' => 'Certified organic composition detailing essential active ingredients and key nutrient levels.',
                'value_ja' => '必要な有効成分と栄養レベルを詳細に示した認定有機組成。',
                'type' => 'textarea',
                'label' => 'Deskripsi Data Teknis',
            ],
            [
                'key' => 'product_tech_image',
                'value' => null,
                'value_en' => null,
                'value_ja' => null,
                'type' => 'image',
                'label' => 'Gambar/Grafik Data Teknis',
            ],
            [
                'key' => 'product_hero_image',
                'value' => 'settings/mS7gNkjQubuucguXKFtksTorm9PfkVWXRg8RupuB.png',
                'value_en' => null,
                'value_ja' => null,
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
                'value_ja' => '2500',
                'type' => 'number',
                'label' => 'Limbah Kulit Diolah (Ton)',
            ],
            [
                'key' => 'sustainability_co2_reduced',
                'value' => '850',
                'value_en' => '850',
                'value_ja' => '850',
                'type' => 'number',
                'label' => 'Emisi CO2 Ditekan (Ton)',
            ],
            [
                'key' => 'sustainability_farmers_served',
                'value' => '1200',
                'value_en' => '1200',
                'value_ja' => '1200',
                'type' => 'number',
                'label' => 'Petani Dilayani',
            ],
            [
                'key' => 'sustainability_hectares_covered',
                'value' => '3500',
                'value_en' => '3500',
                'value_ja' => '3500',
                'type' => 'number',
                'label' => 'Luas Lahan Tercakup (Ha)',
            ],
            [
                'key' => 'sustainability_hero_image',
                'value' => null,
                'value_en' => null,
                'value_ja' => null,
                'type' => 'image',
                'label' => 'Gambar Hero Keberlanjutan',
            ],
            [
                'key' => 'sustainability_impact_image',
                'value' => null,
                'value_en' => null,
                'value_ja' => null,
                'type' => 'image',
                'label' => 'Gambar Dampak Keberlanjutan',
            ],
            [
                'key' => 'sustainability_biodiversity_image',
                'value' => null,
                'value_en' => null,
                'value_ja' => null,
                'type' => 'image',
                'label' => 'Gambar Keanekaragaman Hayati',
            ],
        ]);


        // === Seed Default Banner Slides ===
        Slide::create([
            'title' => 'Mengubah Limbah Kulit Menjadi Emas Pertanian',
            'title_en' => 'Transforming Leather Waste Into Agricultural Gold',
            'title_ja' => '革廃棄物を農業の黄金へと変換する',
            'subtitle' => 'Pupuk organik cair & padat kaya asam amino esensial dari limbah sisa penyamakan kulit sapi. Solusi pertanian sirkular berkinerja tinggi.',
            'subtitle_en' => 'Liquid & solid organic fertilizer rich in essential amino acids from leftover cow hide tanning waste. High-performance circular agriculture solution.',
            'subtitle_ja' => '牛革鞣し廃棄物由来の必須アミノ酸が豊富な液体および固体有機肥料。高性能な循環型農業ソリューション。',
            'cta_text' => 'Katalog Produk',
            'cta_text_en' => 'Product Catalog',
            'cta_text_ja' => '製品カタログ',
            'cta_link' => '/products',
            'image_path' => 'slides/NYhPOmXf98EpBeluIEVrerWxmbPfjZKrq5MvRtgc.jpg',
            'sort_order' => 0,
        ]);

        Slide::create([
            'title' => 'Inovasi Pertanian Berkelanjutan & Mandiri',
            'title_en' => 'Sustainable & Independent Agricultural Innovation',
            'title_ja' => '持続可能で自立した農業イノベーション',
            'subtitle' => 'Meningkatkan kesuburan tanah, mempercepat tumbuh kembang tanaman, dan melestarikan lingkungan melalui zero-waste processing.',
            'subtitle_en' => 'Improving soil fertility, accelerating crop growth, and conserving the environment through zero-waste processing.',
            'subtitle_ja' => 'ゼロ・ウェイスト処理を通じて、土壌の肥沃度を向上させ、作物の成長を加速し、環境を保護します。',
            'cta_text' => 'Pelajari Dampak Ekologi',
            'cta_text_en' => 'Learn Ecological Impact',
            'cta_text_ja' => '環境への影響を学ぶ',
            'cta_link' => '/sustainability',
            'image_path' => 'slides/sXTW0el91H9BFDwSwDNM24vd8gNQhLn3witYIFfl.jpg',
            'sort_order' => 1,
        ]);


        // === Seed Default Posts (News) ===
        Post::create([
            'title' => 'H. Muhammad Rian: Pelopor Inovasi Pupuk Organik Cair dari Limbah Penyamkan Kulit',
            'title_en' => 'H. Muhammad Rian: Pioneer of Liquid Organic Fertilizer Innovation from Tannery Waste',
            'title_ja' => 'H. Muhammad Rian：製革廃棄物からの液体有機肥料イノベーションのパイオニア',
            'slug' => 'h-muhammad-rian-pelopor-inovasi-pupuk-organik-cair-dari-limbah-penyamkan-kulit',
            'excerpt' => 'Pengusaha muda asal Garut, H. Muhammad Rian, berhasil mengubah limbah penyamakan kulit yang dulunya menjadi permasalahan serius di Sukaregang, menjadi produk pupuk organik cair yang kini banyak digunakan oleh petani di Jawa Barat hingga luar Pulau Jawa.',
            'excerpt_en' => 'Young entrepreneur from Garut, H. Muhammad Rian, successfully transformed leather tanning waste, which was once a serious issue in Sukaregang, into liquid organic fertilizer products now widely used by farmers in West Java and beyond.',
            'excerpt_ja' => 'ガルット出身の若手起業家H. Muhammad Rianは、かつてスカレガンで深刻な問題であった革鞣し廃棄物を、現在西ジャワやそれ以外の地域の農家に広く使用されている液体有機肥料製品へと変換することに成功しました。',
            'content' => '<p>Masalah pencemaran lingkungan yang diakibatkan oleh limbah penyamakan kulit di Sukaregang, Garut, akhirnya menemukan solusinya. Pengusaha muda asal Garut, H. Muhammad Rian, berhasil mengubah limbah penyamakan kulit (fleshing) yang dulunya menjadi permasalahan serius, menjadi produk pupuk organik cair yang kaya akan asam amino esensial.</p><p>\r\nInovasi ini tidak hanya mengurangi pencemaran lingkungan secara signifikan tetapi juga memberikan alternatif pupuk organik berkinerja tinggi bagi para petani untuk meningkatkan kesuburan tanah dan mengoptimalkan hasil panen mereka secara berkelanjutan.</p><p><img></p><p><img></p>',
            'content_en' => '<p>The environmental pollution problem caused by leather tanning waste in Sukaregang, Garut, has finally found its solution. H. Muhammad Rian, a young entrepreneur from Garut, succeeded in converting leather tanning waste (fleshing), which used to be a serious issue, into liquid organic fertilizer rich in essential amino acids.\r\n\r\nThis innovation not only significantly reduces environmental pollution but also provides a high-performance organic fertilizer alternative for farmers to improve soil fertility and optimize crop yields sustainably.</p>',
            'content_ja' => '<p>ガルットのスカレガンにおける革鞣し廃棄物による環境汚染問題は、ついに解決策を見出しました。ガルットの若手起業家であるH. Muhammad Rianは、かつて深刻な問題であった革鞣し廃棄物（フレッシング）を、必須アミノ酸が豊富な液体有機肥料製品に変換することに成功しました。\r\n\r\nこのイノベーションは環境汚染を大幅に削減するだけでなく、農家が土壌の肥沃度を向上させ、持続可能な方法で作物の収量を最適化するための高性能な有機肥料の代替品を提供します。</p>',
            'image_path' => 'posts/post_1.jpg',
            'is_published' => true,
            'published_at' => '2024-10-17 20:39:22',
            'views' => 125,
        ]);

        Post::create([
            'title' => 'Sawah Dilanda Kekeringan, Petani di Kampung Mentan Andi Amran Panen Padi 7,3 Ton Per Hektare',
            'title_en' => 'Fields Struck by Drought, Farmers in Mentan Andi Amran Home Village Harvest 7.3 Tons of Rice per Hectare',
            'title_ja' => '干ばつに見舞われた水田、アンディ・アムラン農相の故郷の農家がヘクタールあたり7.3トンの米を収穫',
            'slug' => 'sawah-dilanda-kekeringan-petani-di-kampung-mentan-andi-amran-panen-padi-73-ton-per-hektare',
            'excerpt' => 'Petani di Kampung Menteri Pertanian (Mentan) RI, Andi Amran Sulaiman, di Desa Ponre-ponre, Kabupaten Bone, tersenyum lebar setelah panen perdana padi program Gernas. Meskipun dilanda kekeringan, sawah menghasilkan 7,3 ton per hektare berkat pemanfaatan Pupuk Trubus hasil kolaborasi dengan PT Mandraguna Pusaka Indonesia.',
            'excerpt_en' => 'Farmers in the hometown of the Minister of Agriculture (Mentan) RI, Andi Amran Sulaiman, in Ponre-ponre Village, Bone Regency, smiled widely after the inaugural rice harvest of the Gernas program. Despite the drought, the fields yielded 7.3 tons per hectare thanks to the use of Trubus Fertilizer in collaboration with PT Mandraguna Pusaka Indonesia.',
            'excerpt_ja' => 'ボネ県ポンレポンレ村にあるアンディ・アムラン・スライマンインドネシア農業大臣の故郷の農家は、ゲルナスプログラムの初の米収穫後に満面の笑みを浮かべました。干ばつにもかかわらず、PT Mandraguna Pusaka Indonesiaとの共同開発によるトルブス肥料の使用のおかげで、水田はヘクタールあたり7.3トンを産出しました。',
            'content' => 'Kelompok Tani Desa Ponre-ponre, Kecamatan Libureng, Kabupaten Bone, Provinsi Sulawesi Selatan berhasil melakukan panen perdana padi program Gernas Tahun 2023. Meski sawah dilanda kondisi kekeringan yang parah, hasil panennya terbilang melimpah mencapai 7,35 ton per hektare.\n\nRahasia sukses di balik panen melimpah ini tidak lepas dari penggunaan Pupuk Trubus yang dikerjasamakan dengan PT Mandraguna Pusaka Indonesia. Dengan hanya menggunakan 5 liter pupuk Trubus per hektare, petani dapat menghemat biaya dibanding menggunakan pupuk kimia tradisional, sekaligus mempercepat pertumbuhan padi, meningkatkan jumlah anakan, dan mengurangi penggunaan pestisida kimia.',
            'content_en' => 'The Ponre-ponre Village Farmer Group, Libureng District, Bone Regency, South Sulawesi Province successfully conducted the first rice harvest of the 2023 Gernas program. Although the fields were hit by severe drought conditions, the harvest was abundant, reaching 7.35 tons per hectare.\n\nThe secret to success behind this bumper harvest is the use of Trubus Fertilizer in partnership with PT Mandraguna Pusaka Indonesia. By using only 5 liters of Trubus fertilizer per hectare, farmers can save costs compared to traditional chemical fertilizers, while accelerating rice growth, increasing tillering, and reducing chemical pesticide usage.',
            'content_ja' => '南スラウェシ州ボネ県リブレン地区ポンレポンレ村の農家グループは、2023年ゲルナスプログラムの初の米収穫に成功しました。水田が深刻な干ばつに見舞われたにもかかわらず、収穫量はヘクタールあたり7.35トンに達し、豊富でした。\n\nこの豊作の裏にある成功の秘密は、PT Mandraguna Pusaka Indonesiaと共同で展開されたトルブス肥料の使用にあります。ヘクタールあたりわずか5リットルのトルブス肥料を使用することで、農家は従来の化学肥料と比較してコストを節約できると同時に、稲の成長を加速し、分げつを増やし、化学農薬の使用を減らすことができます。',
            'image_path' => 'posts/post_2.jpg',
            'is_published' => true,
            'published_at' => '2024-03-06 15:31:00',
            'views' => 89,
        ]);

        Post::create([
            'title' => 'H. Rian, Pengusaha Muda Visioner dari Garut Mengubah Limbah Menjadi Berkah',
            'title_en' => 'H. Rian, Visionary Young Entrepreneur from Garut Turns Waste into Blessing',
            'title_ja' => 'H. Rian：ガルット出身の先見の明のある若手起業家、廃棄物を恵みに変える',
            'slug' => 'h-rian-pengusaha-muda-visioner-dari-garut-mengubah-limbah-menjadi-berkah',
            'excerpt' => 'Kabupaten Garut kembali melahirkan sosok inspiratif, H. Muhammad Rian. Pengusaha muda visioner ini sukses mendirikan Mandraguna Grow yang mengolah limbah organik penyamakan kulit menjadi produk bernilai tinggi seperti pupuk organik cair berkualitas tinggi.',
            'excerpt_en' => 'Garut Regency has once again given birth to an inspiring figure, H. Muhammad Rian. This visionary young entrepreneur successfully founded Mandraguna Grow, which processes organic leather tanning waste into high-value products such as high-quality liquid organic fertilizer.',
            'excerpt_ja' => 'ガルット県は再び、刺激的な人物であるH. Muhammad Rianを輩出しました。この先見の明のある若手起業家は、有機的な革鞣し廃棄物を高品質の液体有機肥料などの高価値製品に加工するマンドラグナ・グロウの設立に成功しました。',
            'content' => 'Kabupaten Garut kembali melahirkan sosok inspiratif, H. Muhammad Rian, seorang pengusaha muda visioner yang berhasil mengubah limbah penyamakan kulit menjadi berkah melalui inovasi Mandraguna Grow. Mandraguna Grow fokus pada pengolahan limbah organik fleshing dari penyamakan kulit menjadi pupuk organik cair berkualitas tinggi yang kaya akan kandungan asam amino lengkap.\n\nInovasi pupuk organik ini menjadi solusi vital untuk mengembalikan kesuburan tanah Indonesia, meningkatkan sistem imun tanaman dari hama, meningkatkan kadar klorofil dan laju fotosintesis, serta meminimalisasi stres lingkungan pada tanaman pangan.',
            'content_en' => 'Garut Regency has once again given birth to an inspiring figure, H. Muhammad Rian, a visionary young entrepreneur who turned leather tanning waste into a blessing through the Mandraguna Grow innovation. Mandraguna Grow focuses on processing organic fleshing waste from leather tanning into high-quality liquid organic fertilizer rich in a complete profile of amino acids.\n\nThis organic fertilizer innovation is a vital solution to restore the fertility of Indonesian soils, boost plant immune systems against pests, increase chlorophyll levels and photosynthesis rates, and minimize environmental stress on food crops.',
            'content_ja' => 'ガルット県は再び、マンドラグナ・グロウのイノベーションを通じて革鞣し廃棄物を恵みに変えた、先見の明のある若手起業家H. Muhammad Rianというインスピレーションを与える人物を輩出しました。マンドラグナ・グロウは、革鞣しからの有機フレッシング廃棄物を、完全なアミノ酸含有量に富んだ高品質の液体有機肥料に加工することに焦点を当てています。\n\nこの有機肥料のイノベーションは、インドネシアの土壌の肥沃度を回復し、害虫に対する植物の免疫システムを高め、クロロフィルレベルと光合成速度を向上させ、食用作物の環境ストレスを最小限に抑えるための重要なソリューションです。',
            'image_path' => 'posts/post_3.jpg',
            'is_published' => true,
            'published_at' => '2024-11-26 15:31:00',
            'views' => 211,
        ]);


        // === Seed Default Field Stories (Kabar Lapangan) ===
        FieldStory::create([
            'title' => 'Inovasi Rumah Kaca di Subang',
            'title_en' => 'Greenhouse Innovation in Subang',
            'title_ja' => 'スバンにおける温室イノベーション',
            'slug' => 'inovasi-rumah-kaca-di-subang',
            'excerpt' => 'Bekerja sama erat dengan para pemimpin pertanian setempat untuk menerapkan protokol pemberian nutrisi organik di lingkungan terkendali, menghasilkan dedaunan yang lebih lebat dan sistem perakaran yang kokoh.',
            'excerpt_en' => 'Working closely with local agricultural leaders to implement organic nutrient protocols in controlled environments, resulting in denser foliage and robust root systems.',
            'excerpt_ja' => '管理された環境下で有機栄養供給プロトコルを適用するため、現地の農業指導者と密接に連携し、より密な葉と頑丈な根系を実現。',
            'content' => 'Proyek rumah kaca di Subang merupakan kolaborasi intensif antara tim Mandraguna dengan kelompok tani lokal di Kecamatan Pagaden. Dengan menerapkan protokol pemberian nutrisi organik berbasis asam amino di lingkungan terkendali, kami berhasil mengamati peningkatan signifikan pada kualitas tanaman.\n\nDedaunan tampak lebih lebat dan hijau, sistem perakaran semakin kokoh, dan tingkat ketahanan terhadap hama meningkat drastis. Hasil ini membuka peluang besar untuk replikasi program di wilayah lain.',
            'content_en' => 'The greenhouse project in Subang is an intensive collaboration between the Mandraguna team and local farmer groups in Pagaden District. By implementing amino acid-based organic nutrient protocols in controlled environments, we successfully observed significant improvements in plant quality.\n\nFoliage appeared denser and greener, root systems grew stronger, and the resistance level to pests increased drastically. These results open up great opportunities for program replication in other regions.',
            'content_ja' => 'スバンの温室プロジェクトは、マンドラグナのチームとパガデン地区の地元の農家グループとの集中的なコラボレーションです。管理された環境でアミノ酸ベースの有機栄養プロトコルを適用することにより、植物の品質が大幅に向上するのを観察することに成功しました。\n\n葉はより密で緑豊かになり、根系はより強固になり、害虫に対する耐性レベルは劇的に向上しました。これらの結果は、他の地域でのプログラム展開に向けた大きな道を開くものです。',
            'image_path' => 'field_stories/eAeKG8dLYUFIxGWvot0vCspYlFC6tiJNvCclW4pa.jpg',
            'is_published' => true,
            'published_at' => '2024-09-15 10:00:00',
            'views' => 58,
        ]);

        FieldStory::create([
            'title' => 'Pemanenan Mekanis & Sinergi Organik',
            'title_en' => null,
            'title_ja' => null,
            'slug' => 'pemanenan-mekanis-sinergi-organik',
            'excerpt' => 'Mengintegrasikan operasi mekanis skala besar dengan aplikasi pupuk organik yang presisi. Memastikan integritas tanah tidak terkompromi selama siklus panen hasil tinggi.',
            'excerpt_en' => null,
            'excerpt_ja' => null,
            'content' => 'Program integrasi mekanisasi pertanian dengan pupuk organik Mandraguna telah berhasil diimplementasikan di beberapa lahan sawah besar di Jawa Barat. Kombinasi antara penggunaan alat mekanis modern dengan pemberian pupuk organik yang tepat waktu dan dosis yang presisi terbukti mampu meningkatkan efisiensi panen hingga 40%.\r\n\r\nYang lebih penting, integritas dan kesuburan tanah tetap terjaga bahkan setelah beberapa siklus panen berturut-turut. Ini membuktikan bahwa produktivitas tinggi dan kelestarian lingkungan bisa berjalan beriringan.',
            'content_en' => null,
            'content_ja' => null,
            'image_path' => 'field_stories/TaZJL2BZkcvzpDEJwDqTr4zKulxatSTxth3TmysJ.jpg',
            'is_published' => true,
            'published_at' => '2024-08-20 14:30:00',
            'views' => 46,
        ]);

        FieldStory::create([
            'title' => 'Pemanenan Mekanis & Sinergi Organik',
            'title_en' => 'Mechanical Harvesting & Organic Synergy',
            'title_ja' => '機械的収穫と有機的相乗効果',
            'slug' => 'pemanenan-mekanis-dan-sinergi-organik',
            'excerpt' => 'Mengintegrasikan operasi mekanis skala besar dengan aplikasi pupuk organik yang presisi. Memastikan integritas tanah tidak terkompromi selama siklus panen hasil tinggi.',
            'excerpt_en' => 'Integrating large-scale mechanical operations with precise organic fertilizer application. Ensuring soil integrity is not compromised during high-yield harvest cycles.',
            'excerpt_ja' => '大規模な機械化事業と精密な有機肥料の散布を統合。多収穫サイクルにおいて土壌の完全性が損なわれないようにします。',
            'content' => 'Program integrasi mekanisasi pertanian dengan pupuk organik Mandraguna telah berhasil diimplementasikan di beberapa lahan sawah besar di Jawa Barat. Kombinasi antara penggunaan alat mekanis modern dengan pemberian pupuk organik yang tepat waktu dan dosis yang presisi terbukti mampu meningkatkan efisiensi panen hingga 40%.\n\nYang lebih penting, integritas dan kesuburan tanah tetap terjaga bahkan setelah beberapa siklus panen berturut-turut. Ini membuktikan bahwa produktivitas tinggi dan kelestarian lingkungan bisa berjalan beriringan.',
            'content_en' => 'The program integrating agricultural mechanization with Mandraguna organic fertilizer has been successfully implemented in several large paddy fields in West Java. The combination of using modern mechanical tools with timely and precise application of organic fertilizer is proven to increase harvest efficiency by up to 40%.\n\nMore importantly, soil integrity and fertility are maintained even after several consecutive harvest cycles. This proves that high productivity and environmental sustainability can go hand in hand.',
            'content_ja' => '農業機械化とマンドラグナ有機肥料を統合するプログラムは、西ジャワのいくつかの大規模な水田で導入に成功しています。現代の機械ツールの使用と、タイムリーで精密な有機肥料の散布との組み合わせにより、収穫効率が最大40%向上することが証明されています。\n\nさらに重要なことに、数回の連続した収穫サイクルの後でも、土壌の完全性と肥沃度は維持されています。これは、高い生産性と環境の持続可能性が両立できることを証明しています。',
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
                    'value_ja'   => $item['value_ja'] ?? null,
                    'type'       => $item['type'],
                    'group'      => $group,
                    'label'      => $item['label'],
                    'sort_order' => $index,
                ]
            );
        }
    }
}
