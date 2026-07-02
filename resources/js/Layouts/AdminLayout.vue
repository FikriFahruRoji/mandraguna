<template>
  <div class="admin-layout">
    <!-- Sidebar -->
    <aside class="sidebar" :class="{ collapsed: sidebarCollapsed }">
      <div class="sidebar-brand">
        <img :src="logoUrl" :alt="siteName" class="brand-logo" />
      </div>

      <nav class="sidebar-nav">
        <Link :href="'/panel-umkm'" class="nav-item" :class="{ active: isActive('/panel-umkm', true) }">
          <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
          <span v-if="!sidebarCollapsed">Dashboard</span>
        </Link>

        <Link href="/panel-umkm/posts" class="nav-item" :class="{ active: isActive('/panel-umkm/posts') }">
          <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><path d="M16 8h2"></path><path d="M16 12h2"></path><path d="M16 16h2"></path><path d="M6 8h6v8H6z"></path></svg>
          <span v-if="!sidebarCollapsed">Berita</span>
        </Link>

        <Link href="/panel-umkm/field-stories" class="nav-item" :class="{ active: isActive('/panel-umkm/field-stories') }">
          <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
          <span v-if="!sidebarCollapsed">Kabar Lapangan</span>
        </Link>

        <Link href="/panel-umkm/messages" class="nav-item" :class="{ active: isActive('/panel-umkm/messages') }">
          <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
          <span v-if="!sidebarCollapsed">Pesan</span>
          <span v-if="unreadCount > 0 && !sidebarCollapsed" class="nav-badge">{{ unreadCount }}</span>
        </Link>

        <div class="nav-item-group">
          <Link href="/panel-umkm/settings?group=general" class="nav-item" :class="{ active: isActive('/panel-umkm/settings') }">
            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-2 2 2 2 0 01-2-2v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83 0 2 2 0 010-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 01-2-2 2 2 0 012-2h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 010-2.83 2 2 0 012.83 0l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 012-2 2 2 0 012 2v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 0 2 2 0 010 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 012 2 2 2 0 01-2 2h-.09a1.65 1.65 0 00-1.51 1z"/></svg>
            <span v-if="!sidebarCollapsed">Pengaturan</span>
          </Link>
          <div v-if="isActive('/panel-umkm/settings') && !sidebarCollapsed" class="nav-sub-items">
            <Link href="/panel-umkm/settings?group=general" class="nav-sub-item" :class="{ active: isSubActive('general') }">
              Umum
            </Link>
            <Link href="/panel-umkm/settings?group=slides" class="nav-sub-item" :class="{ active: isSubActive('slides') }">
              Banner Slides
            </Link>
            <Link href="/panel-umkm/settings?group=homepage" class="nav-sub-item" :class="{ active: isSubActive('homepage') }">
              Konten Beranda
            </Link>
            <Link href="/panel-umkm/settings?group=about_page" class="nav-sub-item" :class="{ active: isSubActive('about_page') }">
              Tentang Kami
            </Link>
            <Link href="/panel-umkm/settings?group=product_page" class="nav-sub-item" :class="{ active: isSubActive('product_page') }">
              Halaman Produk
            </Link>
            <Link href="/panel-umkm/settings?group=sustainability" class="nav-sub-item" :class="{ active: isSubActive('sustainability') }">
              Keberlanjutan
            </Link>
            <Link href="/panel-umkm/settings?group=contact" class="nav-sub-item" :class="{ active: isSubActive('contact') }">
              Kontak & Sosial
            </Link>
          </div>
        </div>
      </nav>

      <div class="sidebar-footer">
        <a href="/" target="_blank" class="nav-item">
          <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
          <span v-if="!sidebarCollapsed">Lihat Website</span>
        </a>
      </div>
    </aside>

    <!-- Main Content -->
    <div class="main-wrapper">
      <!-- Top Bar -->
      <header class="topbar">
        <button class="toggle-btn" @click="sidebarCollapsed = !sidebarCollapsed">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
        </button>

        <div class="topbar-right">
          <span class="topbar-user">{{ $page.props.auth?.user?.name }}</span>
          <Link href="/cms-logout" method="post" as="button" class="btn btn-ghost btn-sm">
            Logout
          </Link>
        </div>
      </header>

      <!-- Flash Messages -->
      <div class="main-content">
        <div v-if="$page.props.flash?.success" class="alert alert-success">
          ✓ {{ $page.props.flash.success }}
        </div>
        <div v-if="$page.props.flash?.error" class="alert alert-error">
          ✕ {{ $page.props.flash.error }}
        </div>

        <Transition name="page-fade" mode="out-in" appear>
          <div :key="page.url">
            <slot />
          </div>
        </Transition>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const sidebarCollapsed = ref(false);
