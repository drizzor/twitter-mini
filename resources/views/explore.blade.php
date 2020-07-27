<x-app>
    @foreach ($users as $user)
        <a href="{{ route('profile', $user) }}">
            <div class="flex items-center mb-4">
                <img src="{{ $user->avatar }}" alt="{{ $user->username }}'s avatar'" width="60px" class="mr-4 rounded">
                <div>
                    <h4 class="font-bold">{{ '@' . $user->username }}</h4>
                </div>
            </div>        
        </a>            
    @endforeach
    
    {{ $users->links() }}

</x-app>