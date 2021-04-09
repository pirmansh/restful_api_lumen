<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

        
    function getAll(Request $request)
    {
        $pageSize = $request->get("pageSize", 10);
        $page = $request->get("page", 1);
        $sort = $request->get("sort", "CategoryID");
        $asc = $request->get("asc", "true");
        $builder = DB::table('categories');
        $count = $builder->count();
        $builder = $builder->orderBy($sort, $asc == "true" ? "asc" : "desc");
        $builder->paginate($pageSize);
        $categories = $builder->get();
        return response()->json([
            'data' => $categories,
            'totalRow' => $count,
            'totalPage' => ceil($count / $pageSize),
            'direction' => $asc == 'true' ? 'ASC' : 'DESC'
        ]);

    }

    function getById(Request $request, $id)
    {
        $categories = DB::table('categories')
                    -> where("CategoryID", $id);
                    
        if($categories->exists())
        {
            return response()->json($categories->first());
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
        $success = DB::table('categories')->insert($data);
        return response()->json([
            'success' => true,
            'message' => 'Insert data success',
            'data' => $data
        ]);
    }

    function update(Request $request, $id)
    {
        $builder = DB::table('categories');
        $data = $request->all();
        $categories = $builder->where("CategoryID", $id);

        if($categories->exists())
        {
            $categories->update($data);
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
        $builder = DB::table('categories');
        $data = $request->all();
        $categories = $builder->where("CategoryID", $id);

        if($categories->exists())
        {
            $categories->delete($data);
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
