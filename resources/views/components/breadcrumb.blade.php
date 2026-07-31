@props(['items' => []])

<!-- Breadcrumb -->
<div class="mb-4 sm:mb-6 w-full animate-fade-in-down">
    <nav class="flex text-[10px] sm:text-xs font-medium overflow-x-auto hide-scrollbar pb-1" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-2 whitespace-nowrap">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="inline-flex items-center text-slate-500 hover:text-blue-600 transition-colors">
                    <i class="fas fa-home mr-1.5 sm:mr-2 text-[10px] sm:text-xs"></i> Beranda
                </a>
            </li>
            
            @foreach($items as $item)
                <li>
                    <div class="flex items-center text-slate-400">
                        <i class="fas fa-chevron-right text-[8px] sm:text-[10px] mx-1.5 sm:mx-2 opacity-50"></i>
                        @if(isset($item['url']) && !$loop->last)
                            <a href="{{ $item['url'] }}" class="text-slate-500 hover:text-blue-600 transition-colors">
                                {{ $item['label'] ?? $item['name'] }}
                            </a>
                        @else
                            <span class="text-slate-700 font-semibold truncate max-w-[200px] sm:max-w-none">{{ $item['label'] ?? $item['name'] }}</span>
                        @endif
                    </div>
                </li>
            @endforeach
        </ol>
    </nav>
</div>

<style>
    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .hide-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .animate-fade-in-down {
        animation: fadeInDown 0.5s ease-out forwards;
    }
</style>
