<script setup lang="ts">
import BtnIconTooltip from "../buttons/btnIconTooltip.vue";

defineProps({
    title: String,
    icon: String
});
</script>

<template>
    <div class="d-flex justify-space-between">
        <h1 class="text-primary"><v-icon :icon="icon"/> {{ title }} </h1>
        <btn-icon-tooltip
            icon="mdi-home"
            text="Voltar para a Página Inicial"
            color="primary"
            :to="{ name: 'home' }"
            size="default"
        />
    </div>

    <v-divider class="secondary my-6" />
</template>
