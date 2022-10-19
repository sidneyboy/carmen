@if (count($complainant_data) != 0)
    <div class="table table-responsive">
        <table class="table table-striped table-hover" id="example">
            <thead>
                <th>Photo</th>
                <th>first_name</th>
                <th>middle_name</th>
                <th>last_name</th>
                <th>nickname</th>
                <th>dob</th>
                <th>civil_status</th>
                <th>Zone</th>
                <th>More Info</th>
            </thead>
            <tbody>
                @foreach ($complainant_data as $data)
                    <tr>
                        <td><img src="{{ asset('/storage/' . $data->resident_image) }}" style="width:100px;height:100px"
                                class="img img-thumbnail"></td>
                        <td>{{ $data->first_name }}</td>
                        <td>{{ $data->middle_name }}</td>
                        <td>{{ $data->last_name }}</td>
                        <td>{{ $data->nickname }}</td>
                        <td>{{ $data->dob }}</td>
                        <td>{{ $data->civil_status }}</td>
                        <td>{{ $data->zone }}</td>
                        <td><a href="{{ url('lupon_show_resident_data', ['id' => $data->id]) }}">Show Data</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
 No Data
@endif
