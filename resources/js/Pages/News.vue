<template>
  <Head :title="t('Berita & Media', 'News & Media', 'ニュース＆メディア')" />
  <PublicLayout>
    <!-- Hero Section -->
    <section class="page-hero">
      <div class="container text-center" style="max-width: 800px;">
        <span class="label-caps" style="color: var(--color-primary-fixed-dim); tracking-widest: 0.15em; display: block; margin-bottom: 12px;">{{ t('PERS & PEMBARUAN', 'PRESS & UPDATES', 'プレス＆アップデート') }}</span>
        <h1 class="headline-xl" style="color: white; margin-top: 8px;">{{ t('Berita & Media', 'News & Media', 'ニュース＆メディア') }}</h1>
        <p class="body-lg" style="color: rgba(255,255,255,0.8); margin-top: 20px; line-height: 28px;">
          {{ t('Berbagi cerita tentang perjalanan kami dalam pertanian berkelanjutan. Temukan pembaruan terkini, rilis pers, dan kisah dari lapangan saat kami mendampingi komunitas petani merevitalisasi lahan mereka secara organik.', 'Sharing stories of our journey in sustainable agriculture. Discover the latest updates, press releases, and stories from the field as we support farming communities in revitalizing their lands organically.', '持続可能な農業における私たちの歩みのストーリーを共有します。農家コミュニティが有機的に土地を活性化するのをサポートする中で、最新のアップデート、プレスリリース、および現場からのストーリーをご覧ください。') }}
        </p>
      </div>
    </section>

    <!-- Press Releases Section (2 Balanced Cards with Pagination) -->
    <section id="press-releases-section" class="section bg-white">
      <div class="container">
        <div style="margin-bottom: 40px; border-bottom: 1px solid var(--color-border); padding-bottom: 16px;">
          <h2 class="headline-md">{{ t('Rilis Pers Terbaru', 'Latest Press Releases', '最新のプレスリリース') }}</h2>
        </div>

        <div class="press-grid">
          <template v-if="paginatedPosts && paginatedPosts.length > 0">
            <div v-for="post in paginatedPosts" :key="post.id" class="press-card card hover-lift">
              <!-- Card Image -->
              <div class="press-card-image"
                   :style="post.image_path
                     ? { backgroundImage: `url(/storage/${post.image_path})`, backgroundSize: 'cover', backgroundPosition: 'center' }
                     : { background: 'var(--color-surface-container)', display: 'flex', alignItems: 'center', justifyContent: 'center', fontSize: '48px' }">
                <span v-if="!post.image_path">🌾</span>
              </div>

              <!-- Card Content -->
              <div class="press-card-content">
                <span class="label-caps" style="color: var(--color-secondary); margin-bottom: 8px; font-size: 11px;">
                  {{ formatDate(post.published_at || post.created_at) }}
                </span>
                <h3 class="press-card-title">{{ t(post.title, post.title_en, post.title_ja) }}</h3>
                <p class="body-md press-card-excerpt">{{ t(post.excerpt, post.excerpt_en, post.excerpt_ja) }}</p>
                <Link :href="`/news/${post.slug}`" class="read-link">
                  {{ t('Baca Selengkapnya', 'Read More', '続きを読む') }} <span>→</span>
                </Link>
              </div>
            </div>
          </template>

          <template v-else>
            <div class="press-card card hover-lift">
              <div class="press-card-image" style="background: var(--color-surface-container); display: flex; align-items: center; justify-content: center; font-size: 48px;">🌱</div>
              <div class="press-card-content">
                <span class="label-caps" style="color: var(--color-secondary); margin-bottom: 8px; font-size: 11px;">12 Oktober 2024</span>
                <h3 class="press-card-title">{{ t('Mandraguna Grow: Merevolusi Kesehatan Tanah dengan Asam Amino', 'Mandraguna Grow: Revolutionizing Soil Health with Amino Acids', 'マンドラグナ・グロウ：アミノ酸で土壌の健康に革命を起こす') }}</h3>
                <p class="body-md press-card-excerpt">{{ t('Formulasi terbaru kami mengintegrasikan profil asam amino canggih yang berasal dari limbah organik.', 'Our latest formulation integrates advanced amino acid profiles derived from organic waste.', '当社の最新の処方は、有機廃棄物由来の高度なアミノ酸プロファイルを統合しています。') }}</p>
                <Link href="/news" class="read-link">{{ t('Baca Selengkapnya', 'Read More', '続きを読む') }} <span>→</span></Link>
              </div>
            </div>
          </template>
        </div>

        <!-- Pagination for Press Releases -->
        <div v-if="postsTotalPages > 1" class="pagination-container">
          <button 
            @click="prevPostsPage" 
            :disabled="postsCurrentPage === 1" 
            class="pagination-btn arrow-btn"
            aria-label="Previous Page"
          >
            <span>←</span>
          </button>
          
          <button 
            v-for="page in postsTotalPages" 
            :key="page" 
            @click="goToPostsPage(page)" 
            class="pagination-btn number-btn"
            :class="{ active: postsCurrentPage === page }"
          >
            {{ page }}
          </button>
          
          <button 
            @click="nextPostsPage" 
            :disabled="postsCurrentPage === postsTotalPages" 
            class="pagination-btn arrow-btn"
            aria-label="Next Page"
          >
            <span>→</span>
          </button>
        </div>
      </div>
    </section>

    <!-- In the Field (Kabar dari Lapangan) Section -->
    <section id="field-stories-section" class="section" style="background: var(--color-surface-container-low);">
      <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 48px; border-bottom: 1px solid var(--color-border); padding-bottom: 16px; flex-wrap: wrap; gap: 16px;">
          <div>
            <h2 class="headline-md">{{ t('Kabar dari Lapangan', 'Field Stories', '現場からの報告') }}</h2>
            <p class="body-md" style="color: var(--color-secondary); margin-top: 6px;">{{ t('Pertumbuhan kolaboratif bersama mitra tani kami.', 'Collaborative growth alongside our farming partners.', '農業パートナーと共に行う協調的な成長。') }}</p>
          </div>
        </div>

        <div class="field-grid">
          <template v-if="paginatedStories && paginatedStories.length > 0">
            <div v-for="story in paginatedStories" :key="story.id" class="field-card card bg-white hover-lift">
              <div class="field-image"
                   :style="story.image_path
                     ? { backgroundImage: `url(/storage/${story.image_path})`, backgroundSize: 'cover', backgroundPosition: 'center' }
                     : { background: 'var(--color-surface-container)', display: 'flex', alignItems: 'center', justifyContent: 'center', fontSize: '48px' }">
                <span v-if="!story.image_path">🏡</span>
              </div>
              <div class="field-card-body">
                <span class="label-caps" style="color: var(--color-secondary); font-size: 11px;">
                  {{ formatDate(story.published_at || story.created_at) }}
                </span>
                <h3 class="headline-md" style="font-size: 20px; margin-top: 8px; margin-bottom: 8px;">{{ t(story.title, story.title_en, story.title_ja) }}</h3>
                <p class="body-md" style="color: var(--color-secondary); line-height: 24px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                  {{ t(story.excerpt || story.content, story.excerpt_en || story.content_en, story.excerpt_ja || story.content_ja) }}
                </p>
                <Link :href="`/field-stories/${story.slug}`" class="read-link" style="margin-top: 16px;">
                  {{ t('Baca Selengkapnya', 'Read More', '続きを読む') }} <span>→</span>
                </Link>
              </div>
            </div>
          </template>

          <template v-else>
            <!-- Fallback static stories -->
            <div class="field-card card bg-white">
              <div class="field-image" style="background: var(--color-surface-container); display: flex; align-items: center; justify-content: center; font-size: 48px;">🏡</div>
              <div class="field-card-body">
                <h3 class="headline-md" style="font-size: 20px; margin-top: 8px; margin-bottom: 8px;">{{ t('Inovasi Rumah Kaca di Subang', 'Greenhouse Innovation in Subang', 'スバンにおける温室イノベーション') }}</h3>
                <p class="body-md" style="color: var(--color-secondary); line-height: 24px;">
                  {{ t('Bekerja sama erat dengan para pemimpin pertanian setempat untuk menerapkan protokol pemberian nutrisi organik di lingkungan terkendali.', 'Working closely with local agricultural leaders to implement organic nutrient protocols in controlled environments.', '管理された環境下で有機栄養供給プロトコルを適用するため、現地の農業指導者と密接に連携しています。') }}
                </p>
              </div>
            </div>
            <div class="field-card card bg-white">
              <div class="field-image" style="background: var(--color-surface-container); display: flex; align-items: center; justify-content: center; font-size: 48px;">🚜</div>
              <div class="field-card-body">
                <h3 class="headline-md" style="font-size: 20px; margin-top: 8px; margin-bottom: 8px;">{{ t('Pamanenan Mekanis & Sinergi Organik', 'Mechanical Harvesting & Organic Synergy', '機械的収穫と有機的相乗効果') }}</h3>
                <p class="body-md" style="color: var(--color-secondary); line-height: 24px;">
                  {{ t('Mengintegrasikan operasi mekanis skala besar dengan aplikasi pupuk organik yang presisi.', 'Integrating large-scale mechanical operations with precise organic fertilizer application.', '大規模な機械化事業と精密な有機肥料 of 散布を統合。') }}
                </p>
              </div>
            </div>
          </template>
        </div>

        <!-- Pagination for Field Stories -->
        <div v-if="storiesTotalPages > 1" class="pagination-container">
          <button 
            @click="prevStoriesPage" 
            :disabled="storiesCurrentPage === 1" 
            class="pagination-btn arrow-btn"
            aria-label="Previous Page"
          >
            <span>←</span>
          </button>
          
          <button 
            v-for="page in storiesTotalPages" 
            :key="page" 
            @click="goToStoriesPage(page)" 
            class="pagination-btn number-btn"
            :class="{ active: storiesCurrentPage === page }"
          >
            {{ page }}
          </button>
          
          <button 
            @click="nextStoriesPage" 
            :disabled="storiesCurrentPage === storiesTotalPages" 
            class="pagination-btn arrow-btn"
            aria-label="Next Page"
          >
            <span>→</span>
          </button>
        </div>
      </div>
    </section>
  </PublicLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';
