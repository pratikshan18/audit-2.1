<form method="POST" action="{{ route('login.action') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <input type="email" name="email" id="email" placeholder="email">
        </div>

        <!-- Password -->
        <div class="mt-4">
            <input type="password" name="password" id="password" placeholder="password">
        </div>
        <div class="flex items-center justify-end mt-4">    
           <button type="submit">login</button>
        </div>
    </form>