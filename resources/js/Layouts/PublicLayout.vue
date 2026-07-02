<template>
  <div class="public-layout">
    <!-- Navigation -->
    <header class="navbar">
      <div class="container nav-container">
        <Link href="/" class="nav-brand">
          <img :src="logoUrl" :alt="siteName" class="nav-logo" />
        </Link>

        <nav class="nav-links" :class="{ open: mobileMenuOpen }">
          <Link href="/" class="nav-link" :class="{ active: isActive('/') }">{{ t('Beranda', 'Home', 'ホーム') }}</Link>
          <Link href="/about" class="nav-link" :class="{ active: isActive('/about') }">{{ t('Tentang Kami', 'About Us', '私たちについて') }}</Link>
          <Link href="/products" class="nav-link" :class="{ active: isActive('/products') }">{{ t('Produk', 'Products', '製品') }}</Link>
          <Link href="/sustainability" class="nav-link" :class="{ active: isActive('/sustainability') }">{{ t('Keberlanjutan', 'Sustainability', 'サステナビリティ') }}</Link>
          <Link href="/news" class="nav-link" :class="{ active: isActive('/news') }">{{ t('Berita', 'News', 'ニュース') }}</Link>
          <Link href="/contact" class="nav-link cta-link" :class="{ active: isActive('/contact') }">{{ t('Hubungi Kami', 'Contact Us', 'お問い合わせ') }}</Link>
        </nav>

        <div class="lang-switcher">
          <button @click="setLocale('id')" class="lang-btn" :class="{ active: locale === 'id' }" title="Bahasa Indonesia">ID</button>
          <span class="lang-divider">|</span>
          <button @click="setLocale('en')" class="lang-btn" :class="{ active: locale === 'en' }" title="English">EN</button>

        </div>

        <button class="mobile-toggle" @click="mobileMenuOpen = !mobileMenuOpen" aria-label="Toggle menu">
          <span></span><span></span><span></span>
        </button>
      </div>
    </header>

    <!-- Page Content -->
    <main>
      <Transition name="page-fade" mode="out-in" appear>
        <div :key="page.url">
          <slot />
        </div>
      </Transition>
    </main>

    <!-- Footer -->
    <footer class="footer">
      <div class="container">
        <div class="footer-grid">
          <div class="footer-brand">
            <div class="footer-logo">
              <img :src="logoUrl" :alt="siteName" class="footer-logo-img" />
            </div>
            <p class="footer-desc">
              {{ t('Inovasi pupuk organik kaya asam amino dari pemanfaatan limbah penyamakan kulit sapi. Solusi pertanian berkelanjutan.', 'Innovative amino-acid-rich organic fertilizer derived from cattle tannery waste. Sustainable agricultural solutions.', '牛革鞣し工場の廃棄物を有効活用した、アミノ酸豊富な革新的有機肥料。持続可能な農業ソリューション。') }}
            </p>
          </div>

          <div class="footer-links-group">
            <h4 class="footer-heading">{{ t('Navigasi', 'Navigation', 'ナビゲーション') }}</h4>
            <Link href="/" class="footer-link">{{ t('Beranda', 'Home', 'ホーム') }}</Link>
            <Link href="/about" class="footer-link">{{ t('Tentang Kami', 'About Us', '私たちについて') }}</Link>
            <Link href="/products" class="footer-link">{{ t('Produk', 'Products', '製品') }}</Link>
            <Link href="/sustainability" class="footer-link">{{ t('Keberlanjutan', 'Sustainability', 'サステナビリティ') }}</Link>
          </div>

          <div class="footer-links-group">
            <h4 class="footer-heading">{{ t('Informasi', 'Information', '情報') }}</h4>
            <Link href="/news" class="footer-link">{{ t('Berita & Media', 'News & Media', 'ニュース＆メディア') }}</Link>
            <Link href="/contact" class="footer-link">{{ t('Hubungi Kami', 'Contact Us', 'お問い合わせ') }}</Link>
          </div>

          <div class="footer-links-group">
            <h4 class="footer-heading">{{ t('Kontak', 'Contact', '連絡先') }}</h4>
            <p class="footer-text">{{ page.props.contact?.contact_email || 'info@mandraguna.com' }}</p>
            <p class="footer-text">{{ page.props.contact?.contact_phone || '+62 812 3456 7890' }}</p>
            <div class="footer-socials" style="display: flex; gap: 12px; margin-top: 16px;">
              <a v-if="page.props.contact?.social_instagram" :href="page.props.contact.social_instagram" target="_blank" class="social-icon-link" aria-label="Instagram">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
              </a>
              <a v-if="page.props.contact?.social_facebook" :href="page.props.contact.social_facebook" target="_blank" class="social-icon-link" aria-label="Facebook">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
              </a>
              <a v-if="page.props.contact?.social_youtube" :href="page.props.contact.social_youtube" target="_blank" class="social-icon-link" aria-label="YouTube">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"/><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"/></svg>
              </a>
              <a v-if="page.props.contact?.contact_whatsapp" :href="'https://wa.me/' + page.props.contact.contact_whatsapp" target="_blank" class="social-icon-link" aria-label="WhatsApp">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
              </a>
            </div>
          </div>
        </div>

        <div class="footer-bottom">
          <p>&copy; {{ new Date().getFullYear() }} Mandraguna. All rights reserved.</p>
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { useLanguage } from '@/composables/useLanguage';

const mobileMenuOpen = ref(false);
const page = usePage();
const { locale, setLocale, t } = useLanguage();

const logoUrl = computed(() => {
    const logo = page.props.settings?.general?.company_logo;
    return logo ? `/storage/${logo}` : '/images/logo.png';
});

