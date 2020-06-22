<?php

namespace App\Http\Controllers;

use App\Services\Contracts\LinkServiceInterface;
use Illuminate\Http\Request;

class LinkController extends CrudController
{

    public function __construct(LinkServiceInterface $service)
    {
        $this->service = $service;
    }

    public function store(Request $request){
        return $this->service->store($request);
    }

    public function update(Request $request, $id)
    {
        return $this->service->update($request, $id);
    }





}
