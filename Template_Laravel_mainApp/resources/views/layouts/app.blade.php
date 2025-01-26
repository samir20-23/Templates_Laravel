
@extends('adminlte::page')

{{-- Extend and customize the browser title --}}

@section('title')
    {{ config('adminlte.title') }}
    @hasSection('subtitle')
        | @yield('subtitle')
    @endif
@stop

{{-- Extend and customize the page content header --}}

@section('content_header')
    @hasSection('content_header_title')
        <h1 class="text-muted">
            @yield('content_header_title')

            @hasSection('content_header_subtitle')
                <small class="text-dark">
                    <i class="fas fa-xs fa-angle-right text-muted"></i>
                    @yield('content_header_subtitle')
                </small>
            @endif
        </h1>
    @endif
@stop

{{-- Rename section content to content_body --}}

@section('content')
    @yield('content_body')
@stop

{{-- Create a common footer --}}

@section('footer')
    <div class="float-right">
        Version: {{ config('app.version', '1.0.0') }}
    </div>

    <strong>
        <a href="{{ config('app.company_url', '#') }}">
            {{ config('app.company_name', 'My company') }}
        </a>
    </strong>
@stop

{{-- Add common Javascript/Jquery code --}}

@push('js')
<script>
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
            ${res.product.img_path ? `<img src="${res.product.img_path}" alt="Image" width="50">` : 'No Image'}
        </td>
        <td>
            <!-- Edit Button -->
            <a href="/products/${res.product.id}/edit" class="btn btn-info btn-sm">
                <i class="fas fa-edit"></i>
            </a>
            <!-- View Button -->
            <a href="/products/${res.product.id}" class="btn btn-secondary btn-sm">
                <i class="fas fa-eye"></i>
            </a>
            <!-- Delete Form -->
            <form action="/products/${res.product.id}" method="POST" class="d-inline deleteForm">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
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
</script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    {{-- toaster --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    {{-- sweet laert --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.1/sweetalert2.min.css"
        integrity="sha512-NvuRGlPf6cHpxQqBGnPe7fPoACpyrjhlSNeXVUY7BZAj1nNhuNpRBq3osC4yr2vswUEuHq2HtCsY2vfLNCndYA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>

    {{-- bootbox --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.min.js"
        integrity="sha512-oVbWSv2O4y1UzvExJMHaHcaib4wsBMS5tEP3/YkMP6GmkwRJAa79Jwsv+Y/w7w2Vb/98/Xhvck10LyJweB8Jsw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- toaster --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    {{-- sweet laert --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.1/sweetalert2.min.js"
        integrity="sha512-vCI1Ba/Ob39YYPiWruLs4uHSA3QzxgHBcJNfFMRMJr832nT/2FBrwmMGQMwlD6Z/rAIIwZFX8vJJWDj7odXMaw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush

{{-- Add common CSS customizations --}}

@push('css')
    <style type="text/css">
        {{-- You can add AdminLTE customizations here --}}
        
            .card-header {
                border-bottom: none;
            }
            .card-title {
                font-weight: 600;
            }
           
    </style>
@endpush
