<?php

declare(strict_types=1);

namespace Schema;

use GraphQL\Type\Schema;
use GraphQL\Type\SchemaConfig;
use Types\TypeRegistry;

class SchemaSetup
{
    public static function getSchema()
    {
        return new Schema(
            (new SchemaConfig())
                ->setQuery(TypeRegistry::query())
                ->setMutation(TypeRegistry::mutation())
        );
    }
}
