<script setup lang="ts">

import QuickAccessOption from "../components/containment/QuickAccessOption.vue";
</script>

<template>
    <v-row justify="center">
        <v-col cols="12" lg="9">
            <v-card
                color="transparent"
                elevation="0"
                class="mt-sm-16"
            >
                <v-card-title class="text-center mb-10">
                    <h1 class="text-grey-darken-2 font-weight-bold">
                        Acesso Rápido
                    </h1>
                    <h2 class="text-h6"> Selecione uma das opcões abaixo:</h2>
                </v-card-title>

                <v-card-text class="d-flex justify-center align-center flex-wrap">
                    <quick-access-option
                        title="Autores"
                        icon="mdi-account-star"
                        route-name="authors"
                    />
                    <quick-access-option
                        title="Assuntos"
                        icon="mdi-bookmark-box-multiple"
                        route-name="topics"
                    />
                    <quick-access-option
                        title="Livros"
                        icon="mdi-bookshelf"
                        route-name="books"
                    />
                    <quick-access-option
                        title="Relatório"
                        icon="mdi-table"
                        route-name="report"
                    />
                </v-card-text>
            </v-card>
        </v-col>
    </v-row>

</template>
