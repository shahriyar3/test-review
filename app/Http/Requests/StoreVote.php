<?php

namespace App\Http\Requests;

use App\Rules\CheckVoteable;
use Illuminate\Foundation\Http\FormRequest;

class StoreVote extends FormRequest
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

    protected function prepareForValidation()
    {
        $this->merge([
            'product_id' => $this->route('product.id'),
            'user_id' => auth()->id()
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => ['bail', 'required'],
            'product_id' => ['bail', 'required', new CheckVoteable()],
            'vote' => ['bail', 'required', 'numeric'],
        ];
    }

    public function attributes()
    {
        return [
            'product_id' => 'محصول',
            'vote' => 'رای',
        ];
    }
}
