<li class="{{ request()->url() == $link ? 'active-item' : '' }}">
    <a href="{{ $link }}">
      <i class="{{ $icon }}"></i>
      <span>{{ $slot }}</span>
    </a>
</li>
