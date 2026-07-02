<template>
  <Head title="Ganti Password" />
  <AdminLayout>
    <div style="max-width: 600px; margin: 0 auto;">
      <h1 class="headline-md" style="margin-bottom: 32px;">Ganti Password</h1>

      <form @submit.prevent="submit" class="card">
        <div class="form-group">
          <label class="form-label" for="current_password">Password Saat Ini</label>
          <input
            id="current_password"
            type="password"
            class="form-input"
            v-model="form.current_password"
            required
            autocomplete="current-password"
            placeholder="Masukkan password saat ini"
          />
          <p v-if="form.errors.current_password" class="form-error">{{ form.errors.current_password }}</p>
        </div>

        <div class="form-group">
          <label class="form-label" for="password">Password Baru</label>
          <input
            id="password"
            type="password"
            class="form-input"
            v-model="form.password"
            required
            autocomplete="new-password"
            placeholder="Masukkan password baru (min. 8 karakter)"
          />
          <p v-if="form.errors.password" class="form-error">{{ form.errors.password }}</p>
        </div>

        <div class="form-group">
          <label class="form-label" for="password_confirmation">Konfirmasi Password Baru</label>
          <input
            id="password_confirmation"
            type="password"
            class="form-input"
            v-model="form.password_confirmation"
            required
            autocomplete="new-password"
            placeholder="Ulangi password baru"
          />
          <p v-if="form.errors.password_confirmation" class="form-error">{{ form.errors.password_confirmation }}</p>
        </div>

        <div style="margin-top: 32px; display: flex; gap: 12px;">
          <button type="submit" class="btn btn-gold" :disabled="form.processing" style="padding: 12px 24px;">
            {{ form.processing ? 'Memproses...' : 'Ganti Password' }}
          </button>
          <Link href="/panel-umkm" class="btn btn-ghost" style="padding: 12px 24px;">Batal</Link>
        </div>
      </form>
    </div>
  </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

function submit() {
    form.post('/panel-umkm/change-password', {
        onSuccess: () => form.reset(),
    });
}
</script>

<style scoped>
.card {
    background-color: var(--color-surface-white);
    border: 1px solid var(--color-border);
    border-radius: var(--rounded);
    padding: var(--space-lg);
}

.form-group {
    margin-bottom: var(--space-md);
}

.form-label {
    display: block;
    font-family: var(--font-label);
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    color: var(--color-on-surface-variant);
    margin-bottom: var(--space-sm);
}

.form-input {
    width: 100%;
    padding: 10px 14px;
    font-size: 15px;
    line-height: 1.5;
    color: var(--color-on-surface);
    background-color: var(--color-surface-white);
    border: 1px solid var(--color-border);
    border-radius: var(--rounded);
    transition: border-color var(--transition-fast), box-shadow var(--transition-fast);
}

.form-input:focus {
    outline: none;
    border-color: var(--color-primary);
    box-shadow: 0 0 0 3px rgba(121, 89, 0, 0.1);
}

.form-error {
    font-size: 13px;
    color: var(--color-error);
    margin-top: 4px;
}
</style>
