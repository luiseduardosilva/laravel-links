<?php


namespace App\Services;


use App\Repositores\Contracts\LinkRepositoryInterface;
use App\Services\Contracts\LinkServiceInterface;

class LinkService extends AbstractService implements LinkServiceInterface
{
    private $repository;

    function __construct(LinkRepositoryInterface $repository)
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

        $data   = $request->only(['link', 'user_id', 'categoria_id']);
        return $this->repository->store($data);
    }

    function update($request, $id){

        $data = $request->only(['link', 'user_id', 'categoria_id']);

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
