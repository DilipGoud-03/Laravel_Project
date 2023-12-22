<div class="justify-content-center mt-5">
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @for($i=0;$i<count($users);$i++) <tr>
                <td>{{$users[$i]->id}}</td>
                <td>{{$users[$i]->name}}</td>
                <td>{{$users[$i]->email}}</td>
                <td>
                    <a href=" {{ route('deleteUserByUser',[$users[$i]->id])}}">Delete</a>
                </td>
                </tr>
                @endfor
        </tbody>
    </table>
</div>