<?php

namespace RaoulHofmann\L1;

use Saloon\Http\Connector;
use Saloon\Http\Auth\TokenAuthenticator;

abstract class CloudflareConnector extends Connector
{
    public function __construct(
        protected ?string $token = null,
        public ?string $accountId = null,
        public string $apiUrl = 'https://api.cloudflare.com/client/v4',
    ) {
        $this->authenticate(new TokenAuthenticator($token));
    }

    public function resolveBaseUrl(): string
    {
        return $this->apiUrl;
    }

    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }
}
