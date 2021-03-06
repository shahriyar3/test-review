<?php

namespace App\Http\Requests;

use App\Rules\CheckCommentable;
use Illuminate\Foundation\Http\FormRequest;

class StoreComment extends FormRequest
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
            'product_id' => ['bail', 'required', new CheckCommentable()],
            'subject' => ['bail', 'required', 'string', 'max:191'],
            'body' => ['bail', 'required']
        ];
    }
}
