<template>
    <v-form @submit.prevent="handleSubmit">
        <v-text-field v-model="title" label="Название" required></v-text-field>

        <v-textarea
            v-model="description"
            label="Описание"
            required
        ></v-textarea>

        <div v-for="(image, index) in images" :key="index">
            <v-text-field
                v-model="image.url"
                :label="`Ссылка на изображение ${index + 1}`"
                required
                :rules="[
                    (v) => !!v || 'Ссылка обязательна',
                    (v) => isValidURL(v) || 'Некорректная ссылка',
                ]"
            ></v-text-field>
            <v-btn
                v-if="images.length > 1"
                @click="removeImage(index)"
                class="mt-2"
            >
                Удалить ссылку
            </v-btn>
        </div>
        <v-btn @click="addImage" class="mt-2">Добавить ссылку</v-btn>

        <v-text-field
            v-model.number="price"
            label="Цена"
            type="number"
            required
        ></v-text-field>

        <v-btn type="submit" color="primary">Создать</v-btn>
    </v-form>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            title: "",
            description: "",
            images: [{ url: "" }],
            price: 0,
        };
    },
    methods: {
        handleSubmit() {
            const formData = new FormData();
            formData.append("title", this.title);
            formData.append("description", this.description);
            this.images.forEach((image) => {
                formData.append("images[]", image.url);
            });
            formData.append("price", this.price);

            axios
                .post("/api/advertisements", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then(() => {
                    this.$emit("submit");
                    this.$router.push({ name: "advertisements" });
                })
                .catch((error) => {
                    console.error("Ошибка при создании объявления:", error);
                });
        },
        isValidURL(url) {
            try {
                new URL(url);
                return true;
            } catch (error) {
                return false;
            }
        },
        addImage() {
            this.images.push({ url: "" });
        },
        removeImage(index) {
            if (this.images.length > 1) {
                this.images.splice(index, 1);
            }
        },
    },
};
</script>
