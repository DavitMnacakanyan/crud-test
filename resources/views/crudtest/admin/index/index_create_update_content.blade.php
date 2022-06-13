@php
    /** @var \App\Models\Post $post */
    $url = (isset($post->id)) ? route('admin.posts.update', $post) : route('admin.posts.store');
@endphp

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary btn-md mb-2 col-2">
                    <i class="fas fa-long-arrow-alt-left"></i> Back to company
                </a>

                <div class="form card card-success">
                    <div class="card-header">company</div>

                    <div class="card-body">

                        {!! Form::open([
                                'url' => $url,
                                'method' => 'POST',
                                'enctype' => 'multipart/form-data'
                          ]) !!}

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    {{ Form::label('title') }}
                                    {!! Form::text('title', $post->title ?? old('title'), ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Enter title ...']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    {{ Form::label('description') }}
                                    {!! Form::text('description', $post->description ?? old('description'), ['class' => 'form-control', 'id' => 'description', 'placeholder' => 'Enter description ...']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group" data-select2-id="48">
                                    {{ Form::label('input-file-now', 'Image') }}
                                    {!! Form::file('image', ['id' => 'input-file-now', 'class' => 'dropify']) !!}
                                </div>
                            </div>

                            @if(isset($post->id))
                                <div class="col-md-4">
                                    <div class="form-group" data-select2-id="48">
                                        <label style="display: block; margin-left: 31%;">Image</label>
                                          @foreach($post->images as $image)
                                              <img style="width: 23%; padding-top: 8%;"
                                                   src="{{ $post->getImage($image) }}"
                                                   alt="#">
                                          @endforeach
                                    </div>
                                </div>
                                @method('PUT')
                            @endif
                        </div>

                        {!! Form::submit('Save', ['class' => 'btn btn-success mt-2']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




