<?php

namespace App\Http\Controllers\API;

use App\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopsController extends Controller {
	public function saveShop(Request $request){
		if (!empty($request->name)){
			$shop=new Shop();
			$shop->name=$request->name;
			$shop->url=$request->url;
			$shop->regex=$request->regex;
			$shop->save();
			return $this->listShops($request);
		}
		return response()->json(['message'=>'Shop not saved'],200);
	}
	public function listShops(Request $request){
		$shops=Shop::orderBy('name')->get();
		return response()->json($shops,200);
	}
	public function deleteShop(Request $request, $id=0){
		if ($id>0){
			Shop::destroy([$id]);
			return $this->listShops($request);
		}
		return response()->json(['message'=>'Shop Id not found'],200);
	}
}
