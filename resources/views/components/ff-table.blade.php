@props([
    'headers' => [],
])

<div {{ $attributes->merge(['class' => 'bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden']) }}>
    @isset($tableHeader)
    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
        {{ $tableHeader }}
    </div>
    @endisset

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            @if(count($headers) > 0)
            <thead>
                <tr class="border-b border-slate-100 bg-slate-50">
                    @foreach($headers as $header)
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider whitespace-nowrap">
                        {{ $header }}
                    </th>
                    @endforeach
                </tr>
            </thead>
            @elseif(isset($thead))
            <thead class="border-b border-slate-100 bg-slate-50">
                {{ $thead }}
            </thead>
            @endif

            <tbody class="divide-y divide-slate-100">
                {{ $slot }}
            </tbody>
        </table>
    </div>

    @isset($tableFooter)
    <div class="px-6 py-3 border-t border-slate-100 bg-slate-50">
        {{ $tableFooter }}
    </div>
    @endisset
</div>
