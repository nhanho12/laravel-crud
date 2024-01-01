<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post management</title>
    @include('common/taglib')
</head>

<body>
    @include('common/header')
    <!-- body -->
    <div class="container mt-5">
        <!-- button open modal -->
        <button id="openModalBtn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Add</button>
        <!-- table -->
        <p class="text-center text-danger">{{ session('message') }}</p>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">PostID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Content</th>
                    <th scope="col">Image</th>
                    <th scope="col">Publish Date</th>
                    <th scope="col">Tag</th>
                    <th scope="col">Author</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->content }}</td>
                        <td>
                            <img src="{{ URL::to($post->image) }}" width="200px" height="200px" />
                        </td>
                        <td>{{ $post->published_date }}</td>
                        <td>{{ $post->tags }}</td>
                        <td>{{ $post->author ? $post->author->fullname : 'Unknown Author' }}</td>
                        <td>
                            <a href="#" class="bi bi-pencil-square" data-bs-toggle="modal"
                            data-bs-target="#updateModal-{{ $post->id }}" style="font-size: 24px;color: #000"></a>
                            <!-- modal update -->
                            <div class="modal fade" id="updateModal-{{ $post->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="updateModalLabel-{{ $post->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updatePostModalLabel">Update post</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="updatePostForm-{{ $post->id }}" action="{{ route('admin-update-post', ['id' => $post->id]) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                {{-- @method('PUT') --}}
                                                <div class="mb-3">
                                                    <label for="postTitle" class="form-label">Title</label>
                                                    <input value="{{ $post->title }}" type="text" name="title"
                                                        class="form-control" id="postTitle" name="title">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="postContent" class="form-label">Content</label>
                                                    <textarea class="form-control" name="content" id="postContent" name="content" rows="5">{{ $post->content }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="postContent" class="form-label">Hashtag</label>
                                                    <input value="{{ $post->tags }}" type="text" name="tag"
                                                        class="form-control" id="postTitle" name="tag">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="postContent" class="form-label">Image</label>
                                                    <input type="file" name="image" class="form-control"
                                                        id="postTitle" name="postTitle" accept="image/*">
                                                </div>
                                                <div class="mb-3">
                                                    <img src="{{ URL::to($post->image) }}" alt="post image"
                                                        width="180px" height="180px">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('admin-delete-post', ['id' => $post->id]) }}" class="bi bi-trash"
                                style="font-size: 24px;color: #000"></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
                    <form id="addPostForm" action="{{ route('admin-create-post') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="postTitle" class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" id="postTitle"
                                name="title">
                        </div>
                        <div class="mb-3">
                            <label for="postContent" class="form-label">Content</label>
                            <textarea class="form-control" name="content" id="postContent" name="content" rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="postContent" class="form-label">Hashtag</label>
                            <input type="text" name="tag" class="form-control" id="postTitle"
                                name="tag">
                        </div>
                        <div class="mb-3">
                            <label for="postContent" class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" id="postTitle"
                                name="postTitle" accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
