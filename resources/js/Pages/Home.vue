<template>
  <Head :title="t('Beranda', 'Home')" />
  <PublicLayout>
    <!-- Hero Slider Section (Widyakarsa & Stitch Style) -->
    <section class="hero-slider">
      <div v-for="(slide, index) in slides" :key="slide.id" class="slide-item" :class="{ active: currentSlide === index }">
        <div class="slide-bg" :style="slide.image_path ? { backgroundImage: `url(/storage/${slide.image_path})` } : {}"></div>
        <div class="container hero-container">
          <div class="hero-content">
            <h1 class="headline-xl">{{ t(slide.title, slide.title_en) }}</h1>
            <p class="body-lg hero-subtitle">{{ t(slide.subtitle, slide.subtitle_en) }}</p>
            <div class="hero-actions">
              <Link v-if="slide.cta_text && slide.cta_link" :href="slide.cta_link" class="btn btn-gold">
                {{ t(slide.cta_text, slide.cta_text_en) }}
                <svg class="btn-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="16" height="16"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
              </Link>
            </div>
          </div>
        </div>
      </div>

      <!-- Slider Nav Dots -->
      <div class="slider-dots" v-if="slides.length > 1">
        <button v-for="(slide, index) in slides" :key="slide.id" class="slider-dot" :class="{ active: currentSlide === index }" @click="goToSlide(index)" :aria-label="`Slide ${index + 1}`"></button>
      </div>

      <!-- Slider Arrows -->
      <button class="slider-arrow prev" @click="prevSlide" aria-label="Previous slide" v-if="slides.length > 1">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="20" height="20"><polyline points="15 18 9 12 15 6"/></svg>
      </button>
      <button class="slider-arrow next" @click="nextSlide" aria-label="Next slide" v-if="slides.length > 1">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="20" height="20"><polyline points="9 18 15 12 9 6"/></svg>
      </button>
    </section>

    <!-- About / Who We Are Section -->
    <section class="section bg-white">
      <div class="container about-grid">
        <div class="about-content">
          <span class="label-caps" style="color: var(--color-primary); margin-bottom: 12px; display: block;">{{ t(ha.about_label, ha.about_label_en) || t('SIAPA KAMI', 'WHO WE ARE') }}</span>
          <h2 class="headline-lg">{{ t(ha.about_title, ha.about_title_en) || t('Mewujudkan Kemakmuran Melalui Kesehatan Tanah', 'Realizing Prosperity Through Soil Health') }}</h2>
          <div class="about-text-content font-body-md" style="margin-top: 24px; color: var(--color-on-surface-variant); display: flex; flex-direction: column; gap: 16px;">
            <p v-for="(pText, pIdx) in aboutParagraphs" :key="pIdx">{{ pText }}</p>
          </div>
          <div class="about-stats-row" style="margin-top: 40px; display: grid; grid-template-columns: 1fr 1fr; gap: 24px; border-top: 1px solid var(--color-border); padding-top: 32px;">
            <div>
              <span class="headline-md" style="display: block; color: var(--color-earth-black);">{{ ha.about_stat1_value || '10+' }}</span>
              <span class="label-caps" style="color: var(--color-secondary); font-size: 12px;">{{ t(ha.about_stat1_label, ha.about_stat1_label_en) || t('Tahun Inovasi', 'Years of Innovation') }}</span>
            </div>
            <div>
              <span class="headline-md" style="display: block; color: var(--color-earth-black);">{{ ha.about_stat2_value || '100%' }}</span>
              <span class="label-caps" style="color: var(--color-secondary); font-size: 12px;">{{ t(ha.about_stat2_label, ha.about_stat2_label_en) || t('Bahan Organik', 'Organic Matter') }}</span>
            </div>
          </div>
        </div>

        <div class="about-visual-box" style="position: relative;">
          <div class="about-image-card" style="border-radius: var(--rounded-lg); overflow: hidden; border: 1px solid var(--color-border); aspect-ratio: 1; background: var(--color-surface-container);">
            <img v-if="ha.about_image" :src="'/storage/' + ha.about_image" alt="Tentang Mandraguna" style="width: 100%; height: 100%; object-fit: cover;" />
            <div v-else style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 64px;">🌾</div>
          </div>
          <div class="about-quote-tag" style="position: absolute; bottom: -20px; left: -20px; background: var(--color-earth-black); color: white; padding: 24px; max-width: 300px; border-radius: var(--rounded-md); box-shadow: var(--shadow-elevated);">
            <p style="font-family: var(--font-body); font-style: italic; font-size: 14px; line-height: 20px; opacity: 0.9;">"{{ t(ha.about_quote, ha.about_quote_en) || t('Mandraguna untuk Indonesia, Mandraguna untuk Warisan Indonesia.', 'Mandraguna for Indonesia, Mandraguna for Indonesian Heritage.') }}"</p>
          </div>
        </div>
      </div>
    </section>

    <!-- YouTube Video Section -->
    <section v-if="youtubeEmbedUrl" class="section" style="background: var(--color-earth-black); padding: 60px 0;">
      <div class="container">
        <div style="text-align: center; margin-bottom: 36px;">
          <h2 class="headline-lg" style="color: white;">{{ t('Kenali Mandraguna Lebih Dekat', 'Get Closer to Mandraguna') }}</h2>
        </div>
        <div class="video-wrapper">
          <iframe
            :src="youtubeEmbedUrl"
            :title="t('Video Profil Mandraguna', 'Mandraguna Profile Video')"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerpolicy="strict-origin-when-cross-origin"
            allowfullscreen
          ></iframe>
        </div>
      </div>
    </section>

    <!-- Problem & Solution Bento Grid -->
    <section class="section" style="background: var(--color-surface-container-low);">
      <div class="container">
        <div style="text-align: center; margin-bottom: 60px;">
          <span class="label-caps" style="color: var(--color-primary); display: block; margin-bottom: 8px;">{{ t(ht.transform_label, ht.transform_label_en) || t('TRANSFORMASI', 'TRANSFORMATION') }}</span>
          <h2 class="headline-lg">{{ t(ht.transform_title, ht.transform_title_en) || t('Sains untuk Hasil Panen yang Lebih Baik', 'Science for Better Yields') }}</h2>
        </div>

        <div class="bento-grid">
          <!-- Problem Card -->
          <div class="bento-card bg-white" style="display: flex; flex-direction: column; min-height: 500px;">
            <div style="margin-bottom: 16px;">
              <h3 class="headline-md text-2xl" style="color: var(--color-on-surface); font-weight: 700; margin-bottom: 12px;">{{ t(ht.transform_card1_title, ht.transform_card1_title_en) || t('Tantangan Bahan Kimia', 'The Chemical Challenge') }}</h3>
              <p class="body-md" style="color: var(--color-secondary); line-height: 24px;">
                {{ t(ht.transform_card1_desc, ht.transform_card1_desc_en) || t('Pupuk kimia tradisional menyebabkan degradasi tanah, menurunkan kesuburan jangka panjang, dan memicu toksisitas lingkungan. Kami hadir memberikan solusi alternatif.', 'Traditional chemical fertilizers cause soil degradation, decrease long-term fertility, and trigger environmental toxicity. We are here to provide an alternative solution.') }}
              </p>
            </div>
            
            <div style="margin-top: auto; border-radius: var(--rounded-md); overflow: hidden; background: #eee; border: 1px solid var(--color-border);">
              <img v-if="ht.transform_card1_image" :src="'/storage/' + ht.transform_card1_image" alt="" style="width: 100%; display: block; object-fit: cover;" />
              <div v-else style="height: 180px; display: flex; align-items: center; justify-content: center; font-size: 48px; background: #eee; filter: grayscale(1);">🥀</div>
            </div>
          </div>

          <!-- Amino Power Card -->
          <div class="bento-card bg-black text-white" style="display: flex; flex-direction: column; min-height: 500px; background: var(--color-earth-black); border-color: var(--color-earth-black);">
            <div style="margin-bottom: 16px;">
              <h3 class="headline-md text-2xl" style="color: var(--color-primary-container); font-weight: 700; margin-bottom: 12px;">{{ t(ht.transform_card2_title, ht.transform_card2_title_en) || t('Kekuatan Asam Amino', 'Amino Power') }}</h3>
              <p class="body-md" style="color: rgba(255,255,255,0.8); line-height: 24px;">
                {{ t(ht.transform_card2_desc, ht.transform_card2_desc_en) || t('Kandungan organik tinggi yang kaya akan nutrisi esensial untuk penyerapan cepat oleh tanaman.', 'High organic content rich in essential nutrients for rapid absorption.') }}
              </p>
            </div>
            <div style="margin-top: auto; border-radius: var(--rounded-md); overflow: hidden; background: #222; border: 1px solid rgba(255,255,255,0.1);">
              <img v-if="ht.transform_card2_image" :src="'/storage/' + ht.transform_card2_image" alt="" style="width: 100%; display: block; object-fit: cover;" />
              <div v-else style="height: 180px; display: flex; align-items: center; justify-content: center; font-size: 48px; background: #222;">🧪</div>
            </div>
          </div>

          <!-- Pure Nature Card -->
          <div class="bento-card bg-white" style="display: flex; flex-direction: column; min-height: 500px;">
            <div style="margin-bottom: 16px;">
              <h3 class="headline-md text-2xl" style="color: var(--color-on-surface); font-weight: 700; margin-bottom: 12px;">{{ t(ht.transform_card3_title, ht.transform_card3_title_en) || t('Kemurnian Alam', 'Pure Nature') }}</h3>
              <p class="body-md" style="color: var(--color-secondary); line-height: 24px;">
                {{ t(ht.transform_card3_desc, ht.transform_card3_desc_en) || t('Bebas residu beracun. Aman untuk petani, aman untuk ekosistem, sangat penting untuk tanaman.', 'Zero toxic residues. Safe for farmers, safe for the ecosystem, vital for crops.') }}
              </p>
            </div>

            <div style="margin-top: auto; border-radius: var(--rounded-md); overflow: hidden; background: #eee; border: 1px solid var(--color-border);">
              <img v-if="ht.transform_card3_image" :src="'/storage/' + ht.transform_card3_image" alt="" style="width: 100%; display: block; object-fit: cover;" />
              <div v-else style="height: 180px; display: flex; align-items: center; justify-content: center; font-size: 48px; background: #eee; filter: grayscale(1);">🌱</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Product Preview Section -->
    <section class="section bg-white">
      <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 60px; flex-wrap: wrap; gap: 24px;">
          <div>
            <span class="label-caps" style="color: var(--color-primary); display: block; margin-bottom: 8px;">{{ t(hp.product_section_label, hp.product_section_label_en) || t('PILIHAN PRODUK KAMI', 'OUR PRODUCT SELECTION') }}</span>
            <h2 class="headline-lg">{{ t(hp.product_section_title, hp.product_section_title_en) || t('Keunggulan Mandraguna', 'The Mandraguna Advantage') }}</h2>
          </div>
          <Link href="/products" class="btn-link" style="font-family: var(--font-label); font-weight: 600; text-transform: uppercase; border-bottom: 2px solid var(--color-earth-black); padding-bottom: 4px;">{{ t('Lihat Katalog', 'View Catalog') }}</Link>
        </div>

        <div class="product-preview-grid">
          <div class="product-preview-image" style="height: 100%; display: flex; align-items: center; justify-content: center;">
            <div style="width: 100%; height: 100%; border-radius: var(--rounded-lg); overflow: hidden; display: flex; align-items: center; justify-content: center; padding: 24px;">
              <img v-if="hp.product_featured_image" :src="'/storage/' + hp.product_featured_image" alt="" style="max-width: 100%; max-height: 480px; object-fit: contain;" />
              <div v-else style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 64px;">🌱</div>
            </div>
          </div>

          <div class="product-preview-info">
            <h3 class="headline-md" style="margin-bottom: 16px;">{{ t(hp.product_featured_name, hp.product_featured_name_en) || 'Mandraguna Grow™' }}</h3>
            <p class="body-md" style="color: var(--color-secondary); line-height: 26px; margin-bottom: 32px;">
              {{ t(hp.product_featured_desc, hp.product_featured_desc_en) || t('Formula asam amino unggulan kami yang dirancang khusus untuk berbagai komoditas pertanian di Indonesia.', 'Our flagship amino acid formula specifically designed for various agricultural commodities in Indonesia.') }}
            </p>
            <div class="product-spec-table">
              <div class="spec-row">
                <span class="label-caps">{{ t(hp.product_spec1_label, hp.product_spec1_label_en) || t('Bahan Organik', 'Organic Matter') }}</span>
                <span class="spec-value">{{ t(hp.product_spec1_value, hp.product_spec1_value_en) || '85%+' }}</span>
              </div>
              <div class="spec-row">
                <span class="label-caps">{{ t(hp.product_spec2_label, hp.product_spec2_label_en) || t('Profil Asam Amino', 'Amino Acid Profile') }}</span>
                <span class="spec-value">{{ t(hp.product_spec2_value, hp.product_spec2_value_en) || t('Spektrum Penuh', 'Full Spectrum') }}</span>
              </div>
              <div class="spec-row">
                <span class="label-caps">{{ t(hp.product_spec3_label, hp.product_spec3_label_en) || t('Kelarutan dalam Air', 'Water Solubility') }}</span>
                <span class="spec-value">{{ t(hp.product_spec3_value, hp.product_spec3_value_en) || '100%' }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Technical Specifications -->
    <section class="section">
      <div class="container tech-grid">
        <div class="tech-info">
          <h2 class="headline-lg" style="color: var(--color-earth-black); margin-bottom: 20px;">{{ t(htch.tech_title, htch.tech_title_en) || t('Hasil Terbukti', 'Proven Results') }}</h2>
          <p class="body-md" style="color: var(--color-secondary); line-height: 26px; margin-bottom: 40px; max-width: 440px;">
            {{ t(htch.tech_desc, htch.tech_desc_en) || t('Analisis teknis kami menunjukkan kualitas dan dampak yang konsisten dari pupuk Mandraguna pada berbagai jenis tanah.', 'Our technical analysis shows consistent quality and impact of Mandraguna fertilizer on various soil types.') }}
          </p>
          <div class="tech-graphic-placeholder" style="border: 1px solid rgba(218,165,32,0.2); border-radius: var(--rounded-lg); aspect-ratio: 1.5; overflow: hidden; background: #111; display: flex; align-items: center; justify-content: center; font-size: 48px;">
            <img v-if="htch.tech_image" :src="'/storage/' + htch.tech_image" alt="" style="width: 100%; height: 100%; object-fit: cover;" />
            <span v-else>📈</span>
          </div>
        </div>

        <div class="tech-table-container bg-white text-black">
          <h4 class="label-caps" style="color: var(--color-primary); margin-bottom: 24px; padding: 0 8px;">{{ t('SPESIFIKASI TEKNIS', 'TECHNICAL SPECIFICATIONS') }}</h4>
          <div class="tech-table">
            <div class="tech-row header">
              <span>{{ t('PARAMETER', 'PARAMETER') }}</span>
              <span>{{ t('NILAI', 'VALUE') }}</span>
            </div>
            <div v-if="htch.tech_spec1_label" class="tech-row">
              <span>{{ t(htch.tech_spec1_label, htch.tech_spec1_label_en) }}</span>
              <span class="highlight">{{ t(htch.tech_spec1_val, htch.tech_spec1_val_en) }}</span>
            </div>
            <div v-if="htch.tech_spec2_label" class="tech-row">
              <span>{{ t(htch.tech_spec2_label, htch.tech_spec2_label_en) }}</span>
              <span class="highlight">{{ t(htch.tech_spec2_val, htch.tech_spec2_val_en) }}</span>
            </div>
            <div v-if="htch.tech_spec3_label" class="tech-row">
              <span>{{ t(htch.tech_spec3_label, htch.tech_spec3_label_en) }}</span>
              <span class="highlight">{{ t(htch.tech_spec3_val, htch.tech_spec3_val_en) }}</span>
            </div>
            <div v-if="htch.tech_spec4_label" class="tech-row">
              <span>{{ t(htch.tech_spec4_label, htch.tech_spec4_label_en) }}</span>
              <span class="highlight">{{ t(htch.tech_spec4_val, htch.tech_spec4_val_en) }}</span>
            </div>
            <div v-if="htch.tech_spec5_label" class="tech-row">
              <span>{{ t(htch.tech_spec5_label, htch.tech_spec5_label_en) }}</span>
              <span class="highlight">{{ t(htch.tech_spec5_val, htch.tech_spec5_val_en) }}</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Berita & Kegiatan -->
    <section class="section bg-white">
      <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 48px; flex-wrap: wrap; gap: 24px;">
          <div>
            <span class="label-caps" style="color: var(--color-primary); display: block; margin-bottom: 8px;">{{ t('KABAR TERKINI', 'LATEST NEWS') }}</span>
            <h2 class="headline-lg">{{ t('Berita & Kegiatan', 'News & Activities') }}</h2>
          </div>
          <Link href="/news" class="btn-link" style="font-family: var(--font-label); font-weight: 600; text-transform: uppercase; border-bottom: 2px solid var(--color-earth-black); padding-bottom: 4px;">{{ t('Lihat Semua Berita & Kegiatan', 'View All News & Activities') }}</Link>
        </div>

        <div class="home-news-activities-grid">
          <!-- Kolom 1: Berita Terbaru -->
          <div class="home-news-column">
            <h3 class="headline-md" style="font-size: 22px; margin-bottom: 24px; border-bottom: 2px solid var(--color-primary-container); padding-bottom: 12px; display: flex; justify-content: space-between; align-items: center; color: var(--color-earth-black);">
              <span>{{ t('Berita Terbaru', 'Latest News') }}</span>
              <span class="label-caps" style="font-size: 11px; color: var(--color-secondary); letter-spacing: 0.05em;">{{ t('Rilis Pers', 'Press Release') }}</span>
            </h3>
            
            <div class="home-cards-list">
              <template v-if="posts && posts.length > 0">
                <div v-for="post in posts" :key="post.id" class="home-news-card hover-lift">
                  <div class="card-img-box" :style="post.image_path ? { backgroundImage: `url(/storage/${post.image_path})` } : {}">
                    <span v-if="!post.image_path">🌾</span>
                  </div>
                  <div class="card-text-box">
                    <span class="label-caps" style="color: var(--color-secondary); font-size: 10px; display: block; margin-bottom: 6px;">
                      {{ formatDate(post.published_at || post.created_at) }}
                    </span>
                    <h4 class="card-title">
                      <Link :href="`/news/${post.slug}`">{{ t(post.title, post.title_en) }}</Link>
                    </h4>
                    <p class="card-excerpt">{{ t(post.excerpt, post.excerpt_en) }}</p>
                    <Link :href="`/news/${post.slug}`" class="read-link-sm">{{ t('Baca Selengkapnya →', 'Read More →') }}</Link>
                  </div>
                </div>
              </template>
              <template v-else>
                <div class="empty-state">{{ t('Belum ada berita terbaru.', 'No latest news available.') }}</div>
              </template>
            </div>
          </div>

          <!-- Kolom 2: Kegiatan Terbaru -->
          <div class="home-news-column">
            <h3 class="headline-md" style="font-size: 22px; margin-bottom: 24px; border-bottom: 2px solid var(--color-primary-container); padding-bottom: 12px; display: flex; justify-content: space-between; align-items: center; color: var(--color-earth-black);">
              <span>{{ t('Kegiatan Terbaru', 'Latest Activities') }}</span>
              <span class="label-caps" style="font-size: 11px; color: var(--color-secondary); letter-spacing: 0.05em;">{{ t('Kabar Lapangan', 'Field Stories') }}</span>
            </h3>
            
            <div class="home-cards-list">
              <template v-if="fieldStories && fieldStories.length > 0">
                <div v-for="story in fieldStories" :key="story.id" class="home-news-card hover-lift">
                  <div class="card-img-box" :style="story.image_path ? { backgroundImage: `url(/storage/${story.image_path})` } : {}">
                    <span v-if="!story.image_path">🏡</span>
                  </div>
                  <div class="card-text-box">
                    <span class="label-caps" style="color: var(--color-secondary); font-size: 10px; display: block; margin-bottom: 6px;">
                      {{ formatDate(story.published_at || story.created_at) }}
                    </span>
                    <h4 class="card-title">
                      <Link :href="`/field-stories/${story.slug}`">{{ t(story.title, story.title_en) }}</Link>
                    </h4>
                    <p class="card-excerpt">{{ t(story.excerpt || story.content, story.excerpt_en || story.content_en) }}</p>
                    <Link :href="`/field-stories/${story.slug}`" class="read-link-sm">{{ t('Baca Selengkapnya →', 'Read More →') }}</Link>
                  </div>
                </div>
              </template>
              <template v-else>
                <div class="empty-state">{{ t('Belum ada kegiatan terbaru.', 'No latest activities available.') }}</div>
              </template>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="section text-center" style="background: var(--color-primary-container); padding: 96px 0;">
      <div class="container">
        <h2 class="headline-lg" style="color: var(--color-earth-black); margin-bottom: 24px;">{{ t(hc.cta_title, hc.cta_title_en) || t('Siap Merevitalisasi Tanah Anda?', 'Ready to Revitalize Your Soil?') }}</h2>
        <p class="body-lg" style="color: rgba(26,26,26,0.8); max-width: 640px; margin: 0 auto 40px; line-height: 28px;">
          {{ t(hc.cta_desc, hc.cta_desc_en) || t('Mari bergabung dalam gerakan menuju pertanian Indonesia yang lebih bersih dan produktif.', 'Let’s join the movement towards a cleaner and more productive Indonesian agriculture.') }}
        </p>
        <Link :href="hc.cta_button_link || '/contact'" class="btn btn-primary" style="padding: 16px 36px; font-size: 15px;">{{ t(hc.cta_button_text, hc.cta_button_text_en) || t('Hubungi Ahli Kami', 'Contact Our Expert') }}</Link>
      </div>
    </section>
  </PublicLayout>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import PublicLayout from '@/Layouts/PublicLayout.vue';
import { useLanguage } from '@/composables/useLanguage';

const props = defineProps({
    settings: Object,
    products: Array,
    posts: Array,
    fieldStories: Array,
    sustainability: Object,
    contact: Object,
    slides: Array,
    homepage_about: { type: Object, default: () => ({}) },
    homepage_transform: { type: Object, default: () => ({}) },
    homepage_product: { type: Object, default: () => ({}) },
    homepage_cta: { type: Object, default: () => ({}) },
    homepage_tech: { type: Object, default: () => ({}) },
});

const { t, locale } = useLanguage();

// Shorthand aliases for cleaner template
const ha = computed(() => props.homepage_about || {});
const ht = computed(() => props.homepage_transform || {});
const hp = computed(() => props.homepage_product || {});
const hc = computed(() => props.homepage_cta || {});
const htch = computed(() => props.homepage_tech || {});

function formatDate(dateString) {
  if (!dateString) return '';
  const date = new Date(dateString);
  return date.toLocaleDateString(locale.value === 'en' ? 'en-US' : 'id-ID', {
    day: 'numeric',
    month: 'long',
    year: 'numeric'
  });
}

// About paragraphs split
const aboutParagraphs = computed(() => {
    const defaultID = "PT. Mandraguna Pusaka Indonesia hadir di tengah kekhawatiran masyarakat terhadap pencemaran lingkungan yang telah berlangsung selama beberapa dekade.\n\nKami melihat inovasi dan visi besar dalam pemanfaatan sisa penyamakan kulit sapi—sumber daya yang kaya akan kandungan biologis organik dan nutrisi tinggi.\n\nKami memproses limbah penyamakan kulit ini secara cermat menjadi pupuk asam amino unggulan, dengan keyakinan bahwa segala sesuatu yang diawali dengan niat baik akan menghasilkan yang terbaik untuk warisan Indonesia.";
    const defaultEN = "PT. Mandraguna Pusaka Indonesia stands amidst public concern over environmental pollution that has persisted for decades.\n\nWe see innovation and a grand vision in utilizing beef tannery waste—a resource rich in organic biological elements and high nutritional value.\n\nWe meticulously process this tannery waste into premium amino acid fertilizer, believing that everything started with good intentions will yield the best for the heritage of Indonesia.";
    const defaultJA = "PT. Mandraguna Pusaka Indonesiaは、何十年も続いている環境汚染に対する社会的な懸念から生まれました。\n\n私たちは、有機的生物成分と高栄養に富んだ牛革鞣し工場の廃棄物を有効活用するイノベーション & 壮大なビジョンを持っています。\n\n良い意図から始まったすべてのことが、インドネシアの遺産にとって最高の結果をもたらすと信じ、この革なめし廃棄物をアミノ酸豊富な高品質の有機肥料へと丁寧に加工しています。";
    const content = t(ha.value.about_content, ha.value.about_content_en) || t(defaultID, defaultEN);
    return content.split('\n\n').filter(p => p.trim());
});

// YouTube embed URL from settings
const youtubeEmbedUrl = computed(() => {
    const url = ha.value.about_video_url;
    if (!url) return null;
    let videoId = null;
    // Match youtube.com/watch?v=ID
    const watchMatch = url.match(/[?&]v=([a-zA-Z0-9_-]{11})/);
    if (watchMatch) { videoId = watchMatch[1]; }
    // Match youtu.be/ID
    if (!videoId) {
        const shortMatch = url.match(/youtu\.be\/([a-zA-Z0-9_-]{11})/);
        if (shortMatch) { videoId = shortMatch[1]; }
    }
    // Match youtube.com/embed/ID
    if (!videoId) {
        const embedMatch = url.match(/youtube\.com\/embed\/([a-zA-Z0-9_-]{11})/);
        if (embedMatch) { videoId = embedMatch[1]; }
    }
    return videoId ? `https://www.youtube.com/embed/${videoId}` : null;
});

// Slider States
const currentSlide = ref(0);
let slideInterval = null;

function startInterval() {
    stopInterval();
    if (props.slides && props.slides.length > 1) {
        slideInterval = setInterval(() => {
            currentSlide.value = (currentSlide.value + 1) % props.slides.length;
        }, 7000);
    }
}

function stopInterval() {
    if (slideInterval) {
        clearInterval(slideInterval);
    }
}

function goToSlide(index) {
    currentSlide.value = index;
    startInterval();
}

// Fixed arrow handlers
function nextSlide() {
    if (props.slides && props.slides.length > 0) {
        currentSlide.value = (currentSlide.value + 1) % props.slides.length;
        startInterval();
    }
}

function prevSlide() {
    if (props.slides && props.slides.length > 0) {
        currentSlide.value = (currentSlide.value - 1 + props.slides.length) % props.slides.length;
        startInterval();
    }
}

onMounted(() => {
    startInterval();
});

onUnmounted(() => {
    stopInterval();
});
</script>

<style scoped>
/* Hero Slider */
.hero-slider {
    position: relative;
    height: 100vh;
    height: 100dvh;
    background: var(--color-earth-black);
    overflow: hidden;
}

.slide-item {
    position: absolute;
    inset: 0;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.8s ease-in-out, visibility 0.8s ease-in-out;
    display: flex;
    align-items: center;
    z-index: 1;
}

.slide-item.active {
    opacity: 1;
    visibility: visible;
    z-index: 2;
}

.slide-bg {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-image: linear-gradient(135deg, var(--color-earth-black) 0%, #2a2000 60%, #3d2e00 100%);
    transition: transform 7s ease;
    z-index: 0;
}

.slide-item.active .slide-bg {
    transform: scale(1.04);
}

.slide-bg::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to right, rgba(0, 0, 0, 0.85) 0%, rgba(0, 0, 0, 0.6) 50%, rgba(0, 0, 0, 0.3) 100%);
}

