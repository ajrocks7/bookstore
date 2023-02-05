<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Elastic\Elasticsearch\ClientBuilder;
class products extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'description',
        'genre',
        'isbn',
        'published',
        'publisher',
    ];

    protected $mapping = [
        'properties' => [
            'id' => [
                'type' => 'integer',
                'index' => 'not_analyzed'
            ],
            'title' => [
                'type' => 'text',
                'analyzer' => 'keyword'
            ],
            'author' => [
                'type' => 'text',
                'analyzer' => 'keyword'
            ],
            'genre' => [
                'type' => 'text'
            ],
            'image' => [
                'type' => 'text'
            ],
            'description' => [
                'type' => 'text'
            ],
            'isbn' => [
                'type' => 'text'
            ],
            'published' => [
                'type' => 'date',
                'format'=> 'Y-m-d',
            ],
            'publisher' => [
                'type' => 'text',
                'analyzer' => 'keyword'
            ],
            'status' => [
                'type' => 'integer'
            ],
        ]
    ];

    public function getIndexName()
    {
        return 'products';
    }
}




