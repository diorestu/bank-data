@extends('layouts.app')

@section('content')
    <div class="container-xl">
        <div class="page-header d-print-none">
            <h2 class="page-title text-white">
                {{ __('Dashboard') }}
            </h2>
            <h5 class="font-medium text-white">
                {{ __('Welcome') }} {{ auth()->user()->name ?? null }}
            </h5>
        </div>
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-decks">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                {!! $chart->container() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}
@endsection
