<?php
namespace App\GraphQL\Mutations;
use App\Models\Feed;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
class CreateFeedMutation extends Mutation
{
    protected $attributes = [
        "name" => "createFeed",
    ];
    public function type(): Type
    {
        return GraphQL::type("Feed");
    }
    public function args(): array
    {
        return [
            "title" => [
                "name" => "title",
                "type" => Type::string(),
            ],
            "content" => [
                "name" => "content",
                "type" => Type::nonNull(Type::string()),
            ],
            "user_id" => [
                "name" => "user_id",
                "type" => Type::nonNull(Type::int()),
            ]
        ];
    }
    public function resolve($root, $args)
    {
        $feed = new Feed();
        $feed->fill($args);
        $feed->save();
        return $feed;
    }
}
