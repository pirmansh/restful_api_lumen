<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    function getAll(Request $request)
    {
        $pageSize = $request->get("pageSize", 10);
        $page = $request->get("page", 1);
        $sort = $request->get("sort", "SupplierID");
        $asc = $request->get("asc", "true");
        $builder = DB::table('suppliers');
        $count = $builder->count();
        $builder = $builder->orderBy($sort, $asc == "true" ? "asc" : "desc");
        $builder->paginate($pageSize);
        $supplier = $builder->get();
        return response()->json([
            'data' => $supplier,
            'totalRow' => $count,
            'totalPage' => ceil($count / $pageSize),
            'direction' => $asc == 'true' ? 'ASC' : 'DESC'
        ]);

    }

    function getById(Request $request, $id)
    {
        $supplier = DB::table('suppliers')
                    -> where("SupplierID", $id);
                    
        if($supplier->exists())
        {
            return response()->json($supplier->first());
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
        $success = DB::table('suppliers')->insert($data);
        return response()->json([
            'success' => true,
            'message' => 'Insert data success',
            'data' => $data
        ]);
    }

    function update(Request $request, $id)
    {
        $builder = DB::table('suppliers');
        $data = $request->all();
        $supplier = $builder->where("SupplierID", $id);

        if($supplier->exists())
        {
            $supplier->update($data);
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
        $builder = DB::table('suppliers');
        $data = $request->all();
        $supplier = $builder->where("SupplierID", $id);

        if($supplier->exists())
        {
            $supplier->delete();
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
