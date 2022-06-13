@php
    /** @var \App\Models\Post $post */
@endphp

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Posts</div>

                <a class="btn btn-info btn-sm col-2"
                   href="{{ route('admin.posts.create') }}"><i
                        class="fas fa-pencil-alt"></i> Add</a>

                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Desc</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($posts as $post)
                            <tr>
                                <th scope="row">{{ $post->id }}</th>
                                <th scope="row">{{ $post->title }}</th>
                                <th scope="row">{{ $post->description }}</th>

                                <th scope="row">
                                    @foreach($post->images as $image)
                                        <img src="{{ $post->getImage($image) }}" width="75" alt="">
                                    @endforeach
                                </th>

                                <th scope="row">
                                    <a class="btn btn-info btn-sm"
                                       href="{{ route('admin.posts.edit', $post) }}"><i
                                            class="fas fa-pencil-alt"></i> Edit</a>

                                    <a class="btn btn-secondary btn-sm"
                                       href="{{ route('admin.posts.show', $post) }}"><i
                                            class="fas fa-pencil-alt"></i> Details</a>

                                    {!! Form::open(['url' => route('admin.posts.destroy', $post), 'method' => 'POST']) !!}
                                    @method('DELETE')
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                    {!! Form::close() !!}
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{ $posts->links() }}
        </div>
    </div>
</div>

