@extends('layouts.masterPage')
@section('content')
<body onload=window.location='{{url('/install')}}'>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" style="margin-left: -15px;">
            <div class="card">
                <div class="card-header">Please Wait</div>
                <div style="margin-top: 10px">

                    <form >
                        {{csrf_field()}}
                        
                        
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-border text-secondary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-border text-success" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-border text-danger" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-border text-warning" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-border text-info" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-border text-dark" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-border text-secondary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-border text-success" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-border text-danger" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-border text-warning" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-border text-info" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-border text-dark" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-border text-secondary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-border text-success" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        
                        
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>



@endsection