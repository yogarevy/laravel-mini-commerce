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
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index(Request $request)
    {
        try {
            $search_term = $request->input('search');
            $filterStatus = $request->has('status') ? $request->input('status') : 'all';
            $limit = $request->has('limit') ? $request->input('limit') : 10;
            $sort = $request->has('sort') ? $request->input('sort') : 'updated_at';
            $order = $request->has('order') ? $request->input('order') : 'DESC';
            $status = $request->has('status') ? $request->input('status') : null;
            $conditions = '1 = 1';
            if (!empty($search_term)) {
                $conditions .= " AND category_name LIKE LOWER('%$search_term%')";
            }
            if ($filterStatus != 'all') {
                $conditions .= " AND category_status = $filterStatus";
            }
            $paged = Category::sql()
                ->whereRaw($conditions);

            if ($status) {
                if ($status == 1 || $status == true || $status == 'true' || $status == 'active') {
                    $status = 1;
                }
                $paged = $paged->where('category_status', $status);
            }

            $paged = $paged
                ->orderBy($sort, $order)
                ->paginate($limit);
            return ResponseStd::paginated($paged, Category::count());
        } catch (\Exception $e) {
            return ResponseStd::fail($e->getMessage());
        }
    }

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
