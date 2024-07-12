<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
</head>

<body>
    @yield('content')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.19.3/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#employee-table').DataTable({
                "lengthMenu": [ 10, 25, 50, 75, 100, 250, 500 ], // Pilihan jumlah entri per halaman
                "language": { // Konfigurasi teks untuk navigasi halaman dan pencarian
                    "lengthMenu": "Tampilkan _MENU_ entri per halaman",
                    "search": "Cari:",
                    "paginate": {
                        "first": "«",
                        "last": "»",
                        "next": "›",
                        "previous": "‹"
                    }
                }
            });

            $('#hire_date').datepicker({
                format: 'yyyy-mm-dd'
            });

            $('.select2').select2();

            $('.table').DataTable();

            $('form').validate({
                rules: {
                    name: "required",
                    position: "required",
                    hire_date: "required",
                    salary: {
                        required: true,
                        number: true
                    }
                },
                messages: {
                    name: "Please enter the name",
                    position: "Please enter the position",
                    hire_date: "Please select the hire date",
                    salary: {
                        required: "Please enter the salary",
                        number: "Please enter a valid number"
                    }
                }
            });
        });
    </script>
    
</body>
</html>
