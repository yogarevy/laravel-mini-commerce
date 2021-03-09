<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateRequest;
use App\Libraries\ResponseStd;
use App\Models\Category;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;

class CategoryController extends Controller
{
    //
    /**
     * Show the form for creating a new resource.
     *
     * @param CreateRequest $request
     * @return array
     * @throws \Exception
     */
    public function create(CreateRequest $request)
    {
        \DB::beginTransaction();
        try {
            $item = Category::create([
                'id' => Uuid::generate(4)->string,
                'category_name' => $request->category_name,
                'category_status' => !$request->category_status ? false : true,
                'last_modified_by' => auth('api')->user()->id
            ]);
            \DB::commit();
            return ResponseStd::okSingle($item, $messages = 'Success create category.');
        } catch (\Exception $e) {
            \DB::rollBack();
            return ResponseStd::fail($e->getMessage());
        }
    }
}
