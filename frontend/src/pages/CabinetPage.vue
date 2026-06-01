<script setup lang="ts">
import { computed } from 'vue';
import { authState } from '../auth';
import { allPages, moderatorRoleLabels } from '../data/portal';

const user = computed(() => authState.user);

const managedPages = computed(() =>
  allPages.filter((page) => user.value?.role === 'administrator' || page.moderatorRole === user.value?.role)
);
</script>

<template>
  <section class="section">
    <div class="section__heading">
      <p class="eyebrow">Личный кабинет</p>
      <h1>{{ user?.fullName }}</h1>
      <p>{{ user ? moderatorRoleLabels[user.role] : '' }}</p>
    </div>

    <div class="dashboard-grid">
      <article class="dashboard-card">
        <h2>Профиль</h2>
        <p><strong>Логин:</strong> {{ user?.login }}</p>
        <p><strong>Email:</strong> {{ user?.email }}</p>
        <p><strong>Роль:</strong> {{ user ? moderatorRoleLabels[user.role] : '' }}</p>
      </article>

      <article class="dashboard-card">
        <h2>Доступные действия</h2>
        <ul class="plain-list">
          <li>Просмотр и редактирование закрепленных разделов.</li>
          <li>Управление публикациями в рамках назначенной ветки.</li>
          <li>Работа с запросами пользователей и регламентами.</li>
        </ul>
      </article>

      <article v-if="user?.role === 'administrator'" class="dashboard-card dashboard-card--accent">
        <h2>Админ-панель</h2>
        <ul class="plain-list">
          <li>Управление пользователями, ролями и правами.</li>
          <li>Назначение модераторов на страницы портала.</li>
          <li>Аудит контента, публикаций и обращений.</li>
        </ul>
      </article>
    </div>

    <div class="section__heading">
      <p class="eyebrow">Зоны ответственности</p>
      <h2>Разделы, доступные для модерирования</h2>
    </div>

    <div class="card-grid">
      <article v-for="page in managedPages" :key="page.slug" class="card">
        <p class="card__meta">Права публикации, редактирования и удаления материалов</p>
        <h3>{{ page.title }}</h3>
        <p>{{ page.description }}</p>
        <RouterLink class="card__link" :to="`/pages/${page.slug}`">Открыть раздел</RouterLink>
      </article>
    </div>
  </section>
</template>
