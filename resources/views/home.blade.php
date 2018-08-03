@extends('layouts.main')

@section('content')

    @include('layouts.homeNav')

    <div id="app">
        <div class="container">
            <div class="row justify-content-center">
                <counters-list
                        :counters="{{$counters}}"
                        filterurl="{{ route('filter') }}"
                        metricsurl="{{ route('metrics') }}"
                >
                </counters-list>
            </div>
        </div>
    </div>
@endsection
