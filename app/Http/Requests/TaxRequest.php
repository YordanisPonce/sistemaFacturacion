<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaxRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

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
        return ['name' => 'required|string', 'percentage' => 'required|numeric', 'enterprise_id' => 'required|numeric'];
    }

    public function update()
    {
        return ['name' => 'required|string', 'percentage' => 'required|numeric', 'enterprise_id' => 'required|numeric'];
    }
}
