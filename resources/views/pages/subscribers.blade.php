@extends('pages.app')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
 
<style>

.btn-secondary {
    color: #fff !important;
    background-color: #007bff !important;
    border-color: #007bff !important;
    box-shadow: none;
}

.btn-secondary:hover {
    color: #fff !important;
    background-color:rgb(73, 158, 250) !important;
    border-color: #007bff !important;
    box-shadow: none;
}

.top {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important; /* or 'flex-start' depending on your layout preference */
    flex-wrap: wrap !important; /* optional, allows wrapping on smaller screens */
    gap: 10px !important; /* optional spacing between elements */
}
#payments{
    font-size: 12px !important;
    padding-left: 5px !important;
    padding-right: 8px !important;
    padding-top: 5px !important;
    padding-bottom: 5px !important;
    width: 70px !important;
    text-align: center !important;
}

div:where(.swal2-container) button:where(.swal2-styled):where(.swal2-confirm) {
    border:rgb(51, 155, 25) !important;
    border-radius: var(--swal2-confirm-button-border-radius);
    background: initial;
    background-color: rgb(51, 155, 25) !important;
    color: #fff !important;
    font-size: 1em;
}

div:where(.swal2-container) button:where(.swal2-styled):where(.swal2-confirm):hover {
    border:rgb(51, 155, 25) !important;
    border-radius: var(--swal2-confirm-button-border-radius);
    background: initial;
    background-color: rgb(56, 180, 25) !important;
    color: #fff !important;
    font-size: 1em;
}



</style>
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-2" style="font-weight: bold;">Subscribers</h1>
            </div>
        </div>
    </div>
</div>


<!-- Edit Subscriber Modal -->
<div class="modal fade" id="editSubscriberModal" tabindex="-1" role="dialog" aria-labelledby="editSubscriberModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSubscriberModalLabel">Edit Subscriber</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Edit Form -->
                
                 <form id="editSubscriberForm" method="POST" action="">
                    @csrf
                   
                    <input type="hidden" id="subscriber_id" name="subscriber_id" value="">
           
                    <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="fa fa-user"></span>
                                </div>
                                </div>
                                <input type="text" name="name" class="form-control" id="name" required placeholder="Enter subscriber's name">
                            </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPhoneNumber1">Phone Number</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="fa fa-phone"></span>
                                </div>
                                </div>
                                <input type="text" name="phone" class="form-control" id="phone" required placeholder="Enter phone number">
                            </div>
                    </div>

                 <div class="form-group">
    <label for="Gender">Gender</label>
    <div class="input-group">
    <div class="input-group-prepend">
        <div class="input-group-text">
            <span class="fa fa-mars"></span>
        </div>  
        </div>                
        <select class="form-control" id="gender" name="gender" required>
            <option value="" disabled selected>Select Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>    
    </div>                 
</div>

                    <div class="form-group">
                        <label for="SubscriptionDate">Subscription Date</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="fa fa-calendar-o"></span>
                                </div>
                                </div>
                        <input type="text" name="subscriptiondate" class="flatpickr flatpickr-input form-control" id="subscriptiondate" placeholder="Select Date" data-input>
                    </div>
                    </div>
                    

                    <div class="form-group">
                        <label for="Fees">Fees</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="bi bi-currency-dollar"></span>
                                </div>
                                </div>
                        <input type="text" name="fees" class="form-control" id="fees" placeholder="Enter subscription fees">
                    </div>
                    </div>

  <div class="form-group">
    <label for="editStatus">Status</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <span class="fa fa-credit-card"></span>
            </div>
        </div>
        <select class="form-control" id="status" name="status" required>
            <option value="" disabled selected>Select Status</option>
            <option value="paid">Paid</option>
            <option value="unpaid">Unpaid</option>
        </select>
    </div>