import { useLanguage } from '@/composables/useLanguage';

const props = defineProps({
  posts: {
    type: Array,
    default: () => []
  },
  fieldStories: {
    type: Array,
    default: () => []
  }
});

const { t, locale } = useLanguage();

// Posts Pagination Logic
const postsPerPage = 2;
const postsCurrentPage = ref(1);

const postsTotalPages = computed(() => Math.ceil((props.posts?.length || 0) / postsPerPage));

const paginatedPosts = computed(() => {
  const start = (postsCurrentPage.value - 1) * postsPerPage;
  return props.posts?.slice(start, start + postsPerPage) || [];
});

function prevPostsPage() {
  if (postsCurrentPage.value > 1) {
    postsCurrentPage.value--;
    scrollToSection('press-releases-section');
  }
}

function nextPostsPage() {
  if (postsCurrentPage.value < postsTotalPages.value) {
    postsCurrentPage.value++;
    scrollToSection('press-releases-section');
  }
}

function goToPostsPage(page) {
  postsCurrentPage.value = page;
  scrollToSection('press-releases-section');
}

// Field Stories Pagination Logic
const storiesPerPage = 2;
const storiesCurrentPage = ref(1);

const storiesTotalPages = computed(() => Math.ceil((props.fieldStories?.length || 0) / storiesPerPage));

