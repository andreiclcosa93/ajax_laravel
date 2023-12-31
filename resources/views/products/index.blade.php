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
                        <label for="add_category_name">Category Name<span class="text-danger">*</span></label>
                        <input type="text" id="add_category_name" class="category_name form-control" autocomplete="off">
                    </div>
                    <div class="form-group mb-3">
                        <label for="add_name">Name<span class="text-danger">*</span></label>
                        <input type="text" id="add_name" class="name form-control" autocomplete="off">
                    </div>
                    <div class="form-group mb-3">
                        <label for="add_price">Price<span class="text-danger">*</span></label>
                        <input type="text" id="add_price"  class="price form-control" autocomplete="off">
                    </div>
                    <div class="form-group mb-3">
                        <label for="add_quantity">Quantity<span class="text-danger">*</span></label>
                        <input type="text" id="add_quantity" class="quantity form-control" autocomplete="off">
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

{{-- modal - edit products --}}
<div class="modal fade" id="EditProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h1 class="modal-title fs-5 " id="exampleModalLabel">Edit/Update Product</h1>
                <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                    <ul id="updateform_errList"></ul>

                    <input type="hidden" id="edit_prod_id">

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
                <button type="button" class="btn btn-primary update_product">Update</button>

            </div>
        </div>
    </div>
</div>
{{-- end of modal - edit products --}}


{{-- modal - delete products --}}
<div class="modal fade" id="DeleteProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h1 class="modal-title fs-5 " id="exampleModalLabel">Delete Product</h1>
                <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="delete_prod_id">
                <h5 class="alert alert-danger text-center">Are you sure want to delete this data?</h5>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger delete_product_btn">Yes</button>

            </div>
        </div>
    </div>
</div>
{{-- end of modal - delete products --}}



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
                                    <td>$'+item.price+'</td>\
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


            //  view edit product ############################
                $(document).on('click', '.edit_product', function (e) {
                    e.preventDefault();
                    var prod_id = $(this).val();
                    $('#EditProductModal').modal('show');
                    $.ajax({
                        type: "GET",
                        url: "/edit-product/"+prod_id,
                        success: function (response) {
                            // console.log(response);
                            if(response.status == 404) {
                                $('#success_message').html("");
                                $('#success_message').addClass('alert alert-danger');
                                $('#success_message').text(response.message);
                            } else {
                                $('#category_name').val(response.product.category_name);
                                $('#name').val(response.product.name);
                                $('#price').val(response.product.price);
                                $('#quantity').val(response.product.quantity);
                                $('#edit_prod_id').val(prod_id);
                            }
                        }
                    });
                });
            // end of view edit product ############################


            //  update product ############################
                $(document).on('click', '.update_product', function (e) {
                    e.preventDefault();

                    $(this).text("Updating");

                    var prod_id = $('#edit_prod_id').val();

                    var data = {
                        'category_name' : $('#category_name').val(),
                        'name' : $('#name').val(),
                        'price' : $('#price').val(),
                        'quantity' : $('#quantity').val(),
                    }


                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });


                    $.ajax({
                        type: "PUT",
                        url: "/update-product/"+prod_id,
                        data: data,
                        dataType: "json",
                        success: function (response) {
                            // console.log(response);
                            if(response.status == 400) {

                                // errors
                                $('#updateform_errList').html("");
                                $('#updateform_errList').addClass('alert alert-danger');

                                $.each(response.errors, function (key, err_values) {
                                    $('#updateform_errList').append('<li>'+err_values+'</li>');
                                });
                                $('.update_product').text("Update");

                            } else if(response.status == 404) {

                                $('#updateform_errList').html("");
                                $('#success_message').addClass('alert alert-success')
                                $('#success_message').text(response.message)
                                $('.update_product').text("Update");

                            } else {
                                $('#updateform_errList').html("");
                                $('#success_message').html("");
                                $('#success_message').addClass('alert alert-success')
                                $('#success_message').text(response.message)

                                $('#EditProductModal').modal('hide');
                                $('.update_product').text("Update");
                                showProduct();
                            }
                        }
                    });


                });
            // end of update product ############################



            // delete product ############################
                $(document).on('click', '.delete_product', function (e) {
                    e.preventDefault();
                    var prod_id = $(this).val();

                    $('#delete_prod_id').val(prod_id);
                    $('#DeleteProductModal').modal('show');

                });

                $(document).on('click', '.delete_product_btn', function (e) {
                    e.preventDefault();

                    $(this).text("Deleting");

                    var prod_id = $('#delete_prod_id').val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: "DELETE",
                        url: "/delete-product/"+prod_id,
                        success: function (response) {

                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                            $('#DeleteProductModal').modal('hide');
                            $('.delete_product_btn').text("Yes Delete");
                            showProduct();

                        }
                    });

                });

            // end of delete product ############################


        });

    </script>

@endsection