</div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveSubscriberChanges">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Add Subscriber Modal -->
<div class="modal fade" id="addSubscriberModal" tabindex="-1" role="dialog" aria-labelledby="addSubscriberModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSubscriberModalLabel">Add Subscriber</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add Form -->
                <form id="addSubscriberForm" method="POST" action="{{ route('subscribers.store') }}">
                    @csrf
                    <!-- Add your form fields here -->
                    <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="fa fa-user"></span>
                                </div>
                                </div>
                                <input type="text" name="name" class="form-control" id="name" required placeholder="Enter subscriber's name">
                            </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPhoneNumber1">Phone Number</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="fa fa-phone"></span>
                                </div>
                                </div>
                                <input type="text" name="phone" class="form-control" id="phone" required placeholder="Enter phone number">
                            </div>
                    </div>

<div class="form-group">
    <label for="Gender">Gender</label>
    <div class="input-group">
    <div class="input-group-prepend">
        <div class="input-group-text">
            <span class="fa fa-mars"></span>
        </div>  
        </div>                
        <select class="form-control" id="gender" name="gender" required>
            <option value="" disabled selected>Select Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>    
    </div>                 
</div>

                    <div class="form-group">
                        <label for="SubscriptionDate">Subscription Date</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="fa fa-calendar-o"></span>
                                </div>
                                </div>
                        <input type="text" name="subscription_date" class="flatpickr flatpickr-input form-control" id="subscription_date" placeholder="Select Date" data-input>
                    </div>
                    </div>
                    

                    <div class="form-group">
                        <label for="Fees">Fees</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="bi bi-currency-dollar"></span>
                                </div>
                                </div>
                        <input type="text" name="fees" class="form-control" id="fees" placeholder="Enter subscription fees">
                    </div>
                    </div>


                   <div class="form-group">
    <label for="editStatus">Status</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <span class="fa fa-credit-card"></span>
            </div>
        </div>
        <select class="form-control" id="status" name="status" required>
            <option value="" disabled selected>Select Status</option>
            <option value="paid">Paid</option>
            <option value="unpaid">Unpaid</option>
        </select>
    </div>
</div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="submitSubscriberChanges">Submit</button>
            </div>
        </div>
    </div>
</div>


<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Subscribers List</h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm">
                                <button type="button" class="btn btn-success btn-sm mr-2" data-toggle="modal" data-target="#addSubscriberModal">
                                    <i class="fa fa-plus"></i>&nbsp; Add Subscriber
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="subscribersTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>Subscription Date</th>
                                    <th>Fees ($)</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subscribers as $AllSubscriber => $subscriber)
            <tr>
                <td style="vertical-align: middle !important;">{{ $AllSubscriber + 1 }}</td>
                <td style="vertical-align: middle !important;">{{ $subscriber->name }}</td>
                <td style="vertical-align: middle !important;">{{ $subscriber->phone }}</td>
                <td style="vertical-align: middle !important;">{{ $subscriber->gender }}</td>
                <td style="vertical-align: middle !important;">{{ \Carbon\Carbon::parse($subscriber->subscription_date)->format('Y-m-d') }}</td>
                <td style="vertical-align: middle !important;">{{ $subscriber->fees }}</td>
                @if ($subscriber->status == 'paid')
                    <td style="vertical-align: middle !important;"><span class="badge badge-success" id="payments"><i class="bi bi-check-circle-fill"></i>&nbsp; Paid</span></td>
                @else
                    <td style="vertical-align: middle !important;"><span class="badge badge-danger" id="payments"><i class="bi bi-x-circle-fill"></i>&nbsp; Unpaid</span></td>
                @endif
                <td>

                    <button type="button" class="btn btn-secondary btn-sm editbtn" data-id="{{ $subscriber->id }}"
                        data-name="{{ $subscriber->name }}" 
                        data-phone="{{ $subscriber->phone }}"
                        data-gender="{{ $subscriber->gender }}"
                        data-subscriptiondate="{{ \Carbon\Carbon::parse($subscriber->subscription_date)->format('Y-m-d') }}"
                        data-fees="{{ $subscriber->fees }}"
                        data-status="{{ $subscriber->status }}"
                        data-toggle="modal" data-target="#editSubscriberModal">
                        <i class="fa fa-edit"></i>&nbsp; Edit
                    </button>
                    <button type="button" class="btn btn-danger btn-sm deletebtn" data-toggle="modal" data-target="#deleteSubscriberModal">
                        <i class="fa fa-trash"></i>&nbsp; Delete
                    </button>
                </td>
            </tr>
            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>





