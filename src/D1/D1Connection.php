<?php

namespace RaoulHofmann\L1\D1;

use Illuminate\Database\SQLiteConnection;
use RaoulHofmann\L1\CloudflareD1Connector;
use RaoulHofmann\L1\D1\Pdo\D1Pdo;

class D1Connection extends SQLiteConnection
{
    public function __construct(
        protected CloudflareD1Connector $connector,
        protected $config = [],
    ) {
        parent::__construct(
            new D1Pdo('sqlite::memory:', $this->connector),
            $config['database'] ?? '',
            $config['prefix'] ?? '',
            $config,
        );
    }

    protected function getDefaultSchemaGrammar(): D1SchemaGrammar
    {
        return new D1SchemaGrammar($this);
    }

    public function d1(): CloudflareD1Connector
    {
        return $this->connector;
    }
}