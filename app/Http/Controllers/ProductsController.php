<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Spatie\QueryBuilder\QueryBuilder;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * List products
     * 
     * @param Request $request
     * 
     * @return Response
     */
    public function index(Request $request): Response
    {
        $user = Auth::user();

        $query = QueryBuilder::for(Products::class)
            ->select('product_name', 'style', 'brand')
            ->allowedFields(['products.id', 'products.product_name', 'products.style', 'products.brand', 'inventory.sku'])
            ->allowedIncludes('inventory');

        return response()->json(
            $query->where('admin_id', '=', $user->id)->get()
        );
    }

    /**
     * Store a product
     * 
     * @param Request $request
     * 
     * @return Response
     */
    public function store(Request $request): Response
    {
        $user = Auth::user();

        $data = $this->validate($request, [
            'product_name' => 'required|string|max:255',
            'description' => 'required|string',
            'style' => 'required|string',
            'brand' => 'required|string',
            'url' => 'nullable|string',
            'product_type' => 'required|string',
            'shipping_price' => 'required|numeric',
            'note' => 'required|string',
        ]);
        $data['admin_id'] = $user->id;

        $product = Products::create($data);

        return response()->json($product, 201);
    }
}
