  <a href="{{ route('organization.create') }}">Create New Post</a>
    <ul>
        
        @foreach ($audit_orgnizations as $audit_orgnizations_data)
            <li>
                {{ $audit_orgnizations_data->short_name	 }}
                <a href="{{ route('organization.show', $audit_orgnizations_data->id) }}">View</a>
                <a href="{{ route('organization.edit', $audit_orgnizations_data->id) }}">Edit</a>
                <form action="{{ route('organization.destroy', $audit_orgnizations_data->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
