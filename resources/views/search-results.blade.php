<?php
//echo"<pre>";
//print_r($results);
//exit();
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<style>
    *{
    box-sizing: border-box;
}
body{
    color: grey;
}
#sidebar{
    width: 20%;
    padding: 10px;
    margin: 0;
    float: left;
}
#products{
    width: 80%;
    padding: 10px;
    margin: 0;
    float: right;
}
ul{
    list-style: none;
    padding: 5px;
}
li a{
    color: darkgray;
    text-decoration: none;
}
li a:hover{
    text-decoration: none;
    color: darksalmon;
}
.fa-circle{
    font-size: 20px;
}
#red{
    color: #e94545d7;
}
#teal{
    color: rgb(69, 129, 129);
}
#blue{
    color: #0000ff;
}
.card{
    width: 250px;
    display: inline-block;
    height: 300px;
}
.card-img-top{
    width: 250px;
    height: 210px;
}
.card-body p{
    margin: 2px;
}
.card-body{
    padding: 0;
    padding-left: 2px;
}
.filter{
    display: none;
    padding: 0;
    margin: 0;
}

@media(min-width:991px){
    .navbar-nav{
        margin-left: 35%;
    }
    .nav-item{
        padding-left: 20px;
    }
    .card{
        width: 190px;
        display: inline-block;
        height: 300px;
    }
    .card-img-top{
        width: 188px;
        height: 210px;
    }
    #mobile-filter{
        display: none;
    }
}
@media(min-width:768px) and (max-width:991px){
    .navbar-nav{
        margin-left: 20%;
    }
    .nav-item{
        padding-left: 10px;
    }
    .card{
        width: 230px;
        display: inline-block;
        height: 300px;
        margin-bottom: 10px;
    }
    .card-img-top{
        width: 230px;
        height: 210px;
    }
    #mobile-filter{
        display: none;
    }
}
@media(min-width:568px) and (max-width:767px){
    .navbar-nav{
        margin-left: 20%;
    }
    .nav-item{
        padding-left: 10px;
    }
    .card{
        width: 205px;
        display: inline-block;
        height: 300px;
        margin-bottom: 10px;
    }
    .card-img-top{
        width: 203px;
        height: 210px;
    }
    .fa-circle{
        font-size: 15px;
    }
    #mobile-filter{
        display: none;
    }
}
@media(max-width:567px){
    .navbar-nav{
        margin-left: 0%;
    }
    .nav-item{
        padding-left: 10px;
    }
    #sidebar{
        width: 100%;
        padding: 10px;
        margin: 0;
        float: left;
    }
    #products{
        width: 100%;
        padding: 5px;
        margin: 0;
        float: right;
    }
    .card{
        width: 230px;
        display: inline-block;
        height: 300px;
        margin-bottom: 10px;
        margin-top: 10px;
    }
    .card-img-top{
        width: 230px;
        height: 210px;
    }
    .list-group-item{
        padding: 3px;
    }
    .offset-1{
        margin-left: 8%;
    }
    .filter{
        display: block;
        margin-left: 70%;
        margin-top: 2%;
    }
    #sidebar{
        display: none;
    }
    #mobile-filter{
        padding: 10px;
    }
}

body > div {
	width: 90%;
	max-width: 600px;
	margin-left: auto;
	margin-right: auto;
	margin-top: 5rem;
	margin-bottom: 5rem;
}

details div {
	border-left: 2px solid #000;
	border-right: 2px solid #000;
	border-bottom: 2px solid #000;
	padding: 1.5em;
}

details div > * + * {
	margin-top: 1.5em;
}

details + details {
	margin-top: .5rem;
}

summary {
	list-style: none;
}

summary::-webkit-details-marker {
	display: none;
}

summary {
	border: 2px solid #000;
	padding: .75em 1em;
	cursor: pointer;
	position: relative;
	padding-left: calc(1.75rem + .75rem + .75rem);
}

summary:before {
	position: absolute;
	top: 50%;
	transform: translateY(-50%);
	left: .75rem;
	content: "↓";
	width: 1.75rem;
	height: 1.75rem;
	background-color: #000;
	color: #FFF;
	display: inline-flex;
	justify-content: center;
	align-items: center;
	flex-shrink: 0;
}

details[open] summary {
	background-color: #eee;
}

details[open] summary:before {
	content: "↑";
}

summary:hover {
	background-color: #eee;
}

a {
	color: inherit;
	font-weight: 600;
	text-decoration: none;
	box-shadow: 0 1px 0 0;
}