const siteName = computed(() => {
    return page.props.settings?.general?.site_name || 'Mandraguna';
});

function isActive(path) {
    return page.url === path;
}
</script>

<style scoped>
.public-layout {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

/* ===== NAVBAR ===== */
.navbar {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
    padding: 12px 0;
    background: #120e06;
    border-bottom: 1px solid rgba(255, 255, 255, 0.06);
    box-shadow: 0 2px 16px rgba(0, 0, 0, 0.5);
}

.nav-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.nav-brand {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
}

.nav-logo {
    height: 44px;
    width: auto;
    object-fit: contain;
}

.footer-logo-img {
    height: 52px;
    width: auto;
    object-fit: contain;
}

.nav-links {
    display: flex;
    align-items: center;
    gap: 8px;
}

.nav-link {
    position: relative;
    padding: 8px 16px;
    font-family: var(--font-body);
    font-size: 14px;
    font-weight: 500;
    color: rgba(255, 255, 255, 0.80);
    border-radius: var(--rounded);
    transition: color 0.3s ease;
    text-decoration: none;
    z-index: 1;
}

.nav-link:not(.cta-link)::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.08);
    border-radius: var(--rounded);
    z-index: -1;
    transform: scaleX(0);
    transform-origin: right;
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.nav-link:not(.cta-link):hover::before,
.nav-link:not(.cta-link).active::before {
    transform: scaleX(1);
    transform-origin: left;
}

.nav-link:hover {
    color: var(--color-primary-container);
}

.nav-link.active:not(.cta-link) {
    color: var(--color-primary-container) !important;
    font-weight: 600;
}

.nav-link.cta-link {
    background: var(--color-primary-container);
    color: var(--color-earth-black);
    font-weight: 600;
    margin-left: 8px;
    overflow: hidden;
}

.nav-link.cta-link::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: var(--color-harvest-gold);
    transition: left 0.3s ease;
    z-index: -1;
}

.nav-link.cta-link:hover::after {
    left: 0;
}

.nav-link.cta-link:hover {
    color: var(--color-earth-black);
}

/* Mobile toggle */
.mobile-toggle {
    display: none;
    flex-direction: column;
    gap: 5px;
    padding: 8px;
}

.mobile-toggle span {
    width: 22px;
    height: 2px;
    background: rgba(255, 255, 255, 0.85);
    border-radius: 2px;
    transition: all var(--transition-fast);
}

@media (max-width: 768px) {
    .mobile-toggle { display: flex; }

    .nav-links {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: rgba(18, 14, 6, 0.97);
        flex-direction: column;
        padding: 16px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
    }

    .nav-links.open { display: flex; }

    .nav-link.cta-link {
        margin-left: 0;
        text-align: center;
    }
}

/* ===== FOOTER ===== */
.footer {
    background: var(--color-earth-black);
    color: rgba(255, 255, 255, 0.75);
    padding: 80px 0 0;
    margin-top: auto;
}

.footer-grid {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr;
    gap: 48px;
}

.footer-logo {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 16px;
}

.footer-logo-text {
    font-family: var(--font-headline);
    font-weight: 700;
    font-size: 20px;
    color: var(--color-pure-white);
}

.footer-desc {
    font-size: 14px;
    line-height: 22px;
    max-width: 320px;
}

.footer-heading {
    font-family: var(--font-label);
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--color-primary-container);
    margin-bottom: 16px;
}

.footer-link {
    display: block;
    font-size: 14px;
    color: rgba(255, 255, 255, 0.65);
    margin-bottom: 10px;
    transition: color var(--transition-fast);
    text-decoration: none;
}

.footer-link:hover { color: var(--color-pure-white); }

.footer-text {
    font-size: 14px;
    margin-bottom: 8px;
}

.footer-bottom {
    margin-top: 60px;
    padding: 24px 0;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    font-size: 13px;
    text-align: center;
    color: rgba(255, 255, 255, 0.4);
}

@media (max-width: 768px) {
    .footer-grid {
        grid-template-columns: 1fr;
        gap: 32px;
    }
    .footer { padding: 48px 0 0; }
    .footer-bottom { margin-top: 32px; }
    .lang-switcher {
        margin-left: auto;
        margin-right: 12px;
    }
}

/* ===== LANGUAGE SWITCHER ===== */
.lang-switcher {
    display: flex;
    align-items: center;
    gap: 4px;
    margin-left: 16px;
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.18);
    padding: 2px 6px;
    border-radius: 20px;
}

.lang-btn {
    background: none;
    border: none;
    font-family: var(--font-label);
    font-size: 11px;
    font-weight: 700;
    color: rgba(255, 255, 255, 0.6);
    cursor: pointer;
    padding: 3px 8px;
    border-radius: 12px;
    transition: all var(--transition-fast);
}

.lang-btn.active {
    color: var(--color-earth-black);
    background: var(--color-primary-container);
}

.lang-divider {
    color: rgba(255, 255, 255, 0.25);
    font-size: 10px;
}

.social-icon-link {
    color: rgba(255, 255, 255, 0.6);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.20s ease-in-out;
}

.social-icon-link:hover {
    color: var(--color-primary-container);
    transform: translateY(-2px);
}

/* ===== PAGE TRANSITION ===== */
.page-fade-enter-active,
.page-fade-leave-active {
    transition: opacity 0.2s ease, transform 0.2s ease;
}

.page-fade-enter-from {
    opacity: 0;
    transform: translateY(8px);
}

.page-fade-leave-to {
    opacity: 0;
    transform: translateY(-8px);
}
</style>
