<?php

namespace Src\Users\UseCases;

use Src\Users\Services\GetUsersService;

class GetUsersUseCase
{

    protected $get_users_service;

    public function __construct(GetUsersService $get_users_service)
    {
        $this->get_users_service = $get_users_service;
    }

    public function __invoke($request)
    {

        $offset = $request->get('offset');
        $limit = $request->get('limit');
        $search = $request->get('search');
        $status = $request->get('search');

        $users = $this->get_users_service->__invoke(
            $offset,
            $limit,
            $search,
            $status
        );

        return $this->setResponse($users);
    }

    public function setResponse($query)
    {
        if ($query) {
            return [
                'data' => ['users' => $query],
                'msg' => "se han encontrado productos",
            ];
        } else {
            return [
                'data' =>  ['users' => []],
                'msg' => "Oh no, no se han encontrado productos",
            ];
        }
    }
}
