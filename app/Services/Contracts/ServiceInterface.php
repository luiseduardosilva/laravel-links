<?php


namespace App\Services\Contracts;


use Illuminate\Http\Request;

interface ServiceInterface
{
    public function all();

    public function findAllByUser($request);

    public function show($id);

    public function store(Request $request);

    public function update(Request $request, $id);

    public function destroy($id);

    public function paginate($limit = 20);
}