.hero-container {
    position: relative;
    z-index: 5;
    color: white;
}

.hero-content {
    max-width: 800px;
    padding-top: 80px;
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 6px 16px;
    background: rgba(218, 165, 32, 0.1);
    border: 1px solid rgba(218, 165, 32, 0.25);
    border-radius: var(--rounded-full);
    color: var(--color-primary-fixed-dim);
    font-family: var(--font-label);
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 24px;
    letter-spacing: 0.05em;
    text-transform: uppercase;
}

.badge-dot {
    width: 8px;
    height: 8px;
    background-color: var(--color-primary-container);
    border-radius: 50%;
    display: inline-block;
    box-shadow: 0 0 8px var(--color-primary-container);
}

.hero-subtitle {
    font-family: var(--font-body);
    font-size: 18px;
    line-height: 28px;
    color: rgba(255, 255, 255, 0.8);
    margin-top: 20px;
    max-width: 620px;
}

.hero-actions {
    margin-top: 36px;
    display: flex;
    gap: 16px;
    align-items: center;
    flex-wrap: wrap;
}

.btn-arrow {
    transition: transform var(--transition-fast);
}

.btn:hover .btn-arrow {
    transform: translateX(4px);
}

.slider-dots {
    position: absolute;
    bottom: 40px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 10;
    display: flex;
    gap: 10px;
}

