<?php

namespace App\Http\Controllers\API;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PricesController extends Controller{
	public function saveProduct(Request $request){
		if (!empty($request->product)){
			$product=new Product();
			$product->name=$request->product;
			$product->save();
			return $this->listProducts($request);

		}
		return response()->json(['message'=>'Product not saved'],200);
	}
	public function listProducts(Request $request){
		$products=Product::orderBy('name')->get();
		return response()->json($products,200);
	}
	public function deleteProduct(Request $request, $id=0){
		if ($id>0){
			Product::destroy([$id]);
			return $this->listProducts($request);
		}
		return response()->json(['message'=>'Product Id not found'],200);
	}
}
