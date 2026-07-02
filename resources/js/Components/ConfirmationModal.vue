<template>
  <Transition name="fade">
    <div v-if="show" class="modal-backdrop" @click="handleCancel">
      <Transition name="zoom">
        <div v-if="show" class="modal-container" @click.stop>
          <div class="modal-header">
            <div class="icon-wrapper" :class="confirmType">
              <svg v-if="confirmType === 'danger'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="modal-icon">
                <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                <line x1="12" y1="9" x2="12" y2="13"/>
                <line x1="12" y1="17" x2="12.01" y2="17"/>
              </svg>
              <svg v-else viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="modal-icon">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="16" x2="12" y2="12"/>
                <line x1="12" y1="8" x2="12.01" y2="8"/>
              </svg>
            </div>
            <h3 class="modal-title">{{ title }}</h3>
          </div>
          <div class="modal-body">
            <p>{{ message }}</p>
          </div>
          <div class="modal-footer">
            <button @click="handleCancel" class="btn btn-ghost" :disabled="loading">
              {{ cancelText }}
            </button>
            <button @click="handleConfirm" :class="['btn', confirmButtonClass]" :disabled="loading">
              <span v-if="loading" class="spinner"></span>
              <span v-else>{{ confirmText }}</span>
            </button>
          </div>
        </div>
      </Transition>
    </div>
  </Transition>
</template>

<script setup>
import { onMounted, onUnmounted } from 'vue';

const props = defineProps({
  show: { type: Boolean, required: true },
  title: { type: String, default: 'Konfirmasi Tindakan' },
  message: { type: String, default: 'Apakah Anda yakin ingin melakukan tindakan ini?' },
  confirmText: { type: String, default: 'Yakin' },
  cancelText: { type: String, default: 'Batal' },
  confirmType: { type: String, default: 'danger' }, // 'danger' | 'info' | 'warning'
  loading: { type: Boolean, default: false }
});

const emit = defineEmits(['confirm', 'cancel']);

const confirmButtonClass = props.confirmType === 'danger' ? 'btn-danger' : (props.confirmType === 'warning' ? 'btn-gold' : 'btn-primary');

function handleConfirm() {
  emit('confirm');
}

function handleCancel() {
  if (!props.loading) {
    emit('cancel');
  }
}

// Handle ESC key to close modal
function handleKeyDown(e) {
  if (e.key === 'Escape' && props.show) {
    handleCancel();
  }
}

onMounted(() => {
  window.addEventListener('keydown', handleKeyDown);
});

onUnmounted(() => {
  window.removeEventListener('keydown', handleKeyDown);
});
</script>

<style scoped>
.modal-backdrop {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.6);
  backdrop-filter: blur(4px);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 9999;
}

.modal-container {
  background: var(--color-surface-white);
  border-radius: var(--rounded-lg);
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
  width: 100%;
  max-width: 440px;
  overflow: hidden;
  border: 1px solid var(--color-border);
  padding: var(--space-lg);
  display: flex;
  flex-direction: column;
  gap: var(--space-md);
}

.modal-header {
  display: flex;
  align-items: center;
  gap: var(--space-md);
}

.icon-wrapper {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 44px;
  height: 44px;
  border-radius: var(--rounded-full);
  flex-shrink: 0;
}

.icon-wrapper.danger {
  background-color: #fee2e2;
  color: #ef4444;
}

.icon-wrapper.warning {
  background-color: #fef3c7;
  color: #f59e0b;
}

.icon-wrapper.info {
  background-color: #dbeafe;
  color: #3b82f6;
}

.modal-icon {
  width: 24px;
  height: 24px;
}

.modal-title {
  font-family: var(--font-headline);
  font-size: 18px;
  font-weight: 600;
  color: var(--color-on-surface);
}

.modal-body {
  font-family: var(--font-body);
  font-size: 14px;
  color: var(--color-on-surface-variant);
  line-height: 1.5;
}

.modal-footer {
  display: flex;
  justify-content: flex-end;
  gap: var(--space-sm);
  margin-top: var(--space-sm);
}

.btn {
  font-family: var(--font-label);
  font-weight: 600;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}

/* Spinner for loading state */
.spinner {
  width: 16px;
  height: 16px;
  border: 2px solid rgba(255, 255, 255, 0.3);
  border-radius: 50%;
  border-top-color: white;
  animation: spin 0.8s linear infinite;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

/* Transitions */
.fade-enter-active,
.fade-leave-active {
  transition: opacity var(--transition-base);
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

.zoom-enter-active,
.zoom-leave-active {
  transition: transform var(--transition-base), opacity var(--transition-base);
}

.zoom-enter-from,
.zoom-leave-to {
  transform: scale(0.95);
  opacity: 0;
}
</style>
