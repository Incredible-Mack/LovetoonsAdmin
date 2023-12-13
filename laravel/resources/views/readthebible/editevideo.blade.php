@extends('../layout')
@section('breadcrumb')
    <div class="container">
        <x-heading heading="Update Let Read the bible Video" links='dashboard' prelink='addvideo' />
    </div>
    
@endsection
@section('maincontent')

    <form class="container" method="POST" action="{{ route('updatevideo')}}" enctype="multipart/form-data">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger">
                
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }} </p>
                    @endforeach
                
            </div>
        @endif


        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif
        
        

        <div class="row g-3">
            <div class="col">
                <label for="formFile" class="">Full Name</label>
                <input type="text" class="form-control" name="fullname" placeholder="Full name" aria-label="Full name"
                    value="{{ old('fullname') === null ? $videos['fullname'] : old('fullname') }}" >
            </div>
            
        </div>

        <input type="hidden" name="id" value="{{ $videos['id'] }}">

        <div class="row g-3 mt-4">
            <div class="col">
                <label for="formFile" class="">Video Link</label>
                <input type="text" class="form-control" name="link" placeholder="Video Link" aria-label="Video Link"
                    value="{{ old('link', $videos['link']) }}">
                   
            </div>
            <div class="col">
                <label for="formFile" class="">Bible Chapter</label>
                <input type="text" class="form-control" name='chapter' placeholder="Bible Chapter"
                    aria-label="Bible Chapter" value="{{ old('chapter', $videos['biblechapter']) }}">
            </div>
        </div>


        <div class="mb-3 mt-4">
            <label for="formFile" class="">Select Video Thumbnail</label>
            <input class="form-control" type="file" id="formFile" name="image">
            <input type="hidden" name="filename" value="{{ $videos['image'] }}" >
            <b>Image Name:</b>  {{ $videos['image'] }}
        </div>


        <input type='submit' name="submit" value="Update Video" class="btn btn-sm btn-primary">

    </form>




@endsection
