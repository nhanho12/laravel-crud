<!DOCTYPE html>
<html lang="en">

<head>
    @include('common/taglib')
    <meta charset="UTF-8">
    <title>Thông báo: Có bài viết vừa đc update</title>
</head>

<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                    <h2 class="text-center">Thông báo: Có một bài viết vừa được cập nhật!</h2>
            </div>
            <div class="card-body">
                <p>Xin chào,</p>
                <p>Xem tất cả bài viết và quản lý tại <a href="{{ route('admin-post') }}">đây</a>.</p>
            </div>

        </div>
    </div>

</body>

</html>
