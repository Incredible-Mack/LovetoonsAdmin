@extends('/layout')
@section('breadcrumb')
    <x-heading heading="Error" links=' ' prelink=' ' />
@endsection
@section('maincontent')
    <div class="text-center col-12">
        <h1>404 Not Found</h1>
        <p>Sorry, the page you are looking for might not exist.</p>

        <a href="{{ url('dashboard') }}">Go back to Dashboard </a>

    </div>
@endsection
