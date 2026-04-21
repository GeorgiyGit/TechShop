<nav class="stepper" aria-label="Checkout steps">
    @php
        $steps = [
            1 => 'Items',
            2 => 'Contact',
            3 => 'Delivery',
            4 => 'Payment',
        ];
    @endphp

    <ol class="stepper-list">
        @foreach ($steps as $number => $label)
            <li @class([
                'stepper-item',
                'active' => $currentStep === $number,
                'completed' => $currentStep > $number,
            ])>
                <span class="stepper-number">{{ $number }}</span>
                <span class="stepper-label">{{ $label }}</span>
            </li>

            @if ($number < count($steps))
                <li @class(['stepper-connector', 'active' => $currentStep > $number])></li>
            @endif
        @endforeach
    </ol>
</nav>
