<template>
  <Head title="Dashboard" />
  <AdminLayout>
    <div class="dashboard">
      <h1 class="headline-md" style="margin-bottom: 32px;">Dashboard</h1>

      <!-- Stats Cards -->
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-icon" style="background: rgba(218,165,32,0.12); color: var(--color-primary);">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="22" height="22"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/></svg>
          </div>
          <div class="stat-info">
            <span class="stat-value">{{ stats.products }}</span>
            <span class="stat-label">Produk</span>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-icon" style="background: rgba(12,96,169,0.12); color: var(--color-tertiary);">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="22" height="22"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
          </div>
          <div class="stat-info">
            <span class="stat-value">{{ stats.posts }}</span>
            <span class="stat-label">Artikel</span>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-icon" style="background: rgba(45,106,79,0.12); color: var(--color-success);">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="22" height="22"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
          </div>
          <div class="stat-info">
            <span class="stat-value">{{ stats.published }}</span>
            <span class="stat-label">Terpublish</span>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-icon" :style="stats.unread > 0 ? 'background: rgba(186,26,26,0.12); color: var(--color-error);' : 'background: var(--color-surface-container); color: var(--color-on-surface-variant);'">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="22" height="22"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
          </div>
          <div class="stat-info">
            <span class="stat-value">{{ stats.unread }} <small style="font-size: 14px; color: var(--color-on-surface-variant);">/ {{ stats.messages }}</small></span>
            <span class="stat-label">Pesan Belum Dibaca</span>
          </div>
        </div>
      </div>

      <!-- Recent Messages -->
      <div class="card" style="margin-top: 32px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
          <h2 style="font-family: var(--font-headline); font-size: 20px; font-weight: 600;">Pesan Terbaru</h2>
          <Link href="/panel-umkm/messages" class="btn btn-ghost btn-sm">Lihat Semua →</Link>
        </div>

        <div v-if="recentMessages.length === 0" style="text-align: center; padding: 32px; color: var(--color-on-surface-variant);">
          Belum ada pesan masuk.
        </div>

        <table v-else class="data-table">
          <thead>
            <tr>
              <th>Pengirim</th>
              <th>Subjek</th>
              <th>Tanggal</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="msg in recentMessages" :key="msg.id">
              <td>
                <strong>{{ msg.name }}</strong>
                <br><small style="color: var(--color-on-surface-variant);">{{ msg.email }}</small>
              </td>
              <td>{{ msg.subject || '(Tanpa subjek)' }}</td>
              <td>{{ formatDate(msg.created_at) }}</td>
              <td>
                <span :class="['badge', msg.is_read ? 'badge-info' : 'badge-warning']">
                  {{ msg.is_read ? 'Dibaca' : 'Baru' }}
                </span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';

const props = defineProps({
    stats: Object,
    recentMessages: Array,
});

function formatDate(dateStr) {
    return new Date(dateStr).toLocaleDateString('id-ID', {
        day: 'numeric', month: 'short', year: 'numeric'
    });
}
</script>

<style scoped>
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}

.stat-card {
    background: var(--color-surface-white);
    border: 1px solid var(--color-border);
    border-radius: var(--rounded);
    padding: 24px;
    display: flex;
    align-items: center;
    gap: 16px;
}

.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: var(--rounded-md);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.stat-info {
    display: flex;
    flex-direction: column;
}

.stat-value {
    font-family: var(--font-headline);
    font-size: 28px;
    font-weight: 700;
    color: var(--color-on-surface);
    line-height: 1;
}

.stat-label {
    font-family: var(--font-label);
    font-size: 12px;
    font-weight: 500;
    color: var(--color-on-surface-variant);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-top: 4px;
}

@media (max-width: 1024px) {
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 640px) {
    .stats-grid { grid-template-columns: 1fr; }
}
</style>
