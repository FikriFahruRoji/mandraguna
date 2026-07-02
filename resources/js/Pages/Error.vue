<template>
  <Head :title="pageTitle" />
  
  <div class="error-page">
    <!-- Top Decorative Line -->
    <div class="top-accent"></div>

    <!-- Header Brand -->
    <header class="header">
      <Link href="/" class="brand-link">
        <div class="brand-icon">M</div>
        <span class="brand-name">MANDRAGUNA</span>
      </Link>
      
      <!-- Language Switcher in Header -->
      <button @click="toggleLang" class="lang-switch">
        <span>{{ locale === 'id' ? '🇮🇩 ID' : (locale === 'en' ? '🇬🇧 EN' : '🇯🇵 JA') }}</span>
      </button>
    </header>

    <!-- Main Content -->
    <main class="main-content">
      <div class="error-illustration">
        <!-- SVG Soil / Growth Art with glowing details -->
        <svg class="organic-svg" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
          <circle cx="50" cy="50" r="45" stroke="url(#gold-gradient)" stroke-width="1.5" stroke-dasharray="6 3" class="rotating-ring" />
          <path d="M25 75C35 70 65 70 75 75" stroke="#4a3e2a" stroke-width="3" stroke-linecap="round" />
          <path d="M30 75C40 73 60 73 70 75" stroke="var(--color-primary-container)" stroke-width="1" />
          <!-- Sprout -->
          <path d="M50 73V45" stroke="url(#stem-gradient)" stroke-width="3" stroke-linecap="round" class="grow-stem" />
          <!-- Left Leaf -->
          <path d="M50 58C42 54 36 58 40 64C44 70 50 68 50 68" fill="url(#leaf-gradient)" opacity="0.95" class="leaf-left" />
          <!-- Right Leaf -->
          <path d="M50 50C58 46 64 50 60 56C56 62 50 60 50 60" fill="url(#leaf-gradient)" opacity="0.95" class="leaf-right" />
          <!-- Small glowing spores/particles -->
          <circle cx="35" cy="40" r="1.5" fill="var(--color-primary-fixed-dim)" class="spore spore-1" />
          <circle cx="68" cy="48" r="1" fill="var(--color-primary-fixed)" class="spore spore-2" />
          <circle cx="50" cy="32" r="2" fill="var(--color-primary-container)" class="spore spore-3" />
          
          <defs>
            <linearGradient id="gold-gradient" x1="0" y1="0" x2="100" y2="100" gradientUnits="userSpaceOnUse">
              <stop offset="0%" stop-color="#ffdea0" />
              <stop offset="50%" stop-color="#daa520" />
              <stop offset="100%" stop-color="#795900" />
            </linearGradient>
            <linearGradient id="stem-gradient" x1="50" y1="73" x2="50" y2="45" gradientUnits="userSpaceOnUse">
              <stop offset="0%" stop-color="#795900" />
              <stop offset="100%" stop-color="#daa520" />
            </linearGradient>
            <linearGradient id="leaf-gradient" x1="40" y1="50" x2="60" y2="68" gradientUnits="userSpaceOnUse">
              <stop offset="0%" stop-color="#daa520" />
              <stop offset="100%" stop-color="#2d6a4f" />
            </linearGradient>
          </defs>
        </svg>
        
        <div class="status-code">{{ status }}</div>
      </div>

      <h2 class="title">{{ errorTitle }}</h2>
      <p class="description">
        {{ errorDescription }}
      </p>

      <div class="cta-actions">
        <Link href="/" class="btn btn-gold btn-large">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 6px;"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
          {{ t('Kembali ke Beranda', 'Back to Homepage', 'ホームに戻る') }}
        </Link>
      </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
      <p class="body-sm">© {{ new Date().getFullYear() }} Mandraguna. All rights reserved.</p>
    </footer>
  </div>
</template>

<script setup>
import { computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import { useLanguage } from '@/composables/useLanguage';

const props = defineProps({
    status: Number
});

const { locale, setLocale, t } = useLanguage();

const pageTitle = computed(() => {
    if (props.status === 429) {
        return t('Terlalu Banyak Permintaan', 'Too Many Requests', 'リクエストが多すぎます');
    }
    return t('Halaman Tidak Ditemukan', 'Page Not Found', 'ページが見つかりません');
});

const errorTitle = computed(() => {
    if (props.status === 429) {
        return t('Terlalu Banyak Percobaan Masuk', 'Too Many Login Attempts', 'ログインの試行回数が多すぎます');
    }
    return t('Halaman Tidak Ditemukan', 'Page Not Found', 'ページが見つかりません');
});

const errorDescription = computed(() => {
    if (props.status === 429) {
        return t(
            'Untuk menjaga keamanan sistem, silakan tunggu beberapa menit sebelum mencoba masuk kembali.',
            'To maintain system security, please wait a few minutes before trying to login again.',
            'システムセキュリティを維持するため、再試行する前に数分間お待ちください。'
        );
    }
    return t(
        'Maaf, halaman yang Anda cari tidak tersedia, dihapus, atau alamat URL yang dimasukkan salah.',
        'Sorry, the page you are looking for is not available, has been removed, or the URL entered is incorrect.',
        '申し訳ありませんが、お探しのページは利用できないか、削除されたか、入力されたURLが正しくありません。'
    );
});

function toggleLang() {
    if (locale.value === 'id') {
        setLocale('en');
    } else if (locale.value === 'en') {
        setLocale('ja');
    } else {
        setLocale('id');
    }
}
</script>

<style scoped>
.error-page {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    background: radial-gradient(circle at 50% 40%, #1e1b15 0%, #111111 80%, #080808 100%);
    color: var(--color-pure-white);
    font-family: var(--font-body);
    position: relative;
    overflow: hidden;
    padding: 0 24px;
}

.top-accent {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--color-primary-container) 0%, #ffdea0 50%, var(--color-primary) 100%);
    z-index: 10;
}

/* Header */
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 24px 0;
    max-width: var(--container-max);
    width: 100%;
    margin: 0 auto;
    z-index: 5;
}

