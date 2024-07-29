@extends('layouts.master')

@section('content')
    <div class="container mb-5">
        <div class="text-center mt-5">
            <h1>{{ isset($blog) ? 'Edit Blog Post' : 'Create Blog Post' }}</h1>
        </div>

        <div class="row">
            <div class="col-lg-7 mx-auto">
                <div class="card mt-2 mx-auto p-4 bg-light">
                    <div class="card-body bg-light">
                        <div class="container">
                            <form id="blog-form" role="form" method="POST" enctype="multipart/form-data"
                                action="{{ isset($blog) ? route('blogs.update', $blog->id) : route('blogs.store') }}">
                                @csrf
                                @if (isset($blog))
                                    @method('PUT')
                                    <input type="hidden" name="blog_id" value="{{ $blog->id }}" />
                                @endif
                                <div class="controls">

                                    <!-- Title Field -->
                                    <div class="form-group">
                                        <label for="form_title">Title *</label>
                                        <input id="form_title" type="text" name="title" class="form-control"
                                            placeholder="Enter the blog title *" required="required"
                                            data-error="Title is required."
                                            value="{{ isset($blog) ? $blog->title : old('title') }}">
                                    </div>

                                    <!-- Content Field -->
                                    <div class="form-group">
                                        <label for="form_content">Content *</label>
                                        <textarea id="form_content" name="content" class="form-control" placeholder="Write your content here *" rows="6"
                                            required="required" data-error="Content is required.">{{ isset($blog) ? $blog->content : old('content') }}</textarea>
                                    </div>

                                    <!-- Author Field -->
                                    <div class="form-group">
                                        <label for="form_author">Author *</label>
                                        <input id="form_author" type="text" name="author" class="form-control"
                                            placeholder="Enter the author's name *" required="required"
                                            data-error="Author is required."
                                            value="{{ isset($blog) ? $blog->author : old('author') }}">
                                    </div>

                                    <!-- Published At Field -->
                                    <div class="form-group">
                                        <label for="form_published_at">Published At *</label>
                                        <input id="form_published_at" type="date" name="published_at"
                                            class="form-control" required="required"
                                            data-error="Published date is required."
                                            value="{{ isset($blog) ? $blog->published_at : old('published_at') }}">
                                    </div>

                                    <!-- Photos Field -->
                                    <div class="form-group">
                                        <label for="form_photos">Photos</label>
                                        <input id="form_photos" type="file" name="photo" class="form-control" />
                                    </div>

                                    <hr />

                                    <!-- Submit Button -->
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-success btn-send pt-2 btn-block"
                                            value="{{ isset($blog) ? 'Update Blog Post' : 'Create Blog Post' }}">
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
