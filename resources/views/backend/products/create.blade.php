@extends('layouts.master')

 @section('title')
  Add product
 @endsection

 @section('style')

 @endsection


 @section('content')


 <div class="card shadow mb-4">

    <div class="card-header py-3 d-flex">
        <h6 class="m-0 font-weight-bold text-primary"> products </h6>
        <div class="ml-auto">
            <a href="{{ route('products.index') }}" class="btn btn-primary">
            <span><i class="fa fa-home"></i></span>
            <span> products </span>
        </a>
        </div>
    </div>

    <div class="card-body">

        <form action="{{ route('products.store') }}" method="POST" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="d-flex col-6 flex-column mb-7 fv-row fv-plugins-icon-container">
                    <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                        <span class="required">
                            Name
                        </span>
                    </label>
                    <input type="text"  name="name" value="{{old('name')}}" class="form-control form-control-solid" placeholder="Enter Your Name " >
                    @error('name') <span class="text-danger">{{ $message }}</span>  @enderror
                </div>

                <div class="d-flex col-6 flex-column mb-7 fv-row fv-plugins-icon-container">
                    <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                        <span class="required">
                          price
                        </span>
                    </label>
                    <input type="number"  name="price" value="{{old('price')}}" class="form-control form-control-solid" placeholder="Enter Price" >
                    @error('price') <span class="text-danger">{{ $message }}</span>  @enderror

                </div>


            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                            <span class="required">
                                Category
                            </span>
                        </label>
                        <select name="category_id" class="form-control">
                            <option value=""> -- choose -- </option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach

                        </select>
                        @error('category_id') <span class="text-danger">{{ $message }}</span>  @enderror

                    </div> <br>
            </div>



           <div class="row">
                <div class="d-flex col-6 flex-column mb-7 fv-row fv-plugins-icon-container">
                    <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                        <span class="required">
                           Description
                        </span>
                    </label>
                    <textarea name="desc" class="form-control form-control-solid"  placeholder="Enter Service desc" rows="3">{{old('desc')}}</textarea>
                       @error('desc') <span class="text-danger">{{ $message }}</span>  @enderror

                </div>
           </div>

            <div class="row pt-4">

                <div class="col-6">
                    <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                        <span class="required">
                            product Image
                        </span>
                    </label>
                    <div >
                        <input type="file" name="img" class="form-control" >
                        <span class="form-text text-muted">Image with should be jpg , jpeg , png</span>
                        @error('img') <span class="text-danger">{{ $message }}</span>  @enderror

                    </div>
                </div>

            </div>


            <div class="text-center pt-15">
                <button type="submit" class="btn btn-primary">
                    <span class="indicator-label">Submit</span>
                    <span class="indicator-progress">Please wait...</span>
                </button>
            </div>

        </form>

    </div>

</div>




 @endsection



 @section('js')

 @endsection
