<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous" />
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="{{ asset('frontend/dist/pagination.css') }}">

    <title>Hello, world!</title>
</head>

<body>
    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <div id="render_table">

        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
    
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $eachEmployee)
                    <tr>
    
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ $eachEmployee->FIRST_NAME }}
                        </td>
                        <td>
                            {{ $eachEmployee->LAST_NAME }}
    
                        </td>
                        <td>
                            {{ $eachEmployee->EMAIL }}
                        </td>
    
                    </tr>
                @endforeach
    
            </tbody>
    
        </table>

    </div>
    <div id="pagination-demo"></div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <script src="{{ asset('frontend/dist/pagination.js') }}"></script>

    <script>
        var itemsCount = "{{ $total_data}}";
            
     
        var itemsOnPage = 10;
      
      

        var myPagination = new Pagination({

            container: $("#pagination-demo"),
            pageClickCallback: function(page_number) {
              
                $.ajax({

                    type: 'get',
                    url: "{{ route('get_next_data') }}",
                    data: {
                        rows:page_number,
                        _token: '{{ csrf_token() }}',
                    },

                    success: function(response) {
                        
                        $('#render_table').html('');
                        $('#render_table').html(response.view);


                    }


                });

            },


        });
        myPagination.make(itemsCount, itemsOnPage);
    </script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
        integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous">
    </script>
    -->
</body>

</html>
