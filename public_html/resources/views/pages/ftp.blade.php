@extends('layouts.masterPage')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8" style="margin-left: -15px;">
      <div class="card">
        <div class="card-header">File Upload using FTP</div>
        <div style="margin-top: 10px">
          <form action="{{ url('/ftp') }}" method="post" enctype="multipart/form-data" class="needs-validation was-validated" novalidate>
            


            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">File input</label>
               <div class="col-md-6">
              <input class="form-control" type="file" name="profile_image" id="exampleInputFile" required="" />
              </div>
            </div>


            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">File Name</label>
               <div class="col-md-6">
              <input class="form-control" type="text" name="fn" id="fn" required="" />
              </div>
            </div>


            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">File Type</label>
               <div class="col-md-6">
              <select class="form-control" name="type" id="type" required="">
                <option value=""></option>
                <option value="video/webm">video</option>
                <option value="image">image</option>
                <option value="text">text</option>
                <option value="other">other</option>
              </select>
              </div>
            </div>
            
            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">File Access Mode</label>
               <div class="col-md-6">
              <select class="form-control" name="am" id="am"required="">
                <option value=""></option>
                <option value="inline">inline</option>
                <option value="attachment">attachment</option>
              </select>
              </div>
            </div>
            
            
            {{ csrf_field() }}
            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right"></label>
               <div class="col-md-6">
              <button type="submit" class="btn btn-primary btn-block">Upload</button>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection