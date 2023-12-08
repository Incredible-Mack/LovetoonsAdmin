@extends('../layout')
@section('breadcrumb')
    <x-heading heading="Add Video" links='dashboard' prelink='addvideo' />
@endsection
@section('maincontent')

    <form class="container" method="POST" action='addvideo' enctype="multipart/form-data">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger">
                
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }} </p>
                    @endforeach
                
            </div>
        @endif
{{-- 
        @if($errors->has('fileerror'))
            <div class="alert alert-danger">
                {{ $errors->first('fileerror') }}
            </div>
        @endif --}}
       

        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif
        

       

        <div class="row g-3">
            <div class="col">
                <input type="text" class="form-control" name="firstname" placeholder="First name" aria-label="First name"
                    value="{{ old('firstname') }}">
            </div>
            <div class="col">
                <input type="text" class="form-control" name="lastname" placeholder="Last name" aria-label="Last name"
                    value="{{ old('lastname') }}">
            </div>
        </div>

        <div class="row g-3 mt-4">
            <div class="col">
                <input type="text" class="form-control" name="link" placeholder="Video Link" aria-label="Video Link"
                    value="{{ old('link') }}">
            </div>
            <div class="col">
                <input type="text" class="form-control" name='chapter' placeholder="Bible Chapter"
                    aria-label="Bible Chapter" value="{{ old('chapter') }}">
            </div>
        </div>


        <div class="mb-3 mt-4">
            <label for="formFile" class="">Select Video Thumbnail</label>
            <input class="form-control" type="file" id="formFile" name="image">
        </div>


        <input type='submit' name="submit" value="Upload Video" class="btn btn-lg btn-primary">

    </form>




@endsection
