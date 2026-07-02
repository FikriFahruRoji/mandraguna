<template>
  <Head title="Pengaturan" />
  <AdminLayout>
    <div>
      <h1 class="headline-md" style="margin-bottom: 32px;">Pengaturan Website — {{ activeGroupLabel }}</h1>

      <form @submit.prevent="submit" enctype="multipart/form-data">
        <!-- 1. Umum (General Settings) -->
        <div v-if="settings.general && activeGroup === 'general'" class="settings-group card" style="margin-bottom: 24px;">
          <h2 class="label-caps" style="margin-bottom: 20px; color: var(--color-primary);">{{ groupLabels.general || 'Umum' }}</h2>

          <div class="settings-fields">
            <div v-for="item in settings.general" :key="item.key" class="form-group">
              <label class="form-label" :for="item.key">{{ item.label || item.key }}</label>

              <template v-if="item.type === 'textarea'">
                <div class="input-lang-wrapper textarea-lang-wrapper">
                  <span class="lang-tag">🇮🇩 ID</span>
                  <textarea :id="item.key" class="form-input" v-model="form.settings[item.key]" rows="3" placeholder="Konten Bahasa Indonesia"></textarea>
                </div>
                <div class="input-lang-wrapper textarea-lang-wrapper" style="margin-top: 10px;">
                  <span class="lang-tag">🇬🇧 EN</span>
                  <textarea :id="item.key + '_en'" class="form-input" v-model="form.settings_en[item.key]" rows="3" placeholder="English Content"></textarea>
                </div>

              </template>

              <template v-else-if="item.type === 'iframe_embed'">
                <div class="iframe-embed-wrapper">
                  <div class="iframe-embed-hint">
                    <span>🗺️</span>
                    <span>Tempel kode embed Google Maps (format: <code>&lt;iframe src="..." ...&gt;&lt;/iframe&gt;</code>)</span>
                  </div>
                  <textarea
                    :id="item.key"
                    class="form-input iframe-embed-input"
                    v-model="form.settings[item.key]"
                    rows="5"
                    placeholder='Contoh: <iframe src="https://www.google.com/maps/embed?pb=..." width="600" height="450" ...></iframe>'
                  ></textarea>
                </div>
              </template>

              <template v-else-if="item.type === 'image'">
                <div style="display: flex; align-items: center; gap: 12px;">
                  <img v-if="getImageUrl(item)" :src="getImageUrl(item)" style="width: 80px; height: 60px; object-fit: cover; border-radius: var(--rounded); border: 1px solid var(--color-border);" />
                  <input type="file" :id="item.key" accept="image/*" @change="handleImage($event, item.key)" class="form-input" />
                </div>
              </template>

              <template v-else-if="item.type === 'number'">
                <input :id="item.key" type="number" class="form-input" v-model="form.settings[item.key]" />
              </template>

              <template v-else>
                <div class="input-lang-wrapper">
                  <span class="lang-tag">🇮🇩 ID</span>
                  <input :id="item.key" type="text" class="form-input" v-model="form.settings[item.key]" placeholder="Teks Bahasa Indonesia" />
                </div>
                <div class="input-lang-wrapper" style="margin-top: 10px;">
                  <span class="lang-tag">🇬🇧 EN</span>
                  <input :id="item.key + '_en'" type="text" class="form-input" v-model="form.settings_en[item.key]" placeholder="English Text" />
                </div>

              </template>
            </div>
          </div>
        </div>


        <!-- Slides / Carousels Editor -->
        <div v-if="activeGroup === 'slides'" class="settings-group card" style="margin-bottom: 32px;">
          <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; border-bottom: 1px solid var(--color-border); padding-bottom: 12px;">
            <h2 class="label-caps" style="color: var(--color-primary); margin: 0;">Slide Banner Beranda (Carousel)</h2>
            <button type="button" @click="addSlide" class="btn btn-gold btn-sm">+ Tambah Slide</button>
          </div>

          <div v-if="form.slides.length === 0" style="text-align: center; padding: 32px; color: var(--color-on-surface-variant);">
            Belum ada slide banner. Klik "+ Tambah Slide" untuk menambahkan slide baru.
          </div>

          <div class="slides-list" style="display: flex; flex-direction: column; gap: 24px;">
            <div v-for="(slide, index) in form.slides" :key="slide.id" class="slide-card card-inner" style="border: 1px solid var(--color-border); border-radius: var(--rounded-md); padding: 20px; background: var(--color-surface-container-low); position: relative;">
              <div style="position: absolute; top: 16px; right: 16px; display: flex; gap: 8px;">
                <span class="badge badge-info">Slide #{{ index + 1 }}</span>
                <button type="button" @click="removeSlide(index)" class="btn btn-danger btn-sm" style="padding: 4px 10px;">Hapus</button>
              </div>

              <div class="slide-grid" style="display: grid; grid-template-columns: 1fr 2fr; gap: 20px; margin-top: 16px;">
                <!-- Image Side -->
                <div class="slide-image-upload">
                  <label class="form-label">Gambar Slide</label>
                  <div class="slide-preview-box" style="margin-bottom: 12px; border-radius: var(--rounded); overflow: hidden; background: #ddd; height: 140px; display: flex; align-items: center; justify-content: center; border: 1px solid var(--color-border);">
                    <img v-if="slide.image_preview" :src="slide.image_preview" style="width: 100%; height: 100%; object-fit: cover;" />
                    <img v-else-if="slide.image_path" :src="'/storage/' + slide.image_path" style="width: 100%; height: 100%; object-fit: cover;" />
                    <img v-else :src="defaultSlidePlaceholder" style="width: 100%; height: 100%; object-fit: cover;" />
                  </div>
                  <input type="file" accept="image/*" @change="handleSlideImage($event, index)" class="form-input" style="font-size: 12px;" />
                </div>

                <!-- Fields Side -->
                <div class="slide-fields" style="display: flex; flex-direction: column; gap: 12px;">
                  <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                    <div class="form-group" style="margin: 0;">
                      <label class="form-label">Judul Slide (ID) *</label>
                      <input type="text" class="form-input" v-model="slide.title" placeholder="Masukkan judul slide..." required />
                    </div>
                    <div class="form-group" style="margin: 0;">
                      <label class="form-label">Judul Slide (EN)</label>
                      <input type="text" class="form-input" v-model="slide.title_en" placeholder="Enter slide title in English..." />
                    </div>
                  </div>

                  <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                    <div class="form-group" style="margin: 0;">
                      <label class="form-label">Subjudul Slide (ID)</label>
                      <textarea class="form-input" v-model="slide.subtitle" rows="2" placeholder="Masukkan deskripsi slide..."></textarea>
                    </div>
                    <div class="form-group" style="margin: 0;">
                      <label class="form-label">Subjudul Slide (EN)</label>
                      <textarea class="form-input" v-model="slide.subtitle_en" rows="2" placeholder="Enter slide description in English..."></textarea>
                    </div>
                  </div>

                  <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                    <div class="form-group" style="margin: 0;">
                      <label class="form-label">Teks Tombol (CTA - ID)</label>
                      <input type="text" class="form-input" v-model="slide.cta_text" placeholder="Contoh: Lihat Detail" />
                    </div>
                    <div class="form-group" style="margin: 0;">
                      <label class="form-label">Teks Tombol (CTA - EN)</label>
                      <input type="text" class="form-input" v-model="slide.cta_text_en" placeholder="Example: View Details" />
                    </div>
                  </div>

                  <div style="display: grid; grid-template-columns: 1fr 1fr 1.2fr; gap: 12px;">
                    <div class="form-group" style="margin: 0;">
                      <label class="form-label">Jenis Link</label>
                      <select class="form-input" v-model="slide.link_type" @change="handleLinkTypeChange(index)">
                        <option value="static">Halaman Statis</option>
                        <option value="product">Detail Produk</option>
                        <option value="post">Detail Berita</option>
                        <option value="field_story">Kabar Lapangan</option>
                        <option value="custom">URL Kustom</option>
                      </select>
                    </div>

                    <div class="form-group" style="margin: 0;">
                      <label class="form-label">Tujuan Link</label>
                      
                      <!-- Static Pages Picker -->
                      <select v-if="slide.link_type === 'static'" class="form-input" v-model="slide.link_selection" @change="handleLinkSelectionChange(index)">
                        <option value="/">Beranda</option>
                        <option value="/about">Tentang Kami</option>
                        <option value="/products">Produk</option>
                        <option value="/sustainability">Keberlanjutan</option>
                        <option value="/news">Berita</option>
                        <option value="/contact">Hubungi Kami</option>
                      </select>

                      <!-- Products Picker -->
                      <select v-else-if="slide.link_type === 'product'" class="form-input" v-model="slide.link_selection" @change="handleLinkSelectionChange(index)">
                        <option v-if="products.length === 0" disabled value="">Belum ada produk</option>
                        <option v-for="p in products" :key="p.id" :value="'/products/' + p.slug">{{ p.name }}</option>
                      </select>

                      <!-- Posts Picker -->
                      <select v-else-if="slide.link_type === 'post'" class="form-input" v-model="slide.link_selection" @change="handleLinkSelectionChange(index)">
                        <option v-if="posts.length === 0" disabled value="">Belum ada berita</option>
                        <option v-for="p in posts" :key="p.id" :value="'/news/' + p.slug">{{ p.title }}</option>
                      </select>

                      <!-- Field Stories Picker -->
                      <select v-else-if="slide.link_type === 'field_story'" class="form-input" v-model="slide.link_selection" @change="handleLinkSelectionChange(index)">
                        <option v-if="fieldStories.length === 0" disabled value="">Belum ada kabar lapangan</option>
                        <option v-for="s in fieldStories" :key="s.id" :value="'/field-stories/' + s.slug">{{ s.title }}</option>
                      </select>

                      <!-- Custom URL Input -->
                      <input v-else type="text" class="form-input" v-model="slide.link_selection" @input="handleLinkSelectionChange(index)" placeholder="Contoh: https://..." />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- 3. Other Settings Groups -->
        <div v-for="group in sortedOtherGroups" :key="group" class="settings-group card" style="margin-bottom: 24px;">
          <h2 class="label-caps" style="margin-bottom: 20px; color: var(--color-primary);">{{ groupLabels[group] || group }}</h2>

          <div class="settings-fields">
            <div v-for="item in settings[group]" :key="item.key" class="form-group">
              <label class="form-label" :for="item.key">{{ item.label || item.key }}</label>

              <template v-if="item.type === 'textarea'">
                <div class="input-lang-wrapper textarea-lang-wrapper">
                  <span class="lang-tag">🇮🇩 ID</span>
                  <textarea :id="item.key" class="form-input" v-model="form.settings[item.key]" rows="3" placeholder="Konten Bahasa Indonesia"></textarea>
                </div>
                <div class="input-lang-wrapper textarea-lang-wrapper" style="margin-top: 10px;">
                  <span class="lang-tag">🇬🇧 EN</span>
                  <textarea :id="item.key + '_en'" class="form-input" v-model="form.settings_en[item.key]" rows="3" placeholder="English Content"></textarea>
                </div>
              </template>

              <template v-else-if="item.type === 'iframe_embed'">
                <div class="iframe-embed-wrapper">
                  <div class="iframe-embed-hint">
                    <span>🗺️</span>
                    <span>Tempel kode embed Google Maps (format: <code>&lt;iframe src="..." ...&gt;&lt;/iframe&gt;</code>)</span>
                  </div>
                  <textarea
                    :id="item.key"
                    class="form-input iframe-embed-input"
                    v-model="form.settings[item.key]"
                    rows="5"
                    placeholder='Contoh: <iframe src="https://www.google.com/maps/embed?pb=..." width="600" height="450" ...></iframe>'
                  ></textarea>
                </div>
              </template>

              <template v-else-if="item.type === 'image'">
                <div style="display: flex; align-items: center; gap: 12px;">
                  <img v-if="getImageUrl(item)" :src="getImageUrl(item)" style="width: 80px; height: 60px; object-fit: cover; border-radius: var(--rounded); border: 1px solid var(--color-border);" />
                  <input type="file" :id="item.key" accept="image/*" @change="handleImage($event, item.key)" class="form-input" />
                </div>
              </template>

              <template v-else-if="item.type === 'number'">
                <input :id="item.key" type="number" class="form-input" v-model="form.settings[item.key]" />
              </template>

              <template v-else>
                <div class="input-lang-wrapper">
                  <span class="lang-tag">🇮🇩 ID</span>
                  <input :id="item.key" type="text" class="form-input" v-model="form.settings[item.key]" placeholder="Teks Bahasa Indonesia" />
                </div>
                <div class="input-lang-wrapper" style="margin-top: 10px;">
                  <span class="lang-tag">🇬🇧 EN</span>
                  <input :id="item.key + '_en'" type="text" class="form-input" v-model="form.settings_en[item.key]" placeholder="English Text" />
                </div>
              </template>
            </div>
          </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary" :disabled="form.processing" style="padding: 14px 28px; font-size: 15px;">
          {{ form.processing ? 'Menyimpan...' : 'Simpan Pengaturan' }}
        </button>
      </form>
    </div>
  </AdminLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { useForm, usePage } from '@inertiajs/vue3';

