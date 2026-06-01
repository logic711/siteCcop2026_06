<script setup lang="ts">
import PortalHeader from './components/PortalHeader.vue';
import PortalFooter from './components/PortalFooter.vue';
import CookieBanner from './components/CookieBanner.vue';
</script>

<template>
  <div class="shell">
    <PortalHeader />
    <main class="shell__content">
      <RouterView />
    </main>
    <PortalFooter />
    <CookieBanner />
  </div>
</template>
