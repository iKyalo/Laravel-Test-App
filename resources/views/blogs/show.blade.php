@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <article class="mb-5">
                    <h1 class="mb-3">{{ $blog->title }}</h1>
                    @php
                        $date = $blog->published_at;
                        $dateTime = new DateTime($date);
                    @endphp
                    <p class="text-muted">By <strong>{{ $blog->author }}</strong> on
                        <time>{{ $dateTime->format('jS F, Y') }}</time>
                    </p>
                    @if ($blog->photo)
                        <img src="{{ url('photos/' . $blog->photo) }}" alt="Photo" class="img-fluid"
                            style="max-width: 100%; max-height: 24rem;" />
                    @else
                        <img class="img-fluid card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg"
                            alt="..." />
                    @endif
                    <div class="card my-2">
                        <div class="card-body">
                            <p class="lead">{{ $blog->content }}</p>
                        </div>
                    </div>

                </article>

                <section class="mt-5">
                    <h2>Leave a Comment</h2>
                    <!-- Comment form-->
                    <form class="mb-4" action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <textarea class="form-control" name="comment" rows="3" placeholder="Join the discussion and leave a comment!"
                            required></textarea>
                        <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                        <button class="btn btn-primary my-1" type="submit">Post Comment</button>
                    </form>
                </section>

                <section>
                    <h2>Comments</h2>
                    <hr />
                    @foreach ($blog->comments as $comment)
                        <div class="media mb-4">
                            <div class="media-body">
                                <small>Posted on {{ $comment->created_at->format('d/m/Y') }}</small>
                                <p>{{ $comment->comment }}</p>
                            </div>
                        </div>
                    @endforeach
                </section>


            </div>
        </div>
    </div>
@endsection