<!-- jQuery -->
<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>


<script>
$(document).ready(function() {
    var table = $('#subscribersTable').DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": [
            {
                extend: 'excel',
                className: 'btn btn-sm',
                text: '<i class="bi bi-file-earmark-excel-fill"></i> Excel'
            },
            {
                extend: 'pdf',
                className: 'btn btn-sm',
                text: '<i class="bi bi-filetype-pdf"></i> PDF'
            },
            {
                extend: 'print',
                className: 'btn btn-sm',
                text: '<i class="bi bi-printer-fill"></i> Print'
            },
            {
                text: '<i class="bi bi-arrow-clockwise"></i> Refresh',
                className: 'btn btn-sm',
                action: function (e, dt, node, config) {
                    location.reload(); // Reloads the entire page
                }
            }
        ],
        "dom": '<"top"Bf>rt<"bottom"lip><"clear">',
        "language": {
            "search": "_INPUT_",
            "searchPlaceholder": "Search..."
        }
    });

    table.buttons().container().appendTo('#subscribersTable_wrapper .col-md-6:eq(0)');
});
</script>

<!-- edit subscriber script -->
<script>
$(document).ready(function() {
    // Event listener for the "Edit" button click
    $('#subscribersTable').on('click', '.editbtn', function() {
        const subscriberId = $(this).data('id');
        var row = $(this).closest('tr');
  
        // Extract data from each cell
        var id = subscriberId; // Use the data-id attribute for the ID
        var name = row.find('td').eq(1).text();
        var phone = row.find('td').eq(2).text();
        var gender = row.find('td').eq(3).text().trim().toLowerCase();
        var subscriptiondate = formatDateForInput(row.find('td').eq(4).text());
        var fees = row.find('td').eq(5).text();
        var status = row.find('td').eq(6).text().trim().toLowerCase();

        // Populate the form fields
        $('#name').val(name);
        $('#phone').val(phone);
        
        // Set gender select value properly
        if (gender === 'male' || gender === 'female') {
            $('#gender').val(gender).trigger('change');
        } else {
            $('#gender').val('').trigger('change');
        }
        
        $('#subscriptiondate').val(subscriptiondate);
        $('#fees').val(fees);
        
        // Set status select value properly
        if (status === 'paid' || status === 'unpaid') {
            $('#status').val(status).trigger('change');
        } else {
            $('#status').val('').trigger('change');
        }
        
        $('#subscriber_id').val(id);
        $('#editSubscriberModal').modal('show');
    });

    // Helper function to format date for input[type="date"]
    function formatDateForInput(dateString) {
        if (!dateString) return '';
        var date = new Date(dateString);
        if (isNaN(date.getTime())) return '';
        return date.toISOString().split('T')[0];
    }

    $('#saveSubscriberChanges').on('click', function() {
        $('#editSubscriberForm').submit();
    });
    
    // Validate and handle form submission
    $('#editSubscriberForm').validate({
        rules: {
            name: {
                required: true,
                minlength: 2
            },
            phone: {
                required: true,
                digits: true,
                minlength: 7,
                maxlength: 15
            },
            gender: {
                required: true
            },
            SubscriptionDate: {
                required: true,
                date: true
            },
            fees: {
                required: true,
                number: true,
                min: 0
            },
            status: {
                required: true
            }
        },
        messages: {
            name: {
                required: "Please enter the name",
                minlength: "Name must be at least 2 characters"
            },
            phone: {
                required: "Please enter the phone number",
                digits: "Enter only digits",
                minlength: "Minimum 7 digits",
                maxlength: "Maximum 15 digits"
            },
            gender: {
                required: "Please select a gender"
            },
            SubscriptionDate: {
                required: "Please select a subscription date",
                date: "Enter a valid date"
            },
            fees: {
                required: "Please enter the fee",
                number: "Enter a valid number",
                min: "Fees cannot be negative"
            },
            status: {
                required: "Please select a status"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function (element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function (form) {
            Swal.fire({
                title: 'Edit Subscriber?',
                text: 'Are you sure you want to edit this subscriber?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    submitEditForm();
                }
            });
        }
    });

    function submitEditForm() {
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        // Get form data
        var formData = {
            _token: $('meta[name="csrf-token"]').attr('content'),
            id: $('#subscriber_id').val(),
            name: $('#name').val(),
            phone: $('#phone').val(),
            gender: $('#gender').val(),
            subscriptiondate: $('#subscriptiondate').val(),
            fees: $('#fees').val(),
            status: $('#status').val()
        };

        // Show loading state
        var $btn = $('#saveSubscriberChanges');
        $btn.prop('disabled', true).html(
            '<span class="spinner-border spinner-border-sm"></span> Saving...'
        );

        // Make AJAX request
        $.ajax({
            url: '/update-subscriber/' + formData.id,
            type: 'POST',
            data: formData,
            success: function(response) {
                // Hide modal using Bootstrap's JS if available
                if (typeof $.fn.modal === 'function') {
                    // Replace modal hide with:
                    $('#editSubscriberModal').removeClass('show');
                    $('#editSubscriberModal').css('display', 'none');
                    $('.modal-backdrop').remove();
                    $('body').removeClass('modal-open');
                } else if (typeof $.fn.modal === 'object') {
                    // Fallback if modal function doesn't exist
                    $('#editSubscriberModal').modal('hide');
                } else {
                    // Fallback if modal function doesn't exist
                    $('#editSubscriberModal').hide();
                    $('.modal-backdrop').remove();
                }
                
                // Reset button
                $btn.prop('disabled', false).text('Save changes');
                
                // Show success message
                if (typeof Swal === 'function') {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Subscriber updated successfully!',
                        icon: 'success'
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    alert('Subscriber updated successfully!');
                    window.location.reload();
                }
            },
            error: function(xhr) {
                $btn.prop('disabled', false).text('Save changes');
                
                let errorMsg = 'Failed to update subscriber';
                if (xhr.responseJSON) {
                    if (xhr.responseJSON.errors) {
                        errorMsg = Object.values(xhr.responseJSON.errors).join('<br>');
                    } else if (xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                }
                
                if (typeof Swal === 'function') {
                    Swal.fire({
                        title: 'Error!',
                        html: errorMsg,
                        icon: 'error'
                    });
                } else {
                    alert(errorMsg);
                }
            }
        });
    }

    // Initialize select2
    if ($.fn.select2) {
        $('.select2bs4').select2({
            theme: 'bootstrap4',
            placeholder: function() {
                return $(this).data('placeholder');
            }
        });
    }
    
    $("#subscriptiondate").flatpickr({
        dateFormat: "Y-m-d",
        allowInput: true
    });
});
</script>

<!-- add subscriber script -->
<script>
$(document).ready(function() {
    // Handle submit button click
    $('#submitSubscriberChanges').on('click', function() {
        $('#addSubscriberForm').submit();
    });

    // Validate and handle form submission
    $('#addSubscriberForm').validate({
        rules: {
            name: {
                required: true,
                minlength: 2
            },
            phone: {
                required: true,
                digits: true,
                minlength: 7,
                maxlength: 15
            },
            gender: {
                required: true
            },
            subscription_date: {  // Changed to match database column
                required: true,
                date: true
            },
            fees: {
                required: true,
                number: true,
                min: 0
            },
            status: {
                required: true
            }
        },
        messages: {
            name: {
                required: "Please enter the name",
                minlength: "Name must be at least 2 characters"
            },
            phone: {
                required: "Please enter the phone number",
                digits: "Enter only digits",
                minlength: "Minimum 7 digits",
                maxlength: "Maximum 15 digits"
            },
            gender: {
                required: "Please select a gender"
            },
            subscription_date: {  // Changed to match database column
                required: "Please select a subscription date",
                date: "Enter a valid date"
            },
            fees: {
                required: "Please enter the fee",
                number: "Enter a valid number",
                min: "Fees cannot be negative"
            },
            status: {
                required: "Please select a status"
            }
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function(element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function(form) {
          Swal.fire({
                title: 'Add Subscriber?',
                text: 'Are you sure you want to add this subscriber?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    submitAddForm();
                }
            });
        }
    });

    function submitAddForm() {
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        
        // Get form data - ensure field names match database columns
        var formData = {
            _token: csrfToken,
            name: $('#addSubscriberModal #name').val(),
            phone: $('#addSubscriberModal #phone').val(),
            gender: $('#addSubscriberModal #gender').val(),
            subscription_date: $('#addSubscriberModal #subscription_date').val(), // Match database column
            fees: $('#addSubscriberModal #fees').val(),
            status: $('#addSubscriberModal #status').val()
        };

        // Show loading state
        var $btn = $('#submitSubscriberChanges');
        $btn.prop('disabled', true).html(
            '<span class="spinner-border spinner-border-sm"></span> Submitting...'
        );

        // Make AJAX request
        $.ajax({
            url: '/add-subscriber',
            type: 'POST',
            data: formData,
            success: function(response) {
                // Hide modal
                if (typeof $.fn.modal === 'function') {
                    $('#addSubscriberModal').modal('hide');
                } else {
                    $('#addSubscriberModal').removeClass('show');
                    $('#addSubscriberModal').css('display', 'none');
                    $('.modal-backdrop').remove();
                    $('body').removeClass('modal-open');
                }
                
                // Reset button
                $btn.prop('disabled', false).text('Submit');
                
                // Show success message
                if (typeof Swal === 'function') {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Subscriber added successfully!',
                        icon: 'success'
                    }).then(() => {
                            window.location.reload();
                    });
                } else {
                    alert('Subscriber added successfully!');
                    location.reload();
                }
            },
            error: function(xhr) {
                $btn.prop('disabled', false).text('Submit');
                
                let errorMsg = 'Failed to add subscriber';
                if (xhr.responseJSON) {
                    if (xhr.responseJSON.errors) {
                        errorMsg = Object.values(xhr.responseJSON.errors).join('<br>');
                    } else if (xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                }
                
                if (typeof Swal === 'function') {
                    Swal.fire({
                        title: 'Error!',
                        html: errorMsg,
                        icon: 'error'
                    });
                } else {
                    alert(errorMsg);
                }
            }
        });
    }

    // Initialize select2
    if ($.fn.select2) {
        $('.select2bs4').select2({
            theme: 'bootstrap4',
            placeholder: function() {
                return $(this).data('placeholder');
            }
        });
    }

   $('#subscription_date').flatpickr({
        dateFormat: "Y-m-d",
        allowInput: true
    });
});
</script>

<!-- delete subscriber script -->
<script>
$(document).ready(function() {
    // Event listener for delete button click
    $('#subscribersTable').on('click', '.deletebtn', function() {
        var row = $(this).closest('tr');
        var id = row.find('td').eq(0).text();
        var name = row.find('td').eq(1).text();
        
        Swal.fire({
            title: 'Delete Subscriber?',
            text: 'Are you sure you want to delete "' + name + '"?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancel',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                deleteSubscriber(id, row);
            }
        });
    });

    function deleteSubscriber(id, row) {
        // Show loading state on the button
        var $btn = $('#subscribersTable').find('.deletebtn[data-id="'+id+'"]');
        $btn.html('<i class="fas fa-spinner fa-spin"></i>');
        
        $.ajax({
            url: '/delete-subscriber/' + id,
            type: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Remove row from table
                if ($.fn.DataTable && $('#subscribersTable').DataTable()) {
                    $('#subscribersTable').DataTable().row(row).remove().draw();
                } else {
                    row.remove();
                }
                
                Swal.fire(
                    'Deleted!',
                    'Subscriber has been deleted Successfully!',
                    'success'
                );
            },
            error: function(xhr) {
                $btn.html('<i class="fas fa-trash"></i>');
                Swal.fire(
                    'Error!',
                    'Failed to delete subscriber: ' + (xhr.responseJSON?.message || 'Unknown error'),
                    'error'
                );
            }
        });
    }
});
</script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- jQuery Validation -->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<!-- Flatpickr -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- Optional: Select2 if you're using it -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- SweetAlert2 (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<script>

    // Initialize Flatpickr
    $('#subscription_date').flatpickr({
        dateFormat: "Y-m-d",
        allowInput: true
    });

    $('#subscriptiondate').flatpickr({
        dateFormat: "Y-m-d",
        allowInput: true
    });
   
</script>







@endsection