<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center space-x-2">
                <x-heroicon-o-academic-cap class="w-5 h-5 text-primary-500" />
                <span>Prosedur Pelaksanaan Magang</span>
            </div>
        </x-slot>

        <div class="space-y-0">
            @foreach ($this->getStepsData() as $index => $step)
                <div class="relative flex items-start gap-4 group">
                    @if (!$loop->last)
                        <div class="absolute left-5 top-10 w-0.5 h-[calc(100%-0.5rem)]
                            {{ $step['completed'] ? 'bg-success-300' : 'bg-gray-200' }}
                            group-last:h-0"></div>
                    @endif

                    <div class="relative z-10 flex-shrink-0">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full text-sm font-bold border-2
                            {{ $step['completed'] ? 'bg-success-50 border-success-300 text-success-700' :
                               ($step['active'] ? 'bg-warning-50 border-warning-300 text-warning-700' :
                               'bg-gray-50 border-gray-200 text-gray-400') }}">
                            {{ $index + 1 }}
                            @if($step['completed'])
                                <x-heroicon-s-check class="absolute -right-1 -bottom-1 w-4 h-4 p-0.5 bg-success-500 text-white rounded-full border-2 border-white" />
                            @endif
                        </div>
                    </div>

                    <div class="flex-1 pb-6 pt-1">
                        <h3 class="flex items-center gap-2 text-base font-medium
                            {{ $step['completed'] ? 'text-success-800' :
                               ($step['active'] ? 'text-warning-800' : 'text-gray-500') }}">
                            @if($step['completed'])
                                <x-heroicon-s-check class="w-4 h-4 text-success-500" />
                            @endif
                            <a href="{{ $step['url'] }}"
                               class="{{ $step['completed'] || $step['active'] ? 'hover:underline hover:text-warning-600' : 'cursor-not-allowed' }}"
                               @if (!$step['completed'] && !$step['active']) title="Complete previous steps first" @endif>
                                {{ $step['title'] }}
                            </a>
                        </h3>

                        <p class="mt-1 text-sm
                            {{ $step['completed'] ? 'text-success-600' :
                               ($step['active'] ? 'text-warning-600' : 'text-gray-400') }}">
                            {{ $step['description'] }}
                        </p>

                        <div class="mt-2 flex items-center gap-2">
                            <x-filament::badge
                                color="{{ $step['completed'] ? 'success' : ($step['active'] ? 'warning' : 'gray') }}"
                                size="sm"
                                icon="{{ $step['completed'] ? 'heroicon-o-check-circle' :
                                      ($step['active'] ? 'heroicon-o-arrow-path' : 'heroicon-o-clock') }}"
                                class="inline-flex items-center"
                            >
                                {{ $step['completed'] ? 'Selesai' : ($step['active'] ? 'Sedang Berjalan' : 'Menunggu') }}
                            </x-filament::badge>

                            @if($step['completed'])
                                <span class="text-xs text-success-500">{{ $step['completed_at'] ?? '' }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4 pt-4 border-t border-gray-200">
            @php
                $completedCount = count(array_filter($this->getStepsData(), fn($step) => $step['completed']));
                $totalSteps = count($this->getStepsData());
                $percentage = round(($completedCount / $totalSteps) * 100);
            @endphp

            <div class="mb-2 flex justify-between text-sm font-medium text-gray-700">
                <span>Progress Keseluruhan</span>
                <span>{{ $percentage }}%</span>
            </div>

            <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div class="bg-primary-600 h-2.5 rounded-full transition-all duration-300"
                     style="width: {{ $percentage }}%"></div>
            </div>

            <div class="mt-1 text-xs text-gray-500 text-right">
                {{ $completedCount }} dari {{ $totalSteps }} langkah selesai
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
