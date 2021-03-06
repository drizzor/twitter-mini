<x-app>
    <header class="mb-6 relative">

        <div class="relative">
            <img src="/images/default-profile-banner.jpg" alt="" class="mb-2">

            {{-- position: absolute;
            top: 47%;
            width: 150px;
            left: calc(50% - 75px); --}}
            <img src="{{ $user->avatar }}" alt="avatar" class="rounded-full mr-2 absolute bottom-0 transform -translate-x-1/2 translate-y-1/2" width="150px" style="left:50%">
        </div>        

        <div class="flex justify-between items-center mb-6">
            <div style="max-width:258px">
                <h2 class="font-bold text-2xl mb-0">{{ $user->name }}</h2>
                <p class="text-sm">Joined {{ $user->created_at->diffForHumans() }}</p>
            </div>

            <div class="flex">
                @can ('edit', $user)
                    <a href="{{ route('profile-edit', $user) }}" class="rounded-full border border-gray-300 py-2 px-4 text-black text-xs mr-2">
                        Edit Profile
                    </a>
                @endcan
                <x-follow-button :user="$user"></x-follow-button>                

            </div>
        </div>

        <p class="text-sm">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem autem quisquam animi obcaecati ab ipsam, eum fugit incidunt illo ex beatae commodi ipsa earum laborum exercitationem adipisci molestias veniam quidem!
        </p>      

    </header>

    @include('_timeline', [
        'tweets' => $tweets
    ])
</x-app>
    
    

