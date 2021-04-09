<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    function getAll(Request $request)
    {
        $pageSize = $request->get("pageSize", 10);
        $page = $request->get("page", 1);
        $sort = $request->get("sort", "OrderID");
        $asc = $request->get("asc", "true");
        $builder = DB::table('orders');
        $count = $builder->count();
        $builder = $builder->orderBy($sort, $asc == "true" ? "asc" : "desc");
        $builder->paginate($pageSize);
        $orders = $builder->get();
        return response()->json([
            'data' => $orders,
            'totalRow' => $count,
            'totalPage' => ceil($count / $pageSize),
            'direction' => $asc == 'true' ? 'ASC' : 'DESC'
        ]);

    }

    function getById(Request $request, $id)
    {
        $orders = DB::table('orders')
                    -> where("OrderID", $id);
                    
        if($orders->exists())
        {
            return response()->json($orders->first());
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
        $success = DB::table('orders')->insert($data);
        return response()->json([
            'success' => true,
            'message' => 'Insert data success',
            'data' => $data
        ]);
    }

    function update(Request $request, $id)
    {
        $builder = DB::table('orders');
        $data = $request->all();
        $orders = $builder->where("OrderID", $id);

        if($orders->exists())
        {
            $orders->update($data);
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
        $builder = DB::table('orders');
        $data = $request->all();
        $orders = $builder->where("OrderID", $id);

        if($orders->exists())
        {
            $orders->delete();
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
