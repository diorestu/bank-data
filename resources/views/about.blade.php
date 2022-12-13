@extends('layouts.app')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <h2 class="page-title">
                {{ __('About Page') }}
            </h2>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="alert alert-warning mb-4 text-center">
                <h2 class="display-6">Laravel Dynamic Ajax Progress Bar Example</h2>
            </div>
            <form id="fileUploadForm" method="POST" action="{{ url('/upload-doc-file') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <input name="file" type="file" class="form-control">
                </div>
                <div class="d-grid mb-3">
                    <input type="submit" value="Submit" class="btn btn-primary">
                </div>
                <div class="form-group">
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar"
                            aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                    </div>
                </div>
            </form>
            <div class="card">
                <div class="card-body">
                    <p class="card-text">
                        {{ __('Sample static text page ') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            $(document).ready(function() {
                $('#fileUploadForm').ajaxForm({
                    beforeSend: function() {
                        var percentage = '0';
                    },
                    uploadProgress: function(event, position, total, percentComplete) {
                        var percentage = percentComplete;
                        $('.progress .progress-bar').css("width", percentage + '%', function() {
                            return $(this).attr("aria-valuenow", percentage) + "%";
                        })
                    },
                    complete: function(xhr) {
                        console.log(this);
                        console.log('File has uploaded');
                    }
                });
            });
        });
    </script>
@endsection
