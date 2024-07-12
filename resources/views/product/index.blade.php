<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body>
<div class="container">
    <h1 class="mb-4">Product List</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-4">Add New Product</a>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table id="products-table" class="table">
        <thead>
            <tr>
                <th>Thumbnail</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td><img src="{{ Storage::url($product->thumb_image) }}" width="70" alt="{{ $product->name }}"></td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>${{ $product->price }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                        <form id="delete-form-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $product->id }})">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
$(document).ready(function() {
    $('#products-table').DataTable({
        paging: true,          
        searching: true,     
        info: true,          
        language: {
            paginate: {
                previous: '&laquo;',
                next: '&raquo;'
            }
        }
    });
});

function confirmDelete(productId) {
    toastr.warning(`
        <div>
            Are you sure you want to delete this product?
            <br>
            <button type="button" class="btn btn-danger btn-sm" id="confirmYes">Yes</button>
            <button type="button" class="btn btn-secondary btn-sm" id="confirmNo">No</button>
        </div>
    `, "Delete Confirmation", {
        closeButton: true,
        allowHtml: true,
        positionClass: "toast-top-center",
        timeOut: 0,
        extendedTimeOut: 0,
        tapToDismiss: false,
        onShown: function (toast) {
            $("#confirmYes").click(function() {
                document.getElementById('delete-form-' + productId).submit();
            });
            $("#confirmNo").click(function() {
                toastr.remove();
            });
        }
    });
}
</script>
</body>
</html>
