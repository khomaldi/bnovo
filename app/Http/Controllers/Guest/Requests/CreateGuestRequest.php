<?php

declare(strict_types=1);

namespace App\Http\Controllers\Guest\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Propaganistas\LaravelPhone\PhoneNumber;

class CreateGuestRequest extends FormRequest
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
        return [
            'first_name' => 'required|string|between:1,100',
            'last_name' => 'required|string|between:1,100',
            'phone' => 'required|phone|unique:guests,phone',
            'email' => 'nullable|email|unique:guests,email',
            'country' => 'nullable|string|size:2',
        ];
    }

    public function firstName(): string
    {
        return $this->input('first_name');
    }

    public function lastName(): string
    {
        return $this->input('last_name');
    }

    public function phone(): string
    {
        return (new PhoneNumber($this->input('phone')))->formatE164();
    }

    public function email(): ?string
    {
        return $this->input('email');
    }

    public function country(): ?string
    {
        return $this->input('country');
    }
}
