<script setup lang="ts">
// import { useDisplay } from 'vuetify'
// const { mobile } = useDisplay()


defineProps({
    title: String,
    icon: String,
    routeName: String
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
                :height="$vuetify.display.mobile ? 150 : 250"
                :width="$vuetify.display.mobile ? 150 : 250"
                @click="$router.push({name: routeName})"
            >
                <v-icon
                    :color="isHovering ? 'white' : 'secondary'"
                    :class="$vuetify.display.mobile ? 'text-h2' : 'text-h1'"
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
