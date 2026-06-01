<script setup lang="ts">
import { computed } from 'vue';
import { useRoute } from 'vue-router';
import { pageMap, moderatorRoleLabels } from '../data/portal';
import type { PortalPageSlug } from '../types';

const route = useRoute();

const page = computed(() => pageMap[route.params.slug as PortalPageSlug]);
</script>

<template>
  <section v-if="page" class="section">
    <div class="section__heading">
      <p class="eyebrow">Раздел портала</p>
      <h1>{{ page.title }}</h1>
      <p>{{ page.description }}</p>
    </div>

    <div class="content-layout">
      <article class="content-card">
        <h2>Назначение раздела</h2>
        <p>
          Раздел предназначен для централизованной публикации материалов, обсуждений и регламентов, связанных с
          направлением "{{ page.title }}".
        </p>
      </article>

      <article class="content-card">
        <h2>Права модерации</h2>
        <p v-if="page.moderatorRole">
          {{
            moderatorRoleLabels[page.moderatorRole]
          }}
          может публиковать, изменять и удалять материалы только в рамках своей страницы.
        </p>
        <p v-else>Для этого раздела используется базовый пользовательский доступ.</p>
      </article>

      <article class="content-card">
        <h2>Целевая аудитория</h2>
        <p>{{ page.audience }}</p>
      </article>
    </div>
  </section>

  <section v-else class="auth-layout">
    <div class="auth-card">
      <h1>Раздел не найден</h1>
      <p>Проверьте адрес страницы или вернитесь на главную.</p>
      <RouterLink class="button button--primary" to="/">На главную</RouterLink>
    </div>
  </section>
</template>
