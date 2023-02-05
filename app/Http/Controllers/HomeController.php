<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\products;
use DB;
use Redirect;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Traits\HelperTrait;
class HomeController extends Controller
{
    use HelperTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $client;

    public function __construct()
    {
        
        $this->client =   ClientBuilder::create()
        ->setHosts(['https://test-ab2c15.es.us-central1.gcp.cloud.es.io'])
        ->setBasicAuthentication('elastic', 'CwM4OT6T0X64akLUKFPW5S0s')
        ->build();

        
    }

    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function listproducts()
    {
        try {
        $params = [
            'index' => 'products',
            'body' => [
                'query' => [
                    'match' => [
                        'status' => 1
                    ]
                ],
            ],
            'size' => 1000
        ];
        
        $results = $this->client->search($params);
        $data = $results['hits']['hits'];
       
        return view('listproducts',['data'=>$data]);
    }catch (\Exception $e) {
        return view('listproducts',['data'=>[]]);
    }
    }

    public function addproductsbyapi()
    {
        
        try {
        $response = Http::get('https://fakerapi.it/api/v1/books', [
            '_quantity' => 100,
        ]);
        
        $booksresponse = json_decode($response->body());
        //dd($booksresponse->data);
        foreach($booksresponse->data as $books)
        {
            //$checkbookexist = products::where('isbn',$books->isbn)->get();
           // if(count($checkbookexist)==0){
            //create products
            //Use Trait to Index
           $res =  $this->bulkcreateindex($books);
           // }
        }
        $notification = array(
            'message' => 'Added successfully', 
            'alert-type' => 'success'
        );
          return Redirect::to('Admin/listproducts')->with($notification);
        }catch (\Exception $e) {
            return false;
        } 
    }

    public function addproducts()
    {
        return view('addproducts');
    }

    public function editproduct(Request $request ,$id)
    {
        $params = [
        'index' => 'products',
        'type' => '_doc',
        'id' => $id
        ];
        $productData = $this->client->get($params);
        return view('addproducts',['data'=>$productData]);
    }

    public function saveproduct(Request $request)
    {
        if(empty($request->id))
        {
            //create product
            try {
            $this->createindex($request);
            $notification = array(
                'message' => 'Added successfully', 
                'alert-type' => 'success'
            );
              return Redirect::to('Admin/listproducts')->with($notification);
            }catch (\Exception $e) {
                return false;
            } 
        }else{
            //update product
            try {
            $this->updateindex($request,$request->id);
            $notification = array(
                'message' => 'Updated successfully', 
                'alert-type' => 'success'
            );
              return Redirect::to('Admin/listproducts')->with($notification);
            }catch (\Exception $e) {
                return false;
            }  
        } 
    }

    public function deleteproduct(Request $request)
    {
        //delete index in ES
        try {
        $params = [
            'index' => 'products',
            'type' => '_doc',
            'id' => $request->id,
        ];

        $this->client->delete($params);
        return True;
        }catch (\Exception $e) {
            return false;
        }
    }

    public function deleteindex()
    {
        try {
        //delete all indexes
    $params = [
        'index' => '_all'
    ];
    
    $response = $this->client->indices()->delete($params);
    $notification = array(
        'message' => 'deleted successfully', 
        'alert-type' => 'success'
    );
    return Redirect::to('Admin/listproducts')->with($notification);
    }catch (\Exception $e) {
    return false;
        }
       // dd($response);
    }

