@extends('layouts.master')

 @section('title')
  User Like
 @endsection

 @section('style')

 @endsection


 @section('content')



 <div class="card shadow mb-4">




    <div class="table-responsive">
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">

            <thead>
               <tr class="fw-bolder text-muted">
                   <th class="w-25px">  </th>
                   <th class="min-w-150px">User</th>
                   <th class="min-w-140px">Name</th>
                   <th class="min-w-130px">Price</th>
                   <th class="min-w-130px">Img</th>
                   <th class="min-w-120px">created at</th>

               </tr>
            </thead>
            <tbody>
                @foreach($likes as $like)
                <tr>

                    <td></td>
                    <td>{{ $like->user->name }}</td>
                    <td>{{ $like->products->name }}</td>
                    <td>{{ $like->products->price }}</td>
                    <td>
                        <img src="{{ asset('Attachments/products/'.$like->products->img) }}" width="70px" alt="">

                    </td>

                    <td>{{ $like->created_at }}</td>


                 </tr>

                @endforeach




            </tbody>


        </table>
    </div>


 </div>




 @endsection



 @section('js')

 @endsection
