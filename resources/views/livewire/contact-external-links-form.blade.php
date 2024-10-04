<div>
    @foreach ($external_link_types as $index => $external_link_type)
        <input
            type="hidden"
            name="external_links[{{ $index }}][external_link_type_id]"
            value="{{ $external_link_type->id }}">

        @if ($contact)
            <x-text-input
                type="url"
                title="{{ $external_link_type->name }} Link"
                name="external_links[{{ $index }}][url]"
                id="url-input"
                value="{{
                    old(
                        'external_links.'.$index.'.url',
                        $contact->external_links()
                            ->where('external_links.external_link_type_id', $external_link_type->id)
                            ->first()->url ?? null
                    )
                }}"
                />
        @else
            <x-text-input
                type="url"
                title="{{ $external_link_type->name }} Link"
                name="external_links[{{ $index }}][url]"
                id="url-input"
                value="{{ old('external_links.'.$index.'.url', null) }}"
                />
        @endif
    @endforeach
</div>
