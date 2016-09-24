@foreach($data['project']->setup as $setup)
<div class="col-md-12">
    <p>
        <div class="col-md-9 text-muted">{{ $setup->description }}</div>
            <div class="col-md-3">
            @if($setup->is_dimmable == 1)
                @if($setup->is_on == 0)
                    <span class="switch-btn badge off" data-id="{{ $setup->setup_id }}" data-ipaddress="{{ $setup->is_ipaddress }}" data-status="20">0%</span>
                @else
                    <span class="switch-btn badge on" data-id="{{ $setup->setup_id }}"  data-ipaddress="{{ $setup->is_ipaddress }}" data-status="{{ $setup->is_on }}">{{ $setup->is_on }}</span>
                @endif
            @else
                @if($setup->is_on == 0)
                    <span class="switch-btn badge off" data-id="{{ $setup->setup_id }}" data-ipaddress="{{ $setup->is_ipaddress }}" data-status="1">&nbsp;</span>
                @else
                    <span class="switch-btn badge on" data-id="{{ $setup->setup_id }}" data-ipaddress="{{ $setup->is_ipaddress }}" data-status="0">&nbsp;</span>
                @endif
            @endif
        </div>
    </p>
</div>
@endforeach                   