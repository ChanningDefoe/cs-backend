<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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

        return response()->json(['message' => 'This is secure area.']);
    }
}
