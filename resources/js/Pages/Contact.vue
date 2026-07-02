<template>
  <Head :title="t('Hubungi Kami', 'Contact Us', 'お問い合わせ')" />
  <PublicLayout>
    <!-- Header Hero Section -->
    <section class="page-hero">
      <div class="container">
        <span class="label-caps" style="color: var(--color-primary-fixed-dim); margin-bottom: 12px; display: block;">{{ t('HUBUNGI KAMI', 'CONTACT US', 'お問い合わせ') }}</span>
        <h1 class="headline-xl" style="color: white; margin-top: 8px;">{{ t('Kemitraan & Layanan Tani', 'Partnership & Farming Services', 'パートナーシップ＆農業サービス') }}</h1>
        <p class="body-lg" style="color: rgba(255,255,255,0.8); margin-top: 20px; max-width: 680px; line-height: 28px;">
          {{ t('Hubungi Mandraguna untuk mendiskusikan solusi pupuk organik inovatif, kemitraan distribusi grosir, atau meminta spesifikasi produk terperinci untuk lahan Anda.', 'Contact Mandraguna to discuss innovative organic fertilizer solutions, wholesale distribution partnerships, or request detailed product specifications for your land.', '革新的な有機肥料ソリューション、卸売販売パートナーシップ、またはお客様の農地の詳細な製品仕様のご要望について、マンドラグナまでお問い合わせください。') }}
        </p>
      </div>
    </section>

    <section class="section bg-white">
      <div class="container contact-grid">
        <!-- Contact Form (Inquiry) -->
        <div class="card form-card shadow-sm hover-lift" style="padding: 40px; border: 1px solid var(--color-border); border-radius: var(--rounded-lg);">
          <h2 class="headline-md" style="font-size: 24px; margin-bottom: 32px;">{{ t('Kirim Pesan', 'Send Message', 'メッセージを送信する') }}</h2>

          <div v-if="$page.props.flash?.success" class="alert alert-success" style="margin-bottom: 24px;">
            ✓ {{ $page.props.flash.success }}
          </div>

          <div v-if="form.errors?.too_many_requests" class="alert alert-rate-limit" style="margin-bottom: 24px;">
            🚫 {{ form.errors.too_many_requests }}
          </div>

          <div v-if="rateLimited" class="alert alert-rate-limit" style="margin-bottom: 24px;">
            🚫 {{ t(
              'Terlalu banyak permintaan. Harap tunggu beberapa menit sebelum mencoba lagi.',
              'Too many requests. Please wait a few minutes before trying again.',
              'リクエストが多すぎます。しばらく待ってから再度お試しください。'
            ) }}
          </div>
          <form @submit.prevent="submit" class="inquiry-form" style="display: flex; flex-direction: column; gap: 20px;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
              <div class="form-group" style="margin: 0;">
                <label class="form-label">{{ t('Nama Lengkap *', 'Full Name *', '氏名（必須） *') }}</label>
                <input type="text" class="form-input" v-model="form.name" :placeholder="t('Masukkan nama lengkap Anda', 'Enter your full name', '氏名を入力してください')" required />
                <p v-if="form.errors.name" class="form-error">{{ form.errors.name }}</p>
              </div>
              <div class="form-group" style="margin: 0;">
                <label class="form-label">{{ t('Nama Perusahaan', 'Company Name', '会社名') }}</label>
                <input type="text" class="form-input" v-model="form.company" :placeholder="t('Nama perusahaan (opsional)', 'Company name (optional)', '会社名（任意）')" />
              </div>
            </div>

            <div class="form-group" style="margin: 0;">
              <label class="form-label">{{ t('Alamat Email *', 'Email Address *', 'メールアドレス（必須） *') }}</label>
              <input type="email" class="form-input" v-model="form.email" placeholder="contoh@domain.com" required />
              <p v-if="form.errors.email" class="form-error">{{ form.errors.email }}</p>
            </div>

            <div class="form-group" style="margin: 0;">
              <label class="form-label">{{ t('Tipe Pesan', 'Message Type', 'お問い合わせ種別') }}</label>
              <select class="form-input text-secondary" v-model="form.subject" style="background: white;">
                <option value="Wholesale Distribution">{{ t('Distribusi Grosir / Bulk', 'Wholesale / Bulk Distribution', '卸売・バルク販売') }}</option>
                <option value="Product Information">{{ t('Informasi Spesifikasi Produk', 'Product Specifications Information', '製品仕様に関する情報') }}</option>
                <option value="Partnership">{{ t('Kemitraan Bisnis / Ekologi', 'Business / Ecological Partnership', 'ビジネス・生態系パートナーシップ') }}</option>
                <option value="General Inquiry">{{ t('Tanya Jawab Umum', 'General Inquiry', '一般的なお問い合わせ') }}</option>
              </select>
            </div>

            <div class="form-group" style="margin: 0;">
              <label class="form-label">{{ t('Pesan *', 'Message *', 'メッセージ（必須） *') }}</label>
              <textarea class="form-input" v-model="form.message" rows="4" :placeholder="t('Tuliskan pesan atau pertanyaan Anda di sini...', 'Write your message or question here...', 'メッセージやご質問をここに入力してください...')" required></textarea>
              <p v-if="form.errors.message" class="form-error">{{ form.errors.message }}</p>
            </div>

            <!-- Captcha Section -->
            <div class="form-group" style="margin: 0;">
              <label class="form-label">{{ t('Kode Keamanan (Captcha) *', 'Security Code (Captcha) *', 'セキュリティコード (Captcha)（必須） *') }}</label>
              <div style="display: flex; gap: 12px; align-items: center;">
                <div style="flex-shrink: 0; display: flex; align-items: center; background: #f3f4f6; border-radius: var(--rounded-md); overflow: hidden; border: 1px solid var(--color-border); height: 46px;">
                  <img :src="currentCaptchaImage" alt="Captcha" style="height: 100%; width: auto;" />
                </div>
                <button type="button" @click="refreshCaptcha" class="btn-refresh" :disabled="refreshing" style="background: none; border: 1px solid var(--color-border); border-radius: var(--rounded-md); padding: 0 12px; height: 46px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all var(--transition-base); color: var(--color-on-surface-variant);" :title="t('Perbarui Kode', 'Refresh Code', 'コードの更新')">
                  <span v-if="refreshing" class="spinner"></span>
                  <span v-else style="font-size: 18px;">🔄</span>
                </button>
                <input type="text" class="form-input" v-model="form.captcha" :placeholder="t('Masukkan kode captcha', 'Enter captcha code', 'キャプチャコードを入力してください')" style="height: 46px; margin: 0; flex-grow: 1;" required autocomplete="off" />
              </div>
              <p v-if="form.errors.captcha" class="form-error">{{ form.errors.captcha }}</p>
            </div>

            <button type="submit" class="btn btn-primary" style="margin-top: 12px; padding: 14px 28px; width: 100%; justify-content: center;" :disabled="form.processing || rateLimited">
              <span v-if="rateLimited">⏳ {{ t('Coba lagi dalam beberapa menit', 'Try again in a few minutes', '数分後に再試行してください') }}</span>
              <span v-else>{{ form.processing ? t('Mengirim...', 'Sending...', '送信中...') : t('Kirim Pesan Sekarang', 'Send Message Now', 'メッセージを送信する') }}</span>
            </button>
          </form>
        </div>

        <!-- Info & Distributor Portal Column -->
        <div class="info-sidebar" style="display: flex; flex-direction: column; gap: 32px;">
          <!-- Headquarters Info Card -->
          <div class="card info-card" style="padding: 32px; border: 1px solid var(--color-border); border-radius: var(--rounded-lg); background: var(--color-surface-container-low);">
            <h3 class="label-caps" style="color: var(--color-primary); margin-bottom: 24px;">{{ t('Kantor Pusat Mandraguna', 'Mandraguna Headquarters', 'マンドラグナ本社') }}</h3>
            <div class="info-details" style="display: flex; flex-direction: column; gap: 20px;">
              <div style="display: flex; gap: 16px; align-items: flex-start;">
                <span style="font-size: 20px;">📍</span>
                <p class="body-md" style="line-height: 22px; color: var(--color-on-surface);">
                  {{ t(contact.contact_address || 'Jl. Industri No. 1, Garut, Jawa Barat, Indonesia', contact.contact_address_en || contact.contact_address || 'Jl. Industri No. 1, Garut, West Java, Indonesia') }}
                </p>
              </div>
              <div style="display: flex; gap: 16px; align-items: center;">
                <span style="font-size: 20px;">✉️</span>
                <a :href="'mailto:' + (contact.contact_email || 'info@mandraguna.com')" class="body-md hover-link" style="color: var(--color-primary); font-weight: 600;">
                  {{ contact.contact_email || 'info@mandraguna.com' }}
                </a>
              </div>
              <div style="display: flex; gap: 16px; align-items: center;">
                <span style="font-size: 20px;">📞</span>
                <p class="body-md" style="color: var(--color-on-surface);">{{ contact.contact_phone || '+62 812 3456 7890' }}</p>
              </div>
              <div style="display: flex; gap: 16px; align-items: center;" v-if="contact.contact_whatsapp">
                <span style="font-size: 20px;">💬</span>
                <a :href="'https://wa.me/' + contact.contact_whatsapp" target="_blank" class="body-md hover-link" style="color: var(--color-primary); font-weight: 600;">
                  {{ t('WhatsApp Kami', 'WhatsApp Us', 'WhatsAppでお問い合わせ') }}
                </a>
              </div>
            </div>
          </div>

          <!-- Operational Map Card -->
          <div class="card map-card" style="border: 1px solid var(--color-border); border-radius: var(--rounded-lg); overflow: hidden; background: var(--color-surface-container); min-height: 280px; flex-grow: 1; position: relative; box-shadow: var(--shadow-card);">
            <iframe 
              v-if="mapsIframeSrc" 
              :src="mapsIframeSrc" 
              width="100%" 
              height="100%" 
              style="border:0; display: block;" 
              allowfullscreen="" 
              loading="lazy" 
              referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
            <div v-else style="height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 16px; color: var(--color-on-surface-variant); padding: 32px; text-align: center;">
              <span style="font-size: 48px;">🗺️</span>
              <p class="body-md">{{ t('Lokasi Google Maps belum dikonfigurasi.', 'Google Maps location is not configured yet.', 'Googleマップの位置情報はまだ設定されていません。') }}</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </PublicLayout>
