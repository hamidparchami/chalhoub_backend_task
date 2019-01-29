<?php

namespace App\Http\Controllers\Api;

use App\Events\ProductObjectValidatedForCreation;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Spatie\Fractalistic\Fractal;
use Validator;

class ProductController extends Controller
{
    /**
     * get a list of products
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductsList()
    {
        $itemsPerPage = 10;
        $paginator = Product::paginate($itemsPerPage);
        $products = $paginator->getCollection();

        //format the output
        $products = Fractal::create()
                    ->collection($products, function (Product $product) {
                        return [
                            'id'        => $product->id,
                            'title'     => $product->title,
                            'abstract'  => $product->abstract,
                            'price'     => $product->price,
                            'image_url' => $product->image_url,
                        ];
                    })
                    ->paginateWith(new IlluminatePaginatorAdapter($paginator))
                    ->toArray();

        return response()->json($products);
    }

    /**
     * get a specific product
     * @param $id
     * @return array
     */
    public function getProductDetail($id)
    {
        $product = Product::where('id', $id)->firstOrFail();
        return compact('product');
    }

    /**
     * add new product
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postAddProduct(Request $request)
    {
        //validation rules
        $rules = [
            'title'         => 'required|max:255',
            'abstract'      => 'required|max:5000',
            'description'   => 'required|max:65000',
            'image_url'     => 'sometimes|max:255',
            'price'         => 'required|numeric|digits_between:1,11',
            'stock'         => 'required|numeric|digits_between:0,11',
        ];
        //validate
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 422);
        }

        //dispatch an event to create product and retrieve product model from listener
        $productModel = event(new ProductObjectValidatedForCreation($request->all()));
        $productModel = current($productModel);
        return response()->json(['success' => true, 'id' => $productModel->id], 201);
    }
}