const props = defineProps({
    settings: Object,
    slides: Array,
    products: { type: Array, default: () => [] },
    posts: { type: Array, default: () => [] },
    fieldStories: { type: Array, default: () => [] }
});

const page = usePage();

const activeGroup = computed(() => {
    const urlParams = new URLSearchParams(page.url.split('?')[1] || '');
    return urlParams.get('group') || 'general';
});

const activeGroupLabel = computed(() => {
    if (activeGroup.value === 'general') return 'Umum';
    if (activeGroup.value === 'slides') return 'Slide Banner';
    if (activeGroup.value === 'homepage') return 'Konten Beranda';
    if (activeGroup.value === 'about_page') return 'Tentang Kami';
    if (activeGroup.value === 'product_page') return 'Halaman Produk';
    if (activeGroup.value === 'sustainability') return 'Keberlanjutan';
    if (activeGroup.value === 'contact') return 'Kontak & Sosial Media';
    return '';
});

const groupLabels = {
    general: 'Umum',
    contact: 'Kontak & Sosial Media',
    sustainability: 'Keberlanjutan',
    homepage_about: 'Beranda — Siapa Kami',
    homepage_transform: 'Beranda — Transformasi',
    homepage_tech: 'Beranda — Spesifikasi Teknis',
    homepage_product: 'Beranda — Pilihan Produk',
    homepage_cta: 'Beranda — Call to Action',
    product_page: 'Halaman Produk',
    about_page: 'Tentang Kami',
};

