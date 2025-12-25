<?php

namespace App\Filament\Filters;

use Filament\Forms\Components\Select;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class DateFilter
{
    public static function make(): Filter
    {
        return Filter::make('date_filter')
            ->schema([
                Select::make('preset')
                    ->label('Month or Date')
                    ->options([
                        'today' => 'Today',
                        'yesterday' => 'Yesterday',
                        'this_week' => 'This Week',
                        'last_week' => 'Last Week',
                        'this_month' => 'This Month',
                        'last_month' => 'Last Month',
                        'this_year' => 'This Year',
                        'custom' => 'Custom Range',
                    ])
                    ->reactive(),
                DatePicker::make('from_date')
                    ->label('From Date')
                    ->visible(fn($get) => $get('preset') === 'custom'),
                DatePicker::make('to_date')
                    ->label('To Date')
                    ->visible(fn($get) => $get('preset') === 'custom'),
            ])
            ->query(function (Builder $query, array $data): Builder {
                $preset = $data['preset'] ?? null;

                return match ($preset) {
                    'today' => $query->whereDate('created_at', Carbon::today()),
                    'yesterday' => $query->whereDate('created_at', Carbon::yesterday()),
                    'this_week' => $query->whereBetween('created_at', [
                        Carbon::now()->startOfWeek(),
                        Carbon::now()->endOfWeek()
                    ]),
                    'last_week' => $query->whereBetween('created_at', [
                        Carbon::now()->subWeek()->startOfWeek(),
                        Carbon::now()->subWeek()->endOfWeek()
                    ]),
                    'this_month' => $query->whereMonth('created_at', Carbon::now()->month)
                        ->whereYear('created_at', Carbon::now()->year),
                    'last_month' => $query->whereMonth('created_at', Carbon::now()->subMonth()->month)
                        ->whereYear('created_at', Carbon::now()->subMonth()->year),
                    'this_year' => $query->whereYear('created_at', Carbon::now()->year),
                    'custom' => $query
                        ->when($data['from_date'], fn($q, $date) => $q->whereDate('created_at', '>=', $date))
                        ->when($data['to_date'], fn($q, $date) => $q->whereDate('created_at', '<=', $date)),
                    default => $query,
                };
            })
            ->indicateUsing(function (array $data): array {
                $indicators = [];
                $preset = $data['preset'] ?? null;

                if ($preset && $preset !== 'custom') {
                    $indicators['preset'] = 'Created: ' . ucwords(str_replace('_', ' ', $preset));
                } elseif ($preset === 'custom') {
                    if ($data['from_date'] ?? null) {
                        $indicators['from_date'] = 'From: ' . Carbon::parse($data['from_date'])->toFormattedDateString();
                    }
                    if ($data['to_date'] ?? null) {
                        $indicators['to_date'] = 'Until: ' . Carbon::parse($data['to_date'])->toFormattedDateString();
                    }
                }

                return $indicators;
            });
    }
}
