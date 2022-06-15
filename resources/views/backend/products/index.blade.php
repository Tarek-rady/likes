@extends('layouts.master')

 @section('title')
  Products
 @endsection

 @section('style')

 @endsection


 @section('content')


 <div class="card shadow mb-4">

    <div class="card-header py-3 d-flex">
        <h6 class="m-0 font-weight-bold text-primary"> </h6>
        <div class="ml-auto">
            <a href="{{ route('products.create') }}" class="btn btn-primary">
               <span><i class="fa fa-plus"></i></span>
               <span> Add Product </span>
           </a>
        </div>
    </div>


    <div class="table-responsive">
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">

            <thead>
               <tr class="fw-bolder text-muted">
                   <th class="w-25px">  </th>
                   <th class="min-w-150px">Name</th>
                   <th class="min-w-140px">Img</th>
                   <th class="min-w-130px">Price</th>
                   <th class="min-w-130px">Category</th>
                   <th class="min-w-120px">created at</th>
                   <th class="min-w-110px" style="width:30px ;"> Action</th>

               </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>

                    <td></td>
                    <td>{{ $product->name }}</td>
                    <td>
                        <img src="{{ asset('Attachments/products/'.$product->img) }}" width="70px" alt="">
                    </td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->created_at }}</td>

                    <td>
                        <div class="btn-group">
                            <a href="{{ route('products.edit' , $product->id) }}" class="btn btn-primary">
                               <i class="fa fa-edit"></i>
                            </a>


                          <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#Delete{{ $product->id }}" title="حذف"><i class="fa fa-trash"></i></button>
                          @include('backend.products.delete')
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
