<?php
namespace App\GraphQL\Types;
use App\Models\Feed;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class FeedType extends GraphQLType
{
    protected $attributes = [
        "name" => "Feed",
        "description" => "Collection of feeds and details",
        "model" => Feed::class,
    ];
    public function fields(): array
    {
        return [
            "id" => [
                "type" => Type::nonNull(Type::int()),
                "description" => "Id of a particular feed",
            ],
            "title" => [
                "type" => Type::string(),
                "description" => "The title of the feed",
            ],
            "content" => [
                "type" => Type::nonNull(Type::string()),
                "description" => "The content of the feed",
            ],
            "user_name" => [
                "type" => Type::nonNull(Type::string()),
                "description" => "User name",
            ],
            "photo" => [
                "type" => Type::string(),
                "description" => "User photo",
            ],
            "user_id" => [
                "type" => Type::nonNull(Type::int()),
                "description" => "User ID",
            ]
        ];
    }
}
