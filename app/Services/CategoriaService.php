<?php


namespace App\Services;


use App\Repositores\Contracts\CategoriaRepositoryInterface;
use App\Services\Contracts\CategoriaServiceInterface;

class CategoriaService extends AbstractService implements CategoriaServiceInterface
{

    private $repository;

    function __construct(CategoriaRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    function all(){
        return $this->repository->all();
    }


    public function findAllByUser($request)
    {
        return $this->repository->findAllByUser($request->input('user_id'));
    }

    function show($id){
        return $this->repository->show($id);
    }

    function store($request){
        $data   = $request->only(['nome', 'user_id']);

        return $this->repository->store($data);
    }

    function update($request, $id){

        $data = $request->only(['nome']);

        return $this->repository->update($data, $id);
    }

    function destroy($id){

        $item = $this->repository->show($id);
        if(empty($item)){
            return ["error" => "nenhum dado encontrado"];
        }

        $this->repository->destroy($id);

        return ["msg" => "Dado deletado!"];
    }

    public function paginate($limit = 20)
    {
        return $this->repository->paginate($limit);
    }

}
