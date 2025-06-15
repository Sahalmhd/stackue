$(function () {
    $('#employees-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/employees-data',
        columns: [
            { data: 'employee_govt_id', name: 'employee_govt_id' },
            { data: 'full_name', name: 'full_name' },
            { data: 'email', name: 'email' },
            { data: 'department', name: 'department.name' },
            { data: 'hire_date', name: 'hire_date' },
            { data: 'status', name: 'status' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ]
    });
    $('body').on('click', '.delete-employee', function () {
        var employeeId = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "This will permanently delete the employee.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/employees/' + employeeId,
                    type: 'DELETE',
                    data: {
                        _token: window.appData.csrfToken
                    },
                    success: function () {
                        Swal.fire('Deleted!', 'Employee has been deleted.', 'success');
                        $('#employees-table').DataTable().ajax.reload();
                    },
                    error: function () {
                        Swal.fire('Error!', 'Something went wrong.', 'error');
                    }
                });
            }
        });
    });
});

