<script setup>
import NavBarComponent from './components/NavBarComponent.vue';
import { ref } from 'vue';

components: { NavBarComponent }

const loggedIn = ref(localStorage.getItem('user'))

</script>

<template>
  <NavBarComponent v-if="loggedIn" />
  <router-view></router-view>
</template>

<style scoped></style>
