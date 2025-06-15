<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Employee Management')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css" />

<!-- Existing links and scripts -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        window.appData = {
            csrfToken: '{{ csrf_token() }}'
        };
    </script>

</head>
<body>
    <div class="container mt-5">
        @yield('content')
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle -->
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- DataTables -->
   <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
   

    @yield('scripts')
    
</body>
</html>
