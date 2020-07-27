<x-app>
    <form method="POST" action="{{ route('profile-update', $user)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <label for="name" class="block mb-2 uppercase fontbold text-xs text-gray-700">Name</label>
            <input type="text" name="name" id="name" class="border border-gray-400 p-2 w-full" 
                value="{{ (!old('name'))? $user->name : old('name') }}" required>

            @error('name')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        

        <div class="mb-6">
            <label for="username" class="block mb-2 uppercase fontbold text-xs text-gray-700">Username</label>
            <input type="text" name="username" id="username" class="border border-gray-400 p-2 w-full" 
                value="{{ (!old('username'))? $user->username : old('username') }}" required>

            @error('username')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>       

        <div class="mb-6">
            <label for="avatar" class="block mb-2 uppercase fontbold text-xs text-gray-700">Avatar</label>
            <div class="flex">                
                <input type="file" name="avatar" id="avatar" class="border border-gray-400 p-2 w-full">
                <img src="{{ $user->avatar }}" alt="your avatar" width="40px">
                
                @error('avatar')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>                          
        </div>  
        
        <div class="mb-6">
            <label for="email" class="block mb-2 uppercase fontbold text-xs text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="border border-gray-400 p-2 w-full" 
                value="{{ (!old('email')) ? $user->email : old('email') }}" required>

            @error('email')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password" class="block mb-2 uppercase fontbold text-xs text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="border border-gray-400 p-2 w-full" required>

            @error('password')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password_confirmation" class="block mb-2 uppercase fontbold text-xs text-gray-700">Password Confirmation</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="border border-gray-400 p-2 w-full" required>
            
            @error('password_confirmation')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6 flex justify-between">
            <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">Submit</button>
            
            <button class="bg-red-400 text-white rounded py-2 px-4 hover:bg-red-500"> 
                <a href="{{ route('profile', $user) }}">Cancel</a>    
            </button>
        </div>

    </form>
</x-app>