const paginatedStories = computed(() => {
  const start = (storiesCurrentPage.value - 1) * storiesPerPage;
  return props.fieldStories?.slice(start, start + storiesPerPage) || [];
});

function prevStoriesPage() {
  if (storiesCurrentPage.value > 1) {
    storiesCurrentPage.value--;
    scrollToSection('field-stories-section');
  }
}

function nextStoriesPage() {
  if (storiesCurrentPage.value < storiesTotalPages.value) {
    storiesCurrentPage.value++;
    scrollToSection('field-stories-section');
  }
}

function goToStoriesPage(page) {
  storiesCurrentPage.value = page;
  scrollToSection('field-stories-section');
}

function scrollToSection(id) {
  const element = document.getElementById(id);
  if (element) {
    element.scrollIntoView({ behavior: 'smooth' });
  }
}

function formatDate(dateString) {
  if (!dateString) return '';
  const date = new Date(dateString);
  return date.toLocaleDateString(locale.value === 'en' ? 'en-US' : 'id-ID', {
    day: 'numeric',
    month: 'long',
    year: 'numeric'
  });
}
</script>

<style scoped>
.page-hero {
    padding: 160px 0 80px;
    background: linear-gradient(135deg, var(--color-earth-black) 0%, #2a2000 100%);
}

.section {
    padding: var(--space-section) 0;
}

/* Press Releases - 2 columns, horizontal layout */
.press-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 32px;
}

