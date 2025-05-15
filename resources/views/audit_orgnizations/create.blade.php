

    <form action="{{ route('organization.store') }}" method="POST">
        @csrf
        <input type="text" name="company_name" placeholder="company_name" required>
        <input type="text" name="short_name" placeholder="short_name" required>
        <input type="text" name="address" placeholder="address" required>
        <input type="text" name="com_reg_detail" placeholder="com_reg_detail" required>
        <input type="text" name="company_logo" placeholder="company_logo" required>

        <button type="submit">Create Post</button>
    </form>
