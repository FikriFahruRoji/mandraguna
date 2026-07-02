<template>
  <Head title="Detail Pesan" />
  <AdminLayout>
    <div>
      <div style="margin-bottom: 24px;">
        <Link href="/panel-umkm/messages" style="font-size: 14px; color: var(--color-on-surface-variant);">← Kembali ke Pesan Masuk</Link>
      </div>

      <div class="card">
        <div class="msg-header">
          <div>
            <h1 style="font-family: var(--font-headline); font-size: 22px; font-weight: 600;">{{ message.subject || '(Tanpa Subjek)' }}</h1>
            <p style="color: var(--color-on-surface-variant); font-size: 14px; margin-top: 4px;">
              Dari: <strong>{{ message.name }}</strong> — {{ message.email }}
              <span v-if="message.phone"> · {{ message.phone }}</span>
            </p>
          </div>
          <span class="label-caps" style="color: var(--color-on-surface-variant);">{{ formatDate(message.created_at) }}</span>
        </div>

        <hr style="border: none; border-top: 1px solid var(--color-border); margin: 20px 0;">

        <div style="white-space: pre-wrap; line-height: 1.7; font-size: 15px;">{{ message.message }}</div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';

defineProps({ message: Object });

function formatDate(d) {
    return new Date(d).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' });
}
</script>

<style scoped>
.msg-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}
</style>
