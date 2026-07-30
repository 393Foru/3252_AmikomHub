@props(['items' => []])

<!-- Breadcrumb -->
<div class="mb-6 w-full animate-fade-in-down">
    <nav class="flex text-sm font-medium" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-2 flex-wrap">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="inline-flex items-center text-slate-500 hover:text-blue-600 transition-colors">
                    <i class="fas fa-home mr-2 text-xs"></i> Beranda
                </a>
            </li>
            
            @foreach($items as $item)
                <li>
                    <div class="flex items-center text-slate-400">
                        <i class="fas fa-chevron-right text-[10px] mx-2 opacity-50"></i>
                        @if(isset($item['url']) && !$loop->last)
                            <a href="{{ $item['url'] }}" class="text-slate-500 hover:text-blue-600 transition-colors">
                                {{ $item['label'] }}
                            </a>
                        @else
                            <span class="text-slate-600">{{ $item['label'] }}</span>
                        @endif
                    </div>
                </li>
            @endforeach
        </ol>
    </nav>
</div>

<style>
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
