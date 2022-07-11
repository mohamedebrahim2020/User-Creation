<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\services\UserService;
use Illuminate\Http\Response;

class UserController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $this->service->store($request->validated()); //avoid sql injection
        return response()->json(null, Response::HTTP_CREATED);
    }
}
