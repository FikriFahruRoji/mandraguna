<template>
  <Head :title="t('Produk - Mandraguna Grow', 'Products - Mandraguna Grow', '製品 - マンドラグナ・グロウ')" />
  <PublicLayout>
    <!-- Hero Section: Product Overview -->
    <section class="product-hero">
      <div class="hero-inner">
        <div class="hero-content">
          <div>
            <span class="hero-label">{{ t('PUPUK ORGANIK PREMIUM', 'PREMIUM ORGANIC FERTILIZER', 'プレミアム有機肥料') }}</span>
            <h1 class="hero-title">Mandraguna Grow</h1>
            <p class="hero-desc">
              {{ t(product_page.product_why_choose_subtitle, product_page.product_why_choose_subtitle_en, product_page.product_why_choose_subtitle_ja) || t('Pupuk organik cair berbasis asam amino canggih yang dirancang untuk merangsang pertumbuhan vegetatif, meningkatkan perkembangan akar, dan memperbaiki ketahanan tanaman secara keseluruhan terhadap stres lingkungan.', 'Advanced amino acid-based liquid organic fertilizer designed to stimulate vegetative growth, enhance root development, and improve overall plant resilience against environmental stress.', '先進的なアミノ酸ベースの液体有機肥料。生長を刺激し、根の発達を促進し、環境ストレスに対する植物全体の回復力を向上させるよう設計されています。') }}
            </p>
          </div>
          <div class="hero-actions">
            <a href="/contact" class="btn-gold">
              <span class="btn-icon">🛒</span> {{ t('Pesan Sekarang', 'Order Now', '今すぐ注文する') }}
            </a>
            <a href="#tech-specs" class="btn-ghost">
              <span class="btn-icon">📄</span> {{ t('Spesifikasi Teknis', 'Tech Specs', '技術仕様') }}
            </a>
          </div>
        </div>
        <div class="hero-image">
          <img :src="heroImage" alt="Mandraguna Grow Product" />
        </div>
      </div>
    </section>

    <!-- Product Benefits Grid -->
    <section class="section-benefits">
      <div class="container">
        <div class="section-header">
          <h2 class="section-title">{{ t('Mengapa Memilih Mandraguna Grow?', 'Why Choose Mandraguna Grow?', 'マンドラグナ・グロウを選ぶ理由') }}</h2>
          <p class="section-subtitle">{{ t('Direkayasa untuk penyerapan nutrisi maksimal dan revitalisasi kesehatan tanah.', 'Engineered for maximum nutrient uptake and soil health revitalization.', '栄養吸収の最大化と土壌の健康の活性化を目指して設計されています。') }}</p>
        </div>

        <div class="benefits-grid">
          <!-- Benefit 1 -->
          <div class="benefit-card bg-white hover-lift">
            <span class="bento-icon gold">🌿</span>
            <h3 class="bento-title">{{ t(product_page.product_benefit1_title, product_page.product_benefit1_title_en, product_page.product_benefit1_title_ja) || t('Profil Nutrisi Lengkap', 'Complete Nutrient Profile', '完全な栄養プロファイル') }}</h3>
            <p class="bento-desc">{{ t(product_page.product_benefit1_desc, product_page.product_benefit1_desc_en, product_page.product_benefit1_desc_ja) || t('Diformulasikan dengan campuran seimbang makro dan mikro-nutrisi esensial untuk tahap awal pertumbuhan tanaman. Memastikan perkembangan daun yang cepat dan pembentukan batang yang kuat.', 'Formulated with a balanced blend of macro and micro-nutrients essential for the early stages of plant growth. Ensures rapid leaf development and strong stem formation.', '植物の初期成長段階に必要な主要栄養素と微量栄養素をバランスよく配合。迅速な葉の発育と頑丈な茎の形成を保証します。') }}</p>
          </div>

          <!-- Benefit 2 -->
          <div class="benefit-card bg-white hover-lift">
            <span class="bento-icon gold">🔬</span>
            <h3 class="bento-title">{{ t(product_page.product_benefit2_title, product_page.product_benefit2_title_en, product_page.product_benefit2_title_ja) || t('Enzim Biologis Aktif', 'Active Enzymes', '活性生物酵素') }}</h3>
            <p class="bento-desc">{{ t(product_page.product_benefit2_desc, product_page.product_benefit2_desc_en, product_page.product_benefit2_desc_ja) || t('Mengandung enzim biologis aktif yang mempercepat penyerapan nutrisi dan meningkatkan aktivitas mikroba tanah.', 'Contains active biological enzymes that accelerate nutrient absorption and improve soil microbial activity.', '植物の栄養吸収プロセスを加速し、有益な土壌微生物活性を高める活性生物酵素が含まれています。') }}</p>
          </div>

          <!-- Benefit 3 -->
          <div class="benefit-card bg-white hover-lift">
            <span class="bento-icon gold">🛡️</span>
            <h3 class="bento-title">{{ t(product_page.product_benefit3_title, product_page.product_benefit3_title_en, product_page.product_benefit3_title_ja) || t('Daya Tahan Tanaman', 'Plant Durability', '耐性の向上') }}</h3>
            <p class="bento-desc">{{ t(product_page.product_benefit3_desc, product_page.product_benefit3_desc_en, product_page.product_benefit3_desc_ja) || t('Meningkatkan sistem imun alami tanaman, menjadikannya lebih tahan terhadap hama, penyakit, dan kondisi cuaca ekstrem.', 'Enhances the plant\'s natural immune system, making it more resilient to pests, diseases, and extreme weather conditions.', '植物が病気や環境ストレスに対する自然な防御力を構築するのを助け、過酷な条件下でも収量を安定させます。') }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Technical Specifications (Zebra Stripe Data List) -->
    <section id="tech-specs" class="section-specs">
      <div class="container">
        <div class="specs-grid">
          <!-- Left Column (1/3): Image -->
          <div class="specs-image-wrapper">
            <img :src="specsImage" alt="Product specifications image" class="specs-image" />
          </div>

          <!-- Right Column (2/3): Title, Description, and Table -->
          <div class="specs-content-wrapper">
            <div class="specs-header-section">
              <h2 class="section-title">{{ t('Data Teknis', 'Technical Data', '技術データ') }}</h2>
              <p class="section-subtitle">{{ t('Komposisi organik bersertifikat yang merinci kandungan nutrisi dan bahan aktif esensial.', 'Certified organic composition detailing the essential active ingredients and nutrient levels.', '必要な有効成分と栄養レベルを詳細に示した認定有機組成。') }}</p>
            </div>

            <div class="specs-table">
              <div class="specs-table-header">
                <div>{{ t('Parameter', 'Parameter', 'パラメーター') }}</div>
                <div>{{ t('Nilai / Spesifikasi', 'Value / Specification', '数値 / 仕様') }}</div>
              </div>
              <div v-for="(row, idx) in specData" :key="idx" class="specs-row" :class="{ 'row-alt': idx % 2 !== 0 }">
                <div class="specs-param">{{ t(row.param_id, row.param_en, row.param_ja) }}</div>
                <div class="specs-value">{{ t(row.value_id, row.value_en, row.value_ja) }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Dosage & Usage Guide -->
    <section class="section-dosage">
      <div class="container">
        <div class="section-header">
          <h2 class="section-title">{{ t('Panduan Aplikasi', 'Application Guidelines', '散布ガイドライン') }}</h2>
          <p class="section-subtitle">{{ t('Instruksi dosis yang direkomendasikan untuk hasil optimal pada berbagai jenis tanaman.', 'Recommended dosage instructions for optimal results across different crop types.', 'さまざまな種類の作物で最適な結果を得るための推奨使用量。') }}</p>
        </div>

        <div class="dosage-grid">
          <div v-for="(crop, idx) in cropData" :key="idx" class="dosage-card hover-lift">
            <div class="dosage-header">
              <span class="dosage-icon">{{ crop.icon }}</span>
              <h4 class="dosage-crop-name">{{ t(crop.name_id, crop.name_en, crop.name_ja) }}</h4>
            </div>
            <p class="dosage-examples">{{ t(crop.examples_id, crop.examples_en, crop.examples_ja) }}</p>
            <div class="dosage-info">
              <div>
                <span class="dosage-label">{{ t('DOSIS:', 'DOSAGE:', '用量:') }}</span>
                <p class="dosage-value">{{ t(crop.dosage_id, crop.dosage_en, crop.dosage_ja) }}</p>
              </div>
              <div>
                <span class="dosage-label">{{ t('FREKUENSI:', 'FREQUENCY:', '頻度:') }}</span>
                <p class="dosage-value">{{ t(crop.frequency_id, crop.frequency_en, crop.frequency_ja) }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </PublicLayout>
</template>

<script setup>
import { computed } from 'vue';
import { Head } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';
import { useLanguage } from '@/composables/useLanguage';

const props = defineProps({
    products: { type: Array, default: () => [] },
    product_page: { type: Object, default: () => ({}) }
});

const { t } = useLanguage();

// Placeholder images (using high-quality agricultural photos)
const heroImage = computed(() => {
    return props.product_page.product_hero_image
        ? `/storage/${props.product_page.product_hero_image}`
        : 'https://images.unsplash.com/photo-1625246333195-78d9c38ad449?w=800&h=600&fit=crop&q=80';
});

const specsImage = computed(() => {
    return props.product_page.product_tech_image
        ? `/storage/${props.product_page.product_tech_image}`
        : 'https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=400&h=500&fit=crop&q=80';
});

// Technical specification data
const specData = [
    { param_id: 'Nitrogen (N)', param_en: 'Nitrogen (N)', param_ja: '窒素 (N)', value_id: 'Min. 4,0%', value_en: 'Min. 4.0%', value_ja: '最小 4.0%' },
    { param_id: 'Fosfor (P2O5)', param_en: 'Phosphorus (P2O5)', param_ja: 'リン (P2O5)', value_id: 'Min. 3,0%', value_en: 'Min. 3.0%', value_ja: '最小 3.0%' },
    { param_id: 'Kalium (K2O)', param_en: 'Potassium (K2O)', param_ja: 'カリウム (K2O)', value_id: 'Min. 3,0%', value_en: 'Min. 3.0%', value_ja: '最小 3.0%' },
    { param_id: 'Bahan Organik (C-Organik)', param_en: 'Organic Matter (C-Organic)', param_ja: '有機物 (C-有機)', value_id: '> 15,0%', value_en: '> 15.0%', value_ja: '> 15.0%' },
    { param_id: 'Asam Amino', param_en: 'Amino Acids', param_ja: 'アミノ酸', value_id: 'Ada (Campuran kompleks)', value_en: 'Present (Complex blend)', value_ja: '含有 (複合ブレンド)' },
    { param_id: 'Tingkat pH', param_en: 'pH Level', param_ja: 'pHレベル', value_id: '6,5 - 7,5', value_en: '6.5 - 7.5', value_ja: '6.5 - 7.5' },
];

// Crop dosage data
const cropData = [
    {
        icon: '🌾',
        name_id: 'Tanaman Pangan', name_en: 'Food Crops', name_ja: '食用作物',
        examples_id: 'Padi, Jagung, Gandum', examples_en: 'Rice, Corn, Wheat', examples_ja: '米、トウモロコシ、小麦',
        dosage_id: '2-3 ml per liter air', dosage_en: '2-3 ml per liter of water', dosage_ja: '水1リットルあたり 2-3 ml',
        frequency_id: 'Setiap 10-15 hari', frequency_en: 'Every 10-15 days', frequency_ja: '10-15日ごと',
    },
    {
        icon: '🌻',
        name_id: 'Tanaman Umbi', name_en: 'Tuber Plants', name_ja: '塊茎作物',
        examples_id: 'Kentang, Singkong, Wortel', examples_en: 'Potatoes, Cassava, Carrots', examples_ja: 'ジャガイモ、キャッサバ、人参',
        dosage_id: '3-4 ml per liter air', dosage_en: '3-4 ml per liter of water', dosage_ja: '水1リットルあたり 3-4 ml',
        frequency_id: 'Setiap 14-20 hari', frequency_en: 'Every 14-20 days', frequency_ja: '14-20日ごと',
    },
    {
        icon: '🌳',
        name_id: 'Tanaman Tahunan', name_en: 'Perennials', name_ja: '多年生・果樹',
        examples_id: 'Pohon Buah, Kelapa Sawit, Kakao', examples_en: 'Fruit Trees, Palm Oil, Cocoa', examples_ja: '果樹、アブラヤシ、カカオ',
        dosage_id: '4-5 ml per liter air', dosage_en: '4-5 ml per liter of water', dosage_ja: '水1リットルあたり 4-5 ml',
        frequency_id: 'Setiap 30 hari saat pertumbuhan aktif', frequency_en: 'Every 30 days during active growth', frequency_ja: '活発な成長期に30日ごと',
    },
];
</script>

<style scoped>
/* ===== HERO SECTION ===== */
.product-hero {
    padding: 160px 0 80px;
    background: linear-gradient(135deg, var(--color-earth-black) 0%, #2a2000 100%);
}

.hero-inner {
    max-width: var(--container-max);
    margin: 0 auto;
    padding: 0 var(--margin-mobile);
    display: grid;
    grid-template-columns: 1.2fr 0.8fr;
    gap: var(--gutter);
    align-items: center;
}

.hero-label {
    font-family: var(--font-label);
    font-size: 14px;
    font-weight: 600;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: var(--color-primary-container);
    margin-bottom: 8px;
    display: block;
}

.hero-title {
    font-family: var(--font-headline);
    font-size: 48px;
    font-weight: 700;
    line-height: 56px;
    color: white;
    margin: 8px 0 16px;
}

.hero-desc {
    font-family: var(--font-body);
    font-size: 18px;
    line-height: 28px;
    color: rgba(255, 255, 255, 0.8);
}

.hero-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
    margin-top: 32px;
}

.btn-gold {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--color-harvest-gold);
    color: var(--color-earth-black);
    font-family: var(--font-label);
    font-size: 14px;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    padding: 16px 32px;
    border-radius: var(--rounded);
    text-decoration: none;
    transition: opacity 0.3s ease;
}

.btn-gold:hover {
    opacity: 0.9;
}

.btn-ghost {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: transparent;
    color: white;
    font-family: var(--font-label);
    font-size: 14px;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    padding: 16px 32px;
    border: 1px solid rgba(255, 255, 255, 0.4);
    border-radius: var(--rounded);
    text-decoration: none;
    transition: background-color 0.3s ease, border-color 0.3s ease;
}

.btn-ghost:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: white;
}

.btn-icon {
    font-size: 16px;
}

.hero-image {
    position: relative;
    height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.hero-image img {
    max-width: 100%;
    height: 100%;
    object-fit: contain;
    filter: drop-shadow(0 15px 30px rgba(0, 0, 0, 0.4));
}

/* ===== SECTION COMMON ===== */
.container {
    max-width: var(--container-max);
    margin: 0 auto;
    padding: 0 var(--margin-mobile);
}

.section-header {
    text-align: center;
    max-width: 768px;
    margin: 0 auto 48px;
}

.section-title {
    font-family: var(--font-headline);
    font-size: 32px;
    font-weight: 600;
    line-height: 40px;
    color: var(--color-earth-black);
    margin-bottom: 16px;
}

.section-subtitle {
    font-family: var(--font-body);
    font-size: 16px;
    line-height: 24px;
    color: var(--color-secondary);
}

/* ===== BENEFITS GRID ===== */
.section-benefits {
    padding: var(--space-section) 0;
    background: var(--color-surface);
}

.benefits-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: var(--gutter);
}

.benefit-card {
    padding: 32px;
    border: 1px solid var(--color-secondary-container);
    border-radius: var(--rounded-lg);
    background: var(--color-pure-white);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.bento-icon {
    font-size: 36px;
    display: block;
    margin-bottom: 16px;
}

.bento-icon.gold {
    color: var(--color-harvest-gold);
}

.bento-title {
    font-family: var(--font-headline);
    font-size: 24px;
    font-weight: 600;
    line-height: 32px;
    color: var(--color-earth-black);
    margin-bottom: 8px;
}

.bento-desc {
    font-family: var(--font-body);
    font-size: 16px;
    line-height: 24px;
    color: var(--color-secondary);
}

/* ===== TECHNICAL SPECIFICATIONS ===== */
.section-specs {
    padding: var(--space-section) 0;
    background: var(--color-pure-white);
}

.specs-header-section {
    margin-bottom: 24px;
}

.specs-header-section .section-title {
    text-align: left;
    margin-bottom: 8px;
}

.specs-header-section .section-subtitle {
    text-align: left;
}

.specs-grid {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: var(--gutter);
    align-items: stretch;
}

.specs-image-wrapper {
    position: relative;
    height: 100%;
    width: 100%;
}

.specs-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: var(--rounded-lg);
    box-shadow: var(--shadow-soft);
    border: 1px solid var(--color-secondary-container);
    object-fit: cover;
}

.specs-table {
    border: 1px solid var(--color-secondary-container);
    border-radius: var(--rounded-lg);
    overflow: hidden;
}

.specs-table-header {
    display: grid;
    grid-template-columns: 1fr 1fr;
    background: var(--color-earth-black);
    color: var(--color-pure-white);
    padding: 16px;
    font-family: var(--font-label);
    font-size: 14px;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
}

.specs-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    padding: 16px;
    font-family: var(--font-body);
    font-size: 16px;
    line-height: 24px;
    color: var(--color-earth-black);
    border-bottom: 1px solid var(--color-secondary-container);
    align-items: center;
}

