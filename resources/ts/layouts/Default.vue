<script setup>

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
                <v-list-item class="text-brown-lighten-1" prepend-icon="mdi-home" title="Página Inicial" value="home" :to="{name: 'home'}"/>
                <v-list-item class="bg-brown-lighten-1" prepend-icon="mdi-account-star" title="Autores" value="authors" :to="{name: 'authors'}"/>
                <v-list-item color="primary" prepend-icon="mdi-bookmark-box-multiple" title="Assuntos" value="topics" :to="{name: 'topics'}"/>
                <v-list-item prepend-icon="mdi-bookshelf" title="Livros" value="books" :to="{name: 'books'}"/>
                <v-list-item prepend-icon="mdi-table" title="Relatorio" value="report" :to="{name: 'report'}"/>
                <v-list-item
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
            </v-container>
        </v-main>
    </v-app>
</template>

<style scoped>

</style>
