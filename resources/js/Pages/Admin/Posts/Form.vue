<template>
  <Head :title="isEdit ? 'Edit Artikel' : 'Tambah Artikel'" />
  <AdminLayout>
    <div>
      <div style="margin-bottom: 24px;">
        <Link href="/panel-umkm/posts" style="font-size: 14px; color: var(--color-on-surface-variant);">← Kembali ke Daftar Artikel</Link>
      </div>
      <h1 class="headline-md" style="margin-bottom: 32px;">{{ isEdit ? 'Edit Artikel' : 'Tambah Artikel Baru' }}</h1>

      <form @submit.prevent="submit" class="card" enctype="multipart/form-data">
        <!-- Tab Switcer Bahasa -->
        <div class="lang-tabs">
          <button type="button" @click="activeTab = 'id'" class="tab-btn" :class="{ active: activeTab === 'id' }">
            🇮🇩 Indonesia
          </button>
          <button type="button" @click="activeTab = 'en'" class="tab-btn" :class="{ active: activeTab === 'en' }">
            🇬🇧 English
          </button>

        </div>

        <!-- Tab Indonesia -->
        <div v-show="activeTab === 'id'">
          <div class="form-group">
            <label class="form-label" for="title">Judul Artikel (ID)</label>
            <input id="title" type="text" class="form-input" v-model="form.title" :required="activeTab === 'id'" />
            <p v-if="form.errors.title" class="form-error">{{ form.errors.title }}</p>
          </div>

          <div class="form-group">
            <label class="form-label" for="excerpt">Ringkasan (ID)</label>
            <textarea id="excerpt" class="form-input" v-model="form.excerpt" rows="2" maxlength="500" placeholder="Ringkasan singkat artikel dalam Bahasa Indonesia..."></textarea>
          </div>

          <div class="form-group">
            <label class="form-label">Konten Artikel (ID)</label>
            <RichTextEditor v-model="form.content" />
            <p v-if="form.errors.content" class="form-error">{{ form.errors.content }}</p>
          </div>
        </div>

        <!-- Tab English -->
        <div v-show="activeTab === 'en'">
          <div class="form-group">
            <label class="form-label" for="title_en">Judul Artikel (EN)</label>
            <input id="title_en" type="text" class="form-input" v-model="form.title_en" placeholder="Article Title in English..." />
            <p v-if="form.errors.title_en" class="form-error">{{ form.errors.title_en }}</p>
          </div>

          <div class="form-group">
            <label class="form-label" for="excerpt_en">Ringkasan (EN)</label>
            <textarea id="excerpt_en" class="form-input" v-model="form.excerpt_en" rows="2" maxlength="500" placeholder="Brief summary of the article in English..."></textarea>
          </div>

          <div class="form-group">
            <label class="form-label">Konten Artikel (EN)</label>
            <RichTextEditor v-model="form.content_en" />
            <p v-if="form.errors.content_en" class="form-error">{{ form.errors.content_en }}</p>
          </div>
        </div>



        <!-- Global Fields -->
        <div class="form-group" style="margin-top: 24px;">
          <label class="form-label" for="image">Gambar Cover</label>
          <input id="image" type="file" class="form-input" accept="image/*" @change="handleFileChange" />
          <div style="margin-top: 12px; max-width: 300px; border-radius: var(--rounded-md); overflow: hidden; border: 1px solid var(--color-border); background: var(--color-surface-container-low);">
            <img v-if="imagePreview" :src="imagePreview" style="width: 100%; display: block; object-fit: cover; max-height: 200px;" />
            <img v-else-if="post?.image_path" :src="'/storage/' + post.image_path" style="width: 100%; display: block; object-fit: cover; max-height: 200px;" />
            <img v-else :src="defaultCoverPlaceholder" style="width: 100%; display: block; object-fit: cover; max-height: 200px;" />
          </div>
        </div>

        <div class="form-group" style="display: flex; align-items: center; gap: 8px;">
          <input type="checkbox" id="is_published" v-model="form.is_published" />
          <label for="is_published" style="font-size: 14px; cursor: pointer;">Publikasikan sekarang</label>
        </div>

        <div style="margin-top: 24px; display: flex; gap: 12px;">
          <button type="submit" class="btn btn-gold" :disabled="form.processing">
            {{ form.processing ? 'Menyimpan...' : (isEdit ? 'Perbarui Artikel' : 'Simpan Artikel') }}
          </button>
          <Link href="/panel-umkm/posts" class="btn btn-ghost">Batal</Link>
        </div>
      </form>
    </div>
  </AdminLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { useForm } from '@inertiajs/vue3';
import RichTextEditor from '@/Components/RichTextEditor.vue';

const props = defineProps({ post: { type: Object, default: null } });
const isEdit = computed(() => !!props.post);
const activeTab = ref('id');
const imagePreview = ref(null);

const defaultCoverPlaceholder = "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='400' height='200' viewBox='0 0 400 200'><rect width='100%' height='100%' fill='%23eaeaea'/><text x='50%' y='50%' fill='%239ca3af' font-family='Arial, sans-serif' font-size='14' font-weight='bold' text-anchor='middle' dominant-baseline='middle'>COVER IMAGE PLACEHOLDER</text></svg>";

function handleFileChange(event) {
    const file = event.target.files[0];
    if (file) {
        form.image = file;
        imagePreview.value = URL.createObjectURL(file);
    }
}

const form = useForm({
    title: props.post?.title || '',
    title_en: props.post?.title_en || '',
    excerpt: props.post?.excerpt || '',
    excerpt_en: props.post?.excerpt_en || '',
    content: props.post?.content || '',
    content_en: props.post?.content_en || '',
    image: null,
    is_published: props.post?.is_published ?? false,
});

function submit() {
    const url = isEdit.value ? `/panel-umkm/posts/${props.post.id}` : '/panel-umkm/posts';
    form.post(url, { forceFormData: true });
}
</script>

<style scoped>
.lang-tabs {
    display: flex;
    gap: 8px;
    margin-bottom: 24px;
    border-bottom: 1px solid var(--color-border);
    padding-bottom: 8px;
}

.tab-btn {
    padding: 6px 16px;
    font-size: 14px;
    font-weight: 600;
    color: var(--color-on-surface-variant);
    background: none;
    border: none;
    border-bottom: 2px solid transparent;
    cursor: pointer;
    transition: all var(--transition-fast);
}

.tab-btn:hover {
    color: var(--color-primary);
}

.tab-btn.active {
    color: var(--color-primary);
    border-bottom-color: var(--color-primary);
}
</style>
