@extends('layouts.master')

 @section('title')
  Users
 @endsection

 @section('style')

 @endsection


 @section('content')



 <div class="card shadow mb-4">

    <div class="card-header py-3 d-flex">
        <h6 class="m-0 font-weight-bold text-primary"> </h6>
        <div class="ml-auto">
            <a href="{{ route('users.create') }}" class="btn btn-primary">
               <span><i class="fa fa-plus"></i></span>
               <span> add User </span>
           </a>
        </div>
    </div>


    <div class="table-responsive">
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">

            <thead>
               <tr class="fw-bolder text-muted">
                   <th class="w-25px">  </th>
                   <th class="min-w-150px">name</th>
                   <th class="min-w-140px">Email</th>
                   <th class="min-w-140px">Mobile</th>
                   <th class="min-w-140px">Role</th>

                   <th class="min-w-130px">created at</th>
                   <th class="min-w-110px" style="width:30px ;"> Action</th>

               </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>

                    <td></td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->mobile }}</td>
                    <td>
                        <span class="badge badge-pill badge-success">User</span>
                    </td>
                    <td>{{ $user->created_at }}</td>


                    <td>
                        <div class="btn-group">
                            <a href="{{ route('users.edit' , $user->id) }}" class="btn btn-primary">
                               <i class="fa fa-edit"></i>
                            </a>

                          <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#Delete{{ $user->id }}" title="حذف"><i class="fa fa-trash"></i></button>
                           @include('backend.users.delete')
                        </div>

                    </td>

                 </tr>

                @endforeach




            </tbody>


        </table>
    </div>


 </div>




 @endsection



 @section('js')

 @endsection
