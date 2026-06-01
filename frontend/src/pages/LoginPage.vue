<script setup lang="ts">
import { reactive, ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { login, resolveAuthUser } from '../auth';

const router = useRouter();
const route = useRoute();

const form = reactive({
  identifier: '',
  password: '',
  remember: false
});

const showPassword = ref(false);
const error = ref('');

const submit = () => {
  if (!form.identifier || !form.password) {
    error.value = 'Укажите логин или email и пароль для входа.';
    return;
  }

  const user = resolveAuthUser(form.identifier, form.password);

  if (!user) {
    error.value = 'Неверный логин/email или пароль.';
    return;
  }

  login(user, form.remember);
  const redirect = typeof route.query.redirect === 'string' ? route.query.redirect : '/cabinet';
  router.push(redirect);
};
</script>

<template>
  <section class="auth-layout">
    <form class="auth-card" @submit.prevent="submit">
      <h1>Пожалуйста, авторизуйтесь:</h1>
      <p v-if="error" class="error-banner">{{ error }}</p>

      <label class="field">
        <span>Логин или Email</span>
        <input v-model.trim="form.identifier" type="text" autocomplete="username" />
      </label>

      <label class="field">
        <span>Пароль</span>
        <div class="password-field">
          <input
            v-model="form.password"
            :type="showPassword ? 'text' : 'password'"
            autocomplete="current-password"
          />
          <button type="button" class="password-toggle" @click="showPassword = !showPassword">
            {{ showPassword ? 'Скрыть' : 'Глазик' }}
          </button>
        </div>
      </label>

      <label class="checkbox">
        <input v-model="form.remember" type="checkbox" />
        <span>Запомнить меня на этом компьютере</span>
      </label>

      <button type="submit" class="button button--primary button--full">Войти</button>

      <div class="auth-links">
        <RouterLink to="/password-recovery">Забыли свой пароль?</RouterLink>
        <RouterLink to="/register">Зарегистрироваться</RouterLink>
      </div>

      <p class="auth-note">Если вы впервые на сайте, заполните, пожалуйста, регистрационную форму.</p>
    </form>
  </section>
</template>
