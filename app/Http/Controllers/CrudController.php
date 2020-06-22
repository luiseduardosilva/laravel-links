<?php


namespace App\Http\Controllers;


use App\Services\Contracts\ServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

abstract class CrudController extends Controller
{
    protected $service;

    public function __construct(ServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index(): JsonResponse
    {
        $limit = app('request')->query('limit');

        $items = $limit ? $this->service->paginate($limit) : $this->service->all();

        return new JsonResponse($items, 200, []);
    }


    public function findAllByUser(Request $request): JsonResponse
    {
        $items = $this->service->findAllByUser($request);
        return new JsonResponse($items, 200, []);
    }


    public function show($id): JsonResponse
    {
        return new JsonResponse($this->service->show($id), 200, []);
    }

    public function destroy($id): JsonResponse {
        return new JsonResponse($this->service->destroy($id), 200, []);
    }
}
