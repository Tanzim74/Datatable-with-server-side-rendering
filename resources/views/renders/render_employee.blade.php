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
        @php
            $i = $index;   
        @endphp
        @foreach ($employees as $eachEmployee)
            <tr>

                <td>
                    {{ $i }}
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
            @php
                $i++;
            @endphp
        @endforeach

    </tbody>

</table>