<script setup lang="ts">
defineProps({
    icon: String,
    text: String,
    color: String,
    size: {
        type: String,
        default: 'x-small'
    }
})
</script>

<template>
    <v-btn
        icon
        :size="size"
        :color="color"
        variant="outlined"
        class="ma-1"
        @click=""
    >
        <v-icon>{{ icon }}</v-icon>
        <v-tooltip
            activator="parent"
            location="bottom"
        >
            {{ text }}
        </v-tooltip>
    </v-btn>
</template>

<style scoped>

</style>
