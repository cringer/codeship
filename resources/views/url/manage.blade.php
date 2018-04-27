@extends('layouts.master')

@section('content')
    @if (count($errors) > 0 )
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container-fluid">
        <div class="row">
            <div class="card bg-light w-100">
                <div class="card-body">
                    <form class="form-inline" method="POST" action="{{ route('manage-route') }}">
                        @csrf

                        <label class="mr-sm-2" for="url">URL to shorten</label>
                        <input type="text" class="form-control mr-sm-2" id="url" name="url">

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection