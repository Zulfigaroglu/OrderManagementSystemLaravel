<?php

namespace App\Http\Requests;

use App\Enums\DiscountConditionSubject;
use App\Enums\DiscountConditionType;
use App\Enums\DiscountPolicySubject;
use App\Enums\DiscountPolicyType;
use Illuminate\Foundation\Http\FormRequest;

class DiscountUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'discount_condition_subject' => 'required|in:'.DiscountConditionSubject::toCommaSeperatedString(),
            'discount_condition_type' => 'required|in:'.DiscountConditionType::toCommaSeperatedString(),
            'discount_condition_value' => 'required|numeric',
            'discount_policy_subject' => 'required|in:'.DiscountPolicySubject::toCommaSeperatedString(),
            'discount_policy_type' => 'required|in:'.DiscountPolicyType::toCommaSeperatedString(),
            'discount_policy_value' => 'nullable|numeric',
        ];
    }
}
