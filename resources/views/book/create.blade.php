@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" st>
                    <div class="card-header">Dashboard - Create Book</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('book') }}">

                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Book Title">
                            </div>

                            <div class="form-group">
                                <label>Author</label>
                                <input type="text" name="author" class="form-control" placeholder="Book Author">
                            </div>

                            <div class="form-group">
                                <label>Publication Date</label>
                                <input type="text" name="published_at" class="form-control publication_date" readonly>
                            </div>

                            <!-- csrf -->
                            @csrf


                            <button type="submit" class="btn btn-primary">Submit</button>
                            <br><br>

                            @if($errors->any())
                                @foreach($errors->all() as $message)
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @endforeach
                            @endif
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="{{ asset('js/init.datepicker.js') }}"></script>

@endsection

