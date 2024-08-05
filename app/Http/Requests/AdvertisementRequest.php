<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdvertisementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:200',
            'description' => 'nullable|string|max:1000',
            'images' => 'required|array|max:3',
            'images.*' => 'required|url',
            'price' => 'required|numeric|min:0',
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Название объявления обязательно для заполнения.',
            'title.string' => 'Название объявления должно быть строкой.',
            'title.max' => 'Название объявления не должно превышать 200 символов.',
            'description.string' => 'Описание объявления должно быть строкой.',
            'description.max' => 'Описание объявления не должно превышать 1000 символов.',
            'images.required' => 'Необходимо загрузить хотя бы одно изображение.',
            'images.array' => 'Изображения должны быть переданы в виде массива.',
            'images.max' => 'Можно загрузить не более 3 изображений.',
            'images.*.required' => 'Все изображения обязательны для заполнения.',
            'images.*.url' => 'Неверный формат ссылки на изображение.',
            'price.required' => 'Цена объявления обязательна для заполнения.',
            'price.numeric' => 'Цена объявления должна быть числом.',
            'price.min' => 'Цена объявления должна быть положительным числом.',
        ];
    }
}