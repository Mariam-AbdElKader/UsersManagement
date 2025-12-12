<x-admin.layout title="Edit Comment #{{ $comment->id }} for {{ $post->title }}">
<x-admin.comments.edit :post="$post" :comment="$comment" />
</x-admin.layout>
