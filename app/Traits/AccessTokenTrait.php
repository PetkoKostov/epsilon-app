<?php

namespace App\Traits;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

trait AccessTokenTrait
{
    private $cacheAccessTokenKey = 'authorisation';

    public function getToken()
    {
        if(Cache::has($this->cacheAccessTokenKey)) {
            $accessTokenCache = Cache::get($this->cacheAccessTokenKey);

            //Check if access token is still valid
            $createdAtDate = Carbon::createFromDate($accessTokenCache['created_at']);
            $createdAtDate->addSeconds($accessTokenCache['expires_in']);

            if (Carbon::now()->gte($createdAtDate)) {
                //expired
                $token = $this->refreshToken($accessTokenCache['refresh_token']);
            } else {
                $token = $accessTokenCache;
            }
        } else {
            $token = $this->login();
        }

        return $token['access_token'];
    }

    private function handleFetchTokenResponse($response)
    {
        if($response->ok()) {
            $body = $response->json();
            $body['created_at'] = Carbon::now()->toDateTimeString();

            Cache::put($this->cacheAccessTokenKey, $body);
        } else {
            Cache::forget($this->cacheAccessTokenKey);
        }
    }

    private function refreshToken($refreshToken)
    {
        $response = Http::withHeaders([
            'accept' => 'application/vnd.cloudlx.v1+json'
        ])->post(env('INFINITY_API_URL') . 'oauth2/refresh-token', [
            'refresh_token' => $refreshToken,
            'grant_type' => 'refresh_token',
            'client_id' => env('INFINITY_API_CLIENT_ID'),
            'client_secret' => env('INFINITY_API_CLIENT_SECRET'),
        ]);

        $this->handleFetchTokenResponse($response);

        return $response->json();
    }

    private function login()
    {
        $response = Http::withHeaders([
            'accept' => 'application/vnd.cloudlx.v1+json'
        ])->post(env('INFINITY_API_URL') . 'oauth2/access-token', [
            'grant_type' => 'client_credentials',
            'client_id' => env('INFINITY_API_CLIENT_ID'),
            'client_secret' => env('INFINITY_API_CLIENT_SECRET'),
        ]);

        $this->handleFetchTokenResponse($response);

        return $response->json();
    }
}