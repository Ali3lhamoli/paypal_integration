<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/splidejs/4.1.4/js/splide.min.js"
        integrity="sha512-4TcjHXQMLM7Y6eqfiasrsnRCc8D/unDeY1UGKGgfwyLUCTsHYMxF7/UHayjItKQKIoP6TTQ6AMamb9w2GMAvNg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/splidejs/4.1.4/css/themes/splide-default.min.css"
        integrity="sha512-KhFXpe+VJEu5HYbJyKQs9VvwGB+jQepqb4ZnlhUF/jQGxYJcjdxOTf6cr445hOc791FFLs18DKVpfrQnONOB1g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/css/bootstrap.min.css"
        integrity="sha512-Z/def5z5u2aR89OuzYcxmDJ0Bnd5V1cKqBEbvLOiUNWdg9PQeXVvXLI90SE4QOHGlfLqUnDNVAYyZi8UwUTmWQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/css/bootstrap.rtl.min.css"
        integrity="sha512-wO8UDakauoJxzvyadv1Fm/9x/9nsaNyoTmtsv7vt3/xGsug25X7fCUWEyBh1kop5fLjlcrK3GMVg8V+unYmrVA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="stylesheet" href="{{ asset('site/styles/pages/main.css') }}">

    <title> {{ env('APP_NAME') }} | shop</title>
</head>

<body>
    {{-- @include('inc.cancel') --}}
    <div class="page-wrapper">
        <div class="container">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="fw-bold my-4 h4">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item">shop</li>
                    <li class="breadcrumb-item active" aria-current="page">order</li>
                </ol>
            </nav>
            @include('inc.errors')
            <div class="d-flex flex-column gap-3 account-form mx-auto mt-5">
                <form class="form" action="{{route('paypal.payment')}}" method="POST">
                    @csrf
                    <div class="form-items">
                        <div class="mb-3">
                            <label class="form-label required-label" for="product">Product</label>
                            <select name="name" class="form-control" id="product">
                                <option value="">Select a product</option>
                                <option value="laptop" {{ old('product') == 'laptop' ? 'selected' : '' }}>laptop</option>
                                <option value="phone" {{ old('product') == 'phone' ? 'selected' : '' }}>phone</option>
                                <option value="TV" {{ old('product') == 'TV' ? 'selected' : '' }}>TV</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required-label" for="quantity">quantity</label>
                            <input type="number" name="qty" class="form-control" id="quantity" value="{{old('quantity')}}" >
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Checkout with PayPal</button>
                </form>
            </div>
        
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.min.js"
        integrity="sha512-fHY2UiQlipUq0dEabSM4s+phmn+bcxSYzXP4vAXItBvBHU7zAM/mkhCZjtBEIJexhOMzZbgFlPLuErlJF2b+0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </body>
    
    </html>