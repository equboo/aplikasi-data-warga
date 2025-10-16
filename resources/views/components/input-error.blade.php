@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1']) }}>
        @foreach ((array) $messages as $message)
          @if(is_string($message))
        <li>{{ $message }}</li>  {{-- Output sebagai string jika memang string --}}
        @elseif(is_array($message))
        <li>Error: Array ditemukan - {{ json_encode($message) }}</li>  {{-- Konversi array ke JSON untuk debug --}}
          @else
        <li>{{ (string) $message }}</li>  {{-- Coba konversi ke string, jika memungkinkan --}}
        @endif
@endforeach
    </ul>
@endif
