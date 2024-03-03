<?php

namespace App\Http\Requests;

use App\Helpers\UploadHelper;
use Illuminate\Foundation\Http\FormRequest;

class CLientRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return match ($this->method()) {
            "POST" => $this->store(),
            "PUT" => $this->update(),
            default => [],
        };

    }

    public function store()
    {
        return ['enterprise_id' => 'required|numeric|exists:enterprises,id'];
    }

    public function update()
    {
        return ['enterprise_id' => 'required|numeric|exists:enterprises,id'];
    }

    protected function prepareForValidation()
    {
        $this->merge(['logo' => UploadHelper::saveBase64Image($this->input('logo'), 'enterprises')]);
    }
}
