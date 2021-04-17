<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    function getAll(Request $request)
    {
        $pageSize = $request->get("pageSize", 10);
        $page = $request->get("page", 1);
        $sort = $request->get("sort", "EmployeeID");
        $asc = $request->get("asc", "true");
        $builder = DB::table('employees');
        $count = $builder->count();
        $builder = $builder->orderBy($sort, $asc == "true" ? "asc" : "desc");
        $builder->paginate($pageSize);
        $employee = $builder->get();
        return response()->json([
            'data' => $employee,
            'totalRow' => $count,
            'totalPage' => ceil($count / $pageSize),
            'direction' => $asc == 'true' ? 'ASC' : 'DESC'
        ]);
    }

    function getById(Request $request, $id)
    {
        $employee = DB::table('employees')
                    -> where("EmployeeID", $id);
                    
        if($employee->exists())
        {
            return response()->json($employee->first());
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
        $success = DB::table('employees')->insert($data);
        return response()->json([
            'success' => true,
            'message' => 'Insert data success',
            'data' => $data
        ]);
    }

    function update(Request $request, $id)
    {
        $builder = DB::table('employees');
        $data = $request->all();
        $employee = $builder->where("EmployeeID", $id);

        if($employee->exists())
        {
            $employee->update($data);
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
        $builder = DB::table('employees');
        $data = $request->all();
        $employee = $builder->where("EmployeeID", $id);

        if($employee->exists())
        {
            $employee->delete();
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
