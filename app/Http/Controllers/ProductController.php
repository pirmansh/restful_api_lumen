<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{  
    function getAll(Request $request)
    {
        $pageSize = $request->get("pageSize", 10);
        $page = $request->get("page", 1);
        $sort = $request->get("sort", "ProductID");
        $asc = $request->get("asc", "true");
        $builder = DB::table('products');
        $count = $builder->count();
        $builder = $builder->orderBy($sort, $asc == "true" ? "asc" : "desc");
        $builder->paginate($pageSize);
        $product = $builder->get();
        return response()->json([
            'data' => $product,
            'totalRow' => $count,
            'totalPage' => ceil($count / $pageSize),
            'direction' => $asc == 'true' ? 'ASC' : 'DESC'
        ]);

    }

    function getById(Request $request, $id)
    {
        $product = DB::table('products')
                    -> where("ProductID", $id);
                    
        if($product->exists())
        {
            return response()->json($product->first());
        } 
        else 
        {
            return response()->json([
                'success' => false,
                'status' => 404,
                'type' => 'Not Found',
                'detail' => 'Data Not Found',
                'timestamp' => time()
            ], 404);
        }  
    }

    function insert(Request $request)
    {
        $data = $request->all();
        $success = DB::table('products')->insert($data);
        return response()->json([
            'success' => true,
            'message' => 'Insert data success',
            'data' => $data
        ]);
    }

    function update(Request $request, $id)
    {
        $builder = DB::table('products');
        $data = $request->all();
        $product = $builder->where("ProductID", $id);

        if($product->exists())
        {
            $product->update($data);
            return response()->json([
                'success' => true,
                'message' => 'Update data success',
                'data' => $data
            ]);
        }
        else 
        {
            return response()->json([
                'success' => false,
                'status' => 404,
                'type' => 'Not Found',
                'detail' => 'Data Not Found',
                'timestamp' => time()
            ], 404);
        } 
    }

    function delete(Request $request, $id)
    {
        $builder = DB::table('products');
        $data = $request->all();
        $product = $builder->where("ProductID", $id);

        if($product->exists())
        {
            $product->delete();
            return response()->json([
                'success' => true,
                'message' => 'Delete data success',
                'data' => $data
            ]);
        }
        else 
        {
            return response()->json([
                'success' => false,
                'status' => 404,
                'type' => 'Not Found',
                'detail' => 'Data Not Found',
                'timestamp' => time()
            ], 404);
        } 
    }
}
