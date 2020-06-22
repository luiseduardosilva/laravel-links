<?php


namespace App\Repositores\Contracts;


use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function model(): string;

    public function all();

    public function findAllByUser($user_id);

    public function show($id);

    public function store(Array $array);

    public function destroy($id);

    public function paginate($limit = 20);

}
