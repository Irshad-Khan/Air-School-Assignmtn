@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Videos') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        @include('alerts.success')
                    <form  class="mb-5" method="POST" action="{{ route('videos.upload') }}" enctype="multipart/form-data">
                        <div class="mb-3">
                            <h5>Upload Video</h5>
                            <hr>
                        </div>
                        @csrf
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Upload Video</label>
                            <input class="form-control" value="{{ old('video') }}" name="video" style="padding: 5px" type="file" id="formFile">
                            @if($errors->has('video'))
                                <span class="text-danger">{{$errors->first('video')}}</span>
                            @endif
                          </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
                            @if($errors->has('description'))
                                <span class="text-danger">{{$errors->first('description')}}</span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                      </form>

                      <div class="mb-3">
                        <h5>Videos List</h5>
                        <hr>
                    </div>
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Video</th>
                            <th scope="col">Description</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($videos as $video)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>
                                        <iframe width="400" height="300"
                                        src="{{ asset('uploads/'.$video->video) }}"
                                            allowfullscreen="allowfullscreen"
                                            mozallowfullscreen="mozallowfullscreen"
                                            msallowfullscreen="msallowfullscreen"
                                            oallowfullscreen="oallowfullscreen"
                                            webkitallowfullscreen="webkitallowfullscreen"
                                            sandbox
                                            >
                                        </iframe>
                                    </td>
                                    <td>{{ $video->description }}</td>
                                    <td>
                                        <form id="logout-form{{$loop->iteration}}"
                                            action="{{route('videos.delete', ['id' => $video->id])}}"
                                            method="GET">
                                            <button type="submit" style="width: 86px" onclick="return confirm('Are you sure you want to delete?')"
                                            class="btn btn-danger">Delete
                                            </button>
                                          </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="4">Vidoes not exist</td>
                                </tr>
                            @endforelse
                        </tbody>
                      </table>
                      <div style="margin-left: 350px;">
                        {{ $videos->links() }}
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