.specs-row:last-child {
    border-bottom: none;
}

.specs-row.row-alt {
    background: var(--color-surface);
}

.specs-param {
    font-weight: 600;
}

/* ===== DOSAGE & USAGE GUIDE ===== */
.section-dosage {
    padding: var(--space-section) 0;
    background: var(--color-surface-gray);
    border: 1px solid var(--color-secondary-container);
    border-left: none;
    border-right: none;
}

.section-dosage .container {
    max-width: var(--container-max);
}

.dosage-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: var(--gutter);
}

.dosage-card {
    background: var(--color-pure-white);
    padding: 32px;
    border-radius: var(--rounded-lg);
    border: 1px solid var(--color-secondary-container);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.dosage-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 16px;
}

.dosage-icon {
    font-size: 28px;
}

.dosage-crop-name {
    font-family: var(--font-headline);
    font-size: 18px;
    font-weight: 600;
    color: var(--color-earth-black);
}

.dosage-examples {
    font-family: var(--font-body);
    font-size: 16px;
    line-height: 24px;
    color: var(--color-secondary);
    margin-bottom: 8px;
}

.dosage-info {
    background: var(--color-surface);
    padding: 16px;
    border-radius: var(--rounded);
    margin-top: 16px;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.dosage-label {
    font-family: var(--font-label);
    font-size: 14px;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--color-earth-black);
    display: block;
    margin-bottom: 4px;
}

