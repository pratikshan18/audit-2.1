
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<div>
    <h2>Create Admin</h2>
    <form action="{{ route('admin.store_admin') }}" method="POST">
        @csrf
        <label>Admin Name</label>
        <input type="text" name="name" placeholder="Name" required><br><br>
        <label>Admin Email</label>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <!-- <input type="password" name="password" placeholder="Password" required> -->
        <label>Name of Company</label>
        <select name="company_id" id="company_id" required>
            <option value="">Select Company</option>
            @foreach($companies as $company)
            <option value="{{ $company->id }}">{{ $company->company_name }}</option>
            @endforeach
        </select><br><br>
        <button type="submit">Create</button>
    </form>
</div>
