@if ($father_data == 'input_father_name')
          <input type="text" class="form-control rounded-0" name="specific_father_name">
@else
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#exampleModal_father">
        <img src="{{ asset('/storage/' . $father_data->resident_image) }}" class="img img-thumbnail"
            style="width:100px;height:100px;">
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal_father" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Father Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table table-responsive">
                        <table class="table table-striped table-hover" id="example">
                            <thead>
                                <th>resident_image</th>
                                <th>first_name</th>
                                <th>middle_name</th>
                                <th>last_name</th>
                                <th>nickname</th>
                                <th>dob</th>
                                <th>civil_status</th>
                                <th>place_of_birth</th>
                                <th>sex</th>
                                <th>nationality</th>
                                <th>zone</th>
                                <th>pwd</th>
                                <th>pwd_description</th>
                                <th>permanent_address</th>
                                <th>current_address</th>
                                <th>status</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        {{-- <a target="_blank"
                                                href="{{ url('admin_resident_show_map', ['id' => $father_data->id]) }}"> --}}
                                        <img src="{{ asset('/storage/' . $father_data->resident_image) }}"
                                            class="img img-thumbnail" style="width:100px;height:100px;">
                                        {{-- </a> --}}
                                    </td>
                                    <td>{{ $father_data->first_name }}</td>
                                    <td>{{ $father_data->middle_name }}</td>
                                    <td>{{ $father_data->last_name }}</td>
                                    <td>{{ $father_data->nickname }}</td>
                                    <td>
                                        @php
                                            $dateOfBirth = $father_data->dob;
                                            $today = date('Y-m-d');
                                            $diff = date_diff(date_create($dateOfBirth), date_create($today));
                                            echo $diff->format('%y');
                                        @endphp
                                    </td>
                                    <td>{{ $father_data->civil_status }}</td>
                                    <td>{{ $father_data->place_of_birth }}</td>
                                    <td>{{ $father_data->sex }}</td>
                                    <td>{{ $father_data->nationality }}</td>
                                    <td>{{ $father_data->zone }}</td>
                                    <td>{{ $father_data->pwd }}</td>
                                    <td>{{ $father_data->pwd_description }}</td>
                                    <td>{{ $father_data->status }}</td>
                                    <td>{{ $father_data->permanent_address }}</td>
                                    <td>{{ $father_data->current_address }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
