<div {{ $attributes->merge(['class' => 'fi-in-tags-entry p-4 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800']) }}>  <!-- Rectangle container -->
    <label class="fi-in-entry-label text-sm font-medium text-gray-700 dark:text-gray-300">
        {{ $getLabel() }}
    </label>

    <div class="fi-in-tags-container flex flex-wrap gap-2 mt-2">
        @forelse ($getState() as $tag)
            <span class="fi-in-tag px-3 py-1 text-sm font-medium rounded-full {{ $tag === 'admin' ? 'bg-red-500 text-white' : ($tag === 'student' ? 'bg-blue-500 text-white' : 'bg-gray-500 text-white') }}">  <!-- Colored pills; customize colors per role -->
                {{ $tag }}
            </span>
        @empty
            <p class="text-gray-500 dark:text-gray-400">
                No roles assigned
            </p>
        @endforelse
    </div>
</div>