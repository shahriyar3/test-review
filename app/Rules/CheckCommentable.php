<?php

namespace App\Rules;

use App\Models\Product;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Database\Eloquent\Builder;

class CheckCommentable implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $product = Product::query()->findOrFail($value);
        if (!$product->commentable)
            return false;

        if (!$product->is_public_comment) {
            return $this->checkUserBuyer($product);
        }

        return true;
    }

    private function checkUserBuyer(Product $product)
    {
        $user = auth()->user();
        return $user->orders()->success()->whereHas('items', function (Builder $query) use ($product) {
            return $query->where('product_id', '=', $product->id);
        })->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'شما امکان ارسال نظر برای این محصول را ندارید.';
    }
}
