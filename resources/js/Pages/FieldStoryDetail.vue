<template>
  <Head :title="t(fieldStory.title, fieldStory.title_en, fieldStory.title_ja)" />
  <PublicLayout>
    <section class="page-hero" :style="fieldStory.image_path ? { backgroundImage: `url(/storage/${fieldStory.image_path})` } : {}">
      <div class="container">
        <span class="label-caps" style="color: var(--color-primary-container);">{{ t('Kabar dari Lapangan', 'Field Stories', '現場からの報告') }}</span>
        <span class="label-caps" style="color: rgba(255,255,255,0.5); margin-left: 8px;">•</span>
        <span class="label-caps" style="color: rgba(255,255,255,0.6); margin-left: 8px;">{{ formatDate(fieldStory.published_at || fieldStory.created_at) }}</span>
        <h1 class="headline-lg" style="color: white; margin-top: 8px;">{{ t(fieldStory.title, fieldStory.title_en, fieldStory.title_ja) }}</h1>
      </div>
    </section>

    <section class="section">
      <div class="container article-container">
        <div class="article-content" v-html="t(fieldStory.content, fieldStory.content_en, fieldStory.content_ja)"></div>
      <div style="margin-top: 48px; padding-top: 24px; border-top: 1px solid var(--color-border);">
        <span style="font-size: 13px; color: var(--color-on-surface-variant);">{{ fieldStory.views }} {{ t('kali dibaca', 'views', '回閲覧') }}</span>
      </div>
    </div></section>

    <section v-if="relatedStories.length > 0" class="section" style="background: var(--color-surface-container-low);">
      <div class="container"><h2 class="headline-md text-center" style="margin-bottom: 36px;">{{ t('Kabar Lainnya', 'Other Stories', '他の報告') }}</h2>
        <div class="related-grid">
          <Link v-for="rs in relatedStories" :key="rs.id" :href="'/field-stories/' + rs.slug" class="card" style="padding: 20px;">
            <span style="font-size: 12px; color: var(--color-on-surface-variant);">{{ formatDate(rs.published_at || rs.created_at) }}</span>
            <h3 style="font-family: var(--font-headline); font-weight: 600; margin-top: 4px;">{{ t(rs.title, rs.title_en, rs.title_ja) }}</h3>
          </Link>
        </div>
      </div>
    </section>
  </PublicLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';
import { useLanguage } from '@/composables/useLanguage';

defineProps({ fieldStory: Object, relatedStories: Array });

const { t, locale } = useLanguage();

function formatDate(d) {
  if (!d) return '';
  return new Date(d).toLocaleDateString(locale.value === 'en' ? 'en-US' : 'id-ID', {
    day: 'numeric',
    month: 'long',
    year: 'numeric'
  });
}
</script>

<style scoped>
.page-hero {
    position: relative;
    padding: 200px 0 120px;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-color: var(--color-earth-black);
}
.page-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(180deg, rgba(0,0,0,0.5) 0%, rgba(0,0,0,0.85) 100%);
    z-index: 1;
}
.page-hero .container {
    position: relative;
    z-index: 2;
}
.section { padding: 80px 0; }
.article-container { margin: 0 auto; }
.article-content { font-size: 17px; line-height: 1.8; color: var(--color-on-surface); }
.article-content :deep(p) {
  margin-bottom: 1.5rem;
}
.article-content :deep(h1),
.article-content :deep(h2),
.article-content :deep(h3),
.article-content :deep(h4) {
  font-family: var(--font-headline);
  font-weight: 700;
  color: var(--color-earth-black);
  margin-top: 2rem;
  margin-bottom: 1rem;
}
.article-content :deep(h2) { font-size: 24px; }
.article-content :deep(h3) { font-size: 20px; }
.article-content :deep(ul),
.article-content :deep(ol) {
  margin-bottom: 1.5rem;
  padding-left: 1.5rem;
}
.article-content :deep(li) {
  margin-bottom: 0.5rem;
}
.article-content :deep(img) {
  max-width: 100%;
  height: auto;
  border-radius: var(--rounded);
  margin: 1.5rem 0;
}
.article-content :deep(iframe) {
  width: 100%;
  aspect-ratio: 16/9;
  border-radius: var(--rounded);
  margin: 1.5rem 0;
}
.article-content :deep(a) {
  color: var(--color-primary);
  text-decoration: underline;
}
.article-content :deep(strong) {
  font-weight: 700;
}
.article-content :deep(em) {
  font-style: italic;
}
.related-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
@media (max-width: 768px) { .related-grid { grid-template-columns: 1fr; } }
</style>
