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
        return Feed::select('feeds.*', 'users.name as user_name', 'users.email as email', 'users.photo as photo')
            ->join('users', 'users.id', '=', 'feeds.user_id')
            ->where('feeds.active', true)
            ->orderBy('feeds.created_at', 'desc')
            ->get();
    }
}
