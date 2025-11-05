<?php

namespace RaoulHofmann\L1\D1;

use Illuminate\Database\Schema\Grammars\SQLiteGrammar;
use Illuminate\Support\Str;

class D1SchemaGrammar extends SQLiteGrammar
{
    /** @inheritDoc */
    public function compileTableExists($schema, $table): string
    {
        return Str::of(parent::compileTableExists($schema, $table))
            ->replace('sqlite_master', 'sqlite_schema')
            ->__toString();
    }

    /** @inheritDoc */
    public function compileDropAllTables($schema = null): string
    {
        return Str::of(parent::compileDropAllTables($schema))
            ->replace('sqlite_master', 'sqlite_schema')
            ->__toString();
    }

    /** @inheritDoc */
    public function compileDropAllViews($schema = null): string
    {
        return Str::of(parent::compileDropAllViews($schema))
            ->replace('sqlite_master', 'sqlite_schema')
            ->__toString();
    }
}