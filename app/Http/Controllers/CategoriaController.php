<?php

namespace App\Http\Controllers;

use App\Services\Contracts\CategoriaServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Categoria;

class CategoriaController extends CrudController
{
    public function __construct(CategoriaServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->service->store($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->service->update($request, $id);
    }
}
