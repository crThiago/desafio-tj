<script setup lang="ts">
import { useStore } from "vuex";

const store = useStore();
</script>

<template>
    <v-snackbar
        :model-value="store.state.alert.show"
        :multi-line="true"
        :color="store.state.alert.type"
        @update:model-value="store.commit('alert/hide')"

    >
        {{ store.state.alert.message }}

        <template v-slot:actions>
            <v-btn
                icon="mdi-close"
                size="x-small"
                @click="store.commit('alert/hide')"
            >
            </v-btn>
        </template>
    </v-snackbar>
</template>
