<template>
    <v-card class="mx-auto" max-width="344" color="grey-darken-4" elevation="2">
        <v-img :src="advertisement.main_image" height="200px"></v-img>

        <v-card-title class="white--text">
            {{ advertisement.title }}
        </v-card-title>

        <v-card-subtitle class="white--text">
            Цена: {{ advertisement.price }}
        </v-card-subtitle>

        <v-card-actions>
            <v-btn color="blue" @click="showDialog = true"> Подробнее </v-btn>
        </v-card-actions>

        <v-dialog v-model="showDialog" max-width="600px">
            <v-card color="grey-darken-4">
                <v-card-title class="text-h5 white--text">
                    {{ advertisement.title }}
                </v-card-title>
                <v-card-text class="white--text">
                    <v-img
                        :src="advertisement.main_image"
                        height="200px"
                        class="mb-4"
                    ></v-img>

                    <p v-if="advertisement.description">
                        <strong>Описание:</strong>
                        {{ advertisement.description }}
                    </p>

                    <v-btn
                        v-if="
                            advertisement.images &&
                            advertisement.images.length > 1
                        "
                        color="blue"
                        @click="showImagesDialog = true"
                    >
                        Показать все изображения
                    </v-btn>

                    <v-dialog v-model="showImagesDialog" max-width="800px">
                        <v-card>
                            <v-card-title class="text-h5 white--text">
                                Все изображения
                            </v-card-title>
                            <v-card-text class="grey darken-3">
                                <v-carousel height="400px">
                                    <v-carousel-item
                                        v-for="(
                                            image, index
                                        ) in advertisement.images"
                                        :key="index"
                                    >
                                        <v-img :src="image"></v-img>
                                    </v-carousel-item>
                                </v-carousel>
                            </v-card-text>
                            <v-card-actions class="grey darken-3">
                                <v-spacer></v-spacer>
                                <v-btn
                                    color="blue-darken-1"
                                    text
                                    @click="showImagesDialog = false"
                                >
                                    Закрыть
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>

                    <p><strong>Цена:</strong> {{ advertisement.price }}</p>
                </v-card-text>
                <v-card-actions class="grey darken-3">
                    <v-spacer></v-spacer>
                    <v-btn
                        color="blue-darken-1"
                        text
                        @click="showDialog = false"
                    >
                        Закрыть
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-card>
</template>

<script>
import axios from "axios";

export default {
    props: {
        advertisement: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            showDialog: false,
            showImagesDialog: false,
        };
    },
};
</script>
