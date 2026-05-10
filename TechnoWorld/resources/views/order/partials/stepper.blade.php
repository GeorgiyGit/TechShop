@php
    $steps = [
        1 => 'Items',
        2 => 'Contact',
        3 => 'Delivery',
        4 => 'Payment',
    ];
@endphp

<nav class="stepper" aria-label="Checkout steps">
    <ol class="stepper-list">
        @foreach ($steps as $number => $label)
            @php
                $isCompleted = $currentStep > $number;
                $isActive = $currentStep === $number;
            @endphp

            <li @class(['stepper-item', 'completed' => $isCompleted, 'active' => $isActive])>
                <span class="stepper-number">
                    @if ($isCompleted)
                        <i class="bi bi-check-lg"></i>
                    @else
                        {{ $number }}
                    @endif
                </span>
                <span class="stepper-label">{{ $label }}</span>
            </li>

            @if (!$loop->last)
                <li @class(['stepper-connector', 'active' => $currentStep > $number])></li>
            @endif
        @endforeach
    </ol>
</nav>
