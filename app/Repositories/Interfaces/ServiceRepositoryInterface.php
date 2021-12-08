<?php namespace App\Repositories\Interfaces;

/**
 * Interface UserInterface
 * @package App\Repositories\Interfaces
 */
interface ServiceRepositoryInterface
{
    public function getAll();

    public function getService($serviceId);
}