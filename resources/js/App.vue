<template>
    <v-app theme="dark">
        <v-app-bar app>
            <v-container>
                <v-toolbar-title>
                    <router-link
                        to="/"
                        style="text-decoration: none; color: inherit"
                    >
                        Объявления
                    </router-link>
                </v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn @click="showCreateDialog = true" color="blue"
                    >Создать объявление</v-btn
                >
            </v-container>
        </v-app-bar>

        <v-main>
            <v-container>
                <router-view />
            </v-container>
        </v-main>

        <v-dialog v-model="showCreateDialog" max-width="600px">
            <v-card>
                <v-card-title class="text-h5 white--text">
                    Создать новое объявление
                </v-card-title>
                <v-card-text class="grey darken-3">
                    <AdvertisementForm @submit="onCreateAdvertisement" />
                </v-card-text>
                <v-card-actions class="grey darken-3">
                    <v-spacer></v-spacer>
                    <v-btn
                        color="blue-darken-1"
                        text
                        @click="showCreateDialog = false"
                        >Закрыть</v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-app>
</template>

<script>
import AdvertisementForm from "@/components/AdvertisementForm.vue";
export default {
    components: {
        AdvertisementForm,
    },
    data() {
        return {
            showCreateDialog: false,
        };
    },
    methods: {
        onCreateAdvertisement() {
            this.showCreateDialog = false;
            this.$router.push({ name: "advertisements" });
        },
    },
};
</script>
