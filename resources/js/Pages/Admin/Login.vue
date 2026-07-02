<template>
  <Head title="Admin Login" />
  <div class="login-page">
    <div class="login-card">
      <div class="login-brand">
        <img :src="logoUrl" :alt="siteName" class="login-logo" />
      </div>

      <form @submit.prevent="submit" class="login-form">
        <div class="form-group">
          <label class="form-label" for="email">Email</label>
          <input id="email" type="email" class="form-input" v-model="form.email" :class="{ error: form.errors.email }" placeholder="username" autofocus required />
          <p v-if="form.errors.email" class="form-error">{{ form.errors.email }}</p>
        </div>

        <div class="form-group">
          <label class="form-label" for="password">Password</label>
          <input id="password" type="password" class="form-input" v-model="form.password" :class="{ error: form.errors.password }" placeholder="password" required />
          <p v-if="form.errors.password" class="form-error">{{ form.errors.password }}</p>
        </div>

        <div class="form-group" style="margin-bottom: 20px;">
          <label class="form-label" for="captcha" style="display: block; margin-bottom: 8px;">Kode Keamanan (Captcha)</label>
          <div style="display: flex; gap: 12px; align-items: center;">
            <div style="flex-shrink: 0; display: flex; align-items: center; background: rgba(255, 255, 255, 0.08); border-radius: var(--rounded-md); overflow: hidden; border: 1px solid rgba(255, 255, 255, 0.15); height: 46px;">
              <img :src="currentCaptchaImage" alt="Captcha" style="height: 100%; width: auto;" />
            </div>
            <button type="button" @click="refreshCaptcha" class="btn-refresh" :disabled="refreshing" style="background: none; border: 1px solid rgba(255, 255, 255, 0.15); border-radius: var(--rounded-md); padding: 0 12px; height: 46px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all var(--transition-base); color: white;" title="Perbarui Kode">
              <span v-if="refreshing" style="display: inline-block; width: 16px; height: 16px; border: 2px solid rgba(255,255,255,0.3); border-top-color: white; border-radius: 50%; animation: spin 1s linear infinite;"></span>
              <span v-else style="font-size: 18px;">🔄</span>
            </button>
            <input id="captcha" type="text" class="form-input" v-model="form.captcha" placeholder="kode captcha" style="height: 46px; margin: 0; flex-grow: 1;" required autocomplete="off" />
          </div>
          <p v-if="form.errors.captcha" class="form-error">{{ form.errors.captcha }}</p>
        </div>

        <div class="form-group" style="display: flex; align-items: center; gap: 8px; margin-bottom: 20px;">
          <input type="checkbox" id="remember" v-model="form.remember" />
          <label for="remember" style="font-size: 14px; cursor: pointer; color: rgba(255, 255, 255, 0.85);">Ingat saya</label>
        </div>

        <button type="submit" class="btn btn-gold" style="width: 100%; margin-top: 8px;" :disabled="form.processing">
          {{ form.processing ? 'Memproses...' : 'Masuk' }}
        </button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, watch, computed } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';

const props = defineProps({
    captcha_image: String,
});

const currentCaptchaImage = ref(props.captcha_image);
const refreshing = ref(false);

watch(() => props.captcha_image, (newVal) => {
    currentCaptchaImage.value = newVal;
});

async function refreshCaptcha() {
    if (refreshing.value) return;
    refreshing.value = true;
    try {
        const response = await fetch('/captcha/refresh-login');
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

const page = usePage();
const form = useForm({
    email: '',
    password: '',
    captcha: '',
    remember: false,
});

const logoUrl = computed(() => {
    const logo = page.props.settings?.general?.company_logo;
    return logo ? `/storage/${logo}` : '/images/logo.png';
});

const siteName = computed(() => {
    return page.props.settings?.general?.site_name || 'Mandraguna';
});

function submit() {
    form.post('/cms-login', {
        onFinish: () => form.reset('password'),
        onError: () => refreshCaptcha(),
    });
}
</script>

<style scoped>
.login-page {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--color-earth-black) 0%, #2a2a2a 50%, var(--color-earth-black) 100%);
    padding: 20px;
}

.login-card {
    width: 100%;
    max-width: 420px;
    background: rgba(26, 26, 26, 0.85);
    border: 1px solid rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border-radius: var(--rounded-lg);
    padding: 48px 40px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
}

.login-brand {
    text-align: center;
    margin-bottom: 36px;
}

.login-logo {
    height: 60px;
    width: auto;
    object-fit: contain;
    margin: 0 auto;
}

.login-form {
    display: flex;
    flex-direction: column;
}

.form-label {
    color: rgba(255, 255, 255, 0.7) !important;
}

.form-input {
    background-color: rgba(255, 255, 255, 0.05) !important;
    border: 1px solid rgba(255, 255, 255, 0.12) !important;
    color: #ffffff !important;
}

.form-input:focus {
    border-color: var(--color-harvest-gold) !important;
    box-shadow: 0 0 0 3px rgba(229, 176, 70, 0.25) !important;
}

.form-input::placeholder {
    color: rgba(255, 255, 255, 0.3) !important;
}

.form-input.error {
    border-color: var(--color-error) !important;
}
</style>
