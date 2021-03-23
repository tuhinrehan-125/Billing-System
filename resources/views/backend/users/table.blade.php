<table id="all-unit-user" class="table table-striped table-bordered dt-responsive nowrap">
    <thead>
    <tr>
        <th data-priority="1">Sl./No</th>
        <th data-priority="3">User Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Address</th>
        <th  data-priority="5">Status</th>
        <th  data-priority="6">Action</th>
    </tr>
    </thead>
        <tbody>
            @foreach($user as $data)
            <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$data->name ?? ''}}</td>
            <td>{{$data->phone ?? ''}}</td>
            <td>{{$data->email ?? ''}}</td>
            <td>{{$data->vehicle_number ?? ''}}</td>
            <td>{{$data->address ?? ''}}</td>
            <td>
                @if($data->status==1)
                   <p class="text-success"> Active</p>
                @else
                   <p class="text-danger"> Inactive</p>
                @endif
            </td>
            <td>
                <table>
                    <tr>
                        <td>
                            <a href="#"
                               data-id="{{!empty($data->id) ? $data->id : ''}}"
                               data-name="{{!empty($data->name) ? $data->name : ''}}"
                               data-email="{{!empty($data->email) ? $data->email : ''}}"
                               data-phone="{{!empty($data->phone) ? $data->phone : ''}}"
                               data-address="{{!empty($data->address) ? $data->address : ''}}"
                               data-reg="{{!empty($data->vehicle_number) ? $data->vehicle_number : ''}}"
                               class="btn btn-info view-data"
                               data-toggle="modal" data-target="#viewmodal">View
                            </a>
                        </td>
                        <td><a href="#" class="btn btn-success edit-data"
                               data-toggle="modal" data-target="#editmodal"
                               data-id="{{!empty($data->id) ? $data->id : ''}}"
                               data-name="{{!empty($data->name) ? $data->name : ''}}"
                               data-email="{{!empty($data->email) ? $data->email : ''}}"
                               data-phone="{{!empty($data->phone) ? $data->phone : ''}}"
                               data-address="{{!empty($data->address) ? $data->address : ''}}"
                               data-vehicle="{{!empty($data->vehicle_number) ? $data->vehicle_number : ''}}"

                            ><i class="fa fa-edit"></i></a></td>
                        <td>
                            <form action="#" class="status">
                                @csrf
                                <input type="hidden" name="id"  value="{{$data->id}}">
                                <button  class="btn  {!!  $data->status==1 ? 'btn-outline-success' : 'btn-outline-danger'!!}" onclick="return confirm('Do You Want to sure')"><i
                                        class="fa {!!  $data->status==1 ? 'fa-eye' : 'fa-eye-slash'!!}"></i></button>
                            </form>
                        </td>
                        <td>
                            <form action="#" class="delete">
                                @csrf
                                <input type="hidden" name="id" value="{{$data->id}}">
                                <button class="btn btn-danger" onclick="return confirm('Do You Want to sure')"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                </table>
            </td>
            </tr>
            @endforeach
        </tbody>
    <tfoot>
    <tr>
        <th>Sl./No</th>
        <th>User Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Vehicle Reg No.</th>
        <th>Address</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </tfoot>
</table>
