<x-guest-layout>
    <div class="px-4 py-6">
        <dl class="grid grid-cols-1 rounded-lg bg-white dark:bg-gray-800 overflow-hidden shadow divide-y divide-gray-200 dark:divide-gray-900 md:grid-cols-3 md:divide-y-0 md:divide-x">
            <div class="px-4 py-5 sm:p-6">
                <dt class="text-base font-normal text-gray-900 dark:text-gray-200">
                    Temperature Change
                </dt>
                <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                    <div class="flex items-baseline text-2xl font-semibold text-indigo-600 dark:text-indigo-400">
                        {{ $todayTemp }}
                        <span class="ml-2 text-sm font-medium text-gray-500 dark:text-gray-400">
                            from {{ $yesterdayTemp }}
                        </span>
                    </div>

                    @if($todayTemp > $yesterdayTemp)
                    <div class="inline-flex items-baseline px-2.5 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800 md:mt-2 lg:mt-0">
                        <svg class="flex-shrink-0 self-center h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        {{ abs($todayTemp - $yesterdayTemp) }}
                    </div>
                    @else
                    <div class="inline-flex items-baseline px-2.5 py-0.5 rounded-full text-sm font-medium bg-red-100 text-red-800 md:mt-2 lg:mt-0">
                        <svg class="flex-shrink-0 self-center h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        {{ abs($todayTemp - $yesterdayTemp) }}
                    </div>
                    @endif
                </dd>
            </div>

            <div class="px-4 py-5 sm:p-6">
                <dt class="text-base font-normal text-gray-900 dark:text-gray-200">
                    Precipitation Change
                </dt>
                <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                    <div class="flex items-baseline text-2xl font-semibold text-indigo-600 dark:text-indigo-400">
                        {{ $todayWeather['main'] }}
                        <span class="ml-2 text-sm font-medium text-gray-500 dark:text-gray-400">
                            from {{ $yesterdayWeather['main'] }}
                        </span>
                    </div>
                </dd>
            </div>

            <div class="grid grid-cols-2 divide-x divide-gray-200 dark:divide-gray-900">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-base font-normal text-gray-900 dark:text-gray-200">
                        Joint Pain
                    </dt>
                    <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                        <div class="flex items-baseline text-2xl font-semibold text-indigo-600 dark:text-indigo-400">
                            {{ $jointPain ? 'Likely' : 'Not likely' }}
                        </div>
                    </dd>
                </div>
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-base font-normal text-gray-900 dark:text-gray-200">
                        Muscle Pain
                    </dt>
                    <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                        <div class="flex items-baseline text-2xl font-semibold text-indigo-600 dark:text-indigo-400">
                            {{ $musclePain ? 'Likely' : 'Not likely' }}
                        </div>
                    </dd>
                </div>
            </div>
        </dl>
    </div>
</x-guest-layout>
