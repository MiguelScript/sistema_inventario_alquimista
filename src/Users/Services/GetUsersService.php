<?php

namespace Src\Users\Services;

use Src\Users\Repository\UserRepository;
use Illuminate\Http\Request;


class GetUsersService
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($offset, $limit, $search, $status)
    {

        if ($search == "") {
            $query = $this->repository->get_users_by_offset_and_limit($offset, $limit);
        } else {
            $query = $this->repository->get_users_by_offset_and_limit_and_search($offset, $limit, $search);
        }
        
        return $query;
    }
}
