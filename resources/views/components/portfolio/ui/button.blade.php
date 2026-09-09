@props([
    'href' => '#',
    'label',
    'variant' => 'primary', // primary | outline
    'icon' => null,         // icon name from x-portfolio.ui.icon
    'testid' => null,
    'magnetic' => true,
])

<a href="{{ $href }}"
   class="btn btn-{{ $variant }}"
   @if($testid) data-testid="{{ $testid }}" @endif
   @if($magnetic) data-magnetic @endif
>{{ $label }} @if($icon)<x-portfolio.ui.icon :name="$icon" />@endif</a>
