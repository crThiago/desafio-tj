<script setup>

import Alert from "../components/feedback/Alert.vue";
</script>

<template>
    <v-app id="inspire">
        <v-navigation-drawer
            expand-on-hover
            rail
            color="background"
        >
            <v-list>
                <v-list-item
                    prepend-avatar="https://randomuser.me/api/portraits/women/85.jpg"
                    title="Desafio TJ"
                />
            </v-list>

            <v-list density="compact" nav >
                <v-list-item
                    color="primary"
                    prepend-icon="mdi-home"
                    title="Página
                    Inicial"
                    :to="{name: 'home'}"
                />
                <v-list-item
                    color="primary"
                    prepend-icon="mdi-account-star"
                    title="Autores"
                    :to="{name: 'authors'}"
                />
                <v-list-item
                    color="primary"
                    prepend-icon="mdi-bookmark-box-multiple"
                    title="Assuntos"
                    :to="{name: 'topics'}"
                />
                <v-list-item
                    color="primary"
                    prepend-icon="mdi-bookshelf"
                    title="Livros"
                    :to="{name: 'books'}"
                />
                <v-list-item
                    color="primary"
                    prepend-icon="mdi-table"
                    title="Relatorio"
                    :to="{name: 'report'}"
                />
                <v-list-item
                    color="primary"
                    prepend-icon="mdi-github"
                    title="Repositório"
                    value="repository"
                    href="https://github.com/crThiago/desafio-tj"
                    target="_blank"
                />
            </v-list>
        </v-navigation-drawer>

        <v-main class="background">
            <v-container>
                <RouterView />
                <Alert />
            </v-container>
        </v-main>
    </v-app>
</template>

<style scoped>

</style>
