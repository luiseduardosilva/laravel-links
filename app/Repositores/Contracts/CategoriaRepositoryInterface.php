<?php


namespace App\Repositores\Contracts;


interface CategoriaRepositoryInterface extends RepositoryInterface
{
    function paginate($limit = 20);
}
