
    <form action="{{ route('organization.update', $audit_orgnizations->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="company_name" value="{{ $audit_orgnizations->company_name }}" >
         <input type="text" name="address" value="{{ $audit_orgnizations->address }}" >
       
        <button type="submit">Update Post</button>
    </form>

