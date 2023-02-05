<?php
namespace App\Http\Traits;
use App\Models\products;

trait HelperTrait{
public function createindex($products)
{
   
        $id = uniqid();
        if($products->hasfile('bookimage'))
            {
               $image = $products->file('bookimage');
               $name = asset('').""."uploads/".'book_'.time().'.'.$image->getClientOriginalExtension();
               $image->move(public_path().'/uploads', $name);
            }else{
               $name = asset('').""."no-image.png";
            }
    
    
    
    $params = [
        'index' => 'products',
        'type' => '_doc',
        'id' => $id,
        'body' => [
            'title' => $products->title,
            'author' => $products->author,
            'genre' => $products->genre,
            'image'=>$name,
            'description' => $products->description,
            'isbn' => $products->isbn,
            'published' => date('Y-m-d',strtotime($products->publisheddate)),
            'publisher' => $products->publisher,
            'status' => 1,
        ],
        'mapping' => [
            'properties' => [
            'title' => [
            'type' => 'text',
            'fields' => [
            'keyword' => [
            'type' => 'keyword',
            'ignore_above' => 256
            ]
            ]
            ],
            'author' => [
            'type' => 'text',
            'fields' => [
            'keyword' => [
            'type' => 'keyword',
            'ignore_above' => 256
            ]
            ]
            ],
            'genre' => [
            'type' => 'text',
            'fields' => [
            'keyword' => [
            'type' => 'keyword',
            'ignore_above' => 256
            ]
            ]
            ],
            'image' => [
            'type' => 'text',
            'fields' => [
            'keyword' => [
            'type' => 'keyword',
            'ignore_above' => 256
            ]
            ]
            ],
            'description' => [
            'type' => 'text',
            'fields' => [
            'keyword' => [
            'type' => 'keyword',
            'ignore_above' => 256
            ]
            ]
            ],
            'isbn' => [
            'type' => 'text',
            'fields' => [
            'keyword' => [
            'type' => 'keyword',
            'ignore_above' => 256
            ]
            ]
            ],
            'published' => [
            'type' => 'date',
            'format' => 'Y-m-d',
            ],
            'publisher' => [
            'type' => 'text',
            'fields' => [
            'keyword' => [
            'type' => 'keyword',
            'ignore_above' => 256
            ]
            ]
            ],
            'status' => [
            'type' => 'integer'
            ]
            ]
            ],
    ];

    $this->client->index($params);
}

public function updateindex($products,$productid)
{
    //dd($products->title);
    if($products->hasFile('bookimage')) {  
        $image = $products->file('bookimage');
        $name = asset('').""."uploads/".'book_'.time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path().'/uploads', $name);
    }else{
        $name = $products->existimage; 
    }

    $params = [
        'index' => 'products',
        'id' => $productid,
        'body' => [
            'doc' => [
            'title' => $products->title,
            'author' => $products->author,
            'genre' => $products->genre,
            'image'=>$name,
            'description' => $products->description,
            'isbn' => $products->isbn,
            'published' => date('Y-m-d',strtotime($products->publisheddate)),
            'publisher' => $products->publisher,
            'status' => 1,
            ],
        ],
        'mapping' => [
            'properties' => [
            'title' => [
            'type' => 'text',
            'fields' => [
            'keyword' => [
            'type' => 'keyword',
            'ignore_above' => 256
            ]
            ]
            ],
            'author' => [
            'type' => 'text',
            'fields' => [
            'keyword' => [
            'type' => 'keyword',
            'ignore_above' => 256
            ]
            ]
            ],
            'genre' => [
            'type' => 'text',
            'fields' => [
            'keyword' => [
            'type' => 'keyword',
            'ignore_above' => 256
            ]
            ]
            ],
            'image' => [
            'type' => 'text',
            'fields' => [
            'keyword' => [
            'type' => 'keyword',
            'ignore_above' => 256
            ]
            ]
            ],
            'description' => [
            'type' => 'text',
            'fields' => [
            'keyword' => [
            'type' => 'keyword',
            'ignore_above' => 256
            ]
            ]
            ],
            'isbn' => [
            'type' => 'text',
            'fields' => [
            'keyword' => [
            'type' => 'keyword',
            'ignore_above' => 256
            ]
            ]
            ],
            'published' => [
            'type' => 'date',
            'format' => 'Y-m-d',
            ],
            'publisher' => [
            'type' => 'text',
            'fields' => [
            'keyword' => [
            'type' => 'keyword',
            'ignore_above' => 256
            ]
            ]
            ],
            'status' => [
            'type' => 'integer'
            ]
            ]
            ],
    ];