.brand-link {
    display: flex;
    align-items: center;
    gap: 12px;
}

.brand-icon {
    width: 32px;
    height: 32px;
    background: var(--color-primary-container);
    color: var(--color-earth-black);
    border-radius: var(--rounded);
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: var(--font-headline);
    font-weight: 800;
    font-size: 16px;
    box-shadow: 0 0 12px rgba(218, 165, 32, 0.4);
}

.brand-name {
    font-family: var(--font-headline);
    font-size: 16px;
    font-weight: 800;
    letter-spacing: 0.15em;
    color: var(--color-pure-white);
}

.lang-switch {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    padding: 6px 12px;
    border-radius: var(--rounded-md);
    color: rgba(255, 255, 255, 0.8);
    font-size: 13px;
    font-weight: 600;
    font-family: var(--font-label);
    transition: all var(--transition-fast);
}

.lang-switch:hover {
    background: rgba(255, 255, 255, 0.1);
    color: var(--color-pure-white);
    border-color: var(--color-primary-container);
}

/* Main Content */
.main-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    max-width: 600px;
    margin: 40px auto;
    z-index: 5;
}

/* Illustration & typography */
.error-illustration {
    position: relative;
    width: 220px;
    height: 220px;
    margin-bottom: 24px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.organic-svg {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
}

.rotating-ring {
    transform-origin: center;
    animation: rotate 30s linear infinite;
}

.status-code {
    font-family: var(--font-headline);
    font-size: 72px;
    font-weight: 900;
    background: linear-gradient(135deg, #ffffff 30%, var(--color-primary-fixed-dim) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    letter-spacing: -2px;
    margin-top: 10px;
    z-index: 2;
    text-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
}

.title {
    font-family: var(--font-headline);
    font-size: 32px;
    font-weight: 700;
    color: var(--color-primary-fixed-dim);
    margin-bottom: 12px;
    letter-spacing: -0.5px;
    animation: fadeInUp 0.8s ease forwards;
}

.description {
    font-size: 16px;
    line-height: 26px;
    color: rgba(255, 255, 255, 0.7);
    margin-bottom: 36px;
    font-weight: 400;
    animation: fadeInUp 1s ease forwards;
}

/* Actions */
.cta-actions {
    display: flex;
    gap: 16px;
    justify-content: center;
    flex-wrap: wrap;
    animation: fadeInUp 1.2s ease forwards;
}

.btn-large {
    padding: 14px 28px;
    font-size: 15px;
}

.btn-ghost-light {
    background: rgba(255, 255, 255, 0.03);
    color: rgba(255, 255, 255, 0.9);
    border: 1px solid rgba(255, 255, 255, 0.15);
    padding: 12px 24px;
    font-family: var(--font-label);
    font-size: 14px;
    font-weight: 600;
    line-height: 20px;
    border-radius: var(--rounded);
    transition: all var(--transition-base);
    white-space: nowrap;
}

.btn-ghost-light:hover {
    background: rgba(255, 255, 255, 0.08);
    color: var(--color-pure-white);
    border-color: var(--color-primary-fixed-dim);
    box-shadow: 0 0 15px rgba(255, 255, 255, 0.05);
}

/* Footer */
.footer {
    padding: 24px 0;
    text-align: center;
    color: rgba(255, 255, 255, 0.4);
    font-size: 13px;
    width: 100%;
}

/* Keyframes / Animations */
@keyframes rotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* SVG Animations */
.grow-stem {
    stroke-dasharray: 50;
    stroke-dashoffset: 50;
    animation: draw 1.5s ease-out forwards;
}

.leaf-left {
    transform-origin: 50px 58px;
    transform: scale(0);
    animation: scaleIn 0.8s ease-out 0.8s forwards;
}

.leaf-right {
    transform-origin: 50px 50px;
    transform: scale(0);
    animation: scaleIn 0.8s ease-out 1s forwards;
}

.spore {
    opacity: 0;
}
.spore-1 { animation: floatSpore 3s ease-in-out infinite 1.2s; }
.spore-2 { animation: floatSpore 4s ease-in-out infinite 1.5s; }
.spore-3 { animation: floatSpore 3.5s ease-in-out infinite 1s; }

@keyframes draw {
    to { stroke-dashoffset: 0; }
}

@keyframes scaleIn {
    to { transform: scale(1); }
}

@keyframes floatSpore {
    0% { opacity: 0; transform: translateY(0) scale(0.8); }
    50% { opacity: 0.8; }
    100% { opacity: 0; transform: translateY(-15px) scale(1.2); }
}

@media (max-width: 768px) {
    .title {
        font-size: 26px;
    }
    .description {
        font-size: 15px;
        line-height: 24px;
        margin-bottom: 28px;
    }
    .cta-actions {
        flex-direction: column;
        width: 100%;
        gap: 12px;
        padding: 0 20px;
    }
    .btn {
        width: 100%;
    }
}
</style>
