<script setup>
import NavBarComponent from './components/NavBarComponent.vue';

components: { NavBarComponent }

const loggedIn = localStorage.getItem('user')

</script>

<template>
  <NavBarComponent v-if="loggedIn" />
  <router-view></router-view>
</template>

<style scoped></style>
