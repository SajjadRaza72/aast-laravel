<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductApiRequest;
use App\Product;
use http\Env\Request;
use Illuminate\Http\JsonResponse;
use View;

/**
 * Class ProductApiController
 * @package App\Http\Controllers
 */
class ProductApiController extends Controller
{

    public function index(ProductApiRequest $request)
    {
        $validated = $request->validated();
        if($validated){
            $query = $request->get('is_active');
            $data = Product::select('id','name','sku','description','price','is_active','created_at','updated_at')->where('is_active', $query)->get();
            if($data) {
                $status = '1';
                $message = 'Successfully retrieved products';
                $data = $data;
            }else{
                $status = '0';
                $message = 'No products found';
                $data = [];
            }
            return new JsonResponse(['status' => $status,'message' => $message,'data' => $data], 200);
        }
    }

    public function index_page()
    {
        return view('productIndex');
    }
}
