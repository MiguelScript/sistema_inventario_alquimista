<?php

namespace Src\Users\Repositories;

use Src\Users\Model\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository
{
    protected $model;

    /**
     * UserRepository constructor.
     *
     * @param User $post
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function get_users_by_offset_and_limit($offset, $limit)
    {
        return $this->model->skip($offset)->take($limit)->get();
    }

    public function get_users_by_offset_and_limit_and_search($offset, $limit, $search)
    {
        return $this->model->where('nombre', 'like', '%' . $search . '%')->skip($offset)->take($limit)->get();
    }

    public function create($data)
    {
        return $this->model->insert($data);
    }

    public function update(array $data, $id)
    {
        return $this->model->where('id', $id)
            ->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function find($id)
    {
        if (null == $user = $this->model->find($id)) {
            throw new ModelNotFoundException("User not found");
        }

        return $user;
    }
}