a:hover {
	box-shadow: 0 3px 0 0;
}

code {
	font-family: monospace;
	font-weight: 600;
}
</style>


<nav class="navbar navbar-expand-sm navbar-light bg-white border-bottom">
    <a class="navbar-brand ml-2 font-weight-bold" href="javascript:void(0);">AJ Bookstore</a>
   <input type="hidden" id="queryterm" value="{{ $searchterm }}"> 
</nav>


<section id="sidebar">
<div class="filtersmenu">
	<details open>
		<summary>
			Author
		</summary>
		<div class="sidebarfilters">
			
            @foreach($paginator as $hit)
              <p><input type="checkbox" name="authorfilter[]" id="authorfilter" class="filters authorfilter form-control" value="{{ $hit['_source']['author']  }}">{{ $hit['_source']['author']  }}</p>
                @endforeach
           
		</div>
	</details>
	<details>
		<summary>
			Publisher
		</summary>
		<div class="sidebarfilters" id="publisherfilter">
        @foreach($paginator as $hit)
              <p><input type="checkbox" name="publisherfilter[]"  class="filters publisherfilter form-control" value="{{ $hit['_source']['publisher']  }}">{{ $hit['_source']['publisher']  }}</p>
                @endforeach
		</div>
	</details>
	<details>
		<summary>
			Genre
		</summary>
		<div class="sidebarfilters" id="genrefilter">
        @foreach($paginator as $hit)
              <p><input type="checkbox" name="genrefilter[]"  class="filters genrefilter form-control" value="{{ $hit['_source']['genre']  }}">{{ $hit['_source']['genre']  }}</p>
                @endforeach
		</div>
	</details>
	
</div>
</section>

<div class="container">
    <div class="row" id="search-results">

    @include('search-results-ajax', ['paginator' => $paginator])
        
   
    
    </div>
    
</div>




<script>

   // $(document).ready(function(){
   //     $('.pagination a').removeAttr('href')
    //});

        var currentRequest = null;
        
       
            $('.pagination a').click(function(e) {
                //alert("1");
    e.preventDefault();
    var url = $(this).attr('href');
    var val = $('#queryterm').val();

    if (currentRequest) {
        currentRequest.abort();
    }

    currentRequest = $.ajax({
        url: url,
        type: 'post',
        data:{
        search:val,
        },
        headers: {
    'X-CSRF-Token': '{{ csrf_token() }}',
    },
        success: function(data) {
            
            $('.searchresults').html(data);
        }
    });
});


$('.sidebarfilters').click(function() {
  var authors = [];
  $('.authorfilter:checked').each(function(i) {
    authors.push($(this).val());
  });

  var publishers = [];
  $('.publisherfilter:checked').each(function(i) {
    publishers.push($(this).val());
  });

  var genres = [];
  $('.genrefilter:checked').each(function(i) {
    genres.push($(this).val());
  }); 

  

  filterdata(authors,publishers,genres) 
});

function filterdata(authors,publishers,genres)
{
    var val = $('#queryterm').val();
    $.ajax({
    url: '{{ url('filterbook') }}',
    type: 'post',
    data:{
      search:val,
      author: authors,
      publisher:publishers,
      genres:genres,
    },
    headers: {
      'X-CSRF-Token': '{{ csrf_token() }}',
    },
    success: function(data) {
      $('#search-results').html(data);
    }
  });
}

$(".productdetails").click(function(){
    var productid = $(this).find('#productid').val();
    $.ajax({
    url: '{{ url('getproductdata') }}',
    type: 'post',
    data:{
      productid:productid,
    },
    headers: {
      'X-CSRF-Token': '{{ csrf_token() }}',
    },
    success: function(data) {
        Swal.fire({
         html: data,
         showCloseButton: true
      });
    }
  });
})

//     $('.authorfilter').click(function(e) {
//   var authors = [];
//   $('.authorfilter:checked').each(function(i){
//     authors.push($(this).val());
//   });
//   var publishers = [];
//   $('.publisherfilter:checked').each(function(i){
//     publishers.push($(this).val());
//   });
//   var val = $('#queryterm').val();
//   $.ajax({
//     url: '{{ url('Searchbook') }}',
//     type: 'post',
//     data:{
//       search:val,
//       author:authors,
//       publisher:publishers,
//     },
//     headers: {
//       'X-CSRF-Token': '{{ csrf_token() }}',
//     },
//     success: function(data) {
        
//       $('#search-results').html(data);
//     }
//   });
// });


</script>