<?php


namespace App\Repositores;


use App\Link;
use App\Repositores\Contracts\LinkRepositoryInterface;

class LinkRepository extends AbstractRepository implements LinkRepositoryInterface
{
    public function show($id){
        return $this->model->find($id);
    }

    public function store(Array $data){

        $this->model->link          = $data['link'];
        $this->model->user_id       = $data['user_id'];
        $this->model->categoria_id  = $data['categoria_id'];

        $this->model->save();
        return $this->model;
    }

    public function update($data, $id){
        $link                       = $this->model->find($id);

        $link->link          = $data['link'];
        $link->categoria_id  = $data['categoria_id'];
        $link->save();

        return $link;
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
        return Link::class;
    }
}