    public function Searchbook(Request $request)
    {

        $query = $request->search;
    $date = date_create_from_format('Y-m-d', $query);

    if ($date !== false) {
    $dateval =  date('Y-m-d', strtotime($request->search));

    $query = [
    'multi_match' => [
    'query' => $dateval,
    'fields' => ['published', 'date']
    ]
    ];
    } else {
    $query = [
    'multi_match' => [
    'query' => $query,
    'fields' => ['title', 'author', 'genre', 'isbn', 'publisher'],
    'fuzziness' => 'AUTO'
    ]
    ];
    }
    $filters = [];

    $author = $request->author;
    if ($author) {
    foreach($author as $a){
    $filters[] = [
        'match' => [
        'author' => $a,
    ],
    ];
    }
    }

    $publisher = $request->publisher;
    if ($publisher) {
    foreach($publisher as $a){
    $filters[] = [
        'match' => [
        'publisher' => $a,
    ],
    ];
    }
    }

    $genres = $request->genres;
    if ($genres) {
    foreach($genres as $a){
        $filters[] = [
        'match' => [
        'genre' => $a,
    ],
    ];
    }
    }




    $perPage = 8;
    $page = $request->get('page', 1);
    $offset = ($page - 1) * $perPage;




    $results = $this->client->search([
        'index' => 'products',
     'type' => '_doc',
    'body' => [
    'query' => [
    'bool' => [
    'must' => [
    $query,
    [
    'term' => [
    'status' => 1
    ]
    ]
    ],
    'filter' => [
    'bool' => [
    'should' => $filters,
    ],
    ],
    ]
    ],
    'from' => $offset,
    'size' => $perPage,
    ],
    ]);


//$jsonQuery = json_encode($results, JSON_PRETTY_PRINT);



$total = $results['hits']['total']['value'];
$hits = $results['hits']['hits'];

//dd($total);
$paginator = new LengthAwarePaginator($hits, $total, $perPage, $page, [
'path' => LengthAwarePaginator::resolveCurrentPath(),
]);

        if($total!=0){
        if($request->author || $request->publisher)
        {
            return view('filter-results', ['paginator' => $paginator,'searchterm'=>$request->search]);
        }
        return view('search-results', ['paginator' => $paginator,'searchterm'=>$request->search]);
        }else{
            return "<center><h3>No Data Found</h3></center>";
        }
    }


    public function filterbook(Request $request)
    {

        $filters = [];

$author = $request->author;

if ($author) {
foreach($author as $a){
    
$filters[] = [
'match' => [
'author' => $a,
],
];
}
}

$publisher = $request->publisher;
if ($publisher) {
foreach($publisher as $a){
$filters[] = [
'match' => [
'publisher' => $a,
],
];
}
}

$genres = $request->genres;
if ($genres) {
foreach($genres as $a){
$filters[] = [
'match' => [
'genre' => $a,
],
];
}
}



$perPage = 8;
$page = $request->get('page', 1);
$offset = ($page - 1) * $perPage;


//dd($filters);
if (empty($filters)) {
    $query = [
        'multi_match' => [
        'query' => $request->search,
        'fields' => ['title', 'author', 'genre', 'isbn', 'publisher'],
        'fuzziness' => 'AUTO'
        ]
        ];
} else {
    $query = [
        'bool' => [
            'should' => $filters
        ]
    ];
}

$results = $this->client->search([
    'index' => 'products',
    'type' => '_doc',
    'body' => [
        'query' => [
            'bool' => [
                'must' => [
                    [
                        'bool' => [
                            'should' => $filters,
                        ],
                    ],
                    $query,
                    $request->search,
                    [
                        'term' => [
                            'status' => 1
                        ]
                    ]
                ]
            ]
        ],
        'from' => $offset,
        'size' => $perPage,
    ],
]);

//$jsonQuery = json_encode($query, JSON_PRETTY_PRINT);

$total = $results['hits']['total']['value'];
$hits = $results['hits']['hits'];

$paginator = new LengthAwarePaginator($hits, $total, $perPage, $page, [
'path' => LengthAwarePaginator::resolveCurrentPath(),
]);


        return view('filter-results', ['paginator' => $paginator,'searchterm'=>$request->search]);
    }

public function Searchsuggestions(Request $request)
{
    $books = [];
    $query= $request->q;
    $searchResults = $this->client->search([
        'index' => 'products',
        'body' => [
            'query' => [
                'multi_match' => [
                    'query' => $query,
                    'fields' => ['title', 'author']
                ]
            ],
            'size' => 10
        ]
    ]);
    if ($searchResults['hits']['total']['value'] > 0) {
        foreach ($searchResults['hits']['hits'] as $result) {
            $books[] = $result['_source'];
        }
    }
    return $books;
}

public function getproductdata($id)
{
        $params = [
        'index' => 'products',
        'type' => '_doc',
        'id' => $id,
        ];
        //dd($request->productid);
        $productData = $this->client->get($params);
        
        return view('productdetails',['data'=>$productData]);
}


}
