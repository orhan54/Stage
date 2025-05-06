<?php

namespace App\Model\DAO;

use App\Model\Entity\AbstractEntity;

interface DAOInterface
{
    public function create(AbstractEntity $entity): AbstractEntity;
    public function readOne(int $id): AbstractEntity;
    public function readAll(): array;
    public function update(AbstractEntity $entity): bool;
    public function delete(AbstractEntity $entity): bool;
}