</template>

<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';
import { useLanguage } from '@/composables/useLanguage';
import { ref, watch, computed } from 'vue';

const props = defineProps({
    contact: Object,
    captcha_image: String
});

const { t } = useLanguage();

const currentCaptchaImage = ref(props.captcha_image);
const refreshing = ref(false);
const rateLimited = ref(false);
let rateLimitTimer = null;

// Extract src from full <iframe> tag or return raw value if it's already a URL
const mapsIframeSrc = computed(() => {
    const val = props.contact?.contact_maps_iframe;
    if (!val) return null;
    const match = val.match(/src=["']([^"']+)["']/);
    return match ? match[1] : val;
});

watch(() => props.captcha_image, (newVal) => {
    currentCaptchaImage.value = newVal;
});

const form = useForm({
    name: '',
    company: '',
    email: '',
    subject: 'Wholesale Distribution',
    message: '',
    captcha: '',
});

async function refreshCaptcha() {
    refreshing.value = true;
    try {
        const response = await fetch('/captcha/refresh');
        const data = await response.json();
        currentCaptchaImage.value = data.captcha_image;
        form.captcha = '';
        form.clearErrors('captcha');
    } catch (error) {
        console.error('Failed to refresh captcha', error);
    } finally {
        refreshing.value = false;
    }
}

