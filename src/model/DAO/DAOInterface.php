<?php

namespace App\model\DAO;

use App\model\Entity\AbstractEntity;

interface DAOInterface
{
    public function create(AbstractEntity $entity): AbstractEntity;
    public function readOne(int $id): AbstractEntity;
    public function readAll(): array;
    public function update(AbstractEntity $entity): bool;
    public function delete(AbstractEntity $entity): bool;
}
