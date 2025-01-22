<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Search</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .container {
            /* max-width: 600px; */
            margin: 0 auto;
        }

        body {
            background-color: #f8f9fa;
            padding: 20px;
        }

        .product-card {
            background-color: #fff;
            border: none;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .product-card:hover {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            transform: translateY(-5px);
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .product-title {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .product-price {
            font-size: 1.2rem;
            font-weight: 700;
            color: #28a745;
        }

        .rating {
            color: #ffc107;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card product-card">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Product Image">
                    <div class="card-body">
                        <h5 class="card-title product-title">Product Name</h5>
                        <p class="card-text">A brief description of the product goes here. It should be concise yet
                            informative.</p>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="product-price">$99.99</span>
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span class="ms-1 text-muted">(4.5)</span>
                            </div>
                        </div>
                        <button class="btn btn-primary w-100">Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>