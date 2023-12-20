<?php

namespace ModMage\PmReport\Api;

interface WaysRepositoryInterface
{
    public function save(\ModMage\PmReport\Api\Data\WaysInterface $ways);

    public function getById($id);

    public function delete(\ModMage\PmReport\Api\Data\WaysInterface $ways);

    public function deleteById($id);
}
