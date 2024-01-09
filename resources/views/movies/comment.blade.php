<body>
    @extends('layouts.app2')
    <div class="container mt-2">
        <div class="row">



            <div class="container mt-2">

                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>comments</th>
                            <th>des</th>
                            <th>comments_imge</th>
                            <th>user</th>
                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comment as $comment)
                        <tr>
                            <td>{{ $comment->id }}</td>

                            <td>{{ $comment->comment }}</td>








                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
