<?php


namespace App\Repositores;


use App\Repositores\Contracts\RepositoryInterface;
use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository implements RepositoryInterface
{
    protected $app;

    protected $model;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new \Exception("Class {$this->model()} must be an instance of Model");
        }

        return $this->model = $model;
    }

    abstract function store(Array $array);

    abstract function update(Array $array, $id);

    public function all(){
        return $this->model->all();
    }

    public function findAllByUser($user_id)
    {
        return $this->model->where('user_id', '=', $user_id)->orderBy('id', 'desc')->get();
    }

    public function show($id){
        return $this->model->find($id);
    }

    public function destroy($id){
        return $this->model->destroy($id);
    }

    function paginate($limit = 20){
        return $this->model->paginate($limit);
    }

    abstract public function model(): string;
}
