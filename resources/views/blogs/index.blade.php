@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-table me-1"></i>
                Blogs
            </div>
            <a href="/blogs/create" class="btn btn-primary">
                Add New
            </a>
        </div>

    </div>
    <div class="container mt-2">
        <div class="row">
            @foreach ($blogs as $blog)
                <div class="col-md-4 mb-4">
                    <div class="card mb-4">
                        @if ($blog->photo)
                            <img src="{{ url('photos/' . $blog->photo) }}" alt="Photo" style="max-width: 100%;" />
                        @else
                            <img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg"
                                alt="..." />
                        @endif


                        <div class="card-body">
                            <div class="small text-muted">{{ $blog->published_at }}</div>
                            <h2 class="card-title h4">{{ $blog->title }}</h2>
                            <p class="card-text">{{ $blog->content }}</p>
                            <a class="btn btn-primary" href="/blogs/{{ $blog->id }}">Read more →</a>
                            <a class="btn btn-secondary" href="/blogs/edit/{{ $blog->id }}">Edit</a>
                            {{-- <a class="btn btn-danger" href="#!">Delete</a> --}}
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $blog->id }}">
                                Delete
                            </button>


                            <!-- Modal -->
                            <div class="modal fade" id="deleteModal{{ $blog->id }}" tabindex="-1"
                                aria-labelledby="deleteModalLabel{{ $blog->id }}" aria-hidden="true">
                                <form method="post" action="{{ route('blogs.destroy') }}">
                                    @csrf
                                    <input type="hidden" name="blog_id" value="{{ $blog->id }}" />
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this post?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-danger">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
