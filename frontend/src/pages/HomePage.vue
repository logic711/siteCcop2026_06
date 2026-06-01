<script setup lang="ts">
import { RouterLink } from 'vue-router';
import { allPages } from '../data/portal';
</script>

<template>
  <section class="hero">
    <div class="hero__content">
      <p class="eyebrow">Портал ЦЦОП</p>
      <h1>Единая цифровая среда для сервисов, инструкций, новостей и поддержки РИУ</h1>
      <p class="hero__lead">
        Портал объединяет внутренние сервисы, информационные разделы и сценарии взаимодействия пользователей,
        модераторов и администраторов в одном интерфейсе.
      </p>
      <div class="hero__actions">
        <RouterLink class="button button--primary" to="/login">Открыть личный кабинет</RouterLink>
        <RouterLink class="button button--secondary" to="/register">Зарегистрироваться</RouterLink>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="section__heading">
      <p class="eyebrow">Разделы портала</p>
      <h2>Основные сценарии работы в ЦЦОП</h2>
    </div>
    <div class="card-grid">
      <article v-for="page in allPages" :key="page.slug" class="card">
        <p class="card__meta">{{ page.audience }}</p>
        <h3>{{ page.title }}</h3>
        <p>{{ page.description }}</p>
        <RouterLink class="card__link" :to="`/pages/${page.slug}`">Перейти в раздел</RouterLink>
      </article>
    </div>
  </section>
</template>