const sortedOtherGroups = computed(() => {
    if (activeGroup.value === 'sustainability') {
        return ['sustainability'];
    }
    if (activeGroup.value === 'contact') {
        return ['contact'];
    }
    if (activeGroup.value === 'product_page') {
        return ['product_page'];
    }
    if (activeGroup.value === 'about_page') {
        return ['about_page'];
    }
    if (activeGroup.value === 'homepage') {
        return [
            'homepage_about',
            'homepage_transform',
            'homepage_tech',
            'homepage_product',
            'homepage_cta'
        ];
    }
    return [];
});

// Helper to determine link type and value from cta_link
function parseCtaLink(link) {
    if (!link) {
        return { type: 'static', val: '/' };
    }
    if (link.startsWith('/products/')) {
        const slug = link.replace('/products/', '');
        const prodExists = props.products.some(p => p.slug === slug);
        if (prodExists) {
            return { type: 'product', val: link };
        }
    }
    if (link.startsWith('/news/')) {
        const slug = link.replace('/news/', '');
        const postExists = props.posts.some(p => p.slug === slug);
        if (postExists) {
            return { type: 'post', val: link };
        }
    }
    if (link.startsWith('/field-stories/')) {
        const slug = link.replace('/field-stories/', '');
        const storyExists = props.fieldStories.some(s => s.slug === slug);
        if (storyExists) {
            return { type: 'field_story', val: link };
        }
    }
    
    const staticPages = ['/', '/about', '/products', '/sustainability', '/news', '/contact'];
    if (staticPages.includes(link)) {
        return { type: 'static', val: link };
    }
    
    return { type: 'custom', val: link };
}

