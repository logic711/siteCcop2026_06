<script setup lang="ts">
import { RouterLink } from 'vue-router';
import { footerPages } from '../data/portal';
</script>

<template>
  <footer class="portal-footer">
    <div class="portal-footer__inner">
      <RouterLink v-for="page in footerPages" :key="page.slug" class="portal-footer__link" :to="`/pages/${page.slug}`">
        {{ page.title }}
      </RouterLink>
    </div>
  </footer>
</template>
