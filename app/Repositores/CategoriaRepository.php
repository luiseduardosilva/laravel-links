<?php


namespace App\Repositores;

use App\Categoria;
use App\Repositores\Contracts\CategoriaRepositoryInterface;

class CategoriaRepository extends AbstractRepository implements CategoriaRepositoryInterface
{
    protected $user;

    public function store(Array $data)
    {
        $this->model->nome      = $data['nome'];
        $this->model->user_id   = $data['user_id'];

        $this->model->save();
        return $this->model;
    }

    public function update($data, $id){
        $cat        = $this->model->find($id);
        $cat->nome  = $data['nome'];
        $cat->save();

        return $cat;
    }

    public function destroy($id)
    {
        return $this->model->find($id)->delete();
    }

    public function paginate($limit = 20)
    {
        return $this->model->paginate($limit);
    }

    public function model(): string
    {
        return Categoria::class;
    }
}
