<script setup lang="ts">
import { computed } from 'vue';
import { RouterLink, useRoute } from 'vue-router';
import { authState, logout } from '../auth';
import { headerPages, moderatorRoleLabels } from '../data/portal';

const route = useRoute();

const cabinetLabel = computed(() =>
  authState.user ? `${authState.user.fullName} (${moderatorRoleLabels[authState.user.role]})` : 'Личный кабинет'
);
</script>

<template>
  <header class="portal-header">
    <div class="portal-header__top">
      <div class="portal-header__utility">
        <RouterLink class="portal-header__cabinet-link" :to="authState.user ? '/cabinet' : '/login'">
          {{ cabinetLabel }}
        </RouterLink>
        <button v-if="authState.user" class="link-button" type="button" @click="logout">Выйти</button>
      </div>
    </div>
    <div class="portal-header__bottom">
      <RouterLink class="brand" to="/">Центр цифровой оптимизации процессов</RouterLink>
      <nav class="portal-nav" aria-label="Основная навигация">
        <RouterLink
          v-for="page in headerPages"
          :key="page.slug"
          class="portal-nav__link"
          :class="{ 'portal-nav__link--active': route.path === `/pages/${page.slug}` }"
          :to="`/pages/${page.slug}`"
        >
          {{ page.title }}
        </RouterLink>
      </nav>
    </div>
  </header>
</template>
