<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\ServiceRepositoryInterface;

class ServiceController extends Controller
{
    /**
     * The UserRepository instance.
     *
     * @var App\Repositories\Interfaces\ServiceRepositoryInterface
     */
    protected $serviceRepository;

    /**
     * Create a new ServiceController instance.
     *
     * @param  App\Repositories\Interfaces\ServiceRepositoryInterface $serviceRepository
     * @return void
     */
    public function __construct(ServiceRepositoryInterface $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function index()
    {
        $services = $this->serviceRepository->getAll();

        return view('services', [
            'services' => $services,
        ]);
    }

    public function show($id)
    {
        $service = $this->serviceRepository->getService($id);

        return view('service', [
            'service' => $service,
        ]);
    }
}
