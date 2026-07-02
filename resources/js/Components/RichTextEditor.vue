<template>
  <div class="rich-text-editor-container">
    <div ref="editorEl" class="editor-element"></div>
  </div>
</template>

<script setup>
import { onMounted, ref, watch } from 'vue';

const props = defineProps({
  modelValue: { type: String, default: '' }
});

const emit = defineEmits(['update:modelValue']);
const editorEl = ref(null);
let quill = null;

// Dynamic load Quill from CDN
const loadQuill = () => {
  return new Promise((resolve) => {
    if (window.Quill) {
      resolve(window.Quill);
      return;
    }

    // Load CSS
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = 'https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css';
    document.head.appendChild(link);

    // Load JS
    const script = document.createElement('script');
    script.src = 'https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js';
    script.onload = () => {
      resolve(window.Quill);
    };
    document.head.appendChild(script);
  });
};

onMounted(async () => {
  const Quill = await loadQuill();
  
  quill = new Quill(editorEl.value, {
    theme: 'snow',
    placeholder: 'Tulis konten di sini...',
    modules: {
      toolbar: [
        [{ 'header': [1, 2, 3, 4, false] }],
        ['bold', 'italic', 'underline', 'strike'],
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        ['link', 'image', 'video'],
        ['clean']
      ]
    }
  });

  // Set initial content
  if (props.modelValue) {
    quill.root.innerHTML = props.modelValue;
  }

  // Watch content changes
  quill.on('text-change', () => {
    const html = quill.root.innerHTML;
    // If it's just an empty paragraph, send empty string
    if (html === '<p><br></p>') {
      emit('update:modelValue', '');
    } else {
      emit('update:modelValue', html);
    }
  });

  // Watch external value changes
  watch(() => props.modelValue, (newVal) => {
    if (quill && quill.root.innerHTML !== newVal) {
      if (newVal === '' || newVal === null) {
        quill.root.innerHTML = '<p><br></p>';
      } else {
        quill.root.innerHTML = newVal;
      }
    }
  });
});
</script>

<style>
.rich-text-editor-container {
  background: white;
  border-radius: var(--rounded-sm);
  display: flex;
  flex-direction: column;
}
.ql-toolbar.ql-snow {
  border: 1px solid var(--color-border) !important;
  border-top-left-radius: var(--rounded-sm);
  border-top-right-radius: var(--rounded-sm);
  background: var(--color-surface-container-low);
}
.ql-container.ql-snow {
  border: 1px solid var(--color-border) !important;
  border-top: none !important;
  border-bottom-left-radius: var(--rounded-sm);
  border-bottom-right-radius: var(--rounded-sm);
  min-height: 300px;
  font-family: var(--font-body) !important;
  font-size: 15px !important;
}
.ql-editor {
  min-height: 300px;
}
</style>
