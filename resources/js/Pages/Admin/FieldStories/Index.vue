<template>
  <Head title="Kelola Kabar Lapangan" />
  <AdminLayout>
    <div>
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <h1 class="headline-md">Kabar dari Lapangan</h1>
        <Link href="/panel-umkm/field-stories/create" class="btn btn-gold">+ Tambah Kabar</Link>
      </div>

      <div class="card" style="padding: 0; overflow: hidden;">
        <table class="data-table" v-if="fieldStories.length > 0">
          <thead>
            <tr>
              <th>Judul</th>
              <th>Status</th>
              <th>Views</th>
              <th>Tanggal</th>
              <th style="text-align: right;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="story in fieldStories" :key="story.id">
              <td><strong>{{ story.title }}</strong></td>
              <td>
                <span :class="['badge', story.is_published ? 'badge-success' : 'badge-warning']">
                  {{ story.is_published ? 'Published' : 'Draft' }}
                </span>
              </td>
              <td>{{ story.views }}</td>
              <td>{{ formatDate(story.created_at) }}</td>
              <td style="text-align: right;">
                <div style="display: flex; gap: 8px; justify-content: flex-end;">
                  <Link :href="'/panel-umkm/field-stories/' + story.id + '/edit'" class="btn btn-ghost btn-sm">Edit</Link>
                  <button @click="deleteStory(story)" class="btn btn-danger btn-sm">Hapus</button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>

        <div v-else style="text-align: center; padding: 48px; color: var(--color-on-surface-variant);">
          Belum ada kabar lapangan. Klik "Tambah Kabar" untuk memulai.
        </div>
      </div>
    </div>

    <!-- Custom Confirmation Modal -->
    <ConfirmationModal
      :show="showConfirmModal"
      title="Hapus Kabar Lapangan"
      :message="storyToDelete ? `Apakah Anda yakin ingin menghapus kabar &quot;${storyToDelete.title}&quot;? Tindakan ini tidak dapat dibatalkan.` : ''"
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

defineProps({ fieldStories: Array });

const showConfirmModal = ref(false);
const storyToDelete = ref(null);
const isDeleting = ref(false);

function formatDate(d) {
    return new Date(d).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
}

function deleteStory(story) {
    storyToDelete.value = story;
    showConfirmModal.value = true;
}

function handleConfirmDelete() {
    if (storyToDelete.value) {
        isDeleting.value = true;
        router.delete(`/panel-umkm/field-stories/${storyToDelete.value.id}`, {
            onFinish: () => {
                showConfirmModal.value = false;
                storyToDelete.value = null;
                isDeleting.value = false;
            }
        });
    }
}
</script>
