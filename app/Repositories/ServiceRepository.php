<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ServiceRepositoryInterface;
use Illuminate\Support\Facades\Http;
use App\Traits\AccessTokenTrait;

class ServiceRepository implements ServiceRepositoryInterface
{
    use AccessTokenTrait;

    /**
     * Return all services
     *
     * @return array
     */
    public function getAll()
    {
        $accessToken = $this->getToken();

        $response = Http::withHeaders([
            'accept' => 'application/vnd.cloudlx.v1+json'
        ])
            ->withToken($accessToken)
            ->get(env('INFINITY_API_URL') . 'services')
            ->json();

        return $response['services'];
    }

    /**
     * Return details of a service
     *
     * @param  int $serviceId
     *
     * @return null | array
     */
    public function getService($serviceId)
    {
        $res = null;

        $accessToken = $this->getToken();
        $url = env('INFINITY_API_URL') . "services/{$serviceId}/service";

        $response = Http::withHeaders([
            'accept' => 'application/vnd.cloudlx.v1+json'
        ])
            ->withToken($accessToken)
            ->get($url);

        if($response->ok()) {
            $res = $response->json();
        }

        return $res;
    }
}