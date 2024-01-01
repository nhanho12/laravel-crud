<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trustshop</title>
</head>
@include('common/header')

<div class="container-fluid">
    <div class="row ">
        <div class="col-md-3 col-lg-3 border-end p-4">
            <button id="openModalBtn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Add</button>
            <hr>
            <button class="btn "><i class="bi bi-gear mb-3"></i> Setting</button>
            <hr>
            <button class="btn "><i class="bi bi-list-task"></i> Your post</button>
        </div>

        <div class="col-md-9 col-lg-9 content-user p-5">
            <div class="">
                <p class="text-center text-danger">{{ session('message') }}</p>
                <div class="row">
                    @foreach ($posts as $post)
                        <div class="col-lg-4 col-md-4 mb-4">
                            <div class="card h-100">
                                <img class="card-img-top" width="200px" height="250px"
                                 src="{{ URL::to($post->image) }}" alt="{{ $post->title }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $post->title }}</h5>
                                    <p class="card-text">{{ $post->content }}</p>
                                </div>
                                <div class="card-footer">
                                    <a href="{{ $post->id }}" class="btn btn-primary">Read More</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal create-->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="addPostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPostModalLabel">Add post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addPostForm" action="{{ route('user-create-post') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="postTitle" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" id="postTitle" name="title">
                    </div>
                    <div class="mb-3">
                        <label for="postContent" class="form-label">Content</label>
                        <textarea class="form-control" name="content" id="postContent" name="content" rows="5"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="postContent" class="form-label">Hashtag</label>
                        <input type="text" name="tag" class="form-control" id="postTitle" name="tag">
                    </div>
                    <div class="mb-3">
                        <label for="postContent" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" id="postTitle" name="postTitle" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
