<script setup>
defineProps({
    value: Number
})
</script>

<template>
    {{ new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(value) }}
</template>
