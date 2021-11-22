<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * List inventory
     * 
     * @param Request $request
     * 
     * @return Response
     */
    public function index(Request $request) : Response
    {
        $user = Auth::user();

        $query = QueryBuilder::for(Inventory::class)
        ->with('product')
        ->whereExists(function ($query) use ($user) {
            $query->select(DB::raw(1))
                  ->from('products')
                  ->whereColumn('products.id', 'inventories.product_id')
                  ->where('products.admin_id', '=', $user->id);
        });

        return response()->json(
            $query->get()
        );
    }
}
