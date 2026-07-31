@props(['data', 'fragment' => null])

<div class="mt-6 md:mt-12 flex justify-center w-full">
    @if($fragment)
        {{ $data->withQueryString()->fragment($fragment)->links() }}
    @else
        {{ $data->withQueryString()->links() }}
    @endif
</div>