.slider-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.4);
    border: none;
    transition: all var(--transition-fast);
    cursor: pointer;
}

.slider-dot.active {
    background: var(--color-primary-container);
    width: 24px;
    border-radius: var(--rounded-full);
}

.slider-arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 10;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.15);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all var(--transition-fast);
    cursor: pointer;
}

.slider-arrow:hover {
    background: var(--color-primary-container);
    color: var(--color-earth-black);
    border-color: var(--color-primary-container);
}

.slider-arrow.prev { left: 32px; }
.slider-arrow.next { right: 32px; }

/* Sections */
.section {
    padding: var(--space-section) 0;
}

/* About Grid */
.about-grid {
    display: grid;
    grid-template-columns: 1.2fr 1fr;
    gap: 64px;
    align-items: center;
}

/* Video Embed */
.video-wrapper {
    position: relative;
    width: 100%;
    max-width: 960px;
    margin: 0 auto;
    aspect-ratio: 16 / 9;
    border-radius: var(--rounded-lg);
    overflow: hidden;
    border: 2px solid rgba(218, 165, 32, 0.25);
    box-shadow: 0 0 60px rgba(218, 165, 32, 0.08), var(--shadow-elevated);
}

.video-wrapper iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: none;
}

/* Bento Grid */
.bento-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 32px;
}

