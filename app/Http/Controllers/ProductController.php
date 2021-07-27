<?php

namespace App\Http\Controllers;


use App\Http\Requests\LoginUser;
use App\Http\Requests\StoreComment;
use App\Http\Requests\StoreVote;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/products",
     *      operationId="get all products",
     *      tags={"Product"},
     *      summary="get all products",
     *      description="get all products",
     *
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="/api/products")
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="not found",
     *       ),
     * )
     */
    public function index()
    {
        $products = Product::query()->approved()->withAvg(['votes' => function ($query) {
            return $query->approved();
        }], 'vote')->with(['comments' => function ($query) {
            return $query->approved()->take(3)->with('user');
        }])->paginate();

        return ProductResource::collection($products);
    }

    /**
     * @OA\Get(
     *      path="/api/product/{product}",
     *      operationId="get product by slug",
     *      tags={"Product"},
     *      summary="get product by slug",
     *      description="get product by slug",
     *      @OA\Parameter(
     *          name="product",
     *          description="product slug",
     *          required=true,
     *          in="path",
     *          example="محصول-تست",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="/api/product/{product}")
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="not found",
     *       ),
     * )
     */
    public function show(Product $product)
    {
        if (!$product->approved) {
            return response()->json(['error' => __('messages.Product Not Found')], 404);
        }

        $product->loadAvg(['votes' => function ($query) {
            return $query->approved();
        }], 'vote')->load(['comments' => function ($query) {
            return $query->approved()->take(3)->with('user');
        }]);

        return new ProductResource($product);
    }

    /**
     * @OA\Post(
     *      path="/api/product/{product}/vote",
     *      operationId="save new vote",
     *      tags={"Product"},
     *      summary="save new vote",
     *      description="save new vote",
     *      security={{ "apiAuth": {} }},
     *     @OA\Parameter(
     *          name="product",
     *          description="product id",
     *          required=true,
     *          in="path",
     *          example="1",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  required={"vote"},
     *                  @OA\Property(property="vote", type="string", format="string", example="4"),
     *               ),
     *           ),
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(ref="/api/product/{product}/vote")
     *       ),
     *     @OA\Response(
     *          response=422,
     *          description="error",
     *              @OA\JsonContent(ref="/api/product/{product}/vote")
     *       ),
     *     @OA\Response(
     *          response=401,
     *          description="not authenticate",
     *          @OA\JsonContent(ref="/api/product/{product}/vote")
     *       ),
     * )
     */
    public function storeVote(StoreVote $request, Product $product)
    {
        if (!$product->approved) {
            return response()->json(['error' => __('messages.Product Not Found')], 404);
        }

        $vote = $product->votes()->create($request->validated());
        if ($vote->wasRecentlyCreated)
            return response()->json(['success' => __('messages.Vote Submitted.')]);

        return response()->json(['error' => __('messages.Problem!')]);
    }

    /**
     * @OA\Post(
     *      path="/api/product/{product}/comment",
     *      operationId="save new comment",
     *      tags={"Product"},
     *      summary="save new comment",
     *      description="save new comment",
     *      security={{ "apiAuth": {} }},
     *     @OA\Parameter(
     *          name="product",
     *          description="product id",
     *          required=true,
     *          in="path",
     *          example="1",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  required={"subject", "body"},
     *                  @OA\Property(property="subject", type="string", format="string", example="عنوان کامنت"),
     *                  @OA\Property(property="body", type="string", format="string", example="متن پیام"),
     *               ),
     *           ),
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(ref="/api/product/{product}/comment")
     *       ),
     *     @OA\Response(
     *          response=422,
     *          description="error",
     *              @OA\JsonContent(ref="/api/product/{product}/comment")
     *       ),
     *     @OA\Response(
     *          response=401,
     *          description="not authenticate",
     *          @OA\JsonContent(ref="/api/product/{product}/comment")
     *       ),
     * )
     */
    public function storeComment(StoreComment $request, Product $product)
    {
        if (!$product->approved) {
            return response()->json(['error' => __('messages.Product Not Found')], 404);
        }

        $comment = $product->comments()->create($request->validated());
        if ($comment->wasRecentlyCreated)
            return response()->json(['success' => __('messages.Comment Submitted.')]);

        return response()->json(['error' => __('messages.Problem!')]);

    }
}
