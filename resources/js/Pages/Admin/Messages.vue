<template>
  <Head title="Pesan Masuk" />
  <AdminLayout>
    <div>
      <h1 class="headline-md" style="margin-bottom: 24px;">Pesan Masuk</h1>

      <div class="card" style="padding: 0; overflow: hidden;">
        <table class="data-table" v-if="messages.length > 0">
          <thead>
            <tr>
              <th>Pengirim</th>
              <th>Subjek</th>
              <th>Pesan</th>
              <th>Tanggal</th>
              <th>Status</th>
              <th style="text-align: right;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="msg in messages" :key="msg.id" :style="!msg.is_read ? 'font-weight: 600;' : ''">
              <td>
                {{ msg.name }}
                <br><small style="color: var(--color-on-surface-variant); font-weight: 400;">{{ msg.email }}</small>
              </td>
              <td>{{ msg.subject || '—' }}</td>
              <td style="max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ msg.message }}</td>
              <td>{{ formatDate(msg.created_at) }}</td>
              <td>
                <span :class="['badge', msg.is_read ? 'badge-info' : 'badge-warning']">{{ msg.is_read ? 'Dibaca' : 'Baru' }}</span>
              </td>
              <td style="text-align: right;">
                <div style="display: flex; gap: 8px; justify-content: flex-end;">
                  <Link :href="'/panel-umkm/messages/' + msg.id" class="btn btn-ghost btn-sm">Baca</Link>
                  <button @click="deleteMsg(msg)" class="btn btn-danger btn-sm">Hapus</button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>

        <div v-else style="text-align: center; padding: 48px; color: var(--color-on-surface-variant);">
          Belum ada pesan masuk.
        </div>
      </div>
    </div>

    <!-- Custom Confirmation Modal -->
    <ConfirmationModal
      :show="showConfirmModal"
      title="Hapus Pesan"
      :message="msgToDelete ? `Apakah Anda yakin ingin menghapus pesan dari &quot;${msgToDelete.name}&quot;? Tindakan ini tidak dapat dibatalkan.` : ''"
      confirm-text="Hapus"
      cancel-text="Batal"
      confirm-type="danger"
      :loading="isDeleting"
      @confirm="handleConfirmDelete"
      @cancel="showConfirmModal = false"
    />
  </AdminLayout>
</template>

<script setup>
import { ref } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import ConfirmationModal from '@/Components/ConfirmationModal.vue';
import { router } from '@inertiajs/vue3';

defineProps({ messages: Array });

const showConfirmModal = ref(false);
const msgToDelete = ref(null);
const isDeleting = ref(false);

function formatDate(d) {
    return new Date(d).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
}

function deleteMsg(msg) {
    msgToDelete.value = msg;
    showConfirmModal.value = true;
}

function handleConfirmDelete() {
    if (msgToDelete.value) {
        isDeleting.value = true;
        router.delete(`/panel-umkm/messages/${msgToDelete.value.id}`, {
            onFinish: () => {
                showConfirmModal.value = false;
                msgToDelete.value = null;
                isDeleting.value = false;
            }
        });
    }
}
</script>