.press-card {
    padding: 0;
    overflow: hidden;
    display: grid;
    grid-template-columns: 1fr 1.3fr;
    border-radius: var(--rounded-lg);
    background: white;
    border: 1px solid var(--color-border);
    transition: transform var(--transition-base), box-shadow var(--transition-base), border-color var(--transition-base);
}

.press-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
    border-color: var(--color-primary-container);
}

.press-card-image {
    height: 100%;
    min-height: 260px;
    width: 100%;
}

.press-card-content {
    padding: 28px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.press-card-title {
    font-family: var(--font-headline);
    font-size: 18px;
    font-weight: 700;
    line-height: 26px;
    margin-top: 6px;
    margin-bottom: 12px;
    color: var(--color-earth-black);
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    transition: color var(--transition-fast);
}

.press-card:hover .press-card-title {
    color: var(--color-primary);
}

.press-card-excerpt {
    color: var(--color-secondary);
    line-height: 22px;
    font-size: 14px;
    margin-bottom: 24px;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.read-link {
    color: var(--color-primary);
    font-family: var(--font-label);
    font-weight: 600;
    font-size: 13px;
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: auto;
    transition: gap var(--transition-fast);
}

.read-link:hover {
    gap: 12px;
}

.hover-lift {
    transition: transform var(--transition-base), box-shadow var(--transition-base);
}

.hover-lift:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-soft);
}

/* Field Stories Grid */
.field-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 32px;
}

.field-card {
    overflow: hidden;
    border-radius: var(--rounded-lg);
}

.field-image {
    height: 240px;
    border-radius: var(--rounded);
    width: 100%;
}

.field-card-body {
    padding: 24px;
}

@media (max-width: 992px) {
    .press-card {
        grid-template-columns: 1fr;
    }
    .press-card-image {
        height: 200px;
        min-height: auto;
    }
    .press-card-content {
        padding: 24px;
    }
}

@media (max-width: 768px) {
    .press-grid {
        grid-template-columns: 1fr;
        gap: 24px;
    }
    .field-grid {
        grid-template-columns: 1fr;
    }
}

/* Pagination Styles */
.pagination-container {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
    margin-top: 48px;
}

.pagination-btn {
    background: transparent;
    border: 1px solid var(--color-border);
    color: var(--color-secondary);
    min-width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: var(--font-label);
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all var(--transition-fast);
}

.pagination-btn:hover:not(:disabled) {
    border-color: var(--color-primary);
    color: var(--color-primary);
    background: rgba(212, 175, 55, 0.05);
}

.pagination-btn.active {
    background: var(--color-primary-container);
    border-color: var(--color-primary-container);
    color: var(--color-earth-black);
}

.pagination-btn:disabled {
    opacity: 0.4;
    cursor: not-allowed;
    border-color: var(--color-border);
}

.pagination-btn.arrow-btn {
    font-size: 16px;
}
</style>
