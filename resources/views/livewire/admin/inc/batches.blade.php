@if ($batches)
    <div class="col-12 col-lg-6">
        <div class="mb-3">
            <label for="" class="form-label">
                {{ __('transaction.specific_store_qty') }}
            </label>
            <select class="form-select" wire:model='product.item_batch_id'>
                <option value="">{{ __('btns.select') }}</option>
                @foreach ($batches as $batch)
                    @php
                        if (!isset($unit)) {
                            $unit = $batch->unit;
                        }
                    @endphp
                    @if ($unit->status == 'retail')
                        @php
                            $qty = floatval($batch->qty) * floatval($item->retail_count_for_wholesale);
                            $price = floatval($item->retail_count_for_wholesale) != 0 ? floatval($batch->unit_price) / floatval($item->retail_count_for_wholesale) : 0;
                        @endphp
                        @if ($price > 0)
                            <option value="{{ $batch->id }}" {{ $qty == 0 ? 'readony disabled' : '' }}>
                                {{ __('transaction.number') }} {{ $qty }} ({{ __('stock.unit') . ' : ' . $unit->name }})
                                - {{ __('stock.unit_price') . ' : ' . number_format($price, 0) }}
                            </option>
                        @endif
                    @else
                        <option value="{{ $batch->id }}" {{ $batch->qty == 0 ? 'readony disabled' : '' }}>
                            {{ __('transaction.number') }} {{ number_format($batch->qty, 0) }} ({{ __('stock.unit') }} : {{ $unit->name }})
                            {{ $batch->production_date ? __('transaction.production_date') . ' : ' . $batch->production_date : '' }}
                            - {{ __('stock.unit_price') . ' : ' . number_format($batch->unit_price, 0) }}
                        </option>
                    @endif
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('product.item_batch_id')" class="mt-2" />
        </div>
    </div>
@endif
