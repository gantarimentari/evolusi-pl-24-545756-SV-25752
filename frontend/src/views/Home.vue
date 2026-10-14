<script setup lang="ts">
import { RouterLink } from 'vue-router'
</script>

<template>
  <div class="page-shell">
    

    <main class="home-content">
      <section class="hero-landing">
        <div class="hero-orbit" aria-hidden="true"></div>
        <div class="hero-copy-block">
          
          <h1>Boost your productivity by knowing what to do first</h1>
          <p class="hero-copy">
           organize your taks by priority and focus what matters most
          </p>
          <RouterLink class="primary-button" to="/tasks">
            View all task
            <span aria-hidden="true">-&gt;</span>
          </RouterLink>
        </div>
        <div class="hero-landscape" aria-hidden="true"></div>
        <div class="hero-flower hero-flower-one" aria-hidden="true"></div>
        <div class="hero-flower hero-flower-two" aria-hidden="true"></div>
      </section>
    </main>
  </div>
</template>