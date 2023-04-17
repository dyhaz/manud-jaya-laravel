<?php
namespace App\GraphQL\Queries;
use App\Models\Feed;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
class FeedQuery extends Query
{
    protected $attributes = [
        "name" => "feed",
    ];
    public function type(): Type
    {
        return GraphQL::type("Feed");
    }
    public function args(): array
    {
        return [
            "id" => [
                "name" => "id",
                "type" => Type::int(),
                "rules" => ["required"],
            ],
        ];
    }
    public function resolve($root, $args)
    {
        return Feed::findOrFail($args["id"]);
    }
}