.bento-card {
    background: white;
    border: 1px solid var(--color-border);
    border-radius: var(--rounded-lg);
    padding: 32px;
    transition: box-shadow var(--transition-base), transform var(--transition-base);
}

.bento-card:hover {
    box-shadow: var(--shadow-soft);
    transform: translateY(-4px);
}

.bento-card.col-2 {
    grid-column: span 2;
}

.bento-card.bg-black {
    background: var(--color-earth-black);
    color: white;
    border-color: var(--color-earth-black);
}

/* Product Preview */
.product-preview-grid {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 48px;
    align-items: stretch;
}

.product-spec-table {
    border-left: 4px solid var(--color-primary-container);
    background: var(--color-surface-container-low);
    padding: 32px;
}

.spec-row {
    display: flex;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: 1px solid var(--color-border);
}

.spec-row:last-child {
    border-bottom: none;
}

.spec-value {
    font-weight: 700;
}

/* Tech Specs */
.tech-grid {
    display: grid;
    grid-template-columns: 1fr 1.2fr;
    gap: 64px;
    align-items: center;
}

.tech-table {
    border: 1px solid var(--color-border);
}

.tech-row {
    display: flex;
    justify-content: space-between;
    padding: 16px 20px;
    border-bottom: 1px solid var(--color-border);
}

