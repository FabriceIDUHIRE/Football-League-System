<!-- resources/views/posts/edit.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="min-h-screen flex flex-col items-center justify-center p-10">
    <div class="max-w-3xl w-full">
        <!-- Edit Post Form -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-3xl font-bold text-center mb-6">Edit Post</h1>

            <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <label class="text-gray-700">Title:</label>
                <input type="text" name="title" class="w-full p-2 mb-4 border rounded" value="{{ $post->title }}" required>

                <label class="text-gray-700">Content:</label>
                <textarea name="content" class="w-full p-2 mb-4 border rounded" required>{{ $post->content }}</textarea>

                <label class="text-gray-700">Category:</label>
                <select name="category" class="w-full p-2 mb-4 border rounded">
                    <option value="news" {{ $post->category == 'news' ? 'selected' : '' }}>News 📰</option>
                    <option value="updates" {{ $post->category == 'updates' ? 'selected' : '' }}>Updates 🔥</option>
                    <option value="next_event" {{ $post->category == 'next_event' ? 'selected' : '' }}>Next Event 🎯</option>
                    <option value="match_result" {{ $post->category == 'match_result' ? 'selected' : '' }}>Match Result ⚽</option>
                    <option value="announcement" {{ $post->category == 'announcement' ? 'selected' : '' }}>Announcement 📢</option>z
                </select>

                <label class="text-gray-700">Image (Optional):</label>
                <input type="file" name="image" class="w-full p-2 mb-4 border rounded">

                <label class="text-gray-700">Status:</label>
                <select name="status" class="w-full p-2 mb-4 border rounded">
                    <option value="draft" {{ $post->status == 'draft' ? 'selected' : '' }}>Draft 📝</option>
                    <option value="published" {{ $post->status == 'published' ? 'selected' : '' }}>Publish 🔥</option>
                </select>

                <button type="submit" class="w-full bg-blue-600 text-white p-3 rounded">Update Post 🚀</button>
            </form>
        </div>
    </div>
</body>
</html>
