<script setup lang="ts">
import { ref } from 'vue';

const STORAGE_KEY = 'ccop-cookie-banner';
const visible = ref(localStorage.getItem(STORAGE_KEY) !== 'accepted');

const accept = () => {
  localStorage.setItem(STORAGE_KEY, 'accepted');
  visible.value = false;
};
</script>

<template>
  <transition name="slide-up">
    <aside v-if="visible" class="cookie-banner" aria-live="polite">
      <p>
        Мы используем файлы cookie. В целях улучшения функционирования сайта и проведения статистических исследований
        данные пользователей обрабатываются с использованием сервиса Яндекс Метрика. Продолжая пользоваться сайтом,
        Вы соглашаетесь с использованием этих технологий. Вы можете отключить файлы cookie в настройках браузера.
      </p>
      <button type="button" class="button button--primary" @click="accept">Понятно</button>
    </aside>
  </transition>
</template>
