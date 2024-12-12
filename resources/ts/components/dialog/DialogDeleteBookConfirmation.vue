<script setup lang="ts">
import { inject } from "vue";

const emit = defineEmits({
    deleted: false,
    close: false
});

const bookGateway = inject("bookGateway");
function destroy(id) {
    bookGateway.destroy(id)
        .then(() => {
            emit('deleted', true);
        });
}

</script>

<template>
    <v-dialog max-width="400">
        <v-card>
            <v-card-title>Excluir Livro</v-card-title>
            <v-card-text>Tem certeza que deseja excluir este livro?</v-card-text>
            <v-card-actions>
                <v-btn @click="emit('close')" variant="outlined">Cancelar</v-btn>
                <v-btn @click="destroy($attrs.modelValue)" color="error" variant="outlined">Deletar</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
