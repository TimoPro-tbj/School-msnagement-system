<x-layout title="Admin Actions">
    <div class="actions-header">
        <h2 class="actions-title">⚡ Admin Actions ({{ $count }})</h2>

        <!-- Date Filter -->
        <form method="GET" action="{{ route('admin.actions.index') }}" class="filter-form">
            <label for="date">Filter by Date:</label>
            <input type="date" name="date" id="date" value="{{ request('date') }}">
            <button type="submit" class="filter-btn">Apply</button>
        </form>
    </div>

    <!-- Actions Table -->
    <div class="actions-table-wrapper">
        <table class="actions-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Action</th>
                    <th>Admin</th>
                </tr>
            </thead>
            <tbody>
                @foreach($actions as $action)
                    <tr>
                        <td>{{ $action->created_at->format('d M Y H:i') }}</td>
                        <td>{{ $action->action }}</td>
                        <td>{{ $action->admin->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination">
        {{ $actions->links() }}
    </div>
</x-layout>
