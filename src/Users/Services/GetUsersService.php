<?php

namespace App\Services\Users;

use App\Repositories\Users\UserRepository;
use Illuminate\Http\Request;


class GetUsersService
{

    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function make(Request $request)
    {
        $offset = $request->get('offset');
        $limit = $request->get('limit');
        $search = $request->get('search');

        if ($search == "") {
            $query = $this->repository->get_users_by_offset_and_limit($offset, $limit);
        } else {
            $query = $this->repository->get_users_by_offset_and_limit_and_search($offset, $limit, $search);
        }
        return $this->setResponse($query);
    }

    public function setResponse($query)
    {
        if (count($query) > 0) {
            return response([
                'data' => $query,
                'msg' => "Se ha encontrado usuarios",
            ], 200);
        } else {
            return response([
                'data' => $query,
                'msg' => "Ha ocurrido un error, No se han encontrado usuarios",
            ], 400);
        }
    }
}