function submit() {
    form.post('/contact', {
        onSuccess: () => {
            form.reset();
            rateLimited.value = false;
            refreshCaptcha();
        },
        onError: (errors) => {
            form.captcha = '';
            refreshCaptcha();
        },
        onFinish: () => {
            // Detect 429 rate limit — Inertia may redirect back with no errors
            // but form.recentlySuccessful will be false and status is available
        },
    });
}

// Watch for rate-limit errors returned as page-level errors
watch(() => form.errors, (errs) => {
    if (errs?.too_many_requests) {
        rateLimited.value = true;
        clearTimeout(rateLimitTimer);
        // Auto-reset after 10 minutes
        rateLimitTimer = setTimeout(() => { rateLimited.value = false; }, 10 * 60 * 1000);
    }
}, { deep: true });
</script>

<style scoped>
.page-hero {
    padding: 160px 0 80px;
    background: linear-gradient(135deg, var(--color-earth-black) 0%, #2a2000 100%);
}

.section {
    padding: var(--space-section) 0;
}

.contact-grid {
    display: grid;
    grid-template-columns: 1.2fr 1fr;
    gap: 64px;
    align-items: stretch;
}

.hover-lift {
    transition: transform var(--transition-base), box-shadow var(--transition-base);
}

.hover-lift:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-soft);
}

.hover-link:hover {
    color: var(--color-primary) !important;
    text-decoration: underline;
}

@media (max-width: 1024px) {
    .contact-grid {
        grid-template-columns: 1fr;
        gap: 32px;
    }
    .form-card {
        padding: 24px 16px !important;
    }
}

@media (max-width: 576px) {
    .inquiry-form div[style*="grid-template-columns"] {
        grid-template-columns: 1fr !important;
        gap: 20px !important;
    }
}

.btn-refresh:hover {
    background-color: var(--color-surface-container-high) !important;
    border-color: var(--color-primary-fixed-dim) !important;
    color: var(--color-primary) !important;
}

.spinner {
    width: 18px;
    height: 18px;
    border: 2px solid rgba(0, 0, 0, 0.1);
    border-top-color: var(--color-primary);
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}
</style>
