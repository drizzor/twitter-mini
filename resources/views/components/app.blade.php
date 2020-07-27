<x-master>
    <section class="px-8">
        <main class="container mx-auto">
             {{-- justify-center permet de faire en sorte d'avoir espace à gauche et à droite de l'écran équivalent -> sans ça sur certains écrans ont peut avoir l'impression que les éléments ne sont pas correctement centré --}}
            <div class="lg:flex lg:justify-center">
                {{-- le if nous évite un plantage sur la page de login/register. Les deux sides bar sont visible uniquement si connecté --}}
                @if(auth()->check())
                    <div class="lg:w-32">
                        @include ('_sidebar-links')
                    </div>
                @endif    
                <div class="lg:flex-1 lg:mx-10 lg:mb-10" style="max-width: 700px;">
                    {{ $slot }}
                </div>

                @if(auth()->check())
                    <div class="lg:w-1/6">
                        @include ('_friends-list')
                    </div>
                @endif  
            </div>
        </main>
    </section>  
</x-master>