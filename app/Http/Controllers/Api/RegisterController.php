<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Register\CreateRequest;
use App\Libraries\ResponseStd;
use App\Models\User;
use Symfony\Component\HttpFoundation\JsonResponse;

class RegisterController extends Controller
{
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
            $item = new User();
            $item->name = $request->name;
            $item->email = $request->email;
            $item->password = bcrypt($request->password);
            $item->status = 1;
            $item->is_seller = 0;
            $item->save();


            \DB::commit();
            return ResponseStd::okNoOutput($messages = 'Success Registration.');
        } catch (\Exception $e) {
            \DB::rollback();
            return ResponseStd::fail($e->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR, $messages='Registration Failed.');
        }
    }
}
