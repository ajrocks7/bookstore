@foreach($paginator as $hit)
        <div class="col-lg-3 col-sm-4 col-11 offset-sm-0 offset-1">
        <a href="{{ url('getproductdata/'.$hit['_id']) }}" target="_blank"><div class="card">
                <img class="card-img-top" loading="lazy" width="80" height="90"  src="{{ $hit['_source']['image'] }}" alt="Card image cap">
                <div class="card-body">
                  <p class="card-text">{{ $hit['_source']['title'] }}</p>
                  <p>{{ $hit['_source']['author'] }}</p>
                  <p>{{ $hit['_source']['publisher'] }}</p>          
                </div>
              </div><br><br>
</a>
        </div>
        @endforeach

        {{ $paginator->links("pagination::bootstrap-4") }}


        <script>
           $(document).ready(function(){
        $('.pagination a').removeAttr('href')
    });

    var currentRequest = null;
        
       
            $('.pagination a').click(function(e) {
                var pageclick =$(this).text();
                //alert(pageclick);
    e.preventDefault();
    var url = '{{ url('Searchbook') }}'+'?page='+pageclick;
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
        </script>