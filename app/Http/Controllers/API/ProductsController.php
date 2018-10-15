<?php

namespace App\Http\Controllers\API;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller {
	public function getProduct($id){
		if ($id>0){
			$product=Product::find($id);
			return $product;
		}
	}
	public function saveProduct(Request $request,$id=null){
		if (!empty($request->product)){
			if (!$id) {
				$product = new Product();
			}else{
				$product=Product::find($id);
			}
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