// Build initial form data from settings
const initialSettings = {};
const initialSettingsEn = {};
for (const [group, items] of Object.entries(props.settings)) {
    for (const item of items) {
        initialSettings[item.key] = item.value || '';
        initialSettingsEn[item.key] = item.value_en || '';
    }
}

const form = useForm({
    settings: initialSettings,
    settings_en: initialSettingsEn,
    images: {},
    slides: props.slides.map(slide => {
        const parsed = parseCtaLink(slide.cta_link);
        return {
            id: slide.id,
            title: slide.title || '',
            title_en: slide.title_en || '',
            subtitle: slide.subtitle || '',
            subtitle_en: slide.subtitle_en || '',
            cta_text: slide.cta_text || '',
            cta_text_en: slide.cta_text_en || '',
            cta_link: slide.cta_link || '',
            link_type: parsed.type,
            link_selection: parsed.val,
            sort_order: slide.sort_order || 0,
            image: null,
            image_preview: null
        };
    })
});

const defaultSlidePlaceholder = "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='800' height='400' viewBox='0 0 800 400'><rect width='100%' height='100%' fill='%23111827'/><circle cx='400' cy='200' r='120' fill='%23e5b02e' opacity='0.1'/><text x='50%' y='50%' fill='%23e5b02e' font-family='Arial, sans-serif' font-weight='bold' font-size='24' text-anchor='middle' dominant-baseline='middle'>MANDRAGUNA BANNER</text><text x='50%' y='58%' fill='%239ca3af' font-family='Arial, sans-serif' font-size='14' text-anchor='middle' dominant-baseline='middle'>Default Slide Image (Please upload your own)</text></svg>";

