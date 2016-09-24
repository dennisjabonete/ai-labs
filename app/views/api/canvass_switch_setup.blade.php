@foreach($data['project']->coordinates as $cor)
    @if($cor->setup->is_dimmable == 1)
        @if($cor->setup->is_on == 0)
            <span style="position: absolute; bottom: {{ $cor->coordinates_x }}px; right: {{ $cor->coordinates_y }}px;" class="switch-btn badge off" data-id="{{ $cor->setup_id }}" data-ipaddress="{{ $cor->setup->is_ipaddress }}" data-status="20">0%</span>
        @else                
            <span style="position: absolute; bottom: {{ $cor->coordinates_x }}px; right: {{ $cor->coordinates_y }}px;" class="switch-btn badge on" data-id="{{ $cor->setup_id }}"  data-ipaddress="{{ $cor->setup->is_ipaddress }}" data-status="{{ $cor->setup->is_on }}">{{ $cor->setup->is_on }}</span>
        @endif
    @else
        @if($cor->setup->is_on == 0)
            <span style="position: absolute; bottom: {{ $cor->coordinates_x }}px; right: {{ $cor->coordinates_y }}px;" class="switch-btn badge off" data-id="{{ $cor->setup_id }}" data-ipaddress="{{ $cor->setup->is_ipaddress }}" data-status="1">&nbsp;</span>
        @else
            <span style="position: absolute; bottom: {{ $cor->coordinates_x }}px; right: {{ $cor->coordinates_y }}px;" class="switch-btn badge on" data-id="{{ $cor->setup_id }}" data-ipaddress="{{ $cor->setup->is_ipaddress }}" data-status="0">&nbsp;</span>
        @endif
    @endif
@endforeach                   