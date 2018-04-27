@extends('layouts.master')

@section('content')

@if ($message !== null)
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="container-fluid">
    <div class="row">
        <table class="table table-striped table-bordered table-sm">
            <thead>
                <tr>
                    <th>id</th>
                    <th>shortened url</th>
                    <th>original url</th>
                    <th>created</th>
                    <th>last updated</th>
                </tr>
            </thead>
            <tbody>
            @if (count($urls))
                @foreach ($urls as $url)
                    <tr>
                        <td>{{ $url->id }}</td>
                        <td><a href="{{ $url->shortened_url }}">{{ $url->shortened_url }}</a></td>
                        <td><a href="{{ $url->original_url }}">{{ $url->original_url }}</a></td>
                        <td>{{ $url->created_at }}</td>
                        <td>{{ $url->updated_at }}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>
@endsection