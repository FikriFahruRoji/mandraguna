<template>
  <Head :title="t('Produk - Mandraguna Grow', 'Products - Mandraguna Grow')" />
  <PublicLayout>
    <!-- Hero Section: Product Overview -->
    <section class="product-hero">
      <div class="hero-inner">
        <div class="hero-content">
          <div>
            <span class="hero-label">{{ t('PUPUK ORGANIK PREMIUM', 'PREMIUM ORGANIC FERTILIZER') }}</span>
            <h1 class="hero-title">Mandraguna Grow</h1>
            <p class="hero-desc">
              {{ t(product_page.product_why_choose_subtitle, product_page.product_why_choose_subtitle_en) || t('Pupuk organik cair berbasis asam amino canggih yang dirancang untuk merangsang pertumbuhan vegetatif, meningkatkan perkembangan akar, dan memperbaiki ketahanan tanaman secara keseluruhan terhadap stres lingkungan.', 'Advanced amino acid-based liquid organic fertilizer designed to stimulate vegetative growth, enhance root development, and improve overall plant resilience against environmental stress.') }}
            </p>
          </div>
          <div class="hero-actions">
            <a href="/contact" class="btn-gold">
              <span class="btn-icon">🛒</span> {{ t('Pesan Sekarang', 'Order Now') }}
            </a>
            <a href="#tech-specs" class="btn-ghost">
              <span class="btn-icon">📄</span> {{ t('Spesifikasi Teknis', 'Tech Specs') }}
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
          <h2 class="section-title">{{ t('Mengapa Memilih Mandraguna Grow?', 'Why Choose Mandraguna Grow?') }}</h2>
          <p class="section-subtitle">{{ t('Direkayasa untuk penyerapan nutrisi maksimal dan revitalisasi kesehatan tanah.', 'Engineered for maximum nutrient uptake and soil health revitalization.') }}</p>
        </div>

        <div class="benefits-grid">
          <!-- Benefit 1 -->
          <div class="benefit-card bg-white hover-lift">
            <span class="bento-icon gold">🌿</span>
            <h3 class="bento-title">{{ t(product_page.product_benefit1_title, product_page.product_benefit1_title_en) || t('Profil Nutrisi Lengkap', 'Complete Nutrient Profile') }}</h3>
            <p class="bento-desc">{{ t(product_page.product_benefit1_desc, product_page.product_benefit1_desc_en) || t('Diformulasikan dengan campuran seimbang makro dan mikro-nutrisi esensial untuk tahap awal pertumbuhan tanaman. Memastikan perkembangan daun yang cepat dan pembentukan batang yang kuat.', 'Formulated with a balanced blend of macro and micro-nutrients essential for the early stages of plant growth. Ensures rapid leaf development and strong stem formation.') }}</p>
          </div>

          <!-- Benefit 2 -->
          <div class="benefit-card bg-white hover-lift">
            <span class="bento-icon gold">🔬</span>
            <h3 class="bento-title">{{ t(product_page.product_benefit2_title, product_page.product_benefit2_title_en) || t('Enzim Biologis Aktif', 'Active Enzymes') }}</h3>
            <p class="bento-desc">{{ t(product_page.product_benefit2_desc, product_page.product_benefit2_desc_en) || t('Mengandung enzim biologis aktif yang mempercepat penyerapan nutrisi dan meningkatkan aktivitas mikroba tanah.', 'Contains active biological enzymes that accelerate nutrient absorption and improve soil microbial activity.') }}</p>
          </div>

          <!-- Benefit 3 -->
          <div class="benefit-card bg-white hover-lift">
            <span class="bento-icon gold">🛡️</span>
            <h3 class="bento-title">{{ t(product_page.product_benefit3_title, product_page.product_benefit3_title_en) || t('Daya Tahan Tanaman', 'Plant Durability') }}</h3>
            <p class="bento-desc">{{ t(product_page.product_benefit3_desc, product_page.product_benefit3_desc_en) || t('Meningkatkan sistem imun alami tanaman, menjadikannya lebih tahan terhadap hama, penyakit, dan kondisi cuaca ekstrem.', 'Enhances the plant\'s natural immune system, making it more resilient to pests, diseases, and extreme weather conditions.') }}</p>
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
              <h2 class="section-title">{{ t('Data Teknis', 'Technical Data') }}</h2>
              <p class="section-subtitle">{{ t('Komposisi organik bersertifikat yang merinci kandungan nutrisi dan bahan aktif esensial.', 'Certified organic composition detailing the essential active ingredients and nutrient levels.') }}</p>
            </div>

            <div class="specs-table">
              <div class="specs-table-header">
                <div>{{ t('Parameter', 'Parameter') }}</div>
                <div>{{ t('Nilai / Spesifikasi', 'Value / Specification') }}</div>
              </div>
              <div v-for="(row, idx) in specData" :key="idx" class="specs-row" :class="{ 'row-alt': idx % 2 !== 0 }">
                <div class="specs-param">{{ t(row.param_id, row.param_en) }}</div>
                <div class="specs-value">{{ t(row.value_id, row.value_en) }}</div>
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
          <h2 class="section-title">{{ t('Panduan Aplikasi', 'Application Guidelines') }}</h2>
          <p class="section-subtitle">{{ t('Instruksi dosis yang direkomendasikan untuk hasil optimal pada berbagai jenis tanaman.', 'Recommended dosage instructions for optimal results across different crop types.') }}</p>
        </div>

        <div class="dosage-grid">
          <div v-for="(crop, idx) in cropData" :key="idx" class="dosage-card hover-lift">
            <div class="dosage-header">
              <span class="dosage-icon">{{ crop.icon }}</span>
              <h4 class="dosage-crop-name">{{ t(crop.name_id, crop.name_en) }}</h4>
            </div>
            <p class="dosage-examples">{{ t(crop.examples_id, crop.examples_en) }}</p>
            <div class="dosage-info">
              <div>
                <span class="dosage-label">{{ t('DOSIS:', 'DOSAGE:') }}</span>
                <p class="dosage-value">{{ t(crop.dosage_id, crop.dosage_en) }}</p>
              </div>
              <div>
                <span class="dosage-label">{{ t('FREKUENSI:', 'FREQUENCY:') }}</span>
                <p class="dosage-value">{{ t(crop.frequency_id, crop.frequency_en) }}</p>
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
    { param_id: 'Nitrogen (N)', param_en: 'Nitrogen (N)', value_id: 'Min. 4,0%', value_en: 'Min. 4.0%' },
    { param_id: 'Fosfor (P2O5)', param_en: 'Phosphorus (P2O5)', value_id: 'Min. 3,0%', value_en: 'Min. 3.0%' },
    { param_id: 'Kalium (K2O)', param_en: 'Potassium (K2O)', value_id: 'Min. 3,0%', value_en: 'Min. 3.0%' },
    { param_id: 'Bahan Organik (C-Organik)', param_en: 'Organic Matter (C-Organic)', value_id: '> 15,0%', value_en: '> 15.0%' },
    { param_id: 'Asam Amino', param_en: 'Amino Acids', value_id: 'Ada (Campuran kompleks)', value_en: 'Present (Complex blend)' },
    { param_id: 'Tingkat pH', param_en: 'pH Level', value_id: '6,5 - 7,5', value_en: '6.5 - 7.5' },
];

// Crop dosage data
const cropData = [
    {
        icon: '🌾',
        name_id: 'Tanaman Pangan', name_en: 'Food Crops',
        examples_id: 'Padi, Jagung, Gandum', examples_en: 'Rice, Corn, Wheat',
        dosage_id: '2-3 ml per liter air', dosage_en: '2-3 ml per liter of water',
        frequency_id: 'Setiap 10-15 hari', frequency_en: 'Every 10-15 days',
    },
    {
        icon: '🌻',
        name_id: 'Tanaman Umbi', name_en: 'Tuber Plants',
        examples_id: 'Kentang, Singkong, Wortel', examples_en: 'Potatoes, Cassava, Carrots',
        dosage_id: '3-4 ml per liter air', dosage_en: '3-4 ml per liter of water',
        frequency_id: 'Setiap 14-20 hari', frequency_en: 'Every 14-20 days',
    },
    {
        icon: '🌳',
        name_id: 'Tanaman Tahunan', name_en: 'Perennials',
        examples_id: 'Pohon Buah, Kelapa Sawit, Kakao', examples_en: 'Fruit Trees, Palm Oil, Cocoa',
        dosage_id: '4-5 ml per liter air', dosage_en: '4-5 ml per liter of water',
        frequency_id: 'Setiap 30 hari saat pertumbuhan aktif', frequency_en: 'Every 30 days during active growth',
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