const page = usePage();

const logoUrl = computed(() => {
    const logo = page.props.settings?.general?.company_logo;
    return logo ? `/storage/${logo}` : '/images/logo.png';
});

const siteName = computed(() => {
    return page.props.settings?.general?.site_name || 'Mandraguna';
});

const unreadCount = computed(() => {
    // This would need to be passed from middleware or a shared prop
    return 0;
});

function isActive(path, exact = false) {
    const currentUrl = page.url;
    if (exact) {
        return currentUrl === path;
    }
    return currentUrl.startsWith(path);
}

function isSubActive(groupName) {
    const currentUrl = page.url;
    if (groupName === 'general') {
        return currentUrl === '/panel-umkm/settings' || currentUrl.includes('group=general');
    }
    return currentUrl.includes(`group=${groupName}`);
}
</script>

<style scoped>
.admin-layout {
    display: flex;
    min-height: 100vh;
    background-color: var(--color-background);
}

/* Sidebar */
.sidebar {
    width: 260px;
    background-color: var(--color-earth-black);
    color: var(--color-pure-white);
    display: flex;
    flex-direction: column;
    transition: width var(--transition-base);
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    z-index: 100;
    overflow-x: hidden;
}

.sidebar.collapsed {
    width: 72px;
}

.sidebar-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 20px 20px;
    border-bottom: 1px solid rgba(255,255,255,0.08);
}

.brand-logo {
    height: 32px;
    width: auto;
    object-fit: contain;
    transition: all var(--transition-base);
}

.sidebar.collapsed .brand-logo {
    width: 32px;
    height: 32px;
    object-fit: cover;
    object-position: left center;
}

.sidebar-nav {
    flex: 1;
    padding: 12px 8px;
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.nav-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 14px;
    border-radius: var(--rounded-md);
    color: rgba(255,255,255,0.65);
    font-size: 14px;
    font-weight: 500;
    transition: all var(--transition-fast);
    white-space: nowrap;
    text-decoration: none;
}

.nav-item:hover {
    background: rgba(255,255,255,0.08);
    color: var(--color-pure-white);
}

.nav-item.active {
    background: rgba(218, 165, 32, 0.15);
    color: var(--color-primary-container);
}

.nav-icon {
    width: 20px;
    height: 20px;
    flex-shrink: 0;
}

.nav-badge {
    margin-left: auto;
    background: var(--color-error);
    color: white;
    font-size: 11px;
    font-weight: 700;
    padding: 2px 7px;
    border-radius: var(--rounded-full);
}

.sidebar-footer {
    padding: 12px 8px;
    border-top: 1px solid rgba(255,255,255,0.08);
}

/* Submenu navigation settings */
.nav-sub-items {
    display: flex;
    flex-direction: column;
    gap: 4px;
    padding: 4px 0 8px 38px;
}

.nav-sub-item {
    color: rgba(255, 255, 255, 0.55);
    font-size: 13px;
    font-weight: 500;
    padding: 6px 12px;
    border-radius: var(--rounded-sm);
    text-decoration: none;
    transition: all var(--transition-fast);
}

.nav-sub-item:hover {
    color: var(--color-pure-white);
    background: rgba(255, 255, 255, 0.05);
}

.nav-sub-item.active {
    color: var(--color-primary-container);
    background: rgba(218, 165, 32, 0.1);
    font-weight: 600;
}

/* Main */
.main-wrapper {
    flex: 1;
    margin-left: 260px;
    transition: margin-left var(--transition-base);
}

.sidebar.collapsed ~ .main-wrapper {
    margin-left: 72px;
}

.topbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 32px;
    height: 64px;
    background: var(--color-surface-white);
    border-bottom: 1px solid var(--color-border);
    position: sticky;
    top: 0;
    z-index: 50;
}

.toggle-btn {
    padding: 8px;
    border-radius: var(--rounded);
    color: var(--color-on-surface-variant);
}

.toggle-btn:hover {
    background: var(--color-surface-container);
}

.topbar-right {
    display: flex;
    align-items: center;
    gap: 16px;
}

.topbar-user {
    font-size: 14px;
    font-weight: 500;
    color: var(--color-on-surface);
}

.main-content {
    padding: 32px;
    max-width: 1200px;
}

@media (max-width: 768px) {
    .sidebar {
        transform: translateX(-100%);
    }
    .main-wrapper {
        margin-left: 0;
    }
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
