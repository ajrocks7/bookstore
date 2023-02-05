@foreach($paginator as $hit)
        <div class="col-lg-3 col-sm-4 col-11 offset-sm-0 offset-1 productdetails">
          <a href="{{ url('getproductdata/'.$hit['_id']) }}" target="_blank"><input type="hidden" name="productid" id="productid" value="{{ $hit['_id'] }}">
            <div class="card">
                <img class="card-img-top" loading="lazy" width="80" height="90"  src="{{ $hit['_source']['image'] }}" alt="Card image cap">
                <div class="card-body">
                  <p class="card-text">{{ $hit['_source']['title'] }}</p>
                  <p>{{ $hit['_source']['author'] }}</p>
                  <p>{{ $hit['_source']['publisher'] }}</p>      
                </div>
              </div><br><br>
              </a></div>
        @endforeach

        {{ $paginator->links("pagination::bootstrap-4") }}