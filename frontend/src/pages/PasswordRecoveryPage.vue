<script setup lang="ts">
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();
const loginOrEmail = ref('');
const message = ref('');

const send = () => {
  if (!loginOrEmail.value.trim()) {
    message.value = 'Укажите логин или email.';
    return;
  }

  message.value = 'Контрольная строка для смены пароля и регистрационные данные будут высланы на ваш email.';
};

const goToLogin = () => {
  if (loginOrEmail.value.trim()) {
    router.push('/login');
  }
};
</script>

<template>
  <section class="auth-layout">
    <form class="auth-card" @submit.prevent="send">
      <h1>Восстановление пароля</h1>
      <p>Выберите, какую информацию использовать для изменения пароля:</p>

      <label class="field">
        <span>Логин или Email:</span>
        <input v-model.trim="loginOrEmail" type="text" />
      </label>

      <p class="hint">
        Контрольная строка для смены пароля, а также ваши регистрационные данные, будут высланы вам по email.
      </p>
      <p v-if="message" class="success-banner">{{ message }}</p>

      <div class="stack-actions">
        <button type="submit" class="button button--primary">Выслать</button>
        <button type="button" class="button button--secondary" :disabled="!loginOrEmail.trim()" @click="goToLogin">
          Авторизация
        </button>
      </div>
    </form>
  </section>
</template>
