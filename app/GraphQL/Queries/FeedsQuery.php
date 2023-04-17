<?php
namespace App\GraphQL\Queries;

use App\Models\Feed;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class FeedsQuery extends Query
{
    protected $attributes = [
        "name" => "feeds",
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type("Feed"));
    }

    public function resolve($root, $args)
    {
        return Feed::all();
    }
}
