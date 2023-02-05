<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<style>
    body {
    font-family: 'Roboto Condensed', sans-serif;
    background-color: #f5f5f5
}

.hedding {
    font-size: 20px;
    color: #ab8181`;
}

.main-section {
    position: absolute;
    left: 50%;
    right: 50%;
    transform: translate(-50%, 5%);
}

.left-side-product-box img {
    width: 100%;
}

.left-side-product-box .sub-img img {
    margin-top: 5px;
    width: 83px;
    height: 100px;
}

.right-side-pro-detail span {
    font-size: 15px;
}

.right-side-pro-detail p {
    font-size: 25px;
    color: #a1a1a1;
}

.right-side-pro-detail .price-pro {
    color: #E45641;
}

.right-side-pro-detail .tag-section {
    font-size: 18px;
    color: #5D4C46;
}

.pro-box-section .pro-box img {
    width: 100%;
    height: 200px;
}

@media (min-width:360px) and (max-width:640px) {
    .pro-box-section .pro-box img {
        height: auto;
    }
}
</style>

<div class="container">
    <div class="col-lg-8 border p-3 main-section bg-white">
        <div class="row hedding m-0 pl-3 pt-0 pb-3">
        {{ $data['_source']['title'] }}
        </div>
        <div class="row m-0">
            <div class="col-lg-4 left-side-product-box pb-3">
                <img src="{{ $data['_source']['image'] }}" class="border p-3">
              
            </div>
            <div class="col-lg-8">
                <div class="right-side-pro-detail border p-3 m-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <span></span>
                            <p class="m-0 p-0">Author:</p>
                        </div>
                        <div class="col-lg-12">
                            <p class="m-0 p-0 price-pro">{{ $data['_source']['author'] }}</p>
                            <hr class="p-0 m-0">
                        </div>
                        <div class="col-lg-12 pt-2">
                            <h5>Description</h5>
                            <span>{{ $data['_source']['description'] }}</span>
                            <hr class="m-0 pt-2 mt-2">
                        </div>
                        <div class="col-lg-12">
                            <p class="tag-section"><strong>Genre : </strong><a href="javascript:void(0);">{{ $data['_source']['genre'] }}</a></p>
                        </div>
                        <div class="col-lg-12">
                        <p class="tag-section"><strong><h6>Isbn :</h6></strong></p>
                            {{ $data['_source']['isbn'] }}
                        </div>
                        <div class="col-lg-12">
                        <p class="tag-section"><strong><h6>Publisher :</h6></strong></p>
                            {{ $data['_source']['publisher'] }}
                        </div>
                        <div class="col-lg-12">
                        <p class="tag-section"><strong><h6>Published Date:</h6></strong></p>
                            {{ $data['_source']['published'] }}
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
       
        
    </div>
</div>