    $this->client->update($params);
}

public function bulkcreateindex($books)
{

    $params = [
        'index' => 'products',
        'body' => [],
        ];
        $params['body'][] = [
        'index' => [
        '_id' => $books->id
        ]
        ];
        $params['body'][] = [
        'title' => $books->title,
        'author' => $books->author,
        'genre' => $books->genre,
        'image'=> $books->image,
        'description' => $books->description,
        'isbn' => $books->isbn,
        'published' => date('Y-m-d', strtotime($books->published)),
        'publisher' => $books->publisher,
        'status' => 1,
        'mapping' => [
        'properties' => [
        'title' => [
        'type' => 'text',
        'fields' => [
        'keyword' => [
        'type' => 'keyword',
        'ignore_above' => 256
        ]
        ]
        ],
        'author' => [
        'type' => 'text',
        'fields' => [
        'keyword' => [
        'type' => 'keyword',
        'ignore_above' => 256
        ]
        ]
        ],
        'genre' => [
        'type' => 'text',
        'fields' => [
        'keyword' => [
        'type' => 'keyword',
        'ignore_above' => 256
        ]
        ]
        ],
        'image' => [
        'type' => 'text',
        'fields' => [
        'keyword' => [
        'type' => 'keyword',
        'ignore_above' => 256
        ]
        ]
        ],
        'description' => [
        'type' => 'text',
        'fields' => [
        'keyword' => [
        'type' => 'keyword',
        'ignore_above' => 256
        ]
        ]
        ],
        'isbn' => [
        'type' => 'text',
        'fields' => [
        'keyword' => [
        'type' => 'keyword',
        'ignore_above' => 256
        ]
        ]
        ],
        'published' => [
        'type' => 'date',
        'format' => 'Y-m-d',
        ],
        'publisher' => [
        'type' => 'text',
        'fields' => [
        'keyword' => [
        'type' => 'keyword',
        'ignore_above' => 256
        ]
        ]
        ],
        'status' => [
        'type' => 'integer'
        ]
        ]
        ],
        ];
        
        $res = $this->client->bulk($params);
    //echo"<pre>";print_r($res);
    //exit();
}



// I First added my products in my DB,but now since i use ES Cloud i dont need this
//public function updatecreateproducts($request,$prddetails,$type)
//     {
//         //insert
//             if($type == 1){
//             $prddetails->title = $request->title;
//             $prddetails->author = $request->author;
//             $prddetails->genre = $request->genre;
//             $prddetails->description = $request->description;
//             $prddetails->isbn = $request->isbn;
//             $prddetails->published = date('Y-m-d',strtotime($request->publisheddate));
//             $prddetails->publisher = $request->publisher;
//             if($request->hasfile('bookimage'))
//             {
//                $image = $request->file('bookimage');
//                $name = asset('').""."uploads/".'book_'.time().'.'.$image->getClientOriginalExtension();
//                $image->move(public_path().'/uploads', $name);
//                $prddetails->image = $name;
//             }else{
//                $name = asset('').""."no-image.png";
//                $prddetails->image = $name;
//             }
//             $prddetails->save();
//             return $prddetails;
//             }else if($type == 2)
//             {
//                 //update
//                 if($request->hasFile('bookimage')) {  
//                     $image = $request->file('bookimage');
//                     $name = asset('').""."uploads/".'book_'.time().'.'.$image->getClientOriginalExtension();
//                     $image->move(public_path().'/uploads', $name);
//                     $prddetails->image = $name;
//                 }else{
//                     $name = $request->existimage; 
//                     $prddetails->image = $name;
//                 }
//                 $prddetails->title = $request->title;
//                 $prddetails->author = $request->author;
//                 $prddetails->genre = $request->genre;
//                 $prddetails->description = $request->description;
//                 $prddetails->isbn = $request->isbn;
//                 $prddetails->published = date('Y-m-d',strtotime($request->publisheddate));
//                 $prddetails->publisher = $request->publisher;
//                 $prddetails->save();
//                 return $prddetails;
//             }
//     }

}
?>