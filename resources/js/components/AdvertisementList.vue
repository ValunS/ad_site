<template>
    <div>
        <v-container>
            <v-row class="mb-4">
                <v-col cols="12" sm="6" md="4">
                    <v-select
                        v-model="sortBy"
                        :items="sortOptions"
                        item-title="text"
                        item-value="value"
                        label="Сортировать по"
                        @click="fetchAdvertisements"
                        variant="outlined"
                        color="blue"
                        density="compact"
                        bg-color="grey-darken-4"
                        item-color="blue"
                    ></v-select>
                </v-col>
                <v-col cols="12" sm="6" md="4">
                    <v-select
                        v-model="sortOrder"
                        :items="sortOrderOptions"
                        item-title="text"
                        item-value="value"
                        label="Порядок сортировки"
                        @click="fetchAdvertisements"
                        color="blue"
                        density="compact"
                    ></v-select>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12">
                    <v-btn @click="showCreateDialog = true" color="blue"
                        >Создать объявление</v-btn
                    >
                </v-col>
            </v-row>
            <v-row class="mt-4">
                <v-col
                    v-for="advertisement in advertisements"
                    :key="advertisement.id"
                    cols="12"
                    sm="6"
                    md="4"
                >
                    <Advertisement :advertisement="advertisement" />
                </v-col>
            </v-row>

            <v-pagination
                v-model="currentPage"
                :length="totalPages"
                @click="onPaginationUpdate"
                class="mt-4"
            ></v-pagination>
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
        </v-container>
    </div>
</template>

<script>
import axios from "axios";
import Advertisement from "@/components/Advertisement.vue";
import AdvertisementForm from "@/components/AdvertisementForm.vue";

export default {
    components: { Advertisement, AdvertisementForm },
    data() {
        return {
            advertisements: [],
            sortBy: "created_at",
            sortOrder: "desc",
            currentPage: 1,
            totalPages: 1,
            showCreateDialog: false,
            sortOptions: [
                { text: "Дате создания", value: "created_at" },
                { text: "Цене", value: "price" },
            ],
            sortOrderOptions: [
                { text: "По возрастанию", value: "asc" },
                { text: "По убыванию", value: "desc" },
            ],
        };
    },
    mounted() {
        this.fetchAdvertisements();
    },
    methods: {
        fetchAdvertisements() {
            axios
                .get("/api/advertisements", {
                    params: {
                        sort_by: this.sortBy,
                        sort_order: this.sortOrder,
                        page: this.currentPage,
                    },
                })
                .then((response) => {
                    this.advertisements = response.data.data;
                    this.totalPages = response.data.meta.last_page;
                })
                .catch((error) => {
                    console.error("Ошибка при загрузке объявлений:", error);
                });
        },
        onPaginationUpdate() {
            this.fetchAdvertisements();
        },
        onCreateAdvertisement() {
            this.showCreateDialog = false;
            this.fetchAdvertisements();
        },
    },
};
</script>