.dosage-value {
    font-family: var(--font-body);
    font-size: 16px;
    line-height: 24px;
    color: var(--color-secondary);
}

/* ===== HOVER LIFT ===== */
.hover-lift:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-soft);
}

/* ===== RESPONSIVE ===== */
@media (min-width: 769px) {
    .container {
        padding: 0 var(--margin-desktop);
    }

    .hero-inner {
        padding: 0 var(--margin-desktop);
    }

    .hero-image {
        height: 600px;
    }

    .hero-title {
        font-size: 64px;
        font-weight: 800;
        line-height: 72px;
        letter-spacing: -0.02em;
    }
}

@media (max-width: 992px) {
    .benefits-grid {
        grid-template-columns: 1fr;
    }

    .specs-grid {
        grid-template-columns: 1fr;
        align-items: start;
    }

    .specs-image-wrapper {
        height: 300px;
    }

    .specs-image {
        max-width: 100%;
    }

    .dosage-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .product-hero {
        padding: 120px 0 60px;
    }

    .hero-inner {
        grid-template-columns: 1fr;
    }

    .hero-title {
        font-size: 32px;
        line-height: 40px;
    }

    .hero-image {
        height: 300px;
    }

    .section-benefits,
    .section-specs,
    .section-dosage {
        padding: 60px 0;
    }

    .section-title {
        font-size: 24px;
        line-height: 32px;
    }
}
</style>
