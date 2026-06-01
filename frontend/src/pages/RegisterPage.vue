<script setup lang="ts">
import { computed, reactive, ref } from 'vue';
import ConsentModal from '../components/ConsentModal.vue';

const captcha = ref(String(Math.floor(10000 + Math.random() * 89999)));
const errorText = ref('');
const successText = ref('');
const showConsent = ref(false);

const form = reactive({
  lastName: '',
  firstName: '',
  middleName: '',
  phone: '',
  email: '',
  password: '',
  passwordConfirmation: '',
  captchaInput: '',
  consent: false
});

const passwordRules = computed(
  () =>
    /[A-Z]/.test(form.password) &&
    /[a-z]/.test(form.password) &&
    /\d/.test(form.password) &&
    /[,.<>/?;:'"[\]{}\\|`~!@#$%^&*()_+=-]/.test(form.password) &&
    form.password.length >= 8
);

const setError = (text: string) => {
  errorText.value = text;
  successText.value = '';
  requestAnimationFrame(() => {
    document.getElementById('register-error')?.scrollIntoView({ behavior: 'smooth', block: 'center' });
  });
};

const submit = () => {
  if (!form.phone.trim()) {
    setError('Поле "Телефон" обязательно для заполнения');
    return;
  }

  if (!form.email.trim()) {
    setError('Поле "Email" обязательно для заполнения');
    return;
  }

  if (!form.password) {
    setError('Поле "Пароль" обязательно для заполнения');
    return;
  }

  if (!form.passwordConfirmation) {
    setError('Поле "Подтверждение пароля" обязательно для заполнения');
    return;
  }

  if (form.captchaInput.trim() !== captcha.value) {
    setError('Неверно введено слово с картинки');
    captcha.value = String(Math.floor(10000 + Math.random() * 89999));
    form.captchaInput = '';
    return;
  }

  if (!form.consent) {
    showConsent.value = true;
    return;
  }

  if (form.password !== form.passwordConfirmation) {
    setError('Пароль и подтверждение пароля не совпадают.');
    return;
  }

  if (!passwordRules.value) {
    setError('Пароль не соответствует требованиям сложности.');
    return;
  }

  errorText.value = '';
  successText.value = 'Регистрация успешно отправлена. На указанный email придет запрос на подтверждение регистрации.';
}

const acceptConsent = () => {
  form.consent = true;
  showConsent.value = false;
};

const declineConsent = () => {
  form.consent = false;
  showConsent.value = false;
};
</script>

<template>
  <section class="auth-layout auth-layout--wide">
    <form class="auth-card auth-card--wide" @submit.prevent="submit">
      <h1>Регистрация нового пользователя</h1>
      <p id="register-error" class="error-banner" :class="{ 'error-banner--hidden': !errorText }">
        {{ errorText || ' ' }}
      </p>
      <p class="hint">На указанный в форме email придет запрос на подтверждение регистрации</p>
      <p v-if="successText" class="success-banner">{{ successText }}</p>

      <div class="form-grid">
        <label class="field">
          <span>Фамилия:</span>
          <input v-model.trim="form.lastName" type="text" />
        </label>
        <label class="field">
          <span>Имя:</span>
          <input v-model.trim="form.firstName" type="text" />
        </label>
        <label class="field">
          <span>Отчество:</span>
          <input v-model.trim="form.middleName" type="text" />
        </label>
        <label class="field">
          <span>Телефон:*</span>
          <input v-model.trim="form.phone" type="tel" />
        </label>
        <label class="field">
          <span>Email:*</span>
          <input v-model.trim="form.email" type="email" />
        </label>
        <label class="field">
          <span>Пароль:*</span>
          <input v-model="form.password" type="password" />
        </label>
        <label class="field">
          <span>Подтверждение пароля:*</span>
          <input v-model="form.passwordConfirmation" type="password" />
        </label>
      </div>

      <label class="checkbox checkbox--start">
        <input v-model="form.consent" type="checkbox" />
        <span>
          Нажимая кнопку "Регистрация", я даю свое согласие на обработку моих персональных данных, в соответствии с
          Федеральным законом от 27.07.2006 № 152-ФЗ "О персональных данных", на условиях и для целей, определенных в
          <button type="button" class="inline-link" @click="showConsent = true">Согласии на обработку персональных данных</button>.
        </span>
      </label>

      <div class="captcha-box">
        <p class="captcha-box__label">Защита от автоматической регистрации</p>
        <div class="captcha-box__value" aria-label="CAPTCHA">{{ captcha }}</div>
        <label class="field">
          <span>Введите текст изображенный на картинке:*</span>
          <input v-model.trim="form.captchaInput" type="text" inputmode="numeric" />
        </label>
      </div>

      <button type="submit" class="button button--primary">Регистрация</button>

      <p class="hint hint--small">
        Пароль должен быть не менее 8 символов длиной, содержать латинские символы верхнего регистра (A-Z), содержать
        латинские символы нижнего регистра (a-z), содержать цифры (0-9), содержать знаки пунктуации
        (,.&lt;&gt;/?;:'"[]{}\|`~!@#$%^&amp;*()_+=-).
      </p>
      <p class="hint hint--small">*Поля, обязательные для заполнения.</p>
    </form>

    <ConsentModal :open="showConsent" @accept="acceptConsent" @decline="declineConsent" />
  </section>
</template>
