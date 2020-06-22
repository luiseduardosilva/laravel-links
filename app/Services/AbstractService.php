<?php


namespace App\Services;
use App\Repositores\Contracts\RepositoryInterface;
use App\Services\Contracts\ServiceInterface;
use Illuminate\Http\Request;

abstract class AbstractService implements ServiceInterface
{
    private $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function findAllByUser($request)
    {
        return $this->repository->findAllByUser($request->input('user_id'));
    }

    function show($id){
        return $this->repository->show($id);
    }

    public function paginate($limit = 20)
    {
        return $this->repository->paginate($limit);
    }

    abstract function store(Request $request);

    abstract function update(Request $request, $id);

    abstract function destroy($id);




}