.tech-row:nth-child(even) {
    background-color: var(--color-background);
}

.tech-row:last-child {
    border-bottom: none;
}

.tech-row.header {
    background: var(--color-earth-black);
    color: white;
    font-family: var(--font-label);
    font-size: 13px;
    font-weight: 600;
}

.tech-row .highlight {
    font-weight: 700;
    color: var(--color-primary);
}

/* Home News & Activities */
.home-news-activities-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 48px;
}

.home-cards-list {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.home-news-card {
    display: flex;
    gap: 20px;
    align-items: flex-start;
    padding: 16px;
    border-radius: var(--rounded-md);
    background: var(--color-surface-container-lowest);
    border: 1px solid var(--color-border);
    transition: transform var(--transition-base), box-shadow var(--transition-base);
}

.home-news-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-soft);
}

.card-img-box {
    width: 130px;
    height: 100px;
    border-radius: var(--rounded-sm);
    overflow: hidden;
    flex-shrink: 0;
    background-size: cover;
    background-position: center;
    background-color: var(--color-surface-container);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
}

.card-text-box {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.card-title {
    font-family: var(--font-headline);
    font-size: 16px;
    font-weight: 700;
    line-height: 22px;
    margin: 4px 0 8px;
}

.card-title a {
    color: var(--color-earth-black);
    text-decoration: none;
    transition: color var(--transition-fast);
}

.card-title a:hover {
    color: var(--color-primary);
}

.card-excerpt {
    color: var(--color-secondary);
    font-size: 13.5px;
    line-height: 18px;
    margin-bottom: 10px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.read-link-sm {
    color: var(--color-primary);
    font-family: var(--font-label);
    font-weight: 600;
    font-size: 12px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    text-decoration: none;
    transition: gap var(--transition-fast);
}

.read-link-sm:hover {
    gap: 8px;
}

.empty-state {
    padding: 32px;
    text-align: center;
    background: var(--color-surface-container-low);
    border-radius: var(--rounded-md);
    color: var(--color-secondary);
    border: 1px dashed var(--color-border);
}

@media (max-width: 1024px) {
    .about-grid, .product-preview-grid, .tech-grid {
        grid-template-columns: 1fr;
    }
    .home-news-activities-grid {
        grid-template-columns: 1fr;
        gap: 36px;
    }
    .bento-grid {
        grid-template-columns: 1fr;
    }
    .bento-card.col-2 {
        grid-column: span 1;
    }
}

@media (max-width: 768px) {
    .slider-arrow { display: none; }
    .slide-bg { transform: none !important; }
    .hero-content { padding-top: 80px; }
    .section { padding: 60px 0; }
}
</style>
