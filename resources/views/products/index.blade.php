@extends('template')

@section('content')

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

{{-- modal - add products --}}
<div class="modal fade"  id="AddProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h1 class="modal-title fs-5 " id="exampleModalLabel">Add Products</h1>
                <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <ul id="saveform_errList"></ul>

                    <div class="form-group mb-3">
                        <label for="category_name">Category Name<span class="text-danger">*</span></label>
                        <input type="text" id="category_name" class="category_name form-control" autocomplete="off">
                    </div>
                    <div class="form-group mb-3">
                        <label for="name">Name<span class="text-danger">*</span></label>
                        <input type="text" id="name" class="name form-control" autocomplete="off">
                    </div>
                    <div class="form-group mb-3">
                        <label for="price">Price<span class="text-danger">*</span></label>
                        <input type="text" id="price"  class="price form-control" autocomplete="off">
                    </div>
                    <div class="form-group mb-3">
                        <label for="quantity">Quantity<span class="text-danger">*</span></label>
                        <input type="text" id="quantity" class="quantity form-control" autocomplete="off">
                    </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary add_product">Save</button>
            </div>
        </div>
    </div>
</div>
{{-- end of modal - add products --}}

<div class="container-fluid px-4">
    <h1 class="mt-4">View Products</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item active">View Products</li>
    </ol>

    <div class="row">

        <div class="col-md-12">

            <div class="" id="success_message"></div>

            <div class="card">
                <div class="card-header">
                    <a href="#" class="btn btn-success float-end mb-3 my-4" data-bs-toggle="modal" data-bs-target="#AddProductModal">Add Product</a>
                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-bordered table-hover text-center">
                            <thead>
                                <tr >
                                    <th>Id</th>
                                    <th>Category Name</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

    <script>

        $(document).ready(function () {


            // show product ######################
            showProduct();
            function showProduct()
            {
                $.ajax({
                    type: "GET",
                    url: "/show-products",
                    dataType: "json",
                    success: function (response) {
                        $('tbody').html("");
                        $.each(response.products, function (key, item) {
                            $('tbody').append('<tr>\
                                <td>'+item.id+'</td>\
                                <td>'+item.category_name+'</td>\
                                <td>'+item.name+'</td>\
                                <td>'+item.price+'</td>\
                                <td>'+item.quantity+'</td>\
                                <td><button type="button" value="'+item.id+'" class="edit_product btn btn-warning">Edit</button>\
                                    <button type="button" value="'+item.id+'" class="delete_product btn btn-danger">Delete</button></td>\
                            </tr>');
                        });
                    }
                });
            }
            // end of show product  ######################

            // add product  ######################
            $(document).on('click', '.add_product', function (e) {
                e.preventDefault();

                    var data = {
                        'category_name': $('.category_name').val(),
                        'name': $('.name').val(),
                        'price': $('.price').val(),
                        'quantity': $('.quantity').val(),
                    }

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });


                    $.ajax({
                        type: "POST",
                        url: "/products-store",
                        data: data,
                        dataType: "json",
                        success: function (response) {
                            // console.log(response);
                            if(response.status == 400) {

                                $('#saveform_errList').html("");
                                $('#saveform_errList').addClass('alert alert-danger');

                                $.each(response.errors, function (key, err_values) {
                                    $('#saveform_errList').append('<li>'+err_values+'</li>');
                                });
                            } else {
                                $('#saveform_errList').html("");
                                $('#success_message').addClass('alert alert-success')
                                $('#success_message').text(response.message)
                                $('#AddProductModal').modal('hide');
                                $('#AddProductModal').find('input').val("");
                                showProduct();
                            }
                        }
                    });

            });
             // end of add product  ######################

        });

    </script>

@endsection
