<div class="flex p-4 {{ $loop->last ? '' : 'border-b border-b-gray-400' }}">
    {{-- flex-shrink-0 : afin que flex n'adapte pas la taille de l'image, je veux la garder à 50px --}}
    <div class="mr-2 flex-shrink-0"> 
        {{-- Ici je ne suis pas obligé de précisé le champ "username" de user Laravel sais quoiquoi chercher grâce à notre méthode dans le model user qui demande de pointer username. Par défaut Laravel récupère l'id --}}
        <a href="{{ route('profile', $tweet->user) }}">
            <img src="{{ $tweet->user->avatar }}" alt="avatar" class="rounded-full mr-2" width="50" height="50">
        </a>        
    </div>

    <div>
        <h5 class="font-bold mb-4"> 
            <a href="{{ route('profile', $tweet->user) }}">
                {{ $tweet->user->name }}
            </a>
        </h5>
        <p class="text-sm mb-3"> {{ $tweet->body }} </p>
        
        <x-like-button :tweet="$tweet"></x-like-button>
        
    </div>
</div>