const defaultSettingPlaceholder = "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='120' height='90' viewBox='0 0 120 90'><rect width='100%' height='100%' fill='%23eaeaea'/><text x='50%' y='50%' fill='%239ca3af' font-family='Arial, sans-serif' font-size='10' font-weight='bold' text-anchor='middle' dominant-baseline='middle'>NO IMAGE</text></svg>";

const imagePreviews = ref({});

function getImageUrl(item) {
    if (imagePreviews.value[item.key]) {
        return imagePreviews.value[item.key];
    }
    if (item.value) {
        return '/storage/' + item.value;
    }
    if (item.key === 'company_logo') {
        return '/images/logo.png';
    }
    if (item.key === 'company_favicon') {
        return '/favicon.ico';
    }
    return defaultSettingPlaceholder;
}

function handleImage(event, key) {
    const file = event.target.files[0];
    if (file) {
        form.images[key] = file;
        imagePreviews.value[key] = URL.createObjectURL(file);
    }
}

function handleSlideImage(event, index) {
    const file = event.target.files[0];
    if (file) {
        form.slides[index].image = file;
        form.slides[index].image_preview = URL.createObjectURL(file);
    }
}

function handleLinkTypeChange(index) {
    const slide = form.slides[index];
    if (slide.link_type === 'static') {
        slide.link_selection = '/';
    } else if (slide.link_type === 'product') {
        slide.link_selection = props.products[0] ? `/products/${props.products[0].slug}` : '/products';
    } else if (slide.link_type === 'post') {
        slide.link_selection = props.posts[0] ? `/news/${props.posts[0].slug}` : '/news';
    } else if (slide.link_type === 'field_story') {
        slide.link_selection = props.fieldStories[0] ? `/field-stories/${props.fieldStories[0].slug}` : '/news';
    } else if (slide.link_type === 'custom') {
        slide.link_selection = 'https://';
    }
    slide.cta_link = slide.link_selection;
}

function handleLinkSelectionChange(index) {
    const slide = form.slides[index];
    slide.cta_link = slide.link_selection;
}

function addSlide() {
    form.slides.push({
        id: 'new_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9),
        title: '',
        title_en: '',
        subtitle: '',
        subtitle_en: '',
        image_path: null,
        cta_text: 'Pelajari Selengkapnya',
        cta_text_en: 'Learn More',
        cta_link: '/',
        link_type: 'static',
        link_selection: '/',
        sort_order: form.slides.length,
        image: null,
        image_preview: null
    });
}

function removeSlide(index) {
    form.slides.splice(index, 1);
}

function submit() {
    // Submit settings and slides
    form.post('/panel-umkm/settings', {
        forceFormData: true,
    });
}
</script>

<style scoped>
.settings-fields {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px 24px;
}

.slide-grid {
    align-items: start;
}

.input-lang-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.input-lang-wrapper .form-input {
    padding-left: 64px;
    width: 100%;
}

.lang-tag {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 11px;
    font-weight: 700;
    color: var(--color-on-surface-variant);
    background: var(--color-surface-container-high);
    padding: 3px 6px;
    border-radius: 4px;
    pointer-events: none;
}

.textarea-lang-wrapper .lang-tag {
    top: 12px;
    transform: none;
}

.textarea-lang-wrapper .form-input {
    padding-left: 12px;
    padding-top: 36px;
}

@media (max-width: 768px) {
    .settings-fields { grid-template-columns: 1fr; }
    .slide-grid { grid-template-columns: 1fr; }
}

.iframe-embed-wrapper {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.iframe-embed-hint {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    color: var(--color-on-surface-variant);
    background: var(--color-surface-container-low, #f5f5f5);
    border: 1px solid var(--color-border);
    border-radius: var(--rounded);
    padding: 8px 12px;
}

.iframe-embed-hint code {
    background: rgba(0,0,0,0.07);
    border-radius: 4px;
    padding: 1px 5px;
    font-size: 12px;
    font-family: monospace;
}

.iframe-embed-input {
    font-family: monospace;
    font-size: 13px;
    resize: vertical;
    min-height: 100px;
}
</style>
