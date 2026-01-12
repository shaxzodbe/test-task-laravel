<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lead Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-4">Info</h3>
                    <p><strong>Name:</strong> {{ $lead->full_name }}</p>
                    <p><strong>Phone:</strong> {{ $lead->phone }}</p>
                    <p><strong>Status:</strong> {{ ucfirst(str_replace('_', ' ', $lead->status)) }}</p>
                    <p><strong>Note:</strong> {{ $lead->note }}</p>
                    <div class="mt-4">
                        <a href="{{ route('leads.edit', $lead) }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit Lead</a>
                        <a href="{{ route('leads.index') }}" class="ml-2 text-gray-500 hover:text-gray-700">Back to
                            List</a>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-4">Tasks</h3>

                    <!-- Add Task Form -->
                    <form method="POST" action="{{ route('leads.tasks.store', $lead) }}"
                        class="mb-6 border-b pb-6 dark:border-gray-700">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 place-items-end">
                            <div class="w-full">
                                <label
                                    class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Title</label>
                                <input type="text" name="title"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:text-white"
                                    required minlength="3">
                            </div>
                            <div class="w-full">
                                <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Due
                                    Date</label>
                                <input type="datetime-local" name="due_at"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:text-white">
                            </div>
                            <div class="w-full">
                                <button type="submit"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded w-full md:w-auto">Add
                                    Task</button>
                            </div>
                        </div>
                    </form>

                    <!-- Tasks List -->
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Done?</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Title</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Due At</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($lead->tasks as $task)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form method="POST" action="{{ route('tasks.update', $task) }}">
                                            @csrf
                                            @method('PUT')
                                            <!-- Hidden fields to keep other values if simple toggle isn't enough, but assuming partial update works if TaskRequest allows optional fields properly, or pass all. -->
                                            <!-- Actually, TaskRequest requires title if present? Or validates present. -->
                                            <!-- The update request validates rules. If I only send is_done, validation might fail if other fields are required. -->
                                            <!-- TaskRequest: 'title' => 'required'. So I must send title. -->
                                            <!-- Solution: Use a javascript toggle or send full form. Simplest: Mini form for checkbox that submits on change, including title hidden. -->
                                            <input type="hidden" name="title" value="{{ $task->title }}">
                                            @if($task->due_at) <input type="hidden" name="due_at"
                                            value="{{ $task->due_at->format('Y-m-d\TH:i') }}"> @endif

                                            <input type="hidden" name="is_done" value="0">
                                            <input type="checkbox" name="is_done" value="1" {{ $task->is_done ? 'checked' : '' }} onchange="this.form.submit()"
                                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                        </form>
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap {{ $task->is_done ? 'line-through text-gray-500' : '' }}">
                                        {{ $task->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $task->due_at ? $task->due_at->format('Y-m-d H:i') : '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <!-- Could add edit/delete task here -->
                                        -
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>