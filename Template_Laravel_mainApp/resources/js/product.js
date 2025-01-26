
$(document).ready(function() {
    // Show the create product form in a modal
    $(document).on('click', '#show', function(e) {
        e.preventDefault();

        let url = $(this).attr('href');

        $.ajax({
            type: "GET",
            url: url,
            success: function(res) {
                bootbox.dialog({
                    title: "Create Product",
                    message: "<div class='createForm'></div>",
                });

                $('.createForm').html(res);
            },
            error: function(xhr, status, error) {
                console.error("Failed to load form:", error);
                alert('Failed to load the form. Please check the console for details.');
            }
        });
    });

    // Submit the form via AJAX
    $(document).on('submit', '#addProduct', function(e) {
        e.preventDefault();

        let formData = new FormData($(this)[0]);

        $.ajax({
            type: 'POST',
            url: "{{ route('products.store') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: function(res) {
                if (res.success) {
                    $('table tbody').append(`
<tr>
<td>${res.product.id}</td>
<td>${res.product.title}</td>
<td>${res.product.description}</td>
<td>${res.product.price}</td>
<td>${res.product.stock}</td>
<td>
    ${res.product.img_path ? `<img src="{{ asset('${res.product.img_path}') }}" alt="Image" width="50">` : 'No Image'}
</td>
<td>
    <a href="" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
    <form action="{{ route('products.destroy', '') }}/${res.product.id}" method="POST" class="d-inline deleteForm">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
    </form>
    <a href="" class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i></a>
</td>
</tr>
`);

                    bootbox.hideAll(); // Close the modal
                } else if (res.status === 400) {
                    let errors = res.errors;
                    let errorMessages = Object.values(errors)
                        .map((msg) => msg.join(', '))
                        .join('\n');
                    alert("Validation Errors:\n" + errorMessages);
                }
            },
            error: function(xhr, status, error) {
                console.error("Failed to submit form:", error);
                alert('An error occurred. Please check the console for details.');
            }
        });
    });
    $(document).on('submit', '.deleteForm', function(e) {
        e.preventDefault();
        let form = $(this);
        let url = form.attr('action');
        let row = form.closest('tr'); // Get the row to remove after deletion

        $.ajax({
            type: 'POST',
            url: url,
            data: form.serialize(),
            success: function(response) {
                if (response.status === 200) {
                    // Remove the row from the table
                    row.remove();
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error("Failed to delete product:", error);
                alert('An error occurred. Please try again.');
            }
        });
    });

});
