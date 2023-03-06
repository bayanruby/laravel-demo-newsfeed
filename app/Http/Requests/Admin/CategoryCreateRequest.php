<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('categories')],
        ];
    }

    public function getValidatorInstance()
    {
        $this->formatSlug();

        return parent::getValidatorInstance();
    }

    protected function formatSlug()
    {
        $this->merge([
            'slug' => Str::slug($this->input('slug'), '-')
        ]);
    }
}
