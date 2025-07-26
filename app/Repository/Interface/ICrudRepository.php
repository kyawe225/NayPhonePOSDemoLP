<?php

namespace App\Repository\Interface;

interface ICrudRepository
{
    public function create(array $request);
    public function update(string $id, array $request);
    public function delete(string $id);
    public function get(string $id);
    public function all($request);
}

?>