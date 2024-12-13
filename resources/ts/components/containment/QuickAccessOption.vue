<script setup lang="ts">
import {computed} from "vue";
import { useDisplay } from 'vuetify'

defineProps({
    title: String,
    icon: String,
    routeName: String
})

const { lgAndUp, mdAndUp } = useDisplay()

const dimensions = computed(() => {
    if (lgAndUp.value) {
        return 250
    } else if (mdAndUp.value) {
        return 150
    }

    return 100
})

const iconSize = computed(() => {
    if (lgAndUp.value) {
        return 'text-h1';
    } else if (mdAndUp.value) {
        return 'text-h2';
    }
    return 'text-h3';
})

const titleSize = computed(() => {
    if (lgAndUp.value) {
        return 'text-h4';
    } else if (mdAndUp.value) {
        return 'text-h5';
    }
    return 'text-h6';
})
</script>

<template>
    <v-hover>
        <template v-slot:default="{ isHovering, props }">
            <v-card
                v-bind="props"
                :elevation="isHovering ? 3 : 0"
                class="d-flex flex-column justify-center align-center ma-2"
                color="secondary"
                :variant="isHovering ? 'flat' : 'outlined'"
                :height="dimensions"
                :width="dimensions"
                @click="$router.push({name: routeName})"
            >
                <v-icon
                    :color="isHovering ? 'white' : 'secondary'"
                    :class="iconSize"
                    :icon="icon"
                />
                <h2
                    :color="isHovering ? 'white' : 'secondary'"
                    class="font-weight-bold mt-2"
                    :class="$vuetify.display.mobile ? 'text-h6' : 'text-h4'"
                >
                    {{ title }}
                </h2>
            </v-card>
        </template>
    </v-hover>
</template>

<style scoped>

</style>
