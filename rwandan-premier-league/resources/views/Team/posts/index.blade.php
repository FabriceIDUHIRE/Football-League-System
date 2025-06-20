@php
    use Illuminate\Support\Facades\Auth;
@endphp


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Updates</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background: #0f172a;
            font-family: 'Poppins', sans-serif;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            padding: 30px;
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
            transition: transform 0.3s ease;
        }

        .glass-card:hover {
            transform: scale(1.02);
        }

        .input-field {
            background: rgba(255, 255, 255, 0.2);
            padding: 12px;
            border: none;
            border-radius: 10px;
            outline: none;
            color: white;
            margin-bottom: 20px;
        }

        .input-field::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .btn-primary {
            background: #f59e0b;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .btn-primary:hover {
            background: #d97706;
        }

        .btn-danger {
            background: #ef4444;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .btn-danger:hover {
            background: #dc2626;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col items-center justify-center p-10">

    <div class="max-w-3xl w-full">
        <!-- Post Form -->
        <div class="glass-card mb-10">
            <h1 class="text-3xl text-white text-center mb-6 uppercase font-bold tracking-wide">📢 Team Posts</h1>

            <form method="POST" action="/posts" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="team_id" value="{{ Auth::user()->team_id }}">

                <label class="text-white">Title:</label>
                <input type="text" name="title" class="input-field" placeholder="Post Title..." required>

                <label class="text-white">Content:</label>
                <textarea name="content" class="input-field" placeholder="What's Happening..." required></textarea>

                <label class="text-white">Category:</label>
                <select name="category" class="input-field" required>
                    <option value="">Select Category</option>
                    <option value="news">News 📰</option>
                    <option value="updates">Updates 🔥</option>
                    <option value="next_event">Next Event 🎯</option>
                    <option value="match_result">Match Result ⚽</option>
                    <option value="announcement">Announcement 📢</option>
                    <option value="lineup">Lineup ⚽</option>
                </select>

                <label class="text-white">Image (Optional):</label>
                <input type="file" name="image" class="input-field">

                <label class="text-white">Status:</label>
                <select name="status" class="input-field" required>
                    <option value="draft">Draft 📝</option>
                    <option value="published">Publish 🔥</option>
                </select>

                <button type="submit" class="btn-primary w-full mt-6">
                    Publish Post 🚀
                </button>
            </form>
        </div>

        <!-- Posts Cards -->
        <div class="grid grid-cols-1 gap-6">
            @foreach($posts as $post)
            <div class="glass-card">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl text-white font-bold">{{ $post->title }}</h2>
                    <span class="text-sm text-yellow-400">{{ $post->category }}</span>
                </div>
                <p class="text-white mt-4">{{ $post->content }}</p>

                @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="rounded-lg mt-4">
                @endif

                <div class="mt-4 flex justify-between items-center">
                    <form method="POST" action="/posts/{{ $post->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger">
                            Delete 🗑️
                        </button>
                    </form>

                    <a href="/posts/{{ $post->id }}/edit" class="btn-primary">
                        Edit ✍️
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</body>

</html>
