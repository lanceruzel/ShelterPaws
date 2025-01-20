<script setup>
import { RouterView } from 'vue-router';
import Toast from 'primevue/toast';
import DynamicDialog from 'primevue/dynamicdialog';
import ConfirmDialog from 'primevue/confirmdialog';
</script>

<template>
    <component :is="$route.meta.layout || 'div'">
        <Toast />
        <DynamicDialog />
        <ConfirmDialog />
        <RouterView />
    </component>
</template>