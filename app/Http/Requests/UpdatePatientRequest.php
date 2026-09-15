<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Patient;
use Illuminate\Validation\Rule;

class UpdatePatientRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $patient = Patient::findOrFail($this->route('patient'));
        return [
            'full_name' => 'required|string|max:255',
            'national_id_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('patients', 'national_id_number')->ignore($patient),
            ],
            'age' => 'required|integer|min:0|max:130',
            'email' => 'nullable|email|max:255',
            'gender' => 'required|in:male,female',
            'phone' => ['required', 'string', 'regex:/\A\+?[0-9]{7,15}\z/'],
            'address' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'phone.regex' => 'رقم الهاتف يجب أن يحتوي على 7 إلى 15 رقمًا، مع + اختيارية في البداية، وبدون مسافات.',
        ];
    }
}
