@extends('layouts.master')

 @section('title')
   User Comments
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
                   <th class="min-w-130px">Comment</th>
                   <th class="min-w-120px">created at</th>

               </tr>
            </thead>
            <tbody>
                @foreach($comments as $comment)
                <tr>

                    <td></td>
                    <td>{{ $comment->user->name }}</td>
                    <td>{{ $comment->products->name }}</td>
                    <td>{{ $comment->products->price }}</td>
                    <td>
                        <img src="{{ asset('Attachments/products/'.$comment->products->img) }}" width="70px" alt="">

                    </td>

                    <td>{{ $comment->comments }}</td>

                    <td>{{ $comment->created_at }}</td>



                 </tr>

                @endforeach




            </tbody>


        </table>
    </div>


 </div>




 @endsection



 @section('js')

 @endsection
