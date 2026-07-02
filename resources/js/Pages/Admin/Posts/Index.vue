<template>
  <Head title="Kelola Berita" />
  <AdminLayout>
    <div>
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <h1 class="headline-md">Berita & Artikel</h1>
        <Link href="/panel-umkm/posts/create" class="btn btn-gold">+ Tambah Artikel</Link>
      </div>

      <div class="card" style="padding: 0; overflow: hidden;">
        <table class="data-table" v-if="posts.length > 0">
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
            <tr v-for="post in posts" :key="post.id">
              <td><strong>{{ post.title }}</strong></td>
              <td>
                <span :class="['badge', post.is_published ? 'badge-success' : 'badge-warning']">
                  {{ post.is_published ? 'Published' : 'Draft' }}
                </span>
              </td>
              <td>{{ post.views }}</td>
              <td>{{ formatDate(post.created_at) }}</td>
              <td style="text-align: right;">
                <div style="display: flex; gap: 8px; justify-content: flex-end;">
                  <Link :href="'/panel-umkm/posts/' + post.id + '/edit'" class="btn btn-ghost btn-sm">Edit</Link>
                  <button @click="deletePost(post)" class="btn btn-danger btn-sm">Hapus</button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>

        <div v-else style="text-align: center; padding: 48px; color: var(--color-on-surface-variant);">
          Belum ada artikel. Klik "Tambah Artikel" untuk memulai.
        </div>
      </div>
    </div>

    <!-- Custom Confirmation Modal -->
    <ConfirmationModal
      :show="showConfirmModal"
      title="Hapus Berita & Artikel"
      :message="postToDelete ? `Apakah Anda yakin ingin menghapus artikel &quot;${postToDelete.title}&quot;? Tindakan ini tidak dapat dibatalkan.` : ''"
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

defineProps({ posts: Array });

const showConfirmModal = ref(false);
const postToDelete = ref(null);
const isDeleting = ref(false);

function formatDate(d) {
    return new Date(d).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
}

function deletePost(post) {
    postToDelete.value = post;
    showConfirmModal.value = true;
}

function handleConfirmDelete() {
    if (postToDelete.value) {
        isDeleting.value = true;
        router.delete(`/panel-umkm/posts/${postToDelete.value.id}`, {
            onFinish: () => {
                showConfirmModal.value = false;
                postToDelete.value = null;
                isDeleting.value = false;
            }
        });
    }
}
</script>
